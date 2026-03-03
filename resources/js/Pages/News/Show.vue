<script setup>
import { onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    blog: {
        type: Object,
        required: true
    },
    relatedNews: {
        type: Array,
        default: () => []
    },
    recentNews: {
        type: Array,
        default: () => []
    }
});

const shareUrl = typeof window !== 'undefined' ? encodeURIComponent(window.location.href) : '';
const shareTitle = encodeURIComponent(props.blog.title);
</script>

<template>
    <AppLayout :title="blog.title">
        <Head :title="blog.title" />

        <!-- Banner Slim -->
        <section class="relative pt-32 pb-16 bg-background border-b border-border/40 overflow-hidden">
            <div class="absolute inset-0 z-0 opacity-5">
                <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(#0055A4_1px,transparent_1px)] [background-size:20px_20px]"></div>
            </div>
            
            <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
                <div class="max-w-4xl text-left" data-aos="fade-right">
                    <div class="inline-flex items-center space-x-2 bg-primary/5 border border-primary/10 rounded-full px-3 py-1 mb-6">
                        <span class="text-[9px] font-bold uppercase tracking-[0.2em] text-primary">
                            {{ blog.category }}
                        </span>
                    </div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mt-2 mb-6 tracking-tight text-foreground leading-tight">
                        {{ blog.title }}
                    </h1>
                    
                    <nav class="flex items-center space-x-2 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">
                        <Link :href="route('home')" class="hover:text-primary transition-colors">Accueil</Link>
                        <span>/</span>
                        <Link :href="route('news')" class="hover:text-primary transition-colors">Actualités</Link>
                        <span>/</span>
                        <time class="text-primary">{{ blog.published_at }}</time>
                    </nav>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="py-20 bg-background min-h-[60vh]">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    
                    <!-- Article Content -->
                    <div class="lg:col-span-2 space-y-12">
                        <article class="prose prose-sm md:prose-base dark:prose-invert max-w-none" data-aos="fade-up">
                            <div v-if="blog.image_url" class="relative aspect-video overflow-hidden rounded-3xl border border-border/40 mb-12 shadow-xl shadow-foreground/5">
                                <img :src="blog.image_url" :alt="blog.title" class="w-full h-full object-cover" />
                            </div>

                            <div class="text-muted-foreground leading-relaxed text-lg italic mb-10 border-l-4 border-primary/20 pl-6">
                                {{ blog.excerpt }}
                            </div>

                            <div v-html="blog.content" class="content-rich text-foreground/80 leading-loose"></div>
                        </article>

                        <!-- Share Slim -->
                        <div class="py-8 border-t border-b border-border/40 flex flex-wrap items-center justify-between gap-6" data-aos="fade-up">
                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-muted-foreground">Partager cet article</span>
                            <div class="flex items-center space-x-3">
                                <a v-for="social in [
                                    { name: 'facebook', icon: 'fab fa-facebook-f', url: `https://facebook.com/sharer/sharer.php?u=${shareUrl}` },
                                    { name: 'twitter', icon: 'fab fa-twitter', url: `https://twitter.com/intent/tweet?url=${shareUrl}&text=${shareTitle}` },
                                    { name: 'linkedin', icon: 'fab fa-linkedin-in', url: `https://linkedin.com/shareArticle?mini=true&url=${shareUrl}&title=${shareTitle}` }
                                ]" :key="social.name" :href="social.url" target="_blank" rel="noopener"
                                    class="w-10 h-10 rounded-full border border-border flex items-center justify-center text-muted-foreground hover:bg-primary hover:text-primary-foreground hover:border-primary transition-all active:scale-95">
                                    <i :class="social.icon" class="text-xs"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Related News Slim -->
                        <div v-if="relatedNews.length > 0" class="space-y-8" data-aos="fade-up">
                            <h3 class="text-[11px] font-bold uppercase tracking-[0.2em] text-primary">Articles Similaires</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <article v-for="related in relatedNews" :key="related.id"
                                    class="group flex flex-col h-full bg-card border border-border/60 rounded-2xl overflow-hidden hover:border-primary/40 transition-all duration-500">
                                    <div class="relative aspect-video overflow-hidden">
                                        <img :src="related.image_url" :alt="related.title" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                                    </div>
                                    <div class="p-6">
                                        <time class="text-[9px] font-bold uppercase tracking-widest text-muted-foreground mb-2 block">{{ related.published_at }}</time>
                                        <h4 class="font-bold text-base mb-4 tracking-tight group-hover:text-primary transition-colors line-clamp-2">{{ related.title }}</h4>
                                        <Link :href="route('news.show', related.slug)" class="text-[9px] font-bold uppercase tracking-widest text-primary inline-flex items-center">
                                            Lire la suite
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1.5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                            </svg>
                                        </Link>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-12">
                        <!-- Recent Posts Slim -->
                        <div class="bg-card border border-border/60 rounded-3xl p-8 space-y-8" data-aos="fade-left">
                            <h3 class="text-[11px] font-bold uppercase tracking-[0.2em] text-foreground">Dernières Actualités</h3>
                            <div class="space-y-6">
                                <Link v-for="recent in recentNews" :key="recent.id" :href="route('news.show', recent.slug)"
                                    class="group flex items-start space-x-4">
                                    <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0 border border-border">
                                        <img :src="recent.image_url" class="w-full h-full object-cover transition-transform group-hover:scale-110" />
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="text-xs font-bold text-foreground group-hover:text-primary transition-colors leading-snug line-clamp-2 mb-1">
                                            {{ recent.title }}
                                        </h4>
                                        <time class="text-[9px] font-bold uppercase tracking-widest text-muted-foreground">{{ recent.published_at }}</time>
                                    </div>
                                </Link>
                            </div>
                        </div>

                        <!-- CTA Slim -->
                        <div class="bg-primary rounded-3xl p-8 text-primary-foreground space-y-6 shadow-xl shadow-primary/20" data-aos="fade-left" data-aos-delay="100">
                            <h3 class="text-xl font-bold tracking-tight">Besoin d'un renseignement ?</h3>
                            <p class="text-sm text-primary-foreground/80 leading-relaxed">
                                Nos équipes sont à votre écoute pour toute question concernant nos services ou votre prise en charge.
                            </p>
                            <Link :href="route('contact')" 
                                class="w-full flex items-center justify-center px-6 py-3 bg-background text-foreground text-[10px] font-bold uppercase tracking-widest rounded-full hover:bg-muted transition-all active:scale-95">
                                Nous Contacter
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
