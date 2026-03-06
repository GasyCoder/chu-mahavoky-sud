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

const isScrolled = ref(false);
const mobileMenuOpen = ref(false);

const handleScroll = () => {
    isScrolled.value = window.scrollY > 20;
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});

const menuItems = [
    { name: 'Accueil', route: 'home' },
    { name: 'Services', route: 'services' },
    { name: 'Actualités', route: 'news' },
    { name: 'Contact', route: 'contact' },
];
</script>

<template>
    <nav
        class="fixed top-0 left-0 right-0 z-50 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 transition-all duration-300 shadow-sm"
        :class="[isScrolled ? 'py-2' : 'py-3']"
    >
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <!-- Logo & Brand (Taille réduite pour plus de professionnalisme) -->
                <Link :href="route('home')" class="flex items-center space-x-2 group">
                    <img :src="settings?.logo || '/assets/logo.png'" alt="CHU Logo" class="h-8 w-auto object-contain transition-transform group-hover:scale-105" />
                    <div class="border-l border-slate-200 dark:border-slate-700 pl-3 hidden sm:block">
                        <h1 class="text-[11px] font-black text-slate-900 dark:text-white leading-none uppercase tracking-tight">
                            {{ settings?.site_name || 'CHU Mahavoky' }}
                        </h1>
                        <p class="text-[8px] font-bold text-blue-600 uppercase tracking-widest mt-1">Mahajanga</p>
                    </div>
                </Link>

                <!-- Navigation Links (Style minimaliste) -->
                <div class="hidden md:flex items-center space-x-8">
                    <Link v-for="item in menuItems" :key="item.name" :href="route(item.route)" 
                        class="text-[10px] font-bold uppercase tracking-[0.15em] transition-colors"
                        :class="[route().current(item.route) ? 'text-blue-600' : 'text-slate-600 dark:text-slate-400 hover:text-blue-600']">
                        {{ item.name }}
                    </Link>
                </div>

                <!-- Right Actions -->
                <div class="flex items-center space-x-4">
                    <button @click="$emit('toggle-theme')" 
                        class="p-2 text-slate-400 hover:text-blue-600 transition-colors">
                        <i :class="['fas', isDark ? 'fa-sun' : 'fa-moon', 'text-xs']"></i>
                    </button>

                    <Link :href="route('contact')" 
                        class="hidden sm:inline-flex px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white text-[9px] font-bold uppercase tracking-widest rounded shadow-sm transition-all active:scale-95">
                        Prendre RDV
                    </Link>

                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-slate-600 dark:text-slate-400">
                        <i :class="['fas', mobileMenuOpen ? 'fa-times' : 'fa-bars', 'text-lg']"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div v-if="mobileMenuOpen" class="md:hidden bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800 p-6 shadow-xl animate-in slide-in-from-top-2">
            <div class="flex flex-col space-y-4">
                <Link v-for="item in menuItems" :key="item.name" :href="route(item.route)" 
                    @click="mobileMenuOpen = false"
                    class="text-xs font-bold uppercase tracking-widest text-slate-600 dark:text-slate-400">
                    {{ item.name }}
                </Link>
                <Link :href="route('contact')" class="w-full py-2.5 bg-blue-700 text-white text-center text-xs font-bold uppercase tracking-widest rounded shadow-sm">
                    Prendre RDV
                </Link>
            </div>
        </div>
    </nav>
</template>
