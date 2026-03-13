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
    <section class="py-20 lg:py-28 bg-background border-b border-border/40">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Header with right-aligned link -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
                <div class="max-w-2xl" data-aos="fade-right">
                    <span class="text-primary text-xs font-bold uppercase tracking-[0.2em]">Actualités</span>
                    <h2 class="text-3xl lg:text-4xl font-bold mt-3 mb-4 tracking-tight text-foreground">
                        À la une du CHU
                    </h2>
                    <p class="text-muted-foreground text-base leading-relaxed max-w-lg">
                        Découvrez les dernières actualités, événements et avancées de notre établissement hospitalier.
                    </p>
                </div>

                <Link
                    :href="route('news')"
                    data-aos="fade-left"
                    class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.2em] text-primary border-b border-primary/30 pb-1 hover:border-primary hover:gap-3 transition-all duration-300 self-start md:self-auto"
                >
                    Toutes les actualités
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </Link>
            </div>

            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <article
                    v-for="(article, index) in news.slice(0, 3)"
                    :key="article.id"
                    class="group flex flex-col h-full bg-card border border-border rounded-2xl overflow-hidden hover:border-primary/30 hover:shadow-xl hover:shadow-primary/5 transition-all duration-500"
                    data-aos="fade-up"
                    :data-aos-delay="index * 100"
                >
                    <!-- Image -->
                    <div class="relative aspect-[16/10] overflow-hidden">
                        <img
                            :src="article.image_url || '/assets/news-placeholder.jpg'"
                            :alt="article.title"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        />
                        <!-- Category badge -->
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-background/90 backdrop-blur-sm border border-border rounded-full text-[10px] font-bold uppercase tracking-widest text-primary">
                                {{ article.category?.name || 'Info' }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex flex-col flex-grow">
                        <time class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-3 block">
                            <i class="far fa-calendar-alt mr-1.5"></i>
                            {{ formatDate(article.published_at) }}
                        </time>

                        <h3 class="font-bold text-lg mb-3 tracking-tight text-foreground group-hover:text-primary transition-colors duration-300 line-clamp-2">
                            {{ article.title }}
                        </h3>

                        <p class="text-muted-foreground text-sm leading-relaxed mb-6 line-clamp-3">
                            {{ article.excerpt }}
                        </p>

                        <Link
                            :href="route('news.show', article.slug)"
                            class="mt-auto inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-primary hover:gap-3 transition-all duration-300"
                        >
                            Lire la suite
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </Link>
                    </div>
                </article>
            </div>
        </div>
    </section>
</template>
