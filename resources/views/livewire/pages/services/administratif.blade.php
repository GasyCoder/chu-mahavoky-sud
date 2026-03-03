<div id="content-administrative" class="tab-content {{ $activeTab === 'administrative' ? '' : 'hidden' }}">
    @include('livewire.pages.services.search')
    
    <!-- Liste des services avec design ameliore -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($adminServices as $service)
        <div class="group overflow-hidden bg-white shadow-lg shadow-slate-200/50 rounded-3xl hover:shadow-2xl hover:shadow-primary/15 transition-all duration-500 hover:-translate-y-2"
             data-aos="fade-up"
             data-aos-delay="{{ $loop->index * 50 }}">
            <div class="p-6">
                <!-- Header avec icone -->
                <div class="flex items-start mb-5">
                    <div class="flex-shrink-0 mr-4">
                        <div class="relative">
                            <div class="absolute inset-0 bg-primary/20 rounded-2xl blur-md group-hover:blur-lg transition-all duration-300"></div>
                            <div class="relative flex items-center justify-center w-14 h-14 bg-gradient-to-br from-primary to-blue-600 rounded-2xl shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-110">
                                <i class="{{ $service->icon ?? 'fas fa-file-alt' }} text-xl text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h5 class="mb-2 font-bold text-dark text-lg group-hover:text-primary transition-colors">
                            @if(!empty($searchQuery) && str_contains(strtolower($service->name), strtolower($searchQuery)))
                                {!! preg_replace('/(' . preg_quote($searchQuery, '/') . ')/i', '<span class="px-1 rounded bg-primary/20">$1</span>', $service->name) !!}
                            @else
                                {{ $service->name }}
                            @endif
                        </h5>
                        <div class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium bg-gray-100 text-gray-600">
                            <i class="{{ $service->category->icon ?? 'fas fa-tag' }} mr-1.5"></i>
                            {{ $service->category->name ?? 'Non categorise' }}
                        </div>
                    </div>
                </div>
                
                <!-- Description -->
                <p class="mb-5 text-sm text-gray-600 leading-relaxed line-clamp-2">
                    @if(!empty($searchQuery) && str_contains(strtolower($service->short_description), strtolower($searchQuery)))
                        {!! preg_replace('/(' . preg_quote($searchQuery, '/') . ')/i', '<span class="font-medium bg-primary/20">$1</span>', $service->short_description) !!}
                    @else
                        {{ $service->short_description }}
                    @endif
                </p>
                
                <!-- Informations detaillees -->
                <div class="mb-5 space-y-3 text-xs text-gray-600">
                    @if($service->location)
                    <div class="flex items-start gap-3 group/info">
                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center text-primary flex-shrink-0 group-hover/info:bg-primary group-hover/info:text-white transition-all duration-300">
                            <i class="far fa-map-marker-alt text-sm"></i>
                        </div>
                        <p class="pt-1">{{ $service->location }}</p>
                    </div>
                    @endif
                    @if($service->working_hours)
                    <div class="flex items-start gap-3 group/info">
                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center text-primary flex-shrink-0 group-hover/info:bg-primary group-hover/info:text-white transition-all duration-300">
                            <i class="far fa-clock text-sm"></i>
                        </div>
                        <p class="pt-1">{{ $service->working_hours }}</p>
                    </div>
                    @endif
                    @if($service->phone)
                    <div class="flex items-start gap-3 group/info">
                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center text-primary flex-shrink-0 group-hover/info:bg-primary group-hover/info:text-white transition-all duration-300">
                            <i class="far fa-phone-alt text-sm"></i>
                        </div>
                        <a href="tel:{{ $service->phone }}" class="pt-1 hover:text-primary transition-colors">{{ $service->phone }}</a>
                    </div>
                    @endif
                </div>
                
                <!-- Bouton CTA -->
                <a href="{{ route('services.show', $service->slug) }}" 
                   class="group/btn flex items-center justify-center gap-2 w-full py-3 bg-gradient-to-r from-primary to-primary/90 text-white font-semibold rounded-xl shadow-md hover:shadow-lg hover:shadow-primary/30 transition-all duration-300 hover:scale-[1.02]">
                    <span>En savoir plus</span>
                    <i class="fas fa-arrow-right transition-transform duration-300 group-hover/btn:translate-x-1.5"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full">
            <div class="py-16 text-center bg-white rounded-3xl shadow-lg shadow-slate-200/50">
                @if(!empty($searchQuery))
                    <div class="flex items-center justify-center w-24 h-24 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-primary/10 to-blue-500/10">
                        <i class="text-4xl fas fa-search text-primary"></i>
                    </div>
                    <h3 class="mb-3 text-2xl font-bold text-dark">Aucun resultat trouve</h3>
                    <p class="mb-6 text-gray-600">Aucun service administratif ne correspond a "{{ $searchQuery }}".</p>
                    <div class="flex justify-center gap-3">
                        @if(!empty($selectedCategoryId))
                            <button wire:click="$set('selectedCategoryId', null)" class="inline-flex items-center px-5 py-3 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors">
                                <i class="mr-2 fas fa-filter-circle-xmark"></i> Supprimer le filtre
                            </button>
                        @endif
                        <button wire:click="resetSearch" class="inline-flex items-center px-5 py-3 text-sm font-semibold text-white transition rounded-xl bg-primary hover:bg-primary/90 hover:shadow-lg hover:shadow-primary/30">
                            <i class="mr-2 fas fa-times"></i> Effacer la recherche
                        </button>
                    </div>
                @else
                    <div class="flex items-center justify-center w-24 h-24 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-primary/10 to-blue-500/10">
                        <i class="text-4xl fas fa-info-circle text-primary"></i>
                    </div>
                    <h3 class="mb-3 text-2xl font-bold text-dark">Aucun service disponible</h3>
                    <p class="text-gray-600">Aucun service administratif n'est disponible pour le moment.</p>
                @endif
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination moderne -->
    <div class="flex justify-center mt-12" data-aos="fade-up">
        @if($adminServices->hasPages())
            <nav role="navigation" aria-label="Pagination" class="inline-flex items-center gap-2 p-2 bg-white shadow-lg shadow-slate-200/50 rounded-2xl">
                @if($adminServices->onFirstPage())
                    <span class="px-4 py-2.5 text-gray-400 rounded-xl cursor-not-allowed bg-gray-50">
                        <i class="text-xs fas fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $adminServices->previousPageUrl() }}" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 transition bg-gray-50 rounded-xl hover:bg-primary hover:text-white">
                        <i class="text-xs fas fa-chevron-left"></i>
                    </a>
                @endif

                <div class="hidden md:flex items-center gap-1">
                    @foreach($adminServices->getUrlRange(1, min($adminServices->lastPage(), 5)) as $page => $url)
                        @if($page == $adminServices->currentPage())
                            <span class="flex items-center justify-center min-w-[44px] h-11 font-semibold text-white rounded-xl bg-gradient-to-r from-primary to-primary/90 shadow-md">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="flex items-center justify-center min-w-[44px] h-11 font-medium text-gray-700 transition rounded-xl hover:bg-primary/10 hover:text-primary">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                </div>

                <div class="flex items-center px-4 md:hidden">
                    <span class="font-medium text-gray-700">Page {{ $adminServices->currentPage() }}</span>
                    <span class="mx-2 text-gray-300">/</span>
                    <span class="font-medium text-gray-700">{{ $adminServices->lastPage() }}</span>
                </div>

                @if($adminServices->hasMorePages())
                    <a href="{{ $adminServices->nextPageUrl() }}" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 transition bg-gray-50 rounded-xl hover:bg-primary hover:text-white">
                        <i class="text-xs fas fa-chevron-right"></i>
                    </a>
                @else
                    <span class="px-4 py-2.5 text-gray-400 rounded-xl cursor-not-allowed bg-gray-50">
                        <i class="text-xs fas fa-chevron-right"></i>
                    </span>
                @endif
            </nav>
        @endif
    </div>
</div>
