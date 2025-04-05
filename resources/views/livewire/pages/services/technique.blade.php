<div id="content-technical" class="tab-content {{ $activeTab === 'technical' ? '' : 'hidden' }}">
    <!-- Intro -->
    {{-- <div class="mb-5 text-center" data-aos="fade-up">
        <p class="max-w-xl mx-auto text-sm text-gray-dark md:text-base">
            Le CHU Mahavoky Atsimo offre une large gamme de services techniques de pointe, assurés par des équipes hautement qualifiées.
        </p>
    </div> --}}

    <!-- Barre de recherche -->
    @include('livewire.pages.services.search')
    <!-- Résultats -->
    <div class="grid grid-cols-1 gap-8 mb-12 md:grid-cols-2 lg:grid-cols-3">
        @forelse($technicalServices as $service)
        <div id="{{ $service->slug }}" class="overflow-hidden transition bg-white shadow-md rounded-xl hover:-translate-y-1 hover:shadow-lg group">
            <div class="relative h-52">
                @if($service->image)
                <img src="{{ asset('storage/' . $service->image) }}" alt="Service de {{ $service->name }}"
                     class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105 brightness-75">
                @else
                <div class="flex items-center justify-center w-full h-full bg-gray-100">
                    <i class="{{ $service->icon ?? 'fas fa-tools' }} text-5xl text-purple opacity-80"></i>
                </div>
                @endif

                <div class="absolute bottom-0 left-0 right-0 p-4 bg-black/40 backdrop-blur-sm">
                    <h3 class="text-sm font-semibold text-white truncate">
                        {{ $service->name }}
                    </h3>
                </div>
            </div>
            <div class="p-5">
                <p class="mb-4 text-sm text-gray-600 line-clamp-3">
                    {{ $service->short_description }}
                </p>
                <div class="flex flex-wrap gap-2 mb-4">
                    @if($service->phone)
                    <span class="flex items-center px-3 py-1 text-xs rounded-full bg-purple/10 text-purple">
                        <i class="fas fa-phone-alt mr-1.5"></i>{{ $service->phone }}
                    </span>
                    @endif
                    @if($service->email)
                    <span class="flex items-center px-3 py-1 text-xs rounded-full bg-purple/10 text-purple">
                        <i class="fas fa-envelope mr-1.5"></i>{{ $service->email }}
                    </span>
                    @endif
                </div>
                <a href="{{ route('services.show', $service->slug) }}"
                   class="inline-flex items-center text-sm font-medium transition text-purple hover:text-purple-dark">
                    Voir les détails <i class="ml-2 text-xs fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-3 p-10 text-center bg-white shadow-md rounded-xl">
            <div class="flex items-center justify-center w-20 h-20 mx-auto mb-6 rounded-full bg-purple/10">
                <i class="text-3xl fas fa-info-circle text-purple"></i>
            </div>
            <h3 class="mb-2 text-xl font-bold text-dark">Aucun service disponible</h3>
            @if(!empty($searchQuery))
                <p class="text-gray-500">Aucun service technique ne correspond à "{{ $searchQuery }}".</p>
                <div class="flex justify-center mt-4">
                    <button wire:click="resetSearch" class="flex items-center px-4 py-2 text-sm text-white transition rounded-lg bg-purple hover:bg-purple-600">
                        <i class="mr-2 fas fa-times"></i> Effacer la recherche
                    </button>
                </div>
            @else
                <p class="text-gray-500">Aucun service technique n'est disponible pour le moment.</p>
            @endif
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mb-12" data-aos="fade-up">
        @if($technicalServices->hasPages())
            <nav role="navigation" aria-label="Pagination" class="flex items-center p-2 bg-white shadow-md rounded-xl">
                @if($technicalServices->onFirstPage())
                    <span class="px-3 py-2 mr-1 text-gray-400 rounded-lg cursor-not-allowed">
                        <i class="text-xs fas fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $technicalServices->previousPageUrl() }}" class="px-3 py-2 mr-1 text-gray-700 transition bg-gray-100 rounded-lg hover:bg-purple hover:text-white">
                        <i class="text-xs fas fa-chevron-left"></i>
                    </a>
                @endif

                <div class="hidden md:flex">
                    @foreach($technicalServices->getUrlRange(1, $technicalServices->lastPage()) as $page => $url)
                        @if($page == $technicalServices->currentPage())
                            <span class="flex items-center justify-center w-10 h-10 mx-1 font-medium text-white rounded-full bg-purple">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="flex items-center justify-center w-10 h-10 mx-1 text-gray-700 transition rounded-full hover:bg-purple/10 hover:text-purple">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                </div>

                <div class="flex items-center px-4 md:hidden">
                    <span class="font-medium text-gray-700">Page {{ $technicalServices->currentPage() }}</span>
                    <span class="mx-2 text-gray-400">/</span>
                    <span class="font-medium text-gray-700">{{ $technicalServices->lastPage() }}</span>
                </div>

                @if($technicalServices->hasMorePages())
                    <a href="{{ $technicalServices->nextPageUrl() }}" class="px-3 py-2 ml-1 text-gray-700 transition bg-gray-100 rounded-lg hover:bg-purple hover:text-white">
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
