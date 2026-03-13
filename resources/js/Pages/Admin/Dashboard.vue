<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from '@/Components/Ui/Card.vue';
import Badge from '@/Components/Ui/Badge.vue';

const props = defineProps({
    stats: Object,
    recentUsers: Array
});

const cards = [
    { name: 'Équipe Médicale', value: props.stats.totalUsers, icon: 'fas fa-user-md', color: 'text-blue-600', bg: 'bg-blue-50', iconBg: 'bg-blue-100', ring: 'ring-blue-600/10' },
    { name: 'Services Actifs', value: props.stats.totalServices, icon: 'fas fa-hospital', color: 'text-indigo-600', bg: 'bg-indigo-50', iconBg: 'bg-indigo-100', ring: 'ring-indigo-600/10' },
    { name: 'Actualités', value: '12', icon: 'fas fa-newspaper', color: 'text-emerald-600', bg: 'bg-emerald-50', iconBg: 'bg-emerald-100', ring: 'ring-emerald-600/10' },
    { name: 'Consultations', value: '450', icon: 'fas fa-calendar-check', color: 'text-amber-600', bg: 'bg-amber-50', iconBg: 'bg-amber-100', ring: 'ring-amber-600/10' },
];
</script>

<template>
    <AdminLayout title="Tableau de bord">
        <template #actions>
            <Link :href="route('admin.news')" class="inline-flex items-center px-4 py-2.5 bg-blue-600 border border-transparent rounded-lg font-semibold text-white text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-all active:scale-[0.98]">
                <i class="fas fa-plus mr-2 text-xs"></i> Publier une annonce
            </Link>
        </template>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            <div
                v-for="card in cards"
                :key="card.name"
                class="bg-white rounded-xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition-all duration-200 group"
            >
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">{{ card.name }}</p>
                        <p class="text-3xl font-bold text-slate-900 mt-1 tracking-tight">{{ card.value }}</p>
                    </div>
                    <div
                        :class="[card.iconBg, card.color, card.ring]"
                        class="w-11 h-11 rounded-xl flex items-center justify-center ring-4 group-hover:scale-110 transition-transform duration-200"
                    >
                        <i :class="[card.icon, 'text-base']"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Users Table -->
            <div class="lg:col-span-2">
                <Card title="Personnel récent" :padding="false">
                    <template #header-actions>
                        <Link :href="route('profile.edit')" class="text-sm font-medium text-blue-600 hover:text-blue-500 transition-colors">
                            Voir tout
                        </Link>
                    </template>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-100">
                            <thead>
                                <tr class="bg-slate-50/80">
                                    <th scope="col" class="px-6 py-3 text-left text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Utilisateur</th>
                                    <th scope="col" class="px-6 py-3 text-left text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Rôle</th>
                                    <th scope="col" class="px-6 py-3 text-right text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Date d'ajout</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <tr v-for="user in recentUsers" :key="user.id" class="hover:bg-slate-50/60 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center text-blue-600 font-bold text-sm flex-shrink-0">
                                                {{ user.name?.charAt(0) }}
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-sm font-semibold text-slate-900 truncate">{{ user.name }}</p>
                                                <p class="text-xs text-slate-500 truncate">{{ user.email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <Badge variant="default" size="sm">{{ user.role }}</Badge>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-slate-500">
                                        {{ user.created_at }}
                                    </td>
                                </tr>
                                <tr v-if="recentUsers.length === 0">
                                    <td colspan="3" class="px-6 py-12 text-center">
                                        <div class="text-slate-400">
                                            <i class="fas fa-users text-2xl mb-2"></i>
                                            <p class="text-sm">Aucun utilisateur trouvé.</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </Card>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Quick Links -->
                <Card title="Raccourcis">
                    <div class="grid grid-cols-2 gap-3">
                        <Link :href="route('admin.news')" class="flex flex-col items-center justify-center p-4 border border-slate-200 rounded-xl hover:bg-blue-50 hover:border-blue-200 transition-all group">
                            <div class="w-10 h-10 rounded-lg bg-slate-100 group-hover:bg-blue-100 flex items-center justify-center mb-2 transition-colors">
                                <i class="fas fa-file-alt text-slate-400 group-hover:text-blue-600 transition-colors"></i>
                            </div>
                            <span class="text-xs font-semibold text-slate-600 group-hover:text-blue-700 transition-colors">Articles</span>
                        </Link>
                        <Link :href="route('admin.services.medical')" class="flex flex-col items-center justify-center p-4 border border-slate-200 rounded-xl hover:bg-blue-50 hover:border-blue-200 transition-all group">
                            <div class="w-10 h-10 rounded-lg bg-slate-100 group-hover:bg-blue-100 flex items-center justify-center mb-2 transition-colors">
                                <i class="fas fa-stethoscope text-slate-400 group-hover:text-blue-600 transition-colors"></i>
                            </div>
                            <span class="text-xs font-semibold text-slate-600 group-hover:text-blue-700 transition-colors">Services</span>
                        </Link>
                        <Link :href="route('admin.setting')" class="flex flex-col items-center justify-center p-4 border border-slate-200 rounded-xl hover:bg-blue-50 hover:border-blue-200 transition-all group">
                            <div class="w-10 h-10 rounded-lg bg-slate-100 group-hover:bg-blue-100 flex items-center justify-center mb-2 transition-colors">
                                <i class="fas fa-cog text-slate-400 group-hover:text-blue-600 transition-colors"></i>
                            </div>
                            <span class="text-xs font-semibold text-slate-600 group-hover:text-blue-700 transition-colors">Paramètres</span>
                        </Link>
                        <Link :href="route('profile.edit')" class="flex flex-col items-center justify-center p-4 border border-slate-200 rounded-xl hover:bg-blue-50 hover:border-blue-200 transition-all group">
                            <div class="w-10 h-10 rounded-lg bg-slate-100 group-hover:bg-blue-100 flex items-center justify-center mb-2 transition-colors">
                                <i class="fas fa-shield-alt text-slate-400 group-hover:text-blue-600 transition-colors"></i>
                            </div>
                            <span class="text-xs font-semibold text-slate-600 group-hover:text-blue-700 transition-colors">Sécurité</span>
                        </Link>
                    </div>
                </Card>

                <!-- Documentation Panel -->
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl shadow-lg shadow-blue-600/20 p-6 text-white overflow-hidden relative">
                    <div class="absolute -right-6 -bottom-6 text-blue-500/20">
                        <i class="fas fa-book-open text-[80px]"></i>
                    </div>
                    <div class="relative z-10">
                        <h3 class="text-lg font-bold mb-2">Documentation</h3>
                        <p class="text-blue-100 text-sm leading-relaxed mb-5">Consultez le guide d'utilisation pour maîtriser toutes les fonctionnalités.</p>
                        <button class="w-full bg-white/90 backdrop-blur text-blue-700 px-4 py-2.5 rounded-xl font-semibold text-sm hover:bg-white transition-colors shadow-sm">
                            Lire le manuel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
