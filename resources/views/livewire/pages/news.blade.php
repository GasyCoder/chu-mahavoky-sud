<div>
    <!-- En-tête de la page -->
    <section class="bg-white py-10 sm:py-16">
        <div class="container">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-3xl font-bold text-dark mb-4">Nos actualités</h1>
                <p class="text-gray-dark mb-6">Restez informé des dernières nouvelles, événements et développements de notre établissement</p>

                <!-- Formulaire de recherche -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-4 mb-8">
                    <div class="w-full sm:w-auto flex-grow max-w-md">
                        <input
                            wire:model.live.debounce.300ms="search"
                            type="text"
                            placeholder="Rechercher..."
                            class="w-full rounded-full border-gray px-4 py-2.5 focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50"
                        >
                    </div>
                    @if($search || $category)
                        <button
                            wire:click="clearFilters"
                            class="text-sm text-purple hover:text-purple-dark flex items-center"
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

    <!-- Actualités en vedette (slider) -->
    @if($featuredNews->count() > 0)
        <section class="bg-gray-light py-8">
            <div class="container">
                <h2 class="text-xl font-bold text-dark mb-6 flex items-center">
                    <div class="w-1.5 h-6 bg-gradient-to-b from-purple to-turquoise rounded-full mr-3"></div>
                    À la une
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($featuredNews as $featured)
                        <article class="group bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 border border-gray flex flex-col h-full transform hover:-translate-y-1">
                            <!-- Image avec overlay au survol -->
                            <div class="relative overflow-hidden aspect-video">
                                <img
                                    src="{{ $featured->image_url }}"
                                    alt="{{ $featured->title }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>

                                <!-- Badge flottant -->
                                <div class="absolute top-3 left-3 z-10">
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-{{ $featured->category_color }} text-white shadow-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            {!! $featured->category_icon !!}
                                        </svg>
                                        {{ $featured->category }}
                                    </span>
                                </div>
                            </div>

                            <!-- Contenu avec espacement optimisé -->
                            <div class="p-5 flex flex-col flex-grow">
                                <!-- Date avec icône plus lisible -->
                                <div class="flex items-center text-gray-dark text-sm mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <time datetime="{{ $featured->published_at->format('Y-m-d') }}">{{ $featured->published_at->format('d M Y') }}</time>
                                </div>

                                <!-- Titre avec effet de transition -->
                                <h3 class="font-bold text-lg text-dark group-hover:text-purple transition-colors duration-300 mb-3 line-clamp-2">
                                    {{ $featured->title }}
                                </h3>

                                <!-- Résumé avec meilleure lisibilité -->
                                <p class="text-gray-dark text-sm leading-relaxed mb-5 line-clamp-3 flex-grow">
                                    {{ $featured->excerpt }}
                                </p>

                                <!-- CTA plus visible -->
                                <a href="{{ route('news.show', $featured->slug) }}" class="inline-flex items-center font-medium text-purple hover:text-purple-dark transition-colors mt-auto group/link">
                                    <span>Lire plus</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transform group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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

    <!-- Filtres par catégorie -->
    <section class="bg-white py-8">
        <div class="container">
            <div class="flex flex-wrap justify-center gap-2 mb-8">
                <button
                    wire:click="clearFilters"
                    class="px-4 py-2 rounded-full text-sm font-medium {{ empty($category) ? 'bg-purple text-white' : 'bg-gray-light text-dark hover:bg-gray' }} transition-colors"
                >
                    Toutes les actualités
                </button>

                @foreach($categories as $cat)
                    <button
                        wire:click="filterByCategory('{{ $cat }}')"
                        class="px-4 py-2 rounded-full text-sm font-medium {{ $category == $cat ? 'bg-purple text-white' : 'bg-gray-light text-dark hover:bg-gray' }} transition-colors"
                    >
                        {{ $cat }}
                    </button>
                @endforeach
            </div>

            <!-- Grille d'articles -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($news as $article)
                    <article class="group bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 border border-gray flex flex-col h-full transform hover:-translate-y-1">
                        <!-- Image avec overlay au survol -->
                        <div class="relative overflow-hidden aspect-video">
                            <img
                                src="{{ $article->image_url }}"
                                alt="{{ $article->title }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>

                            <!-- Badge flottant -->
                            <div class="absolute top-3 left-3 z-10">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-{{ $article->category_color }} text-white shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        {!! $article->category_icon !!}
                                    </svg>
                                    {{ $article->category }}
                                </span>
                            </div>
                        </div>

                        <!-- Contenu avec espacement optimisé -->
                        <div class="p-5 flex flex-col flex-grow">
                            <!-- Date avec icône plus lisible -->
                            <div class="flex items-center text-gray-dark text-sm mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <time datetime="{{ $article->published_at->format('Y-m-d') }}">{{ $article->published_at->format('d M Y') }}</time>
                            </div>

                            <!-- Titre avec effet de transition -->
                            <h3 class="font-bold text-lg text-dark group-hover:text-purple transition-colors duration-300 mb-3 line-clamp-2">
                                {{ $article->title }}
                            </h3>

                            <!-- Résumé avec meilleure lisibilité -->
                            <p class="text-gray-dark text-sm leading-relaxed mb-5 line-clamp-3 flex-grow">
                                {{ $article->excerpt }}
                            </p>

                            <!-- CTA plus visible -->
                            <a href="{{ route('news.show', $article->slug) }}" class="inline-flex items-center font-medium text-purple hover:text-purple-dark transition-colors mt-auto group/link">
                                <span>Lire plus</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transform group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full py-12 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-dark mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <h3 class="text-xl font-semibold text-dark mb-2">Aucun résultat trouvé</h3>
                        <p class="text-gray-dark">Essayez de modifier votre recherche ou vos filtres.</p>
                        <button
                            wire:click="clearFilters"
                            class="mt-4 px-4 py-2 bg-purple text-white rounded-lg hover:bg-purple-dark transition-colors"
                        >
                            Voir toutes les actualités
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
