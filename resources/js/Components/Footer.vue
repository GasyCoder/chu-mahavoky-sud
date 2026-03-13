<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    settings: {
        type: Object,
        default: () => ({})
    }
});

const currentYear = new Date().getFullYear();
const showBackToTop = ref(false);

const quickLinks = [
    { name: 'Accueil', route: 'home' },
    { name: 'Services', route: 'services' },
    { name: 'Actualités', route: 'news' },
    { name: 'Contact', route: 'contact' },
];

const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
};

const handleScroll = () => {
    showBackToTop.value = window.scrollY > 500;
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <footer class="bg-background border-t border-border mt-20">
        <!-- Emergency Banner -->
        <div class="bg-red-50 dark:bg-red-950/30 border-b border-red-100 dark:border-red-900/30">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-3 flex flex-col sm:flex-row items-center justify-between gap-2">
                <div class="flex items-center gap-2 text-sm font-semibold text-red-700 dark:text-red-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                    <span>Service des urgences disponible 24h/24, 7j/7</span>
                </div>
                <a
                    :href="'tel:' + (settings?.contact?.emergency || '117')"
                    class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-full transition-colors duration-200"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    Appeler: {{ settings?.contact?.emergency || '117' }}
                </a>
            </div>
        </div>

        <!-- Main Footer Content -->
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12">
                <!-- Brand Column -->
                <div class="lg:col-span-1 space-y-5">
                    <Link :href="route('home')" class="flex items-center gap-3 group">
                        <img
                            :src="settings?.logo || '/assets/logo.png'"
                            alt="CHU Logo"
                            class="h-10 w-auto object-contain transition-transform duration-200 group-hover:scale-105"
                        />
                        <div>
                            <h3 class="text-sm font-bold text-foreground leading-tight">
                                {{ settings?.site_name || 'CHU Mahavoky' }}
                            </h3>
                            <p class="text-xs text-primary font-medium">Mahajanga</p>
                        </div>
                    </Link>
                    <p class="text-sm text-muted-foreground leading-relaxed max-w-xs">
                        {{ settings?.site_description || 'Excellence médicale et soins de proximité au cœur de Mahajanga.' }}
                    </p>

                    <!-- Social Links -->
                    <div class="flex items-center gap-3">
                        <a
                            v-if="settings?.social?.facebook"
                            :href="settings.social.facebook"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="p-2 rounded-lg bg-muted/50 text-muted-foreground hover:text-primary hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors duration-200"
                            aria-label="Facebook"
                        >
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a
                            v-if="settings?.social?.twitter"
                            :href="settings.social.twitter"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="p-2 rounded-lg bg-muted/50 text-muted-foreground hover:text-primary hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors duration-200"
                            aria-label="Twitter"
                        >
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                        <a
                            v-if="settings?.social?.linkedin"
                            :href="settings.social.linkedin"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="p-2 rounded-lg bg-muted/50 text-muted-foreground hover:text-primary hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors duration-200"
                            aria-label="LinkedIn"
                        >
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                        <a
                            v-if="settings?.social?.youtube"
                            :href="settings.social.youtube"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="p-2 rounded-lg bg-muted/50 text-muted-foreground hover:text-primary hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors duration-200"
                            aria-label="YouTube"
                        >
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Navigation Column -->
                <div>
                    <h4 class="text-sm font-semibold text-foreground mb-5">Navigation</h4>
                    <ul class="space-y-3">
                        <li v-for="link in quickLinks" :key="link.name">
                            <Link
                                :href="route(link.route)"
                                class="inline-flex items-center gap-2 text-sm text-muted-foreground hover:text-primary transition-colors duration-200"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                                {{ link.name }}
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Contact Column -->
                <div>
                    <h4 class="text-sm font-semibold text-foreground mb-5">Contact</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-sm text-muted-foreground leading-relaxed">
                                {{ settings?.contact?.address || 'Mahajanga, Madagascar' }}
                            </span>
                        </li>
                        <li>
                            <a
                                :href="'tel:' + (settings?.contact?.phone || '+261 20 00 000 00')"
                                class="flex items-center gap-3 text-sm text-muted-foreground hover:text-primary transition-colors duration-200"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                {{ settings?.contact?.phone || '+261 20 00 000 00' }}
                            </a>
                        </li>
                        <li v-if="settings?.contact?.email">
                            <a
                                :href="'mailto:' + settings.contact.email"
                                class="flex items-center gap-3 text-sm text-muted-foreground hover:text-primary transition-colors duration-200"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                {{ settings.contact.email }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Hours Column -->
                <div>
                    <h4 class="text-sm font-semibold text-foreground mb-5">Horaires</h4>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="text-sm text-muted-foreground space-y-1">
                                <p>{{ settings?.hours?.weekdays || 'Lun - Ven: 7h30 - 17h00' }}</p>
                                <p v-if="settings?.hours?.saturday">{{ settings.hours.saturday }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <p class="text-sm font-medium text-red-600 dark:text-red-400">
                                Urgences: 24h/24, 7j/7
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-border bg-muted/30">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-5 flex flex-col sm:flex-row justify-between items-center gap-3">
                <p class="text-xs text-muted-foreground">
                    &copy; {{ currentYear }} {{ settings?.site_name || 'CHU Mahavoky' }}. Tous droits réservés.
                </p>
                <div class="flex items-center gap-4 text-xs text-muted-foreground">
                    <a href="#" class="hover:text-primary transition-colors duration-200">Confidentialité</a>
                    <span class="text-border">|</span>
                    <span>
                        Conçu par
                        <a
                            href="https://gasycoder.com"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="font-medium text-primary hover:underline"
                        >GasyCoder</a>
                    </span>
                </div>
            </div>
        </div>

        <!-- Back to Top Button -->
        <Transition
            enter-active-class="transition-all duration-300 ease-out"
            enter-from-class="opacity-0 translate-y-4"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition-all duration-200 ease-in"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 translate-y-4"
        >
            <button
                v-if="showBackToTop"
                @click="scrollToTop"
                class="fixed bottom-8 right-8 p-3 rounded-full bg-primary text-primary-foreground shadow-elevated transition-transform duration-200 hover:scale-110 active:scale-95 z-50"
                aria-label="Retour en haut"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
            </button>
        </Transition>
    </footer>
</template>
