<div id="content-technical" class="tab-content {{ $activeTab === 'technical' ? '' : 'hidden' }}">
    @include('livewire.pages.services.search')
    
    <!-- Resultats avec design ameliore -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($technicalServices as $service)
        <div id="{{ $service->slug }}" 
             class="group overflow-hidden bg-white shadow-lg shadow-slate-200/50 rounded-3xl hover:shadow-2xl hover:shadow-primary/15 transition-all duration-500 hover:-translate-y-2"
             data-aos="fade-up"
             data-aos-delay="{{ $loop->index * 50 }}">
            <!-- Image avec overlay -->
            <div class="relative h-56 overflow-hidden rounded-t-3xl">
                @if($service->image)
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent z-10 opacity-60 group-hover:opacity-80 transition-opacity duration-500"></div>
                <img src="{{ asset('storage/' . $service->image) }}" alt="Service de {{ $service->name }}"
                     class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-110">
                @else
                <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-primary/10 to-blue-500/10">
                    <div class="relative">
                        <div class="absolute inset-0 bg-primary/20 rounded-full blur-xl"></div>
                        <div class="relative w-20 h-20 bg-gradient-to-br from-primary to-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-110">
                            <i class="{{ $service->icon ?? 'fas fa-tools' }} text-3xl text-white"></i>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Badge categorie -->
                <div class="absolute top-4 left-4 z-20">
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-white/90 backdrop-blur-sm text-primary shadow-lg">
                        <i class="fas fa-stethoscope mr-1.5"></i>Technique
                    </span>
                </div>

                <!-- Nom du service -->
                <div class="absolute bottom-4 left-4 right-4 z-20">
                    <h3 class="text-xl font-bold text-white truncate">
                        {{ $service->name }}
                    </h3>
                </div>
            </div>
            
            <!-- Contenu de la carte -->
            <div class="p-6">
                <p class="mb-5 text-sm text-gray-600 leading-relaxed line-clamp-3">
                    {{ $service->short_description }}
                </p>
                
                <!-- Tags de contact -->
                <div class="flex flex-wrap gap-2 mb-5">
                    @if($service->phone)
                    <a href="tel:{{ $service->phone }}" class="flex items-center px-3 py-2 text-xs font-medium rounded-xl bg-primary/10 text-primary hover:bg-primary/20 transition-colors">
                        <i class="far fa-phone mr-1.5"></i>{{ $service->phone }}
                    </a>
                    @endif
                    @if($service->email)
                    <a href="mailto:{{ $service->email }}" class="flex items-center px-3 py-2 text-xs font-medium rounded-xl bg-blue-500/10 text-blue-600 hover:bg-blue-500/20 transition-colors">
                        <i class="far fa-envelope mr-1.5"></i>{{ Str::limit($service->email, 18) }}
                    </a>
                    @endif
                </div>
                
                <!-- Bouton CTA -->
                <a href="{{ route('services.show', $service->slug) }}"
                   class="group/btn flex items-center justify-center gap-2 w-full py-3 bg-gradient-to-r from-primary to-primary/90 text-white font-semibold rounded-xl shadow-md hover:shadow-lg hover:shadow-primary/30 transition-all duration-300 hover:scale-[1.02]">
                    <span>Voir les details</span>
                    <i class="fas fa-arrow-right transition-transform duration-300 group-hover/btn:translate-x-1.5"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full">
            <div class="py-16 text-center bg-white rounded-3xl shadow-lg shadow-slate-200/50">
                <div class="flex items-center justify-center w-24 h-24 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-primary/10 to-blue-500/10">
                    <i class="text-4xl fas fa-info-circle text-primary"></i>
                </div>
                <h3 class="mb-3 text-2xl font-bold text-dark">Aucun service disponible</h3>
                @if(!empty($searchQuery))
                    <p class="text-gray-600 mb-6">Aucun service technique ne correspond a "{{ $searchQuery }}".</p>
                    <button wire:click="resetSearch" class="inline-flex items-center px-6 py-3 text-sm font-semibold text-white transition rounded-xl bg-primary hover:bg-primary/90 hover:shadow-lg hover:shadow-primary/30">
                        <i class="mr-2 fas fa-times"></i> Effacer la recherche
                    </button>
                @else
                    <p class="text-gray-600">Aucun service technique n'est disponible pour le moment.</p>
                @endif
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination moderne -->
    <div class="flex justify-center mt-12" data-aos="fade-up">
        @if($technicalServices->hasPages())
            <nav role="navigation" aria-label="Pagination" class="inline-flex items-center gap-2 p-2 bg-white shadow-lg shadow-slate-200/50 rounded-2xl">
                @if($technicalServices->onFirstPage())
                    <span class="px-4 py-2.5 text-gray-400 rounded-xl cursor-not-allowed bg-gray-50">
                        <i class="text-xs fas fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $technicalServices->previousPageUrl() }}" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 transition bg-gray-50 rounded-xl hover:bg-primary hover:text-white">
                        <i class="text-xs fas fa-chevron-left"></i>
                    </a>
                @endif

                <div class="hidden md:flex items-center gap-1">
                    @foreach($technicalServices->getUrlRange(1, min($technicalServices->lastPage(), 5)) as $page => $url)
                        @if($page == $technicalServices->currentPage())
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
                    <span class="font-medium text-gray-700">Page {{ $technicalServices->currentPage() }}</span>
                    <span class="mx-2 text-gray-300">/</span>
                    <span class="font-medium text-gray-700">{{ $technicalServices->lastPage() }}</span>
                </div>

                @if($technicalServices->hasMorePages())
                    <a href="{{ $technicalServices->nextPageUrl() }}" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 transition bg-gray-50 rounded-xl hover:bg-primary hover:text-white">
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
