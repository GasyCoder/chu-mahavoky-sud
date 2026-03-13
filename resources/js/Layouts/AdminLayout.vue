<script setup>
import { ref, onMounted } from 'vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Ui/Dropdown.vue';
import Alert from '@/Components/Ui/Alert.vue';

const page = usePage();
const sidebarOpen = ref(false);

const props = defineProps({
    title: { type: String, default: 'Tableau de bord' }
});

const navigation = [
    { name: 'Tableau de bord', href: route('admin.dashboard'), icon: 'fas fa-chart-pie' },
    { name: 'Services Médicaux', href: route('admin.services.medical'), icon: 'fas fa-stethoscope' },
    { name: 'Services Administratifs', href: route('admin.services.administration'), icon: 'fas fa-building' },
    { name: 'Actualités', href: route('admin.news'), icon: 'fas fa-newspaper' },
    { name: 'Catégories', href: route('admin.news.categories'), icon: 'fas fa-tags', sub: true },
    { name: 'Équipements', href: route('admin.equipments'), icon: 'fas fa-microscope' },
    { name: 'Partenaires', href: route('admin.partners'), icon: 'fas fa-handshake' },
    { name: 'Paramètres', href: route('admin.setting'), icon: 'fas fa-cog' },
];

const isActive = (item) => {
    const currentUrl = page.url.split('?')[0];
    const itemPath = new URL(item.href, window.location.origin).pathname;
    if (itemPath === '/admin' || itemPath === '/admin/dashboard') {
        return currentUrl === '/admin' || currentUrl === '/admin/dashboard';
    }
    if (item.sub) {
        return currentUrl.startsWith(itemPath);
    }
    // For parent items, check exact match or startsWith but NOT if a sub-item matches
    const hasActiveSub = navigation.some(n => n.sub && currentUrl.startsWith(new URL(n.href, window.location.origin).pathname));
    if (hasActiveSub) {
        return currentUrl === itemPath;
    }
    return currentUrl.startsWith(itemPath);
};

const user = page.props.auth?.user;
const userInitial = user?.name?.charAt(0)?.toUpperCase() || 'A';
</script>

