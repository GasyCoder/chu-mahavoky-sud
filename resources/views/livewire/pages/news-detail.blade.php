<div>
    <!-- En-tête de l'article -->
    <section class="bg-white py-10">
        <div class="container">
            <div class="flex flex-col items-start gap-2 mb-6">
                <a href="{{ route('news') }}" class="inline-flex items-center text-sm font-medium text-purple hover:text-purple-dark transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour aux actualités
                </a>

                <div>
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-{{ $blog->category_color }} text-white shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            {!! $blog->category_icon !!}
                        </svg>
                        {{ $blog->category }}
                    </span>
                </div>
            </div>

            <div class="max-w-4xl mx-auto">
                <h1 class="text-xl md:text-xl font-bold text-dark mb-4">{{ $blog->title }}</h1>

                <div class="flex items-center text-gray-dark text-sm mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <time datetime="{{ $blog->published_at->format('Y-m-d') }}">{{ $blog->published_at->format('d F Y') }}</time>
                </div>

                <div class="mb-8 rounded-xl overflow-hidden shadow-md">
                    <img
                        src="{{ $blog->image_url }}"
                        alt="{{ $blog->title }}"
                        class="w-full h-auto object-cover max-h-[50vh]"
                    >
                </div>

                <div class="prose prose-lg max-w-none mb-10">
                    {!! $blog->content !!}
                </div>

                <!-- Partage social -->
                <div class="flex items-center justify-center gap-4 py-6 border-t border-b border-gray mb-10">
                    <span class="text-sm font-medium text-dark">Partager :</span>
                    <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(route('news.show', $blog->slug)) }}" target="_blank" rel="noopener" class="text-purple hover:text-purple-dark transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                        </svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('news.show', $blog->slug)) }}&text={{ urlencode($blog->title) }}" target="_blank" rel="noopener" class="text-purple hover:text-purple-dark transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/>
                        </svg>
                    </a>
                    <a href="https://linkedin.com/shareArticle?mini=true&url={{ urlencode(route('news.show', $blog->slug)) }}&title={{ urlencode($blog->title) }}" target="_blank" rel="noopener" class="text-purple hover:text-purple-dark transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    <a href="mailto:?subject={{ urlencode($blog->title) }}&body={{ urlencode(route('news.show', $blog->slug)) }}" class="text-purple hover:text-purple-dark transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Articles liés -->
    @if($relatedNews->count() > 0)
        <section class="bg-gray-light py-12">
            <div class="container">
                <h2 class="text-2xl font-bold text-dark mb-8 flex items-center">
                    <div class="w-1.5 h-6 bg-gradient-to-b from-purple to-turquoise rounded-full mr-3"></div>
                    Articles similaires
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedNews as $related)
                        <article class="group bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 border border-gray flex flex-col h-full transform hover:-translate-y-1">
                            <!-- Image avec overlay au survol -->
                            <div class="relative overflow-hidden aspect-video">
                                <img
                                    src="{{ $related->image_url }}"
                                    alt="{{ $related->title }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                            </div>

                            <!-- Contenu avec espacement optimisé -->
                            <div class="p-5 flex flex-col flex-grow">
                                <!-- Date avec icône plus lisible -->
                                <div class="flex items-center text-gray-dark text-sm mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <time datetime="{{ $related->published_at->format('Y-m-d') }}">{{ $related->published_at->format('d M Y') }}</time>
                                </div>

                                <!-- Titre avec effet de transition -->
                                <h3 class="font-bold text-lg text-dark group-hover:text-purple transition-colors duration-300 mb-3 line-clamp-2">
                                    {{ $related->title }}
                                </h3>

                                <!-- Résumé avec meilleure lisibilité -->
                                <p class="text-gray-dark text-sm leading-relaxed mb-5 line-clamp-3 flex-grow">
                                    {{ $related->excerpt }}
                                </p>

                                <!-- CTA plus visible -->
                                <a href="{{ route('news.show', $related->slug) }}" class="inline-flex items-center font-medium text-purple hover:text-purple-dark transition-colors mt-auto group/link">
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

    <!-- Actualités récentes (sidebar design) -->
    @if($recentNews->count() > 0)
        <section class="bg-white py-12">
            <div class="container">
                <div class="max-w-4xl mx-auto">
                    <h2 class="text-2xl font-bold text-dark mb-6 flex items-center">
                        <div class="w-1.5 h-6 bg-gradient-to-b from-purple to-turquoise rounded-full mr-3"></div>
                        Actualités récentes
                    </h2>

                    <div class="space-y-4">
                        @foreach($recentNews as $recent)
                            <a href="{{ route('news.show', $recent->slug) }}" class="block group">
                                <div class="flex items-start gap-4 p-4 rounded-lg hover:bg-gray-light transition-colors">
                                    <div class="w-20 h-20 shrink-0 overflow-hidden rounded-lg">
                                        <img
                                            src="{{ $recent->image_url }}"
                                            alt="{{ $recent->title }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                        >
                                    </div>
                                    <div class="flex-grow">
                                        <h3 class="font-medium text-dark group-hover:text-purple transition-colors line-clamp-2 mb-1">
                                            {{ $recent->title }}
                                        </h3>
                                        <div class="flex items-center text-gray-dark text-xs">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <time datetime="{{ $recent->published_at->format('Y-m-d') }}">{{ $recent->published_at->format('d M Y') }}</time>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-8 text-center">
                        <a href="{{ route('news') }}" class="inline-flex items-center px-5 py-2.5 rounded-full bg-purple text-white hover:bg-purple-dark transition-colors">
                            <span>Voir toutes les actualités</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
