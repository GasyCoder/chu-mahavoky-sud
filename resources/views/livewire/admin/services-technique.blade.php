<div class="space-y-6">
    <!-- Messages de notification -->
    @if (session('success') || session('message'))
        <div class="p-4 text-white rounded-lg bg-turquoise">
            {{ session('success') ?? session('message') }}
        </div>
    @endif

    @if (session('error'))
        <div class="p-4 text-white rounded-lg bg-pink">
            {{ session('error') }}
        </div>
    @endif

    <div class="p-6 bg-white rounded-lg shadow-md">
        <!-- En-tête avec le titre et bouton d'ajout -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-purple">{{ $pageTitle ?? 'Gestion des Services Techniques' }}</h2>
            <button
                wire:click="createNewService"
                class="px-4 py-2 text-white transition-colors rounded-md hover:bg-purple-dark bg-purple">
                <i class="mr-1 fas fa-plus"></i> Ajouter un service technique
            </button>
        </div>

        <div class="flex flex-col justify-between mb-4 space-y-4 md:flex-row md:space-y-0">
            <!-- Recherche -->
            <div class="flex items-center">
                <div class="relative">
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="searchTerm"
                        placeholder="Rechercher..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-l-md md:w-64 focus:border-purple focus:ring-purple">
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

        </div>

        <!-- Tableau des services -->
        <div class="mb-6 overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="text-white bg-purple">
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
                        <th class="px-4 py-3 border-b">Major</th>
                        <th class="px-4 py-3 border-b cursor-pointer" wire:click="sortBy('active')">
                            <div class="flex items-center">
                                Statut
                                @if($sortField === 'active')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                @endif
                            </div>
                        </th>
                        <th class="px-4 py-3 text-center border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 border-b">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-white rounded-md bg-purple-light">
                                    <i class="{{ $service->icon ?: 'fas fa-stethoscope' }} text-lg"></i>

                                </div>
                                <div class="ml-3">
                                    <p class="font-medium">{{ $service->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $service->phone }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 border-b">
                            <span class="px-2 py-1 text-xs text-white rounded-full bg-purple-light">
                                {{ $service->category->name ?? 'Non catégorisé' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 border-b">
                            <div class="flex flex-col">
                                @php
                                    $team = is_array($service->team_members) ? $service->team_members : json_decode($service->team_members, true);
                                    $leader = $team['leader'] ?? null;
                                    $members = $team['members'] ?? [];
                                @endphp

                                @if(isset($leader['name']) && $leader['name'])
                                <p class="text-sm font-medium">Chef: {{ $leader['name'] }}</p>
                                @else
                                <p class="text-sm italic text-gray-500">Aucun chef d'équipe</p>
                                @endif

                                @if(is_array($members) && count($members) > 0)
                                <p class="text-xs text-gray-500">{{ count($members) }} membre(s)</p>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3 border-b">
                            <div>
                                <span class="px-2 py-1 {{ $service->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-full text-xs">
                                    {{ $service->active ? 'Actif' : 'Inactif' }}
                                </span>

                                @if($service->featured)
                                <span class="px-2 py-1 ml-1 text-xs text-yellow-800 bg-yellow-100 rounded-full">
                                    Mis en avant
                                </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center border-b">
                            <div class="flex justify-center space-x-2">
                                <button
                                    wire:click="editService({{ $service->id }})"
                                    class="px-2.5 py-1 bg-purple text-white rounded-lg hover:bg-purple-dark transition"
                                    title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button
                                    wire:click="confirmDeleteService({{ $service->id }})"
                                    wire:confirm="Êtes-vous sûr de vouloir supprimer ce service technique ? Cette action est irréversible."
                                    class="px-2.5 py-1 bg-pink text-white rounded-lg hover:bg-pink-dark transition"
                                    title="Supprimer">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="mt-2">Aucun service technique trouvé</p>
                                <button wire:click="resetFilters" class="mt-2 text-sm text-purple hover:text-purple-dark">
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

    <!-- Inclusion du modal d'édition -->
    @include('livewire.admin.modal-service')
</div>
