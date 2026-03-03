<script setup>
import { ref, onMounted } from 'vue';
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

onMounted(() => {
    window.addEventListener('scroll', () => {
        showBackToTop.value = window.scrollY > 500;
    });
});
</script>

<template>
    <footer class="bg-muted/30 border-t border-border mt-20">
        <div class="max-w-7xl mx-auto px-6 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Brand -->
                <div class="space-y-6">
                    <Link :href="route('home')" class="flex items-center space-x-3">
                        <img :src="settings?.logo || '/assets/logo.png'" alt="CHU" class="h-10 w-auto" />
                        <span class="text-lg font-bold tracking-tight">{{ settings?.site_name || 'CHU Mahavoky' }}</span>
                    </Link>
                    <p class="text-sm text-muted-foreground leading-relaxed max-w-xs">
                        {{ settings?.site_description || 'Excellence médicale et soins de proximité au cœur de Mahajanga.' }}
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider mb-6 text-foreground">Navigation</h4>
                    <ul class="space-y-4">
                        <li v-for="link in quickLinks" :key="link.name">
                            <Link :href="route(link.route)" class="text-sm text-muted-foreground hover:text-primary transition-colors">
                                {{ link.name }}
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider mb-6 text-foreground">Contact</h4>
                    <ul class="space-y-4 text-sm text-muted-foreground">
                        <li class="flex items-start space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>{{ settings?.contact?.address || 'Mahajanga, Madagascar' }}</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>{{ settings?.contact?.phone || '+261 20 00 000 00' }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Hours -->
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider mb-6 text-foreground">Horaires</h4>
                    <div class="space-y-2 text-sm text-muted-foreground">
                        <p>{{ settings?.hours?.weekdays || 'Lun - Ven: 7h30 - 17h00' }}</p>
                        <p class="text-primary font-medium">Urgences: 24h/24, 7j/7</p>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="mt-16 pt-8 border-t border-border flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-muted-foreground">
                <p>&copy; {{ currentYear }} {{ settings?.site_name }}. Tous droits réservés.</p>
                <div class="flex items-center space-x-6">
                    <a href="#" class="hover:text-primary transition-colors">Confidentialité</a>
                    <a href="https://gasycoder.com" target="_blank" class="font-medium text-primary hover:underline">GasyCoder</a>
                </div>
            </div>
        </div>

        <!-- Back to Top -->
        <button 
            @click="scrollToTop"
            class="fixed bottom-8 right-8 p-3 rounded-full bg-primary text-primary-foreground shadow-lg transition-all duration-300 hover:scale-110 active:scale-95 z-50"
            :class="showBackToTop ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10 pointer-events-none'"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>
    </footer>
</template>
