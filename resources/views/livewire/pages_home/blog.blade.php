<!-- Section blog - Design moderne avec effets de survol -->
<section class="py-20 md:py-28 bg-white relative overflow-hidden">
    <!-- Elements decoratifs -->
    <div class="absolute top-0 left-1/2 w-[800px] h-[800px] bg-primary/3 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
    
    <div class="container relative z-10">
        <!-- En-tete de section ameliore -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 md:mb-16 gap-6" data-aos="fade-up">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 bg-primary/10 rounded-full px-4 py-2 mb-4">
                    <i class="fas fa-newspaper text-primary text-sm"></i>
                    <span class="text-sm font-semibold text-primary">Actualites & Evenements</span>
                </div>
                <h2 class="text-2xl md:text-3xl font-bold text-dark mb-3">A la une</h2>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-16 h-1 bg-gradient-to-r from-primary to-blue-500 rounded-full"></div>
                </div>
                <p class="text-gray-600 leading-relaxed">
                    Decouvrez les dernieres actualites, evenements et avancées de notre etablissement hospitalier
                </p>
            </div>

            <a href="{{ route('news') }}" class="group inline-flex items-center gap-2 text-primary hover:text-primary/80 font-semibold text-sm transition-all duration-300">
                <span class="px-5 py-2.5 bg-primary/10 rounded-xl group-hover:bg-primary/20 transition-colors">Toutes les actualites</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>

        <!-- Grille d'articles avec design moderne -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @forelse($latestNews as $article)
                <article class="group flex flex-col h-full bg-white rounded-3xl shadow-lg shadow-slate-200/50 overflow-hidden hover:shadow-2xl hover:shadow-primary/15 transition-all duration-500 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <!-- Image avec overlay -->
                    <div class="relative overflow-hidden aspect-[16/10]">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10"></div>
                        <img
                            src="{{ $article->image_url }}"
                            alt="{{ $article->title }}"
                            class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-110"
                        >
                        <!-- Badge categorie avec glassmorphism -->
                        <div class="absolute top-4 left-4 z-20">
                            <span class="inline-flex items-center px-3.5 py-1.5 rounded-full text-xs font-semibold bg-white/90 backdrop-blur-sm text-primary shadow-lg">
                                {{ $article->category }}
                            </span>
                        </div>
                        <!-- Date badge en bas -->
                        <div class="absolute bottom-4 left-4 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <div class="flex items-center gap-2 text-white/90 text-sm">
                                <i class="far fa-calendar-alt"></i>
                                <time datetime="{{ $article->published_at->format('Y-m-d') }}">{{ $article->published_at->format('d M Y') }}</time>
                            </div>
                        </div>
                    </div>

                    <!-- Contenu avec padding ameliore -->
                    <div class="flex flex-col flex-grow p-6">
                        <!-- Date visible par defaut -->
                        <div class="flex items-center mb-3 text-xs text-gray-500 group-hover:hidden transition-opacity duration-300">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <time datetime="{{ $article->published_at->format('Y-m-d') }}">{{ $article->published_at->format('d M Y') }}</time>
                        </div>

                        <!-- Titre avec animation -->
                        <h3 class="font-bold text-lg text-dark group-hover:text-primary transition-colors duration-300 mb-3 line-clamp-2 leading-snug">
                            {{ $article->title }}
                        </h3>

                        <!-- Resume -->
                        <p class="flex-grow mb-5 text-sm leading-relaxed text-gray-600 line-clamp-3">
                            {{ $article->excerpt }}
                        </p>

                        <!-- CTA avec design moderne -->
                        <a href="{{ route('news.show', $article->slug) }}" class="group/btn inline-flex items-center font-semibold text-primary hover:text-primary/80 transition-all duration-300 text-sm">
                            <span class="pr-2">Lire l'article</span>
                            <span class="relative">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform duration-300 group-hover/btn:translate-x-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                                <span class="absolute inset-0 bg-primary/20 rounded-full blur-sm scale-0 group-hover/btn:scale-100 transition-transform duration-300"></span>
                            </span>
                        </a>
                    </div>
                </article>
            @empty
                <div class="py-16 text-center col-span-full">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="far fa-newspaper text-4xl text-gray-400"></i>
                    </div>
                    <p class="text-gray-500 text-lg mb-2">Aucune actualite disponible</p>
                    <p class="text-gray-400 text-sm">Revenez bientot pour decouvrir nos dernieres nouvelles</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