<template>
    <Head :title="title + ' | Admin'" />

    <div class="flex h-screen overflow-hidden bg-slate-100 text-slate-800 font-sans">

        <!-- Sidebar Backdrop (Mobile) -->
        <Transition
            enter-active-class="transition-opacity duration-300"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition-opacity duration-200"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div
                v-if="sidebarOpen"
                class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden"
                @click="sidebarOpen = false"
            ></div>
        </Transition>

        <!-- Sidebar -->
        <aside
            class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-950 text-slate-400 transition-transform duration-300 transform lg:static lg:translate-x-0 flex flex-col"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <!-- Logo -->
            <div class="flex items-center gap-3 h-16 px-5 bg-slate-900/80 border-b border-slate-800/60 flex-shrink-0">
                <div class="w-9 h-9 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-600/20">
                    <i class="fas fa-hospital text-white text-sm"></i>
                </div>
                <div>
                    <span class="text-base font-bold text-white tracking-wide">Admin CHU</span>
                </div>
            </div>

            <!-- Nav Links -->
            <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto">
                <p class="px-3 text-[10px] font-semibold text-slate-600 uppercase tracking-[0.15em] mb-4">Menu Principal</p>

                <Link
                    v-for="item in navigation"
                    :key="item.name"
                    :href="item.href"
                    class="flex items-center gap-3 rounded-lg text-[13px] font-medium transition-all duration-200"
                    :class="[
                        isActive(item)
                            ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20'
                            : 'text-slate-400 hover:bg-slate-800/70 hover:text-white',
                        item.sub ? 'pl-6 px-3 py-2' : 'px-3 py-2.5'
                    ]"
                >
                    <div
                        class="rounded-lg flex items-center justify-center flex-shrink-0 transition-colors"
                        :class="[
                            isActive(item) ? 'bg-blue-500/30' : 'bg-slate-800/50',
                            item.sub ? 'w-6 h-6' : 'w-8 h-8'
                        ]"
                    >
                        <i :class="[item.icon, item.sub ? 'text-[10px]' : 'text-xs']"></i>
                    </div>
                    <span>{{ item.name }}</span>
                </Link>
            </nav>

            <!-- Sidebar Footer -->
            <div class="p-3 border-t border-slate-800/60 flex-shrink-0">
                <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-slate-900/50">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold text-sm shadow-sm flex-shrink-0">
                        {{ userInitial }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-200 truncate">{{ user?.name }}</p>
                        <p class="text-[11px] text-slate-500 truncate">{{ user?.email }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden relative">

            <!-- Top Navbar -->
            <header class="h-16 bg-white border-b border-slate-200/80 flex items-center justify-between px-4 lg:px-6 z-10 flex-shrink-0 shadow-sm">
                <div class="flex items-center gap-4">
                    <!-- Mobile hamburger -->
                    <button
                        @click="sidebarOpen = !sidebarOpen"
                        class="w-9 h-9 flex items-center justify-center text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors lg:hidden"
                    >
                        <i class="fas fa-bars text-base"></i>
                    </button>

                    <!-- Breadcrumb -->
                    <div class="hidden sm:flex items-center gap-2 text-sm">
                        <Link :href="route('admin.dashboard')" class="text-slate-400 hover:text-blue-600 transition-colors">
                            <i class="fas fa-home text-xs"></i>
                        </Link>
                        <i class="fas fa-chevron-right text-[9px] text-slate-300"></i>
                        <span class="font-medium text-slate-700">{{ title }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <!-- View Site -->
                    <a
                        :href="route('home')"
                        target="_blank"
                        class="hidden sm:inline-flex items-center gap-2 px-3 py-1.5 text-xs font-medium text-slate-500 hover:text-blue-600 border border-slate-200 rounded-lg hover:border-blue-200 hover:bg-blue-50/50 transition-all"
                    >
                        <i class="fas fa-external-link-alt text-[10px]"></i>
                        Voir le site
                    </a>

                    <!-- Notifications -->
                    <button class="relative w-9 h-9 flex items-center justify-center text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors">
                        <i class="fas fa-bell text-sm"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
                    </button>

                    <!-- User Dropdown -->
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <button class="flex items-center gap-2.5 pl-2 pr-1 py-1 rounded-lg hover:bg-slate-50 transition-colors">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold text-xs shadow-sm">
                                    {{ userInitial }}
                                </div>
                                <span class="text-sm font-medium text-slate-700 hidden md:block">{{ user?.name }}</span>
                                <i class="fas fa-chevron-down text-[9px] text-slate-400 hidden md:block mr-1"></i>
                            </button>
                        </template>

                        <template #content="{ close }">
                            <div class="py-1">
                                <Link
                                    :href="route('profile.edit')"
                                    @click="close"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition-colors"
                                >
                                    <i class="fas fa-user text-slate-400 w-4 text-center text-xs"></i>
                                    Mon Profil
                                </Link>
                                <Link
                                    :href="route('admin.setting')"
                                    @click="close"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition-colors"
                                >
                                    <i class="fas fa-cog text-slate-400 w-4 text-center text-xs"></i>
                                    Paramètres
                                </Link>
                                <div class="border-t border-slate-100 my-1"></div>
                                <button
                                    @click="router.post(route('logout'))"
                                    class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors"
                                >
                                    <i class="fas fa-sign-out-alt w-4 text-center text-xs"></i>
                                    Déconnexion
                                </button>
                            </div>
                        </template>
                    </Dropdown>
                </div>
            </header>

            <!-- Main Workspace -->
            <main class="flex-1 overflow-y-auto bg-slate-100 p-4 lg:p-8">

                <!-- Page Title + Actions -->
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">{{ title }}</h1>
                    <slot name="actions"></slot>
                </div>

                <!-- Flash Messages -->
                <Alert v-if="page.props.flash?.success" variant="success" dismissible class="mb-6">
                    {{ page.props.flash.success }}
                </Alert>

                <Alert v-if="page.props.flash?.error" variant="danger" dismissible class="mb-6">
                    {{ page.props.flash.error }}
                </Alert>

                <!-- Content Slot -->
                <slot />
            </main>
        </div>
    </div>
</template>
