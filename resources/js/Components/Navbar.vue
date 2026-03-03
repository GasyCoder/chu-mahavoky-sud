<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const props = defineProps({
    settings: {
        type: Object,
        default: () => ({})
    },
    isDark: {
        type: Boolean,
        default: false
    }
});

defineEmits(['toggle-theme']);

const page = usePage();
const isScrolled = ref(false);
const mobileMenuOpen = ref(false);

const handleScroll = () => {
    isScrolled.value = window.scrollY > 10;
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});

const closeMobileMenu = () => {
    mobileMenuOpen.value = false;
};

const menuItems = [
    { name: 'Accueil', route: 'home' },
    { name: 'Services', route: 'services' },
    { name: 'Actualités', route: 'news' },
    { name: 'Contact', route: 'contact' },
];
</script>

<template>
    <nav
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 border-b border-border/40"
        :class="[
            isScrolled 
                ? 'bg-background/90 backdrop-blur-md py-2' 
                : 'bg-background/50 backdrop-blur-sm py-4'
        ]"
    >
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-12">
                <!-- Logo & Brand -->
                <Link :href="route('home')" class="flex items-center space-x-3 group">
                    <img :src="settings?.logo || '/assets/logo.png'" alt="CHU" class="h-9 w-auto object-contain" />
                    <div class="hidden sm:block border-l border-border pl-3">
                        <h1 class="text-sm font-bold tracking-tight text-foreground leading-none uppercase">
                            {{ settings?.site_name || 'CHU Mahavoky' }}
                        </h1>
                        <p class="text-[9px] uppercase tracking-[0.2em] text-primary font-bold mt-1">Mahajanga</p>
                    </div>
                </Link>

                <!-- Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <Link v-for="item in menuItems" :key="item.name" :href="route(item.route)" 
                        class="text-[10px] font-bold uppercase tracking-[0.2em] transition-colors hover:text-primary py-2"
                        :class="[route().current(item.route) ? 'text-primary' : 'text-foreground/60']">
                        {{ item.name }}
                    </Link>
                </div>

                <!-- Actions -->
                <div class="flex items-center space-x-4">
                    <button @click="$emit('toggle-theme')" 
                        class="p-2 rounded-full hover:bg-muted transition-colors text-foreground/40 hover:text-foreground">
                        <svg v-if="isDark" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.071 16.071l.707.707M7.757 7.757l.707-.707ZM12 8a4 4 0 100 8 4 4 0 000-8z" />
                        </svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    <Link :href="route('contact')" 
                        class="hidden sm:flex items-center px-6 py-2 border border-primary/20 bg-primary/5 text-primary text-[10px] font-bold uppercase tracking-[0.15em] rounded-full hover:bg-primary hover:text-white transition-all active:scale-95">
                        Prendre RDV
                    </Link>

                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-foreground/60">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</template>
