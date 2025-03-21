<!-- Contenu des services médicaux avec design amélioré -->
<div id="content-medical" class="tab-content {{ $activeTab === 'medical' ? '' : 'hidden' }}">
    <div class="mb-5 text-center" data-aos="fade-up" data-aos-duration="1000">
        <h2 class="text-xl font-bold text-dark mb-6 relative inline-block">
            Services Médicaux
            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1 bg-purple rounded"></span>
        </h2>
        <p class="max-w-xl mx-auto text-gray-dark text-sm md:text-base">
            Le CHU Mahavoky Atsimo offre une large gamme de services médicaux de pointe, assurés par des médecins spécialistes et des équipes soignantes hautement qualifiées.
        </p>
    </div>
    <div class="flex items-center justify-between mb-0">
        <h3 class="text-lg font-semibold text-dark">Catégories médicales</h3>
    </div>
    <div class="relative mb-5" data-aos="fade-up" data-aos-duration="1000">
        <div class="flex overflow-x-auto py-6 scrollbar-hide service-filter-container">
            <div class="flex space-x-3 px-2 mx-auto">
                <a href="#all" class="service-filter whitespace-nowrap px-5 py-2 rounded-full border-2 border-purple bg-purple text-white transition-all duration-300 flex items-center shadow-sm">
                    <i class="fas fa-th-large mr-2"></i>
                    <span class="font-medium">Tous les services</span>
                </a>
                @foreach($medicalCategories as $category)
                <a href="#{{ $category->slug }}" class="service-filter whitespace-nowrap flex items-center px-3 py-1.5 rounded-full text-xs font-medium border transition-colors bg-white text-dark border-purple/20 hover:bg-purple/5" data-category="{{ $category->slug }}">
                    <i class="{{ $category->icon }} mr-1.5"></i> {{ $category->name }}
                </a>
                @endforeach
            </div>
        </div>
        <div class="absolute left-0 top-1/2 -translate-y-1/2 hidden md:block">
            <button id="scroll-left" class="w-8 h-8 rounded-full bg-white shadow-lg flex items-center justify-center text-purple hover:bg-purple hover:text-white transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-purple/50">
                <i class="fas fa-chevron-left"></i>
            </button>
        </div>
        <div class="absolute right-0 top-1/2 -translate-y-1/2 hidden md:block">
            <button id="scroll-right" class="w-8 h-8 rounded-full bg-white shadow-lg flex items-center justify-center text-purple hover:bg-purple hover:text-white transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-purple/50">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        @forelse($medicalServices as $service)
        <div id="{{ $service->slug }}" class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group" data-aos="fade-up" data-aos-duration="1000" data-category="{{ $service->category->slug }}">
            <div class="relative h-52">
                @if($service->image)
                <img src="{{ asset('storage/' . $service->image) }}" alt="Service de {{ $service->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                @else
                <div class="w-full h-full bg-gray-100 flex items-center justify-center group-hover:bg-gray-200 transition-colors duration-300">
                    <i class="{{ $service->icon ?? 'fas fa-stethoscope' }} text-6xl {{ $loop->even ? 'text-turquoise' : 'text-purple' }} opacity-80"></i>
                </div>
                @endif
                <div class="absolute top-0 left-0 m-4">
                    <span class="bg-{{ $loop->even ? 'turquoise' : 'purple' }} text-white text-sm px-3 py-1 rounded-lg shadow-md flex items-center">
                        <i class="{{ $service->category->icon ?? 'fas fa-tag' }} mr-1 text-xs"></i>
                        {{ $service->category->name }}
                    </span>
                </div>
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                    <h3 class="font-bold text-sm text-white">{{ $service->name }}</h3>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-700 text-sm mb-5 line-clamp-3 h-18">
                    {{ $service->short_description }}
                </p>
                <div class="border-t border-gray-100 pt-4 mt-4">
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
                        <i class="fas fa-arrow-right text-xs ml-2 transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 p-10 bg-white rounded-xl shadow-md text-center">
            <div class="w-20 h-20 bg-purple/10 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-info-circle text-purple text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-dark mb-2">Aucun service disponible</h3>
            <p class="text-gray-500">Aucun service médical n'est disponible pour le moment.</p>
        </div>
        @endforelse
    </div>

    <div class="flex justify-center mb-12" data-aos="fade-up" data-aos-duration="800">
        @if($medicalServices->hasPages())
            <nav role="navigation" aria-label="Pagination" class="flex items-center bg-white rounded-xl shadow-md p-2">
                @if($medicalServices->onFirstPage())
                    <span class="px-3 py-2 text-gray-400 rounded-lg mr-1 cursor-not-allowed">
                        <i class="fas fa-chevron-left text-xs"></i>
                    </span>
                @else
                    <a href="{{ $medicalServices->previousPageUrl() }}" class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg mr-1 hover:bg-purple hover:text-white transition-colors duration-300">
                        <i class="fas fa-chevron-left text-xs"></i>
                    </a>
                @endif

                <div class="hidden md:flex">
                    @foreach($medicalServices->getUrlRange(1, $medicalServices->lastPage()) as $page => $url)
                        @if($page == $medicalServices->currentPage())
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
                    <span class="font-medium text-gray-700">Page {{ $medicalServices->currentPage() }}</span>
                    <span class="mx-2 text-gray-400">/</span>
                    <span class="font-medium text-gray-700">{{ $medicalServices->lastPage() }}</span>
                </div>

                @if($medicalServices->hasMorePages())
                    <a href="{{ $medicalServices->nextPageUrl() }}" class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg ml-1 hover:bg-purple hover:text-white transition-colors duration-300">
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