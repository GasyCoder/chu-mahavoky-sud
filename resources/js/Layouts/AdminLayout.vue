<script setup>
import { ref, onMounted } from 'vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';

const page = usePage();
const sidebarOpen = ref(true);
const dropdownOpen = ref(false);

const props = defineProps({
    title: { type: String, default: 'Tableau de bord' }
});

const navigation = [
    { name: 'Tableau de bord', href: route('admin.dashboard'), icon: 'fas fa-chart-pie' },
    { name: 'Services Médicaux', href: route('admin.services.medical'), icon: 'fas fa-stethoscope' },
    { name: 'Services Administratifs', href: route('admin.services.administration'), icon: 'fas fa-building' },
    { name: 'Actualités', href: route('admin.news'), icon: 'fas fa-newspaper' },
    { name: 'Partenaires', href: route('admin.partners'), icon: 'fas fa-handshake' },
    { name: 'Paramètres', href: route('admin.setting'), icon: 'fas fa-cog' },
];

// Close dropdown when clicking outside
onMounted(() => {
    document.addEventListener('click', (e) => {
        const dropdown = document.getElementById('user-dropdown');
        const button = document.getElementById('user-menu-button');
        if (dropdown && button && !dropdown.contains(e.target) && !button.contains(e.target)) {
            dropdownOpen.value = false;
        }
    });
});
</script>

<template>
    <Head :title="title + ' | Admin'" />

    <div class="flex h-screen overflow-hidden bg-slate-50 text-slate-800 font-sans">
        
        <!-- Sidebar Backdrop (Mobile) -->
        <div v-if="sidebarOpen" class="fixed inset-0 z-20 bg-slate-900/50 lg:hidden" @click="sidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside 
            class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-900 text-slate-300 transition-transform duration-300 transform lg:static lg:translate-x-0 flex flex-col"
            :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
        >
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 bg-slate-950 px-4">
                <Link :href="route('home')" class="flex items-center gap-2 text-white">
                    <i class="fas fa-hospital text-blue-500 text-xl"></i>
                    <span class="text-lg font-bold tracking-wide uppercase">Admin CHU</span>
                </Link>
            </div>

            <!-- Nav Links -->
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                <p class="px-2 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4 mt-2">Menu Principal</p>
                
                <Link 
                    v-for="item in navigation" 
                    :key="item.name" 
                    :href="item.href"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors"
                    :class="route().current(item.href.split('/').pop() + '*') || route().current(item.href.split('/').slice(-2).join('.'))
                        ? 'bg-blue-600 text-white' 
                        : 'hover:bg-slate-800 hover:text-white'"
                >
                    <i :class="[item.icon, 'w-5 text-center text-sm']"></i>
                    <span class="text-sm font-medium">{{ item.name }}</span>
                </Link>
            </nav>

            <!-- Sidebar Footer -->
            <div class="p-4 bg-slate-950">
                <div class="flex items-center gap-3 px-3 py-2">
                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-sm">
                        {{ page.props.auth.user?.name?.charAt(0) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">{{ page.props.auth.user?.name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ page.props.auth.user?.email }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden relative">
            
            <!-- Top Navbar -->
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 lg:px-8 z-10">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-slate-500 hover:text-slate-700 lg:hidden focus:outline-none">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                    <!-- Breadcrumb / Title -->
                    <div class="hidden sm:flex items-center gap-2 text-sm font-medium text-slate-500">
                        <i class="fas fa-home"></i>
                        <span>/</span>
                        <span class="text-slate-900">{{ title }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <!-- View Site -->
                    <a :href="route('home')" target="_blank" class="p-2 text-slate-400 hover:text-blue-600 transition-colors" title="Voir le site public">
                        <i class="fas fa-external-link-alt"></i>
                    </a>

                    <!-- Notifications (Mock) -->
                    <button class="relative p-2 text-slate-400 hover:text-slate-600 transition-colors">
                        <i class="fas fa-bell"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- User Dropdown -->
                    <div class="relative">
                        <button id="user-menu-button" @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-2 focus:outline-none">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" alt="User" class="w-8 h-8 rounded-full border border-slate-200">
                            <span class="text-sm font-medium text-slate-700 hidden md:block">{{ page.props.auth.user?.name }}</span>
                            <i class="fas fa-chevron-down text-xs text-slate-400 hidden md:block"></i>
                        </button>

                        <div v-if="dropdownOpen" id="user-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg border border-slate-100 py-1 z-50">
                            <Link :href="route('profile.edit')" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                <i class="fas fa-user mr-2 text-slate-400"></i> Mon Profil
                            </Link>
                            <Link :href="route('admin.setting')" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                <i class="fas fa-cog mr-2 text-slate-400"></i> Paramètres
                            </Link>
                            <div class="border-t border-slate-100 my-1"></div>
                            <form @submit.prevent="router.post(route('logout'))">
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Workspace -->
            <main class="flex-1 overflow-y-auto bg-slate-50 p-4 lg:p-8">
                
                <!-- Page Title -->
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <h1 class="text-2xl font-bold text-slate-900">{{ title }}</h1>
                    <slot name="actions"></slot>
                </div>

                <!-- Flash Messages -->
                <div v-if="page.props.flash?.success" class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center gap-3">
                    <i class="fas fa-check-circle"></i>
                    <span class="text-sm font-medium">{{ page.props.flash.success }}</span>
                </div>

                <div v-if="page.props.flash?.error" class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center gap-3">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span class="text-sm font-medium">{{ page.props.flash.error }}</span>
                </div>

                <!-- Content Slot -->
                <slot />
            </main>

        </div>
    </div>
</template>
