<div>
    <div class="p-6 bg-white rounded-lg shadow-md">

        <div class="flex flex-col justify-between mb-4 space-y-4 md:flex-row md:space-y-0">
            <!-- Recherche -->
            <div class="flex items-center">
                <div class="relative">
                    <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="Rechercher..." class="w-full px-4 py-2 border border-gray-300 rounded-l-md md:w-64">
                    @if($searchTerm)
                    <button wire:click="resetSearch" class="absolute top-0 right-0 h-full px-3 text-gray-600 hover:text-gray-800">
                        <i class="fas fa-times"></i>
                    </button>
                    @endif
                </div>
                <button wire:click="$refresh" class="px-4 py-2 bg-gray-100 border border-l-0 border-gray-300 hover:bg-gray-200 rounded-r-md">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
            
            <!-- Filtres -->
            <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2">
                <!-- Filtre de catégorie -->
                <select wire:model="categoryFilter" class="px-4 py-2 border border-gray-300 rounded-md">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                
                <!-- Filtre de statut -->
                <select wire:model="statusFilter" class="px-4 py-2 border border-gray-300 rounded-md">
                    <option value="">Tous les statuts</option>
                    <option value="1">Actif</option>
                    <option value="0">Inactif</option>
                </select>
                
                <!-- Bouton de réinitialisation des filtres -->
                <button wire:click="resetFilters" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                    <i class="mr-1 fas fa-filter-circle-xmark"></i> Réinitialiser
                </button>
            </div>
        </div>
        
        <!-- Tableau des services -->
        <div class="mb-6 overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 border-b cursor-pointer" wire:click="sortBy('name')">
                            <div class="flex items-center">
                                Nom
                                @if($sortField === 'name')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                @endif
                            </div>
                        </th>
                        <th class="px-4 py-3 border-b cursor-pointer" wire:click="sortBy('category_id')">
                            <div class="flex items-center">
                                Catégorie
                                @if($sortField === 'category_id')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                @endif
                            </div>
                        </th>
                        {{-- <th class="px-4 py-3 border-b">Description</th> --}}
                        <th class="px-4 py-3 border-b">Équipe</th>
                        <th class="px-4 py-3 border-b cursor-pointer" wire:click="sortBy('active')">
                            <div class="flex items-center">
                                Statut
                                @if($sortField === 'active')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                @endif
                            </div>
                        </th>
                        <th class="px-4 py-3 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 border-b">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-gray-100 rounded-md text-turquoise">
                                    <i class="{{ $service->icon ?: 'fas fa-user-tie' }} text-lg"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium">{{ $service->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $service->phone }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 border-b">
                            <span class="px-2 py-1 text-xs rounded-full bg-turquoise/10 text-turquoise-800">
                                {{ $service->category->name ?? 'Non catégorisé' }}
                            </span>
                        </td>
                        {{-- <td class="px-4 py-3 border-b">
                            <p class="max-w-xs text-sm truncate">{{ $service->short_description }}</p>
                        </td> --}}
                        <td class="px-4 py-3 border-b">
                            <div class="flex flex-col">
                                @if(isset($service->team_members['leader']['name']) && $service->team_members['leader']['name'])
                                <p class="text-sm font-medium">Chef: {{ $service->team_members['leader']['name'] }}</p>
                                @else
                                <p class="text-sm italic text-gray-500">Aucun chef d'équipe</p>
                                @endif
                                
                                @if(isset($service->team_members['members']) && count($service->team_members['members']) > 0)
                                <p class="text-xs text-gray-500">{{ count($service->team_members['members']) }} membre(s)</p>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3 border-b">
                            <span class="px-2 py-1 {{ $service->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-full text-xs">
                                {{ $service->active ? 'Actif' : 'Inactif' }}
                            </span>
                            
                            @if($service->featured)
                            <span class="px-2 py-1 ml-1 text-xs text-yellow-800 bg-yellow-100 rounded-full">
                                Mis en avant
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 border-b">
                            <div class="flex space-x-2">
                                <button wire:click="openEditModal({{ $service->id }})" class="px-2.5 py-1 bg-purple text-white rounded-lg hover:bg-purple-dark transition">
                                    <i class="fas fa-edit"></i>
                                </button>
                                
                                <button 
                                    wire:click="deleteService({{ $service->id }})"
                                    wire:confirm="Êtes-vous sûr de vouloir supprimer ce service ? Cette action est irréversible."
                                    class="px-2.5 py-1 bg-pink text-white rounded-lg hover:bg-pink-dark transition"
                                >
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-6 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="mt-2">Aucun service administratif trouvé</p>
                                <button wire:click="resetFilters" class="mt-2 text-sm text-turquoise hover:text-turquoise-dark">
                                    Réinitialiser les filtres
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="mt-4">
            {{ $services->links() }}
        </div>
    </div>
    
    <!-- Modal pour éditer/créer un service -->
    @include('livewire.admin.modal-service')
</div>