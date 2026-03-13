<script setup>
import { onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PageBanner from '@/Components/Ui/PageBanner.vue';
import Badge from '@/Components/Ui/Badge.vue';
import Card from '@/Components/Ui/Card.vue';

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

        <!-- Banner -->
        <PageBanner
            :title="blog.title"
            :label="blog.category"
            :breadcrumbs="[
                { label: 'Accueil', route: 'home' },
                { label: 'Actualités', route: 'news' },
                { label: blog.published_at }
            ]"
        />

        <!-- Main Content -->
        <section class="py-16 bg-background min-h-[60vh]">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                    <!-- Article Content -->
                    <div class="lg:col-span-2 space-y-12">
                        <article class="prose prose-sm md:prose-base dark:prose-invert max-w-none" data-aos="fade-up">
                            <!-- Featured Image -->
                            <div v-if="blog.image_url" class="relative aspect-video overflow-hidden rounded-2xl border border-border mb-10 shadow-lg">
                                <img :src="blog.image_url" :alt="blog.title" class="w-full h-full object-cover" />
                            </div>

                            <!-- Excerpt -->
                            <div class="text-muted-foreground leading-relaxed text-lg italic mb-10 border-l-4 border-primary/20 pl-6 not-prose">
                                {{ blog.excerpt }}
                            </div>

                            <!-- Content -->
                            <div v-html="blog.content" class="content-rich text-foreground/80 leading-loose"></div>
                        </article>

                        <!-- Share Buttons -->
                        <div class="py-8 border-t border-b border-border flex flex-wrap items-center justify-between gap-6" data-aos="fade-up">
                            <span class="text-xs font-bold uppercase tracking-[0.15em] text-muted-foreground">Partager cet article</span>
                            <div class="flex items-center gap-3">
                                <a
                                    v-for="social in [
                                        { name: 'facebook', icon: 'fab fa-facebook-f', url: `https://facebook.com/sharer/sharer.php?u=${shareUrl}` },
                                        { name: 'twitter', icon: 'fab fa-twitter', url: `https://twitter.com/intent/tweet?url=${shareUrl}&text=${shareTitle}` },
                                        { name: 'linkedin', icon: 'fab fa-linkedin-in', url: `https://linkedin.com/shareArticle?mini=true&url=${shareUrl}&title=${shareTitle}` }
                                    ]"
                                    :key="social.name"
                                    :href="social.url"
                                    target="_blank"
                                    rel="noopener"
                                    class="w-10 h-10 rounded-full border border-border bg-card flex items-center justify-center text-muted-foreground hover:bg-primary hover:text-white hover:border-primary transition-all active:scale-95"
                                >
                                    <i :class="social.icon" class="text-xs"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Related News -->
                        <div v-if="relatedNews.length > 0" class="space-y-8" data-aos="fade-up">
                            <h3 class="text-lg font-bold text-foreground">Articles Similaires</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <article
                                    v-for="related in relatedNews"
                                    :key="related.id"
                                    class="group flex flex-col h-full bg-card border border-border rounded-2xl overflow-hidden hover:border-primary/40 hover:shadow-elevated transition-all duration-500"
                                >
                                    <div class="relative aspect-video overflow-hidden">
                                        <img :src="related.image_url" :alt="related.title" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                                    </div>
                                    <div class="p-6">
                                        <time class="text-xs font-medium text-muted-foreground mb-2 block">{{ related.published_at }}</time>
                                        <h4 class="font-bold text-base mb-4 text-foreground tracking-tight group-hover:text-primary transition-colors line-clamp-2">
                                            {{ related.title }}
                                        </h4>
                                        <Link :href="route('news.show', related.slug)" class="text-xs font-bold uppercase tracking-widest text-primary inline-flex items-center group/link">
                                            Lire la suite
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 ml-1.5 transition-transform group-hover/link:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                            </svg>
                                        </Link>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-8">
                        <!-- Recent Posts -->
                        <Card :padding="false" data-aos="fade-left">
                            <div class="p-6 border-b border-border">
                                <h3 class="text-sm font-bold uppercase tracking-wider text-foreground">Dernières Actualités</h3>
                            </div>
                            <div class="p-6 space-y-5">
                                <Link
                                    v-for="recent in recentNews"
                                    :key="recent.id"
                                    :href="route('news.show', recent.slug)"
                                    class="group flex items-start gap-4"
                                >
                                    <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0 border border-border">
                                        <img :src="recent.image_url" class="w-full h-full object-cover transition-transform group-hover:scale-110" />
                                    </div>
                                    <div class="flex-grow min-w-0">
                                        <h4 class="text-sm font-semibold text-foreground group-hover:text-primary transition-colors leading-snug line-clamp-2 mb-1">
                                            {{ recent.title }}
                                        </h4>
                                        <time class="text-xs text-muted-foreground">{{ recent.published_at }}</time>
                                    </div>
                                </Link>
                            </div>
                        </Card>

                        <!-- CTA Card -->
                        <div class="bg-primary rounded-2xl p-8 text-white space-y-5 shadow-xl shadow-primary/20" data-aos="fade-left" data-aos-delay="100">
                            <h3 class="text-xl font-bold tracking-tight">Besoin d'un renseignement ?</h3>
                            <p class="text-sm text-white/80 leading-relaxed">
                                Nos équipes sont à votre écoute pour toute question concernant nos services ou votre prise en charge.
                            </p>
                            <Link
                                :href="route('contact')"
                                class="w-full flex items-center justify-center px-6 py-3 bg-white text-foreground text-sm font-bold rounded-full hover:bg-white/90 transition-all active:scale-95"
                            >
                                Nous Contacter
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
