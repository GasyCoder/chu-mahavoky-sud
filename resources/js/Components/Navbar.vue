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
    handleScroll();
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
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
        :class="[
            isScrolled
                ? 'py-2 bg-white/95 dark:bg-slate-900/95 backdrop-blur-md shadow-soft border-b border-border'
                : 'py-4 bg-white dark:bg-slate-900 border-b border-border'
        ]"
    >
        <!-- Optional top bar with emergency number (desktop only) -->
        <div
            v-if="!isScrolled"
            class="hidden lg:block border-b border-border"
        >
            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-1.5 flex items-center justify-between text-xs text-muted-foreground">
                <div class="flex items-center gap-4">
                    <span class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Lun - Ven: 7h30 - 17h00
                    </span>
                    <span class="text-border">|</span>
                    <span class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ settings?.contact?.address || 'Mahajanga, Madagascar' }}
                    </span>
                </div>
                <div class="flex items-center gap-1.5 text-destructive font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    Urgences: {{ settings?.contact?.emergency || '117' }}
                </div>
            </div>
        </div>

        <!-- Main navbar -->
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-14">
                <!-- Logo & Brand -->
                <Link :href="route('home')" class="flex items-center gap-3 group flex-shrink-0">
                    <img
                        :src="settings?.logo || '/assets/logo.png'"
                        alt="CHU Logo"
                        class="h-9 w-auto object-contain transition-transform duration-200 group-hover:scale-105"
                        :class="isScrolled ? 'h-8' : 'h-9'"
                    />
                    <div class="hidden sm:block">
                        <h1 class="text-sm font-bold text-foreground leading-tight">
                            {{ settings?.site_name || 'CHU Mahavoky' }}
                        </h1>
                        <p class="text-[11px] text-emerald-600 dark:text-emerald-400 font-medium leading-tight">Mahajanga</p>
                    </div>
                </Link>

                <!-- Desktop Navigation Links (centered) -->
                <div class="hidden md:flex items-center gap-1">
                    <Link
                        v-for="item in menuItems"
                        :key="item.name"
                        :href="route(item.route)"
                        class="relative px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200"
                        :class="[
                            route().current(item.route)
                                ? 'text-primary'
                                : 'text-muted-foreground hover:text-foreground hover:bg-muted/50'
                        ]"
                    >
                        {{ item.name }}
                        <!-- Active indicator -->
                        <span
                            v-if="route().current(item.route)"
                            class="absolute bottom-0 left-1/2 -translate-x-1/2 w-5 h-0.5 bg-primary rounded-full"
                        ></span>
                    </Link>
                </div>

                <!-- Right Actions -->
                <div class="flex items-center gap-2">
                    <!-- Emergency number (compact, visible when top bar hidden) -->
                    <a
                        v-if="isScrolled"
                        :href="'tel:' + (settings?.contact?.emergency || '117')"
                        class="hidden lg:flex items-center gap-1.5 text-xs font-semibold text-destructive mr-2 hover:text-red-700 dark:hover:text-red-400 transition-colors"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        {{ settings?.contact?.emergency || '117' }}
                    </a>

                    <!-- Dark mode toggle -->
                    <button
                        @click="$emit('toggle-theme')"
                        class="p-2 rounded-lg text-muted-foreground hover:text-foreground hover:bg-muted/50 transition-colors duration-200"
                        :aria-label="isDark ? 'Activer le mode clair' : 'Activer le mode sombre'"
                    >
                        <!-- Sun icon (shown in dark mode) -->
                        <svg v-if="isDark" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <!-- Moon icon (shown in light mode) -->
                        <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    <!-- CTA Button -->
                    <Link
                        :href="route('contact')"
                        class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 bg-primary hover:bg-primary-600 text-white text-sm font-medium rounded-full shadow-sm hover:shadow-md transition-all duration-200 active:scale-95"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Prendre RDV
                    </Link>

                    <!-- Mobile menu button -->
                    <button
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden p-2 rounded-lg text-muted-foreground hover:text-foreground hover:bg-muted/50 transition-colors duration-200"
                        aria-label="Menu"
                    >
                        <!-- Hamburger icon -->
                        <svg v-if="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- Close icon -->
                        <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <Transition
            enter-active-class="transition-all duration-300 ease-out"
            enter-from-class="opacity-0 -translate-y-2 max-h-0"
            enter-to-class="opacity-100 translate-y-0 max-h-96"
            leave-active-class="transition-all duration-200 ease-in"
            leave-from-class="opacity-100 translate-y-0 max-h-96"
            leave-to-class="opacity-0 -translate-y-2 max-h-0"
        >
            <div
                v-if="mobileMenuOpen"
                class="md:hidden overflow-hidden border-t border-border bg-white dark:bg-slate-900"
            >
                <div class="max-w-7xl mx-auto px-6 py-4 space-y-1">
                    <Link
                        v-for="item in menuItems"
                        :key="item.name"
                        :href="route(item.route)"
                        @click="mobileMenuOpen = false"
                        class="flex items-center px-4 py-3 rounded-lg text-sm font-medium transition-colors duration-200"
                        :class="[
                            route().current(item.route)
                                ? 'text-primary bg-primary-50 dark:bg-primary-900/20'
                                : 'text-muted-foreground hover:text-foreground hover:bg-muted/50'
                        ]"
                    >
                        {{ item.name }}
                    </Link>

                    <!-- Emergency number in mobile -->
                    <a
                        :href="'tel:' + (settings?.contact?.emergency || '117')"
                        class="flex items-center gap-2 px-4 py-3 text-sm font-semibold text-destructive"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        Urgences: {{ settings?.contact?.emergency || '117' }}
                    </a>

                    <div class="pt-2">
                        <Link
                            :href="route('contact')"
                            @click="mobileMenuOpen = false"
                            class="flex items-center justify-center gap-2 w-full py-3 bg-primary hover:bg-primary-600 text-white text-sm font-medium rounded-full transition-colors duration-200"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Prendre RDV
                        </Link>
                    </div>
                </div>
            </div>
        </Transition>
    </nav>
</template>
