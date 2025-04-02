<!-- Section blog avec marge inférieure pour créer l'espace souhaité -->
<section class="pt-0 pb-16 bg-white sm:pt-4 sm:pb-12">
    <div class="container">
        <!-- En-tête de section avec animation subtile -->
        <div class="flex flex-col items-start justify-between mb-5 sm:flex-row sm:items-center sm:mb-10">
            <div class="group">
                <div class="flex items-center">
                    <div class="w-1.5 h-6 bg-gradient-to-b from-purple to-turquoise rounded-full mr-3 transition-all duration-300 group-hover:h-8"></div>
                    <h2 class="text-xl font-bold text-dark">À la une</h2>
                </div>
                <p class="max-w-lg mt-2 ml-4 text-gray-dark">Actualités et événements importants de notre établissement</p>
            </div>

            <!-- Bouton "Toutes les actualités" avec animation au survol -->
            <a href="{{ route('news') }}" class="inline-flex items-center px-4 py-2 mt-4 text-sm font-medium transition-all duration-300 border rounded-full group sm:mt-0 text-purple hover:text-white border-purple hover:bg-purple">
                <span>Toutes les actualités</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <!-- Grille d'articles avec animation au chargement de la page -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 lg:gap-8">
            @forelse($latestNews as $article)
                <!-- Article -->
                <article class="flex flex-col h-full overflow-hidden transition-all duration-500 transform bg-white border shadow-md group rounded-xl hover:shadow-xl border-gray hover:-translate-y-1">
                    <!-- Image avec overlay au survol -->
                    <div class="relative overflow-hidden aspect-video">
                        <img
                            src="{{ $article->image_url }}"
                            alt="{{ $article->title }}"
                            class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-110"
                        >
                        <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black to-transparent group-hover:opacity-30"></div>

                        <!-- Badge flottant -->
                        <div class="absolute z-10 top-3 left-3">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-{{ $article->category_color }} text-white shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    {!! $article->category_icon !!}
                                </svg>
                                {{ $article->category }}
                            </span>
                        </div>
                    </div>

                    <!-- Contenu avec espacement optimisé -->
                    <div class="flex flex-col flex-grow p-5">
                        <!-- Date avec icône plus lisible -->
                        <div class="flex items-center mb-3 text-sm text-gray-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <time datetime="{{ $article->published_at->format('Y-m-d') }}">{{ $article->published_at->format('d M Y') }}</time>
                        </div>

                        <!-- Titre avec effet de transition -->
                        <h3 class="font-bold text-sm text-dark group-hover:text-{{ $article->category == 'Service' ? 'turquoise' : 'purple' }} transition-colors duration-300 mb-3 line-clamp-2">
                            {{ $article->title }}
                        </h3>

                        <!-- Résumé avec meilleure lisibilité -->
                        <p class="flex-grow mb-5 text-sm leading-relaxed text-gray-dark line-clamp-3">
                            {{ $article->excerpt }}
                        </p>

                        <!-- CTA plus visible -->
                        <a href="{{ route('news.show', $article->slug) }}" class="inline-flex items-center font-medium text-{{ $article->category == 'Service' ? 'turquoise' : 'purple' }} hover:text-{{ $article->category == 'Service' ? 'turquoise' : 'purple' }}-dark transition-colors mt-auto group/link">
                            <span>{{ $article->category == 'Service' ? 'En savoir plus' : ($article->category == 'Équipement' ? 'Découvrir' : 'Lire plus') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 transition-transform transform group-hover/link:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </article>
            @empty
                <!-- Message si aucune actualité disponible -->
                <div class="py-10 text-center col-span-full">
                    <p class="text-gray-dark">Aucune actualité disponible pour le moment.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination mobile améliorée - uniquement si 3 articles sont présents -->
        @if($latestNews->count() == 3)
            <div class="flex items-center justify-center gap-2 mt-8 md:hidden">
                <button class="w-2.5 h-2.5 rounded-full bg-purple ring-2 ring-gray-light"></button>
                <button class="w-2 h-2 transition-colors rounded-full bg-gray hover:bg-purple-light"></button>
                <button class="w-2 h-2 transition-colors rounded-full bg-gray hover:bg-purple-light"></button>
            </div>
        @endif
    </div>
</section>
