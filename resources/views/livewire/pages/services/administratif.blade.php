<div id="content-admin" class="tab-content {{ $activeTab === 'admin' ? '' : 'hidden' }}">
    <div class="container py-8">
        <div class="mb-10 text-center" data-aos="fade-up" data-aos-duration="1000">
            <h2 class="text-xl md:text-xl font-bold text-dark mb-3">Services Administratifs</h2>
            <p class="max-w-xl mx-auto text-gray-dark text-sm md:text-base">
                Le CHU Mahavoky Atsimo dispose de services administratifs performants qui soutiennent les activités médicales et facilitent les démarches des patients et de leurs familles.
            </p>
        </div>

        {{-- <div class="relative mb-8">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-semibold text-dark">Catégories administratives</h3>
            </div>
            <div class="service-filter-container relative flex items-center space-x-2 overflow-x-auto pb-2 scrollbar-hide">
                <a href="#all" class="service-filter whitespace-nowrap flex items-center px-3 py-1.5 rounded-full text-xs font-medium border transition-colors bg-purple text-white border-purple" data-category="all">
                    <i class="fas fa-th-list mr-1.5"></i> Tous les services
                </a>
                @foreach($adminCategories as $category)
                <a href="#{{ $category->slug }}" class="service-filter whitespace-nowrap flex items-center px-3 py-1.5 rounded-full text-xs font-medium border transition-colors bg-white text-dark border-purple/20 hover:bg-purple/5" data-category="{{ $category->slug }}">
                    <i class="{{ $category->icon }} mr-1.5"></i> {{ $category->name }}
                </a>
                @endforeach
            </div>
        </div> --}}

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($adminServices as $service)
            <div class="bg-white rounded-lg shadow-sm hover:shadow transition-shadow overflow-hidden border border-gray-100" data-category="{{ $service->category->slug }}">
                <div class="p-5">
                    <div class="flex items-start mb-4">
                        <div class="flex-shrink-0 mr-4">
                            <div class="w-12 h-12 rounded-full bg-{{ $loop->even ? 'turquoise' : 'purple' }}/10 flex items-center justify-center text-{{ $loop->even ? 'turquoise' : 'purple' }}">
                                <i class="{{ $service->icon }}"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-semibold text-dark mb-0.5">{{ $service->name }}</h5>
                            <div class="inline-flex items-center rounded-full px-2 py-0.5 text-[10px] font-medium bg-gray-light text-gray-dark">
                                <i class="{{ $service->category->icon }} mr-1"></i>
                                {{ $service->category->name }}
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-dark text-sm mb-4 line-clamp-2">{{ $service->short_description }}</p>
                    <div class="space-y-2 mb-4">
                        @if($service->location)
                        <div class="flex items-start">
                            <div class="text-{{ $loop->even ? 'turquoise' : 'purple' }} mr-2 mt-0.5">
                                <i class="fas fa-map-marker-alt text-xs"></i>
                            </div>
                            <p class="text-gray-dark text-xs">{{ $service->location }}</p>
                        </div>
                        @endif
                        @if($service->working_hours)
                        <div class="flex items-start">
                            <div class="text-{{ $loop->even ? 'turquoise' : 'purple' }} mr-2 mt-0.5">
                                <i class="far fa-clock text-xs"></i>
                            </div>
                            <p class="text-gray-dark text-xs">{{ $service->working_hours }}</p>
                        </div>
                        @endif
                        @if($service->phone)
                        <div class="flex items-start">
                            <div class="text-{{ $loop->even ? 'turquoise' : 'purple' }} mr-2 mt-0.5">
                                <i class="fas fa-phone-alt text-xs"></i>
                            </div>
                            <p class="text-gray-dark text-xs">{{ $service->phone }}</p>
                        </div>
                        @endif
                    </div>
                    <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center text-xs font-medium text-{{ $loop->even ? 'turquoise' : 'purple' }} hover:underline">
                        En savoir plus
                        <i class="fas fa-arrow-right ml-1.5 text-[10px]"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full py-8 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-light mb-4">
                    <i class="fas fa-search text-gray-dark text-xl"></i>
                </div>
                <h3 class="text-lg font-medium text-dark mb-2">Aucun service trouvé</h3>
                <p class="text-gray-dark text-sm">Veuillez sélectionner une autre catégorie ou réinitialiser les filtres.</p>
            </div>
            @endforelse
        </div>

        <div class="flex justify-center mb-12" data-aos="fade-up" data-aos-duration="800">
            @if($adminServices->hasPages())
                <nav role="navigation" aria-label="Pagination" class="flex items-center bg-white rounded-xl shadow-md p-2">
                    @if($adminServices->onFirstPage())
                        <span class="px-3 py-2 text-gray-400 rounded-lg mr-1 cursor-not-allowed">
                            <i class="fas fa-chevron-left text-xs"></i>
                        </span>
                    @else
                        <a href="{{ $adminServices->previousPageUrl() }}" class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg mr-1 hover:bg-purple hover:text-white transition-colors duration-300">
                            <i class="fas fa-chevron-left text-xs"></i>
                        </a>
                    @endif

                    <div class="hidden md:flex">
                        @foreach($adminServices->getUrlRange(1, $adminServices->lastPage()) as $page => $url)
                            @if($page == $adminServices->currentPage())
                                <span class="mx-1 w-10 h-10 flex items-center justify-center rounded-full bg-purple text-white font-medium">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="mx-1 w-10 h-10 flex items-center justify-center rounded-full hover:bg-purple/10 text-gray-700 hover:text-purple transition-colors duration-300">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    </div>

                    <div class="flex md:hidden px-4 items-center">
                        <span class="font-medium text-gray-700">Page {{ $adminServices->currentPage() }}</span>
                        <span class="mx-2 text-gray-400">/</span>
                        <span class="font-medium text-gray-700">{{ $adminServices->lastPage() }}</span>
                    </div>

                    @if($adminServices->hasMorePages())
                        <a href="{{ $adminServices->nextPageUrl() }}" class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg ml-1 hover:bg-purple hover:text-white transition-colors duration-300">
                            <i class="fas fa-chevron-right text-xs"></i>
                        </a>
                    @else
                        <span class="px-3 py-2 text-gray-400 rounded-lg ml-1 cursor-not-allowed">
                            <i class="fas fa-chevron-right text-xs"></i>
                        </span>
                    @endif
                </nav>
            @endif
        </div>
    </div>
</div>