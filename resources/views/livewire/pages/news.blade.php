<div>
    <!-- En-tete -->
    <section class="bg-white py-12 sm:py-16">
        <div class="container">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-3xl font-bold text-dark mb-4">Nos actualites</h1>
                <div class="w-12 h-1 bg-primary rounded-full mx-auto mb-4"></div>
                <p class="text-gray-dark mb-8">Restez informe des dernieres nouvelles, evenements et developpements de notre etablissement</p>

                <!-- Recherche -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-4 mb-8">
                    <div class="w-full sm:w-auto flex-grow max-w-md">
                        <input
                            wire:model.live.debounce.300ms="search"
                            type="text"
                            placeholder="Rechercher..."
                            class="w-full rounded-xl border-gray-200 px-5 py-3 shadow-sm focus:border-primary focus:ring-2 focus:ring-primary/20"
                        >
                    </div>
                    @if($search || $category)
                        <button
                            wire:click="clearFilters"
                            class="text-sm text-primary hover:underline flex items-center"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Effacer les filtres
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Featured -->
    @if($featuredNews->count() > 0)
        <section class="bg-gray-light py-10">
            <div class="container">
                <h2 class="text-xl font-bold text-dark mb-2">A la une</h2>
                <div class="w-12 h-1 bg-primary rounded-full mb-6"></div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($featuredNews as $featured)
                        <article class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full">
                            <div class="relative overflow-hidden aspect-video rounded-t-2xl">
                                <img
                                    src="{{ $featured->image_url }}"
                                    alt="{{ $featured->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                >
                                <div class="absolute top-3 left-3 z-10">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary backdrop-blur-sm bg-white/80">
                                        {{ $featured->category }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-5 flex flex-col flex-grow">
                                <div class="flex items-center text-gray-dark text-sm mb-3">
                                    <i class="far fa-calendar-alt mr-2 text-xs"></i>
                                    <time datetime="{{ $featured->published_at->format('Y-m-d') }}">{{ $featured->published_at->format('d M Y') }}</time>
                                </div>

                                <h3 class="font-semibold text-lg text-dark group-hover:text-primary transition-colors duration-300 mb-3 line-clamp-2">
                                    {{ $featured->title }}
                                </h3>

                                <p class="text-gray-dark text-sm leading-relaxed mb-5 line-clamp-3 flex-grow">
                                    {{ $featured->excerpt }}
                                </p>

                                <a href="{{ route('news.show', $featured->slug) }}" class="inline-flex items-center font-medium text-primary hover:underline transition-colors mt-auto text-sm">
                                    <span>Lire plus</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Filtres -->
    <section class="bg-white py-10">
        <div class="container">
            <div class="flex flex-wrap justify-center gap-2 mb-8">
                <button
                    wire:click="clearFilters"
                    class="px-4 py-2 rounded-full text-sm font-medium {{ empty($category) ? 'bg-primary text-white' : 'bg-gray-light text-dark hover:bg-primary hover:text-white' }} transition-colors"
                >
                    Toutes les actualites
                </button>

                @foreach($categories as $cat)
                    <button
                        wire:click="filterByCategory('{{ $cat }}')"
                        class="px-4 py-2 rounded-full text-sm font-medium {{ $category == $cat ? 'bg-primary text-white' : 'bg-gray-light text-dark hover:bg-primary hover:text-white' }} transition-colors"
                    >
                        {{ $cat }}
                    </button>
                @endforeach
            </div>

            <!-- Grille d'articles -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($news as $article)
                    <article class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full">
                        <div class="relative overflow-hidden aspect-video rounded-t-2xl">
                            <img
                                src="{{ $article->image_url }}"
                                alt="{{ $article->title }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            >
                            <div class="absolute top-3 left-3 z-10">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary backdrop-blur-sm bg-white/80">
                                    {{ $article->category }}
                                </span>
                            </div>
                        </div>

                        <div class="p-5 flex flex-col flex-grow">
                            <div class="flex items-center text-gray-dark text-sm mb-3">
                                <i class="far fa-calendar-alt mr-2 text-xs"></i>
                                <time datetime="{{ $article->published_at->format('Y-m-d') }}">{{ $article->published_at->format('d M Y') }}</time>
                            </div>

                            <h3 class="font-semibold text-lg text-dark group-hover:text-primary transition-colors duration-300 mb-3 line-clamp-2">
                                {{ $article->title }}
                            </h3>

                            <p class="text-gray-dark text-sm leading-relaxed mb-5 line-clamp-3 flex-grow">
                                {{ $article->excerpt }}
                            </p>

                            <a href="{{ route('news.show', $article->slug) }}" class="inline-flex items-center font-medium text-primary hover:underline transition-colors mt-auto text-sm">
                                <span>Lire plus</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full py-12 text-center">
                        <i class="far fa-newspaper text-4xl text-gray-dark mb-4"></i>
                        <h3 class="text-xl font-semibold text-dark mb-2">Aucun resultat trouve</h3>
                        <p class="text-gray-dark">Essayez de modifier votre recherche ou vos filtres.</p>
                        <button
                            wire:click="clearFilters"
                            class="mt-4 px-6 py-2.5 bg-primary text-white rounded-xl hover:bg-primary/90 transition-colors"
                        >
                            Voir toutes les actualites
                        </button>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-10 flex justify-center">
                {{ $news->links() }}
            </div>
        </div>
    </section>
</div>
