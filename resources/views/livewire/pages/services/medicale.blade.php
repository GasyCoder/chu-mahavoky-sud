<!-- Contenu des services médicaux avec design amélioré -->
<div id="content-medical" class="tab-content {{ $activeTab === 'medical' ? '' : 'hidden' }}">
    <div class="mb-5 text-center" data-aos="fade-up" data-aos-duration="1000">
        <h2 class="relative inline-block mb-6 text-xl font-bold text-dark">
            Services Médicaux
            <span class="absolute bottom-0 w-20 h-1 transform -translate-x-1/2 rounded left-1/2 bg-purple"></span>
        </h2>
        <p class="max-w-xl mx-auto text-sm text-gray-dark md:text-base">
            Le CHU Mahavoky Atsimo offre une large gamme de services médicaux de pointe, assurés par des médecins spécialistes et des équipes soignantes hautement qualifiées.
        </p>
    </div>

    <!-- Barre de recherche Livewire corrigée -->
    <div class="relative flex items-center justify-between mb-5" data-aos="fade-up" data-aos-duration="800">
        <!-- Zone de recherche avec animation et style cohérent -->
        <div class="relative w-full mr-4 md:w-80">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-search text-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }} opacity-60"></i>
            </div>
            <!-- Utilisation de wire:model.live.debounce pour la recherche en temps réel -->
            <input 
                wire:model.live="searchQuery" 
                type="text" 
                placeholder="Rechercher un service..." 
                class="w-full pl-10 pr-10 text-sm transition-colors duration-300 border-2 rounded-full py-2.5 border-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }}/20 focus:border-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }} focus:ring-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }}/20"
            >
            @if(!empty($searchQuery))
                <button 
                    wire:click="resetSearch" 
                    type="button"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 transition-colors hover:text-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }}"
                >
                    <i class="fas fa-times"></i>
                </button>
            @endif
        </div>
        
        <!-- Indicateur de résultats de recherche - s'affiche uniquement pendant une recherche -->
        @if(!empty($searchQuery))
            <div class="hidden text-sm text-gray-500 md:block">
                <span>{{ $totalResults }} résultat{{ $totalResults > 1 ? 's' : '' }} trouvé{{ $totalResults > 1 ? 's' : '' }}</span>
                @if(!empty($selectedCategoryId))
                    <span class="mx-1">•</span>
                    <span>Filtré par catégorie</span>
                @endif
            </div>
        @endif
    </div>

    <!-- État des résultats de recherche - visible uniquement sur mobile -->
    @if(!empty($searchQuery))
        <div class="flex items-center justify-between px-4 py-2 mb-4 text-sm rounded-lg md:hidden bg-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }}/10 text-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }}-800">
            <span class="font-medium">{{ $totalResults }} résultat{{ $totalResults > 1 ? 's' : '' }}</span>
            <button 
                wire:click="resetSearch"
                type="button"
                class="flex items-center px-2 py-1 text-xs text-white transition-colors duration-300 rounded-md bg-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }} hover:bg-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }}-600"
            >
                <i class="mr-1 fas fa-times"></i> Effacer
            </button>
        </div>
    @endif

    <div class="flex items-center justify-between mb-0">
        <h3 class="text-lg font-semibold text-dark">Catégories médicales</h3>
    </div>

