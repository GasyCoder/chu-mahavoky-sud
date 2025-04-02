<div class="space-y-6">
    <!-- Messages de notification -->
    @if (session('message'))
        <div class="p-4 text-white rounded-lg bg-turquoise">
            {{ session('message') }}
        </div>
    @endif
    
    @if (session('error'))
        <div class="p-4 text-white rounded-lg bg-pink">
            {{ session('error') }}
        </div>
    @endif

    <!-- Liste des services -->
    <div class="overflow-hidden bg-white rounded-lg shadow">
        <!-- En-tête avec titre et barre de recherche -->
        <div class="flex flex-col gap-3 p-4 border-b bg-gray-light border-gray sm:flex-row sm:justify-between sm:items-center">
            <h2 class="text-lg font-semibold text-dark">Liste des services</h2>
            
            <!-- Barre de recherche -->
            <div class="w-full sm:w-64 lg:w-80">
                <div class="relative text-gray-600">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="text-gray-400 fas fa-search"></i>
                    </span>
                    <input 
                        type="text" 
                        wire:model.live="searchTerm" 
                        class="w-full py-2 pl-10 pr-4 text-sm bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-turquoise focus:border-turquoise"
                        placeholder="Rechercher un service..."
                    >
                    @if(!empty($searchTerm))
                        <button 
                            wire:click="resetSearch" 
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-light">
                        <!-- En-tête Nom - Triable -->
                        <th class="px-4 py-2 text-sm font-medium text-left text-dark">
                            <button 
                                wire:click="sortBy('name')" 
                                class="flex items-center text-left focus:outline-none"
                            >
                                Nom
                                @if($sortField === 'name')
                                    <span class="ml-1 text-xs">
                                        @if($sortDirection === 'asc')
                                            <i class="fas fa-sort-up"></i>
                                        @else
                                            <i class="fas fa-sort-down"></i>
                                        @endif
                                    </span>
                                @else
                                    <span class="ml-1 text-xs text-gray-400">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                @endif
                            </button>
                        </th>
                        
                        <!-- En-tête Catégorie - Triable -->
                        <th class="px-4 py-2 text-sm font-medium text-left text-dark">
                            <button 
                                wire:click="sortBy('category_id')" 
                                class="flex items-center text-left focus:outline-none"
                            >
                                Catégorie
                                @if($sortField === 'category_id')
                                    <span class="ml-1 text-xs">
                                        @if($sortDirection === 'asc')
                                            <i class="fas fa-sort-up"></i>
                                        @else
                                            <i class="fas fa-sort-down"></i>
                                        @endif
                                    </span>
                                @else
                                    <span class="ml-1 text-xs text-gray-400">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                @endif
                            </button>
                        </th>
                        
                        <!-- En-tête Description - Non triable -->
                        <th class="px-4 py-2 text-sm font-medium text-left text-dark">
                            Description
                        </th>
                        
                        <!-- En-tête Contact - Non triable -->
                        <th class="px-4 py-2 text-sm font-medium text-left text-dark">
                            Contact
                        </th>
                        
                        <!-- En-tête Actif - Triable -->
                        <th class="px-4 py-2 text-sm font-medium text-left text-dark">
                            <button 
                                wire:click="sortBy('active')" 
                                class="flex items-center text-left focus:outline-none"
                            >
                                Statut
                                @if($sortField === 'active')
                                    <span class="ml-1 text-xs">
                                        @if($sortDirection === 'asc')
                                            <i class="fas fa-sort-up"></i>
                                        @else
                                            <i class="fas fa-sort-down"></i>
                                        @endif
                                    </span>
                                @else
                                    <span class="ml-1 text-xs text-gray-400">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                @endif
                            </button>
                        </th>
                        
                        <!-- En-tête Actions - Non triable -->
                        <th class="px-4 py-2 text-sm font-medium text-left text-dark">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                        <tr class="border-t border-gray hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm text-dark">
                                <div class="flex items-center">
                                    @if($service->image)
                                        <div class="flex-shrink-0 w-8 h-8 mr-3">
                                            <img class="object-cover w-8 h-8 rounded-full" src="{{ asset($service->image) }}" alt="{{ $service->name }}">
                                        </div>
                                    @elseif($service->icon)
                                        <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 mr-3 bg-gray-100 rounded-full">
                                            <i class="{{ $service->icon }} text-turquoise"></i>
                                        </div>
                                    @endif
                                    <span class="font-medium">{{ $service->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-2 text-sm text-dark">
                                <span class="px-2 py-1 text-xs text-purple-800 bg-purple-100 rounded-full">
                                    {{ $service->category->name }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-sm text-dark">{{ Str::limit($service->short_description, 50) }}</td>
                            <td class="px-4 py-2 text-sm text-dark">
                                @if($service->phone)
                                    <div class="flex items-center text-xs">
                                        <i class="mr-1 text-gray-400 fas fa-phone-alt"></i>
                                        {{ $service->phone }}
                                    </div>
                                @endif
                                @if($service->email)
                                    <div class="flex items-center mt-1 text-xs">
                                        <i class="mr-1 text-gray-400 fas fa-envelope"></i>
                                        {{ $service->email }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-sm text-dark">
                                <span class="inline-flex items-center px-2 py-1 text-xs rounded-full {{ $service->active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    <i class="fas {{ $service->active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                    {{ $service->active ? 'Actif' : 'Inactif' }}
                                </span>
                            </td>
                            <td class="flex gap-2 px-4 py-2 text-sm">
                                <button 
                                    wire:click="openEditModal({{ $service->id }})" 
                                    class="px-2.5 py-1 bg-purple text-white rounded-lg hover:bg-purple-dark transition"
                                >
                                    <i class="fas fa-edit"></i> 
                                </button>
                                <button 
                                    wire:click="deleteService({{ $service->id }})" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce service ?')" 
                                    class="px-2.5 py-1 bg-pink text-white rounded-lg hover:bg-pink-dark transition"
                                >
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-sm text-center text-dark">
                                <div class="flex flex-col items-center justify-center py-4">
                                    @if(!empty($searchTerm) || !empty($categoryFilter) || $statusFilter !== null || $sortField !== 'name')
                                        <div class="mb-3 text-4xl text-gray-400">
                                            <i class="fas fa-search"></i>
                                        </div>
                                        <p class="mb-2 text-gray-500">Aucun service ne correspond à votre recherche</p>
                                        <button 
                                            wire:click="resetFilters" 
                                            class="mt-2 text-sm px-3 py-1.5 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition"
                                        >
                                            <i class="mr-1 fas fa-undo-alt"></i> Réinitialiser les filtres
                                        </button>
                                    @else
                                        <div class="mb-4 text-5xl text-gray-300">
                                            <i class="fas fa-inbox"></i>
                                        </div>
                                        <p class="text-gray-500">Aucun service trouvé.</p>
                                        <button 
                                            wire:click="createNewService" 
                                            class="px-4 py-2 mt-3 text-sm text-white transition rounded-lg bg-turquoise hover:bg-turquoise-dark"
                                        >
                                            <i class="mr-1 fas fa-plus-circle"></i> Ajouter un service
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="p-4 border-t border-gray">
            {{ $services->links() }}
        </div>
    </div>

    <!-- Modal d'édition -->
    @include('livewire.admin.modal-service')
</div>