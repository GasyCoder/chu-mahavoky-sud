<script setup>
import { ref, watch, onMounted } from 'vue';
import { router, Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    news: {
        type: Object,
        default: () => ({ data: [], last_page: 1, current_page: 1 })
    },
    featuredNews: {
        type: Array,
        default: () => []
    },
    categories: {
        type: Array,
        default: () => []
    },
    filters: {
        type: Object,
        default: () => ({ search: '', category: '' })
    }
});

const search = ref(props.filters.search || '');
const category = ref(props.filters.category || '');
const loading = ref(false);

const loadNews = () => {
    loading.value = true;
    router.get(route('news'), {
        search: search.value,
        category: category.value,
    }, {
        preserveState: true,
        preserveScroll: true,
        onFinish: () => loading.value = false
    });
};

watch([search, category], () => {
    loadNews();
});

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('fr-FR', {
        day: 'numeric',
        month: 'short',
        year: 'numeric'
    });
};

const handleImageError = (e) => {
    e.target.src = '/assets/herobg.jpg'; // Image de secours fiable
};

const clearFilters = () => {
    search.value = '';
    category.value = '';
};
</script>

<template>
    <AppLayout title="Actualités">
        <Head title="Nos Actualités" />

        <!-- Banner Slim -->
        <section class="relative pt-32 pb-16 bg-background border-b border-border/40 overflow-hidden">
            <div class="absolute inset-0 z-0 opacity-5">
                <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(#0055A4_1px,transparent_1px)] [background-size:20px_20px]"></div>
            </div>
            
            <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
                <div class="max-w-3xl text-left" data-aos="fade-right">
                    <span class="text-primary text-[10px] font-bold uppercase tracking-[0.2em]">CHU Mahajanga</span>
                    <h1 class="text-4xl md:text-5xl font-bold mt-4 mb-6 tracking-tight text-foreground">Actualités & Événements</h1>
                    <p class="text-muted-foreground text-base md:text-lg max-w-xl leading-relaxed">
                        Restez informé des dernières avancées médicales, des événements et de la vie de notre établissement hospitalier.
                    </p>
                </div>
            </div>
        </section>

        <!-- Controls Bar -->
        <section class="sticky top-16 z-30 bg-background/80 backdrop-blur-md border-b border-border/40 py-4">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <!-- Search Slim -->
                    <div class="relative max-w-sm w-full">
                        <input v-model="search" type="text" placeholder="Rechercher un article..." 
                            class="w-full bg-muted/50 border-border/50 rounded-full pl-10 pr-4 py-2 text-xs font-medium focus:ring-primary/20 focus:border-primary transition-all" />
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <!-- Categories Slim -->
                    <div class="flex items-center space-x-2 overflow-x-auto pb-2 md:pb-0 no-scrollbar">
                        <button @click="category = ''" 
                            class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest transition-all whitespace-nowrap"
                            :class="!category ? 'bg-primary text-primary-foreground shadow-sm' : 'hover:bg-muted text-muted-foreground'">
                            Tous
                        </button>
                        <button v-for="cat in categories" :key="cat" @click="category = cat"
                            class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest transition-all whitespace-nowrap"
                            :class="category === cat ? 'bg-primary text-primary-foreground shadow-sm' : 'hover:bg-muted text-muted-foreground'">
                            {{ cat }}
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="py-20 bg-background min-h-[60vh]">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <!-- Grid -->
                <div v-if="news.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <article v-for="(article, index) in news.data" :key="article.id"
                        class="group flex flex-col h-full bg-card border border-border/60 rounded-2xl overflow-hidden hover:border-primary/40 transition-all duration-500"
                        data-aos="fade-up" :data-aos-delay="index * 50">
                        
                        <div class="relative aspect-[16/10] overflow-hidden">
                            <img :src="article.image_url" :alt="article.title"
                                @error="handleImageError"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-background/90 backdrop-blur-sm border border-border rounded-full text-[9px] font-bold uppercase tracking-widest text-primary">
                                    {{ article.category }}
                                </span>
                            </div>

                        </div>

                        <div class="p-8 flex flex-col flex-grow">
                            <time class="text-[9px] font-bold uppercase tracking-widest text-muted-foreground mb-4 block">
                                {{ formatDate(article.published_at) }}
                            </time>
                            <h3 class="font-bold text-xl mb-4 tracking-tight group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                                {{ article.title }}
                            </h3>
                            <p class="text-muted-foreground text-sm leading-relaxed mb-8 line-clamp-3">
                                {{ article.excerpt }}
                            </p>
                            <Link :href="route('news.show', article.slug)" class="mt-auto inline-flex items-center text-[10px] font-bold uppercase tracking-widest text-primary group/link">
                                Lire l'article
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-2 transition-transform group-hover/link:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </Link>
                        </div>
                    </article>
                </div>

                <!-- Empty State -->
                <div v-else class="py-20 text-center" data-aos="fade-up">
                    <div class="w-16 h-16 bg-muted rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Aucun article trouvé</h3>
                    <p class="text-muted-foreground text-sm mb-8">Essayez de modifier vos filtres ou votre recherche.</p>
                    <button @click="clearFilters" class="px-6 py-2 bg-primary text-primary-foreground text-[10px] font-bold uppercase tracking-widest rounded-full">
                        Réinitialiser
                    </button>
                </div>

                <!-- Pagination Slim -->
                <div v-if="news.last_page > 1" class="mt-20 flex justify-center border-t border-border/40 pt-10">
                    <div class="flex items-center space-x-1">
                        <Link v-for="link in news.links" :key="link.label"
                            :href="link.url || '#'"
                            class="px-4 py-2 text-[10px] font-bold uppercase tracking-widest rounded-full transition-all"
                            :class="[
                                link.active ? 'bg-primary text-primary-foreground shadow-md' : 'text-muted-foreground hover:bg-muted',
                                !link.url ? 'opacity-30 cursor-not-allowed' : ''
                            ]"
                            v-html="link.label"
                        />
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
