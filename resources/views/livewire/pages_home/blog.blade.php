<!-- Section "À la une" avec design UI/UX optimisé et responsive -->
<section class="bg-white py-16 sm:py-20">
    <div class="container">
        <!-- En-tête de section avec animation subtile -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 sm:mb-12">
            <div class="group">
                <div class="flex items-center">
                    <div class="w-1.5 h-6 bg-gradient-to-b from-purple to-turquoise rounded-full mr-3 transition-all duration-300 group-hover:h-8"></div>
                    <h2 class="text-xl font-bold text-dark">À la une</h2>
                </div>
                <p class="text-gray-dark mt-2 ml-4 max-w-lg">Actualités et événements importants de notre établissement</p>
            </div>

            <!-- Bouton "Toutes les actualités" avec animation au survol -->
            <a href="{{ route('news') }}" class="group inline-flex items-center mt-4 sm:mt-0 px-4 py-2 rounded-full text-sm font-medium text-purple hover:text-white border border-purple hover:bg-purple transition-all duration-300">
                <span>Toutes les actualités</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <!-- Grille d'articles avec animation au chargement de la page -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @forelse($latestNews as $article)
                <!-- Article -->
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
                        <h3 class="font-bold text-sm text-dark group-hover:text-{{ $article->category == 'Service' ? 'turquoise' : 'purple' }} transition-colors duration-300 mb-3 line-clamp-2">
                            {{ $article->title }}
                        </h3>

                        <!-- Résumé avec meilleure lisibilité -->
                        <p class="text-gray-dark text-sm leading-relaxed mb-5 line-clamp-3 flex-grow">
                            {{ $article->excerpt }}
                        </p>

                        <!-- CTA plus visible -->
                        <a href="{{ route('news.show', $article->slug) }}" class="inline-flex items-center font-medium text-{{ $article->category == 'Service' ? 'turquoise' : 'purple' }} hover:text-{{ $article->category == 'Service' ? 'turquoise' : 'purple' }}-dark transition-colors mt-auto group/link">
                            <span>{{ $article->category == 'Service' ? 'En savoir plus' : ($article->category == 'Équipement' ? 'Découvrir' : 'Lire plus') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transform group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </article>
            @empty
                <!-- Message si aucune actualité disponible -->
                <div class="col-span-full py-10 text-center">
                    <p class="text-gray-dark">Aucune actualité disponible pour le moment.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination mobile améliorée - uniquement si 3 articles sont présents -->
        @if($latestNews->count() == 3)
            <div class="flex justify-center items-center gap-2 mt-8 md:hidden">
                <button class="w-2.5 h-2.5 rounded-full bg-purple ring-2 ring-gray-light"></button>
                <button class="w-2 h-2 rounded-full bg-gray hover:bg-purple-light transition-colors"></button>
                <button class="w-2 h-2 rounded-full bg-gray hover:bg-purple-light transition-colors"></button>
            </div>
        @endif
    </div>
</section>
