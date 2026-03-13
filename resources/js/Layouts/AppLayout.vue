<script setup>
import { computed, onMounted, ref } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';

const page = usePage();
const isDark = ref(false);

const props = defineProps({
    title: {
        type: String,
        default: ''
    },
    description: {
        type: String,
        default: ''
    },
    settings: {
        type: Object,
        default: () => ({
            site_name: 'CHU Mahavoky',
            site_description: 'Centre Hospitalier Universitaire Mahavoky Atsimo',
            favicon: null,
            seo: { keywords: '' }
        })
    },
    showNavbar: {
        type: Boolean,
        default: true
    },
    showFooter: {
        type: Boolean,
        default: true
    }
});

const currentTitle = computed(() => {
    return props.title || props.settings?.site_name || 'CHU Mahavoky';
});

// Theme management
const toggleTheme = () => {
    isDark.value = !isDark.value;
    localStorage.setItem('theme', isDark.value ? 'dark' : 'light');
    if (isDark.value) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
};

onMounted(() => {
    const savedTheme = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    
    if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
        isDark.value = true;
        document.documentElement.classList.add('dark');
    } else {
        isDark.value = false;
        document.documentElement.classList.remove('dark');
    }
});
</script>

<template>
    <Head :title="currentTitle">
        <link rel="icon" :href="settings?.favicon || '/assets/logo.png'" type="image/x-icon" />
        <meta name="description" :content="description || settings?.site_description" />
        <meta name="keywords" :content="settings?.seo?.keywords || 'CHU, hôpital, santé, Madagascar, Mahajanga'" />
    </Head>

    <div class="min-h-screen transition-colors duration-300">
        <!-- Navbar -->
        <Navbar 
            v-if="showNavbar" 
            :settings="settings" 
            :isDark="isDark" 
            @toggle-theme="toggleTheme" 
        />

        <!-- Page Content -->
        <main class="relative overflow-hidden pt-[120px]">
            <slot />
        </main>

        <!-- Footer -->
        <Footer v-if="showFooter" :settings="settings" />
    </div>
</template>
