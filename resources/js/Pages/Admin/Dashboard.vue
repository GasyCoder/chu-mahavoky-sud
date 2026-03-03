<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    stats: Object,
    recentUsers: Array
});

const cards = [
    { name: 'Équipe Médicale', value: props.stats.totalUsers, icon: 'fas fa-user-md', color: 'text-blue-600', bg: 'bg-blue-100' },
    { name: 'Services Actifs', value: props.stats.totalServices, icon: 'fas fa-hospital', color: 'text-indigo-600', bg: 'bg-indigo-100' },
    { name: 'Actualités', value: '12', icon: 'fas fa-newspaper', color: 'text-emerald-600', bg: 'bg-emerald-100' },
    { name: 'Consultations', value: '450', icon: 'fas fa-calendar-check', color: 'text-amber-600', bg: 'bg-amber-100' },
];
</script>

<template>
    <AdminLayout title="Tableau de bord">
        <template #actions>
            <Link :href="route('admin.news')" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-white text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-colors">
                <i class="fas fa-plus mr-2"></i> Publier une annonce
            </Link>
        </template>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div v-for="card in cards" :key="card.name" class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm flex items-center">
                <div :class="[card.bg, card.color, 'p-4 rounded-lg flex-shrink-0']">
                    <i :class="[card.icon, 'text-xl w-6 text-center']"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-500 truncate">{{ card.name }}</p>
                    <p class="text-2xl font-bold text-slate-900">{{ card.value }}</p>
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Table Users -->
            <div class="lg:col-span-2 bg-white rounded-lg border border-slate-200 shadow-sm">
                <div class="px-6 py-4 border-b border-slate-200 flex justify-between items-center">
                    <h2 class="text-lg font-medium text-slate-900">Personnel récent</h2>
                    <Link :href="route('profile.edit')" class="text-sm font-medium text-blue-600 hover:text-blue-500">Voir tout</Link>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Utilisateur</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Rôle</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Date d'ajout</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <tr v-for="user in recentUsers" :key="user.id" class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                                                {{ user.name?.charAt(0) }}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-slate-900">{{ user.name }}</div>
                                            <div class="text-sm text-slate-500">{{ user.email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-100 text-slate-800 capitalize">
                                        {{ user.role }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-slate-500">
                                    {{ user.created_at }}
                                </td>
                            </tr>
                            <tr v-if="recentUsers.length === 0">
                                <td colspan="3" class="px-6 py-10 text-center text-slate-500">
                                    Aucun utilisateur trouvé.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="space-y-6">
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6">
                    <h2 class="text-lg font-medium text-slate-900 mb-4">Raccourcis</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <Link :href="route('admin.news')" class="flex flex-col items-center justify-center p-4 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                            <i class="fas fa-file-alt text-slate-400 text-xl mb-2"></i>
                            <span class="text-sm font-medium text-slate-700">Articles</span>
                        </Link>
                        <Link :href="route('admin.services.medical')" class="flex flex-col items-center justify-center p-4 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                            <i class="fas fa-stethoscope text-slate-400 text-xl mb-2"></i>
                            <span class="text-sm font-medium text-slate-700">Services</span>
                        </Link>
                        <Link :href="route('admin.setting')" class="flex flex-col items-center justify-center p-4 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                            <i class="fas fa-cog text-slate-400 text-xl mb-2"></i>
                            <span class="text-sm font-medium text-slate-700">Paramètres</span>
                        </Link>
                        <Link :href="route('profile.edit')" class="flex flex-col items-center justify-center p-4 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                            <i class="fas fa-shield-alt text-slate-400 text-xl mb-2"></i>
                            <span class="text-sm font-medium text-slate-700">Sécurité</span>
                        </Link>
                    </div>
                </div>

                <div class="bg-blue-600 rounded-lg shadow-sm p-6 text-white">
                    <h3 class="text-lg font-medium mb-2">Documentation</h3>
                    <p class="text-blue-100 text-sm mb-4">Consultez le guide d'utilisation pour maîtriser toutes les fonctionnalités de l'administration.</p>
                    <button class="w-full bg-white text-blue-600 px-4 py-2 rounded font-medium text-sm hover:bg-blue-50 transition-colors">
                        Lire le manuel
                    </button>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
