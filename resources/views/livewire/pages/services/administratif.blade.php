<div id="content-administrative" class="tab-content {{ $activeTab === 'administrative' ? '' : 'hidden' }}">
    @include('livewire.pages.services.search')
    <!-- Liste des services -->
    <div class="grid grid-cols-1 gap-6 mb-12 md:grid-cols-2 lg:grid-cols-3">
        @forelse($adminServices as $service)
        <div class="overflow-hidden transition-shadow bg-white border border-gray-100 rounded-lg shadow-sm hover:shadow-md">
            <div class="p-5">
                <div class="flex items-start mb-4">
                    <div class="flex-shrink-0 mr-4">
                        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-turquoise/10 text-turquoise">
                            <i class="{{ $service->icon ?? 'fas fa-file-alt' }}"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="mb-1 font-semibold text-dark">
                            @if(!empty($searchQuery) && str_contains(strtolower($service->name), strtolower($searchQuery)))
                                {!! preg_replace('/(' . preg_quote($searchQuery, '/') . ')/i', '<span class="px-1 rounded bg-turquoise/20">$1</span>', $service->name) !!}
                            @else
                                {{ $service->name }}
                            @endif
                        </h5>
                        <div class="inline-flex items-center rounded-full px-2 py-0.5 text-[10px] font-medium bg-gray-light text-gray-dark">
                            <i class="{{ $service->category->icon ?? 'fas fa-tag' }} mr-1"></i>
                            {{ $service->category->name ?? 'Non catégorisé' }}
                        </div>
                    </div>
                </div>
                <p class="mb-4 text-sm text-gray-dark line-clamp-2">
                    @if(!empty($searchQuery) && str_contains(strtolower($service->short_description), strtolower($searchQuery)))
                        {!! preg_replace('/(' . preg_quote($searchQuery, '/') . ')/i', '<span class="font-medium bg-turquoise/20">$1</span>', $service->short_description) !!}
                    @else
                        {{ $service->short_description }}
                    @endif
                </p>
                <div class="mb-4 space-y-2 text-xs text-gray-dark">
                    @if($service->location)
                    <div class="flex items-start">
                        <div class="text-turquoise mr-2 mt-0.5">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <p>{{ $service->location }}</p>
                    </div>
                    @endif
                    @if($service->working_hours)
                    <div class="flex items-start">
                        <div class="text-turquoise mr-2 mt-0.5">
                            <i class="far fa-clock"></i>
                        </div>
                        <p>{{ $service->working_hours }}</p>
                    </div>
                    @endif
                    @if($service->phone)
                    <div class="flex items-start">
                        <div class="text-turquoise mr-2 mt-0.5">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <p>{{ $service->phone }}</p>
                    </div>
                    @endif
                </div>
                <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center text-xs font-medium text-turquoise hover:underline">
                    En savoir plus <i class="fas fa-arrow-right ml-1.5 text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="py-8 text-center bg-white rounded-lg shadow-md col-span-full">
            @if(!empty($searchQuery))
                <div class="flex items-center justify-center w-20 h-20 mx-auto mb-6 rounded-full bg-turquoise/10">
                    <i class="text-3xl fas fa-search text-turquoise"></i>
                </div>
                <h3 class="mb-2 text-xl font-bold text-dark">Aucun résultat trouvé</h3>
                <p class="mb-4 text-gray-500">Aucun service administratif ne correspond à "{{ $searchQuery }}".</p>
                <div class="flex justify-center mt-4">
                    @if(!empty($selectedCategoryId))
                        <button wire:click="$set('selectedCategoryId', null)" class="flex items-center px-4 py-2 mr-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                            <i class="mr-2 fas fa-filter-circle-xmark"></i> Supprimer le filtre
                        </button>
                    @endif
                    <button wire:click="resetSearch" class="flex items-center px-4 py-2 text-sm text-white rounded-lg bg-turquoise hover:bg-turquoise-600">
                        <i class="mr-2 fas fa-times"></i> Effacer la recherche
                    </button>
                </div>
            @else
                <div class="flex items-center justify-center w-20 h-20 mx-auto mb-6 rounded-full bg-turquoise/10">
                    <i class="text-3xl fas fa-info-circle text-turquoise"></i>
                </div>
                <h3 class="mb-2 text-xl font-bold text-dark">Aucun service disponible</h3>
                <p class="text-gray-500">Aucun service administratif n'est disponible pour le moment.</p>
            @endif
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mb-12" data-aos="fade-up">
        @if($adminServices->hasPages())
            <nav role="navigation" aria-label="Pagination" class="flex items-center p-2 bg-white shadow-md rounded-xl">
                @if($adminServices->onFirstPage())
                    <span class="px-3 py-2 mr-1 text-gray-400 rounded-lg cursor-not-allowed">
                        <i class="text-xs fas fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $adminServices->previousPageUrl() }}" class="px-3 py-2 mr-1 text-gray-700 transition bg-gray-100 rounded-lg hover:bg-turquoise hover:text-white">
                        <i class="text-xs fas fa-chevron-left"></i>
                    </a>
                @endif
                <div class="hidden md:flex">
                    @foreach($adminServices->getUrlRange(1, $adminServices->lastPage()) as $page => $url)
                        @if($page == $adminServices->currentPage())
                            <span class="flex items-center justify-center w-10 h-10 mx-1 font-medium text-white rounded-full bg-turquoise">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="flex items-center justify-center w-10 h-10 mx-1 text-gray-700 transition rounded-full hover:bg-turquoise/10 hover:text-turquoise">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                </div>
                <div class="flex items-center px-4 md:hidden">
                    <span class="font-medium text-gray-700">Page {{ $adminServices->currentPage() }}</span>
                    <span class="mx-2 text-gray-400">/</span>
                    <span class="font-medium text-gray-700">{{ $adminServices->lastPage() }}</span>
                </div>
                @if($adminServices->hasMorePages())
                    <a href="{{ $adminServices->nextPageUrl() }}" class="px-3 py-2 ml-1 text-gray-700 transition bg-gray-100 rounded-lg hover:bg-turquoise hover:text-white">
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
