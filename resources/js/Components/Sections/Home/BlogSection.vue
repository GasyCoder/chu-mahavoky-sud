<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    latestNews: {
        type: Array,
        default: () => []
    }
});
</script>

<template>
    <!-- Section blog -->
    <section class="py-16 md:py-24 bg-white">
        <div class="container">
            <!-- En-tete de section -->
            <div class="flex flex-col items-start justify-between mb-8 sm:flex-row sm:items-center sm:mb-12">
                <div>
                    <h2 class="text-xl font-bold text-dark mb-2">A la une</h2>
                    <div class="w-12 h-1 bg-primary rounded-full mb-3"></div>
                    <p class="max-w-lg text-gray-dark">Actualites et evenements importants de notre etablissement</p>
                </div>

                <Link 
                    :href="route('news')" 
                    class="mt-4 sm:mt-0 text-primary hover:underline font-medium text-sm inline-flex items-center gap-1 transition-colors"
                >
                    Toutes les actualites
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </Link>
            </div>

            <!-- Grille d'articles -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 lg:gap-8">
                <template v-if="latestNews && latestNews.length > 0">
                    <article 
                        v-for="article in latestNews" 
                        :key="article.id"
                        class="flex flex-col h-full bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300 group"
                        data-aos="fade-up"
                    >
                        <!-- Image -->
                        <div class="relative overflow-hidden aspect-video rounded-t-2xl">
                            <img
                                :src="article.image_url"
                                :alt="article.title"
                                class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105"
                            />
                            <!-- Badge categorie -->
                            <div class="absolute z-10 top-3 left-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary backdrop-blur-sm bg-white/80">
                                    {{ article.category }}
                                </span>
                            </div>
                        </div>

                        <!-- Contenu -->
                        <div class="flex flex-col flex-grow p-5">
                            <!-- Date -->
                            <div class="flex items-center mb-3 text-sm text-gray-dark">
                                <i class="far fa-calendar-alt mr-2 text-xs"></i>
                                <time :datetime="article.published_at_iso">{{ article.published_at }}</time>
                            </div>

                            <!-- Titre -->
                            <h3 class="font-semibold text-lg text-dark group-hover:text-primary transition-colors duration-300 mb-3 line-clamp-2">
                                {{ article.title }}
                            </h3>

                            <!-- Resume -->
                            <p class="flex-grow mb-5 text-sm leading-relaxed text-gray-dark line-clamp-3">
                                {{ article.excerpt }}
                            </p>

                            <!-- CTA -->
                            <Link :href="route('news.show', article.slug)" class="inline-flex items-center font-medium text-primary hover:underline transition-colors mt-auto text-sm">
                                <span>Lire plus</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </Link>
                        </div>
                    </article>
                </template>
                <template v-else>
                    <div class="py-10 text-center col-span-full">
                        <p class="text-gray-dark">Aucune actualite disponible pour le moment.</p>
                    </div>
                </template>
            </div>
        </div>
    </section>
</template>
