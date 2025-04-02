<div>
    {{-- En-tête de la page --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-dark">Gestion des actualités</h2>
        <button wire:click="create" class="px-4 py-2 bg-purple text-white rounded-lg hover:bg-purple-dark transition-colors">
            <i class="fas fa-plus mr-2"></i> Nouvel article
        </button>
    </div>

    {{-- Message de confirmation --}}
    @if (session()->has('message'))
        <div class="bg-turquoise text-white p-3 rounded-lg mb-6">
            {{ session('message') }}
        </div>
    @endif

    {{-- Filtres de recherche --}}
    <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="col-span-1 md:col-span-2">
                <label for="search" class="block text-sm font-medium text-dark mb-1">Recherche</label>
                <input wire:model.live.debounce.300ms="search" type="text" id="search" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50" placeholder="Rechercher un article...">
            </div>
            <div>
                <label for="category_filter" class="block text-sm font-medium text-dark mb-1">Catégorie</label>
                <select wire:model.live="category_filter" id="category_filter" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="status_filter" class="block text-sm font-medium text-dark mb-1">Statut</label>
                <select wire:model.live="status_filter" id="status_filter" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                    <option value="">Tous les statuts</option>
                    @foreach($statuses as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- Tableau des articles --}}
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-light text-dark">
                        <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" wire:click="sortBy('title')">
                            Titre
                            @if($sortField === 'title')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                            @endif
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Catégorie</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" wire:click="sortBy('published_at')">
                            Date de publication
                            @if($sortField === 'published_at')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                            @endif
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Statut</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">À la une</th>
                        <th class="px-4 py-3 text-right text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray">
                    @forelse($blogs as $blog)
                        <tr class="hover:bg-gray-light transition-colors">
                            <td class="px-4 py-3 text-sm">
                                <div class="flex items-center">
                                    @if($blog->image)
                                        <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="w-10 h-10 object-cover rounded-md mr-3">
                                    @endif
                                    <span class="font-medium">{{ $blog->title }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-{{ $blog->category_color }} text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        {!! $blog->category_icon !!}
                                    </svg>
                                    {{ $blog->category }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $blog->published_at ? $blog->published_at->format('d/m/Y H:i') : 'Non publié' }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @if($blog->status === \App\Models\Blog::STATUS_PUBLISHED)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-turquoise text-white">Publié</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-dark text-white">Brouillon</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                @if($blog->is_featured)
                                    <i class="fas fa-star text-purple"></i>
                                @else
                                    <i class="far fa-star text-gray-dark"></i>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-right">
                                <button wire:click="edit({{ $blog->id }})" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button wire:click="confirmDelete({{ $blog->id }})" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-dark">
                                Aucun article trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="px-4 py-3 bg-white border-t border-gray">
            <div class="flex flex-col sm:flex-row justify-between items-center">
                <div class="mb-4 sm:mb-0">
                    <select wire:model.live="perPage" class="rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                        <option value="10">10 par page</option>
                        <option value="25">25 par page</option>
                        <option value="50">50 par page</option>
                        <option value="100">100 par page</option>
                    </select>
                </div>
                {{ $blogs->links() }}
            </div>
        </div>
    </div>

    {{-- Modal pour créer/éditer un article --}}
    @if($isModalOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-dark bg-opacity-50 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-xl max-w-3xl w-full mx-4 my-6 max-h-[90vh] overflow-y-auto">
                <div class="px-6 py-4 border-b border-gray">
                    <h3 class="text-xl font-semibold text-dark">
                        {{ $blog_id ? 'Modifier l\'article' : 'Nouvel article' }}
                    </h3>
                </div>

                <form wire:submit.prevent="store">
                    <div class="px-6 py-4 space-y-4">
                        {{-- Titre --}}
                        <div>
                            <label for="title" class="block text-sm font-medium text-dark mb-1">Titre *</label>
                            <input wire:model="title" type="text" id="title" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50" required>
                            @error('title') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- Slug --}}
                        <div>
                            <label for="slug" class="block text-sm font-medium text-dark mb-1">Slug (laissez vide pour génération automatique)</label>
                            <input wire:model="slug" type="text" id="slug" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                            @error('slug') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- Extrait --}}
                        <div>
                            <label for="excerpt" class="block text-sm font-medium text-dark mb-1">Extrait (résumé court)</label>
                            <textarea wire:model="excerpt" id="excerpt" rows="2" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50"></textarea>
                            @error('excerpt') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- Contenu --}}
                        <div>
                            <label for="content" class="block text-sm font-medium text-dark mb-1">Contenu *</label>
                            <textarea wire:model="content" id="content" rows="6" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50"></textarea>
                            @error('content') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- Image --}}
                        <div>
                            <label for="temp_image" class="block text-sm font-medium text-dark mb-1">Image</label>
                            @if($image && !$temp_image)
                                <div class="mb-2 flex items-center">
                                    <img src="{{ asset('storage/' . $image) }}" alt="Image actuelle" class="w-32 h-20 object-cover rounded-md">
                                    <button type="button" wire:click="$set('image', null)" class="ml-2 text-red-600 hover:text-red-800">
                                        <i class="fas fa-times"></i> Supprimer
                                    </button>
                                </div>
                            @endif
                            <input wire:model="temp_image" type="file" id="temp_image" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                            @error('temp_image') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            {{-- Catégorie --}}
                            <div>
                                <label for="category" class="block text-sm font-medium text-dark mb-1">Catégorie *</label>
                                <select wire:model="category" id="category" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50" required>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}">{{ $cat }}</option>
                                    @endforeach
                                </select>
                                @error('category') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- Statut --}}
                            <div>
                                <label for="status" class="block text-sm font-medium text-dark mb-1">Statut *</label>
                                <select wire:model="status" id="status" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50" required>
                                    @foreach($statuses as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('status') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- Date de publication --}}
                            <div>
                                <label for="published_at" class="block text-sm font-medium text-dark mb-1">Date de publication</label>
                                <input wire:model="published_at" type="datetime-local" id="published_at" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                                @error('published_at') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Mise en avant --}}
                        <div class="flex items-center">
                            <input wire:model="is_featured" type="checkbox" id="is_featured" class="rounded border-gray text-purple focus:ring-purple">
                            <label for="is_featured" class="ml-2 text-sm text-dark">Mettre à la une sur la page d'accueil</label>
                            @error('is_featured') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-light flex justify-end space-x-2">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-dark text-white rounded-lg hover:bg-black transition-colors">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 bg-purple text-white rounded-lg hover:bg-purple-dark transition-colors">
                            {{ $blog_id ? 'Mettre à jour' : 'Enregistrer' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Modal de confirmation de suppression --}}
    @if($confirmingItemDeletion)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-dark bg-opacity-50 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
                <div class="px-6 py-4 border-b border-gray">
                    <h3 class="text-xl font-semibold text-dark">Confirmer la suppression</h3>
                </div>

                <div class="px-6 py-4">
                    <p class="text-gray-dark">Êtes-vous sûr de vouloir supprimer cet article ? Cette action est irréversible.</p>
                </div>

                <div class="px-6 py-4 bg-gray-light flex justify-end space-x-2">
                    <button type="button" wire:click="cancelDelete" class="px-4 py-2 bg-gray-dark text-white rounded-lg hover:bg-black transition-colors">
                        Annuler
                    </button>
                    <button type="button" wire:click="delete" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        Supprimer
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
