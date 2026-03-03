<div>
    <!-- En-tete article -->
    <section class="bg-white py-10">
        <div class="container">
            <div class="flex flex-col items-start gap-2 mb-6">
                <a href="{{ route('news') }}" class="inline-flex items-center text-sm font-medium text-primary hover:underline transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour aux actualites
                </a>

                <div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary">
                        {{ $blog->category }}
                    </span>
                </div>
            </div>

            <div class="max-w-4xl mx-auto">
                <h1 class="text-xl md:text-2xl font-bold text-dark mb-4">{{ $blog->title }}</h1>

                <div class="flex items-center text-gray-dark text-sm mb-8">
                    <i class="far fa-calendar-alt mr-2"></i>
                    <time datetime="{{ $blog->published_at->format('Y-m-d') }}">{{ $blog->published_at->format('d F Y') }}</time>
                </div>

                <div class="mb-8 rounded-2xl overflow-hidden shadow-sm">
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
                <div class="flex items-center justify-center gap-3 py-6 border-t border-b border-gray-200 mb-10">
                    <span class="text-sm font-medium text-dark">Partager :</span>
                    <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(route('news.show', $blog->slug)) }}" target="_blank" rel="noopener" class="rounded-full w-10 h-10 bg-gray-light hover:bg-primary hover:text-white flex items-center justify-center text-gray-dark transition-all">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('news.show', $blog->slug)) }}&text={{ urlencode($blog->title) }}" target="_blank" rel="noopener" class="rounded-full w-10 h-10 bg-gray-light hover:bg-primary hover:text-white flex items-center justify-center text-gray-dark transition-all">
                        <i class="fab fa-twitter text-sm"></i>
                    </a>
                    <a href="https://linkedin.com/shareArticle?mini=true&url={{ urlencode(route('news.show', $blog->slug)) }}&title={{ urlencode($blog->title) }}" target="_blank" rel="noopener" class="rounded-full w-10 h-10 bg-gray-light hover:bg-primary hover:text-white flex items-center justify-center text-gray-dark transition-all">
                        <i class="fab fa-linkedin-in text-sm"></i>
                    </a>
                    <a href="mailto:?subject={{ urlencode($blog->title) }}&body={{ urlencode(route('news.show', $blog->slug)) }}" class="rounded-full w-10 h-10 bg-gray-light hover:bg-primary hover:text-white flex items-center justify-center text-gray-dark transition-all">
                        <i class="far fa-envelope text-sm"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Articles similaires -->
    @if($relatedNews->count() > 0)
        <section class="bg-gray-light py-12">
            <div class="container">
                <h2 class="text-2xl font-bold text-dark mb-2">Articles similaires</h2>
                <div class="w-12 h-1 bg-primary rounded-full mb-8"></div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedNews as $related)
                        <article class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full">
                            <div class="relative overflow-hidden aspect-video rounded-t-2xl">
                                <img
                                    src="{{ $related->image_url }}"
                                    alt="{{ $related->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                >
                            </div>

                            <div class="p-5 flex flex-col flex-grow">
                                <div class="flex items-center text-gray-dark text-sm mb-3">
                                    <i class="far fa-calendar-alt mr-2 text-xs"></i>
                                    <time datetime="{{ $related->published_at->format('Y-m-d') }}">{{ $related->published_at->format('d M Y') }}</time>
                                </div>

                                <h3 class="font-semibold text-lg text-dark group-hover:text-primary transition-colors duration-300 mb-3 line-clamp-2">
                                    {{ $related->title }}
                                </h3>

                                <p class="text-gray-dark text-sm leading-relaxed mb-5 line-clamp-3 flex-grow">
                                    {{ $related->excerpt }}
                                </p>

                                <a href="{{ route('news.show', $related->slug) }}" class="inline-flex items-center font-medium text-primary hover:underline transition-colors mt-auto text-sm">
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

    <!-- Actualites recentes -->
    @if($recentNews->count() > 0)
        <section class="bg-white py-12">
            <div class="container">
                <div class="max-w-4xl mx-auto">
                    <h2 class="text-2xl font-bold text-dark mb-2">Actualites recentes</h2>
                    <div class="w-12 h-1 bg-primary rounded-full mb-6"></div>

                    <div class="rounded-2xl bg-gray-light p-6 space-y-4">
                        @foreach($recentNews as $recent)
                            <a href="{{ route('news.show', $recent->slug) }}" class="block group">
                                <div class="flex items-start gap-4 p-3 rounded-xl hover:bg-white transition-colors">
                                    <div class="w-20 h-20 shrink-0 overflow-hidden rounded-xl">
                                        <img
                                            src="{{ $recent->image_url }}"
                                            alt="{{ $recent->title }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                        >
                                    </div>
                                    <div class="flex-grow">
                                        <h3 class="font-medium text-dark group-hover:text-primary transition-colors line-clamp-2 mb-1">
                                            {{ $recent->title }}
                                        </h3>
                                        <div class="flex items-center text-gray-dark text-xs">
                                            <i class="far fa-calendar-alt mr-1 text-xs"></i>
                                            <time datetime="{{ $recent->published_at->format('Y-m-d') }}">{{ $recent->published_at->format('d M Y') }}</time>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-8 text-center">
                        <a href="{{ route('news') }}" class="inline-flex items-center px-6 py-3 rounded-xl bg-primary text-white hover:bg-primary/90 transition-colors font-medium">
                            <span>Voir toutes les actualites</span>
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