<!-- Filtres de catégorie avec Livewire -->
<div class="relative mb-5" data-aos="fade-up" data-aos-duration="1000">
    <div class="flex py-6 overflow-x-auto scrollbar-hide service-filter-container">
        <div class="flex px-2 mx-auto space-x-3">
            <!-- Bouton "Tous les services" avec Livewire -->
            <button 
                wire:click="clearCategoryFilter" 
                type="button"
                class="flex items-center px-5 py-2 text-white transition-all duration-300 border-2 rounded-full shadow-sm whitespace-nowrap border-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }} bg-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }} {{ $selectedCategoryId === null ? 'opacity-100' : 'opacity-70 hover:opacity-100' }}"
            >
                <i class="mr-2 fas fa-th-large"></i>
                <span class="font-medium">Tous les services</span>
            </button>
            
            <!-- Boutons de catégorie avec Livewire -->
            @foreach($activeTab === 'medical' ? $medicalCategories : $adminCategories as $category)
                <button 
                    wire:click="selectCategory({{ $category->id }})" 
                    type="button"
                    class="flex items-center px-3 py-1.5 text-xs font-medium transition-colors border rounded-full whitespace-nowrap bg-white text-dark border-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }}/20 hover:bg-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }}/5 {{ $selectedCategoryId === $category->id ? 'bg-' . ($activeTab === 'medical' ? 'purple' : 'turquoise') . '/10 border-' . ($activeTab === 'medical' ? 'purple' : 'turquoise') . '/50 font-semibold' : '' }}"
                >
                    <i class="{{ $category->icon }} mr-1.5"></i> {{ $category->name }}
                </button>
            @endforeach
        </div>
    </div>
    
    <!-- Boutons de défilement restent inchangés -->
    <div class="absolute left-0 hidden -translate-y-1/2 top-1/2 md:block">
        <button id="scroll-left" class="flex items-center justify-center w-8 h-8 transition-colors duration-300 bg-white rounded-full shadow-lg text-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }} hover:bg-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }} hover:text-white focus:outline-none focus:ring-2 focus:ring-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }}/50">
            <i class="fas fa-chevron-left"></i>
        </button>
    </div>
    <div class="absolute right-0 hidden -translate-y-1/2 top-1/2 md:block">
        <button id="scroll-right" class="flex items-center justify-center w-8 h-8 transition-colors duration-300 bg-white rounded-full shadow-lg text-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }} hover:bg-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }} hover:text-white focus:outline-none focus:ring-2 focus:ring-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }}/50">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</div>

    <div class="grid grid-cols-1 gap-8 mb-12 md:grid-cols-2 lg:grid-cols-3">
        @forelse($medicalServices as $service)
        <div id="{{ $service->slug }}" class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group {{ !empty($searchQuery) && (
            str_contains(strtolower($service->name), strtolower($searchQuery)) || 
            str_contains(strtolower($service->short_description), strtolower($searchQuery))
        ) ? 'ring-2 ring-' . ($loop->even ? 'turquoise' : 'purple') . ' ring-offset-2' : '' }}" 
            data-aos="fade-up" 
            data-aos-duration="1000" 
            data-category="{{ $service->category->slug }}"
        >
            <div class="relative h-52">
                @if($service->image)
                <img src="{{ asset('storage/' . $service->image) }}" alt="Service de {{ $service->name }}" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105">
                @else
                <div class="flex items-center justify-center w-full h-full transition-colors duration-300 bg-gray-100 group-hover:bg-gray-200">
                    <i class="{{ $service->icon ?? 'fas fa-stethoscope' }} text-6xl {{ $loop->even ? 'text-turquoise' : 'text-purple' }} opacity-80"></i>
                </div>
                @endif
                <div class="absolute top-0 left-0 m-4">
                    <span class="bg-{{ $loop->even ? 'turquoise' : 'purple' }} text-white text-sm px-3 py-1 rounded-lg shadow-md flex items-center">
                        <i class="{{ $service->category->icon ?? 'fas fa-tag' }} mr-1 text-xs"></i>
                        {{ $service->category->name }}
                    </span>
                </div>
                
                <!-- Badge de correspondance de recherche -->
                @if(!empty($searchQuery) && (
                    str_contains(strtolower($service->name), strtolower($searchQuery)) || 
                    str_contains(strtolower($service->short_description), strtolower($searchQuery)) ||
                    str_contains(strtolower($service->category->name), strtolower($searchQuery))
                ))
                    <div class="absolute top-0 right-0 m-4">
                        <span class="bg-white text-{{ $loop->even ? 'turquoise' : 'purple' }} text-xs px-3 py-1 rounded-lg shadow-md flex items-center font-medium">
                            <i class="mr-1 fas fa-search"></i> Correspondance
                        </span>
                    </div>
                @endif
                
                <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent">
                    <!-- Mise en évidence des termes recherchés dans le nom du service -->
                    @if(!empty($searchQuery) && str_contains(strtolower($service->name), strtolower($searchQuery)))
                        <h3 class="text-sm font-bold text-white">
                            {!! preg_replace('/(' . preg_quote($searchQuery, '/') . ')/i', '<span class="bg-' . ($loop->even ? 'turquoise' : 'purple') . '/70 px-1 rounded">$1</span>', $service->name) !!}
                        </h3>
                    @else
                        <h3 class="text-sm font-bold text-white">{{ $service->name }}</h3>
                    @endif
                </div>
            </div>
            <div class="p-6">
                <!-- Mise en évidence des termes recherchés dans la description -->
                @if(!empty($searchQuery) && str_contains(strtolower($service->short_description), strtolower($searchQuery)))
                    <p class="mb-5 text-sm text-gray-700 line-clamp-3 h-18">
                        {!! preg_replace('/(' . preg_quote($searchQuery, '/') . ')/i', '<span class="bg-' . ($loop->even ? 'turquoise' : 'purple') . '/20 font-medium">$1</span>', $service->short_description) !!}
                    </p>
                @else
                    <p class="mb-5 text-sm text-gray-700 line-clamp-3 h-18">
                        {{ $service->short_description }}
                    </p>
                @endif
                
                <div class="pt-4 mt-4 border-t border-gray-100">
                    <div class="flex flex-wrap gap-2 mb-4">
                        @if($service->phone)
                        <span class="bg-{{ $loop->even ? 'turquoise' : 'purple' }}/10 text-{{ $loop->even ? 'turquoise' : 'purple' }} text-xs px-3 py-1.5 rounded-full flex items-center">
                            <i class="fas fa-phone-alt mr-1.5"></i>{{ $service->phone }}
                        </span>
                        @endif
                        @if($service->email)
                        <span class="bg-{{ $loop->even ? 'turquoise' : 'purple' }}/10 text-{{ $loop->even ? 'turquoise' : 'purple' }} text-xs px-3 py-1.5 rounded-full flex items-center">
                            <i class="fas fa-envelope mr-1.5"></i>{{ $service->email }}
                        </span>
                        @endif
                    </div>
                    <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center text-{{ $loop->even ? 'turquoise' : 'purple' }} font-medium hover:text-{{ $loop->even ? 'purple' : 'turquoise' }} transition-colors group-hover:translate-x-1 duration-300">
                        <span>Voir les détails</span>
                        <i class="ml-2 text-xs transition-transform fas fa-arrow-right group-hover:translate-x-1"></i>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 p-10 text-center bg-white shadow-md rounded-xl">
            @if(!empty($searchQuery))
                <!-- Message spécifique pour les recherches sans résultat -->
                <div class="w-20 h-20 bg-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }}/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-search text-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }} text-3xl"></i>
                </div>
                <h3 class="mb-2 text-xl font-bold text-dark">Aucun résultat trouvé</h3>
                <p class="mb-4 text-gray-500">Aucun service {{ $activeTab === 'medical' ? 'médical' : 'administratif' }} ne correspond à "{{ $searchQuery }}".</p>
                
                <div class="flex justify-center mt-4">
                    @if(!empty($selectedCategoryId))
                        <button wire:click="$set('selectedCategoryId', null)" class="flex items-center px-4 py-2 mr-2 text-sm text-gray-600 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200">
                            <i class="mr-2 fas fa-filter-circle-xmark"></i> Supprimer le filtre de catégorie
                        </button>
                    @endif
                    
                    <button wire:click="resetSearch" class="px-4 py-2 bg-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }} text-white rounded-lg hover:bg-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }}-dark transition-colors flex items-center text-sm">
                        <i class="mr-2 fas fa-times"></i> Effacer la recherche
                    </button>
                </div>
            @else
                <!-- Message par défaut quand il n'y a pas de services -->
                <div class="w-20 h-20 bg-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }}/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-info-circle text-{{ $activeTab === 'medical' ? 'purple' : 'turquoise' }} text-3xl"></i>
                </div>
                <h3 class="mb-2 text-xl font-bold text-dark">Aucun service disponible</h3>
                <p class="text-gray-500">Aucun service {{ $activeTab === 'medical' ? 'médical' : 'administratif' }} n'est disponible pour le moment.</p>
            @endif
        </div>
        @endforelse
    </div>

    <div class="flex justify-center mb-12" data-aos="fade-up" data-aos-duration="800">
        @if($medicalServices->hasPages())
            <nav role="navigation" aria-label="Pagination" class="flex items-center p-2 bg-white shadow-md rounded-xl">
                @if($medicalServices->onFirstPage())
                    <span class="px-3 py-2 mr-1 text-gray-400 rounded-lg cursor-not-allowed">
                        <i class="text-xs fas fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $medicalServices->previousPageUrl() }}" class="px-3 py-2 mr-1 text-gray-700 transition-colors duration-300 bg-gray-100 rounded-lg hover:bg-purple hover:text-white">
                        <i class="text-xs fas fa-chevron-left"></i>
                    </a>
                @endif

                <div class="hidden md:flex">
                    @foreach($medicalServices->getUrlRange(1, $medicalServices->lastPage()) as $page => $url)
                        @if($page == $medicalServices->currentPage())
                            <span class="flex items-center justify-center w-10 h-10 mx-1 font-medium text-white rounded-full bg-purple">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="flex items-center justify-center w-10 h-10 mx-1 text-gray-700 transition-colors duration-300 rounded-full hover:bg-purple/10 hover:text-purple">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                </div>

                <div class="flex items-center px-4 md:hidden">
                    <span class="font-medium text-gray-700">Page {{ $medicalServices->currentPage() }}</span>
                    <span class="mx-2 text-gray-400">/</span>
                    <span class="font-medium text-gray-700">{{ $medicalServices->lastPage() }}</span>
                </div>

                @if($medicalServices->hasMorePages())
                    <a href="{{ $medicalServices->nextPageUrl() }}" class="px-3 py-2 ml-1 text-gray-700 transition-colors duration-300 bg-gray-100 rounded-lg hover:bg-purple hover:text-white">
                        <i class="text-xs fas fa-chevron-right"></i>
                    </a>
                @else
                    <span class="px-3 py-2 ml-1 text-gray-400 rounded-lg cursor-not-allowed">
                        <i class="text-xs fas fa-chevron-right"></i>
                    </span>
                @endif
            </nav>
        @endif
    </div>
</div>