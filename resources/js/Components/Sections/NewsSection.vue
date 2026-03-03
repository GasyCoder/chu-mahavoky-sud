<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    news: {
        type: Array,
        default: () => []
    }
});

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('fr-FR', {
        day: 'numeric',
        month: 'short',
        year: 'numeric'
    });
};
</script>

<template>
    <section class="py-24 bg-background border-b border-border/40">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Header Slim -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-8">
                <div class="max-w-2xl" data-aos="fade-right">
                    <span class="text-primary text-[10px] font-bold uppercase tracking-[0.2em]">Actualités</span>
                    <h2 class="text-3xl lg:text-4xl font-bold mt-4 mb-6 tracking-tight">À la une du CHU</h2>
                    <p class="text-muted-foreground text-sm max-w-lg">
                        Découvrez les dernières actualités, événements et avancées de notre établissement hospitalier.
                    </p>
                </div>

                <Link :href="route('news')" data-aos="fade-left"
                    class="text-[10px] font-bold uppercase tracking-[0.2em] text-primary border-b border-primary/30 pb-1 hover:border-primary transition-all">
                    Toutes les actualités
                </Link>
            </div>

            <!-- News Grid Slim -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <article v-for="(article, index) in news.slice(0, 3)" :key="article.id"
                    class="group flex flex-col h-full bg-card border border-border rounded-2xl overflow-hidden hover:border-primary/40 transition-all duration-500"
                    data-aos="fade-up" :data-aos-delay="index * 100">
                    
                    <div class="relative aspect-[16/10] overflow-hidden">
                        <img :src="article.image_url || '/assets/news-placeholder.jpg'" :alt="article.title"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-background/90 backdrop-blur-sm border border-border rounded-full text-[9px] font-bold uppercase tracking-widest text-primary">
                                {{ article.category?.name || 'Info' }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 flex flex-col flex-grow">
                        <time class="text-[9px] font-bold uppercase tracking-widest text-muted-foreground mb-3 block">
                            {{ formatDate(article.published_at) }}
                        </time>
                        <h3 class="font-bold text-lg mb-3 tracking-tight group-hover:text-primary transition-colors line-clamp-2">
                            {{ article.title }}
                        </h3>
                        <p class="text-muted-foreground text-xs leading-relaxed mb-6 line-clamp-3">
                            {{ article.excerpt }}
                        </p>
                        <Link :href="route('news.show', article.slug)" class="mt-auto inline-flex items-center text-[10px] font-bold uppercase tracking-widest text-primary group/link">
                            Lire la suite
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-2 transition-transform group-hover/link:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </Link>
                    </div>
                </article>
            </div>
        </div>
    </section>
</template>
