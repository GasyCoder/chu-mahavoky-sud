<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    settings: Object,
});

const activeTab = ref('general');

const tabs = [
    { id: 'general', label: 'Général', icon: 'fas fa-sliders-h', color: 'blue' },
    { id: 'hero', label: "Page d'accueil", icon: 'fas fa-home', color: 'cyan' },
    { id: 'director', label: 'Direction', icon: 'fas fa-user-tie', color: 'indigo' },
    { id: 'contact', label: 'Contact & Horaires', icon: 'fas fa-address-book', color: 'emerald' },
    { id: 'social', label: 'Réseaux sociaux', icon: 'fas fa-share-alt', color: 'pink' },
    { id: 'display', label: 'Affichage', icon: 'fas fa-eye', color: 'amber' },
];

const generalForm = useForm({
    site_name: props.settings.site_name || '',
    site_description: props.settings.site_description || '',
    site_slogan: props.settings.site_slogan || '',
    logo: null,
    favicon: null,
});

const heroForm = useForm({
    hero_title: props.settings.hero_title || '',
    hero_subtitle: props.settings.hero_subtitle || '',
    presentation_video: props.settings.presentation_video || '',
    hero_background: null,
    stat_doctors: props.settings.stat_doctors || '47',
    stat_services: props.settings.stat_services || '12',
    stat_beds: props.settings.stat_beds || '150',
    stat_emergency: props.settings.stat_emergency || '24h/7j',
    services_section_label: props.settings.services_section_label || 'Nos Spécialités',
    services_section_title: props.settings.services_section_title || 'Excellence en Soins de Santé',
    services_section_description: props.settings.services_section_description || '',
});

const directorForm = useForm({
    director_name: props.settings.director_name || '',
    director_title: props.settings.director_title || '',
    director_message: props.settings.director_message || '',
    director_photo: null,
});

const contactForm = useForm({
    contact_phone: props.settings.contact_phone || '',
    contact_emergency: props.settings.contact_emergency || '',
    contact_email: props.settings.contact_email || '',
    contact_direction_email: props.settings.contact_direction_email || '',
    contact_address: props.settings.contact_address || '',
    opening_hours: props.settings.opening_hours || '',
    weekend_hours: props.settings.weekend_hours || '',
});

const socialForm = useForm({
    facebook_url: props.settings.facebook_url || '',
    twitter_url: props.settings.twitter_url || '',
    linkedin_url: props.settings.linkedin_url || '',
    youtube_url: props.settings.youtube_url || '',
});

const displayForm = useForm({
    show_stats_section: props.settings.show_stats_section ?? true,
    show_services_section: props.settings.show_services_section ?? true,
    show_about_section: props.settings.show_about_section ?? true,
    show_emergency_section: props.settings.show_emergency_section ?? true,
    show_experts_section: props.settings.show_experts_section ?? false,
    show_infrastructure_section: props.settings.show_infrastructure_section ?? true,
    show_news_section: props.settings.show_news_section ?? true,
    show_partners_section: props.settings.show_partners_section ?? true,
});

const submitGeneral = () => {
    generalForm.post(route('admin.settings.general'), { preserveScroll: true });
};
const submitHero = () => {
    heroForm.post(route('admin.settings.hero'), { preserveScroll: true });
};
const submitDirector = () => {
    directorForm.post(route('admin.settings.director'), { preserveScroll: true });
};
const submitContact = () => {
    contactForm.post(route('admin.settings.contact'), { preserveScroll: true });
};
const submitSocial = () => {
    socialForm.post(route('admin.settings.social'), { preserveScroll: true });
};
const submitDisplay = () => {
    displayForm.post(route('admin.settings.display'), { preserveScroll: true });
};

const sectionToggles = [
    { key: 'show_stats_section', label: 'Compteur de statistiques', desc: 'Chiffres clés (médecins, lits, etc.)', icon: 'fas fa-chart-bar' },
    { key: 'show_services_section', label: 'Nos Spécialités', desc: 'Section des services médicaux', icon: 'fas fa-stethoscope' },
    { key: 'show_about_section', label: 'Mot du Directeur', desc: 'Message de la direction', icon: 'fas fa-quote-left' },
    { key: 'show_emergency_section', label: 'Bannière Urgences', desc: 'Bandeau appel urgence', icon: 'fas fa-ambulance' },
    { key: 'show_experts_section', label: 'Nos Experts de Santé', desc: 'Équipe médicale sur la page d\'accueil', icon: 'fas fa-user-md' },
    { key: 'show_infrastructure_section', label: 'Infrastructure', desc: 'Section infrastructure et équipements', icon: 'fas fa-building' },
    { key: 'show_news_section', label: 'Actualités', desc: 'Dernières actualités', icon: 'fas fa-newspaper' },
    { key: 'show_partners_section', label: 'Partenaires', desc: 'Logos partenaires', icon: 'fas fa-handshake' },
];
</script>

<template>
    <AdminLayout title="Configuration du portail">
        <div class="max-w-full mx-auto pb-12">
            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Sidebar Navigation -->
                <div class="lg:w-72 flex-shrink-0">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden sticky top-8">
                        <div class="p-4 bg-slate-50 border-b border-slate-200">
                            <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Réglages</h2>
                        </div>
                        <nav class="p-2 space-y-1">
                            <button
                                v-for="tab in tabs"
                                :key="tab.id"
                                @click="activeTab = tab.id"
                                :class="[
                                    activeTab === tab.id
                                        ? `bg-${tab.color}-50 text-${tab.color}-700 border-${tab.color}-200`
                                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 border-transparent',
                                    'w-full flex items-center gap-3 px-4 py-3 rounded-xl border font-medium text-sm transition-all duration-200 group'
                                ]"
                            >
                                <div :class="[
                                    activeTab === tab.id ? `bg-${tab.color}-100 text-${tab.color}-600` : 'bg-slate-100 text-slate-400 group-hover:bg-slate-200',
                                    'w-8 h-8 rounded-lg flex items-center justify-center transition-colors'
                                ]">
                                    <i :class="tab.icon"></i>
                                </div>
                                {{ tab.label }}
                                <i v-if="activeTab === tab.id" class="fas fa-chevron-right ml-auto text-xs opacity-50"></i>
                            </button>
                        </nav>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="flex-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden min-h-[600px] transition-all duration-300">

                        <!-- Header Dynamic -->
                        <div class="px-8 py-6 border-b border-slate-100 bg-gradient-to-r from-white to-slate-50/50">
                            <div class="flex items-center gap-4">
                                <div :class="`w-12 h-12 rounded-xl bg-${tabs.find(t => t.id === activeTab).color}-100 text-${tabs.find(t => t.id === activeTab).color}-600 flex items-center justify-center text-xl shadow-sm`">
                                    <i :class="tabs.find(t => t.id === activeTab).icon"></i>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-slate-900">{{ tabs.find(t => t.id === activeTab).label }}</h2>
                                    <p class="text-sm text-slate-500 mt-0.5">Gérez les informations relatives à la section {{ tabs.find(t => t.id === activeTab).label.toLowerCase() }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-8">

                            <!-- ========== GENERAL ========== -->
                            <div v-if="activeTab === 'general'" class="animate-in fade-in slide-in-from-bottom-2 duration-300">
                                <form @submit.prevent="submitGeneral" class="space-y-8">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                                        <div class="space-y-6">
                                            <div class="group">
                                                <label class="block text-sm font-semibold text-slate-700 mb-2 group-focus-within:text-blue-600 transition-colors">Nom de l'établissement</label>
                                                <input v-model="generalForm.site_name" type="text" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all outline-none" placeholder="Ex: CHU Mahavoky Sud">
                                                <p v-if="generalForm.errors.site_name" class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                                    <i class="fas fa-exclamation-circle"></i> {{ generalForm.errors.site_name }}
                                                </p>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold text-slate-700 mb-2">Description du site</label>
                                                <textarea v-model="generalForm.site_description" rows="4" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all outline-none resize-none" placeholder="Décrivez brièvement l'établissement..."></textarea>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold text-slate-700 mb-2">Slogan publicitaire</label>
                                                <input v-model="generalForm.site_slogan" type="text" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all outline-none" placeholder="Ex: Votre santé, notre priorité">
                                            </div>
                                        </div>

                                        <div class="space-y-8">
                                            <div class="p-6 bg-blue-50/50 rounded-2xl border border-blue-100 relative overflow-hidden group">
                                                <div class="absolute -right-4 -top-4 text-blue-100 text-6xl rotate-12 transition-transform group-hover:scale-110">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                                <label class="block text-sm font-bold text-blue-900 mb-4 relative z-10">Logo de l'établissement</label>
                                                <div class="flex flex-col items-center justify-center p-4 bg-white rounded-xl border-2 border-dashed border-blue-200 transition-colors hover:border-blue-400 relative z-10">
                                                    <div v-if="settings.logo_url" class="mb-4 p-2 bg-white shadow-sm rounded-lg">
                                                        <img :src="settings.logo_url" class="h-20 object-contain">
                                                    </div>
                                                    <div v-else class="mb-4 w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center text-slate-300">
                                                        <i class="fas fa-hospital text-2xl"></i>
                                                    </div>
                                                    <input type="file" @input="generalForm.logo = $event.target.files[0]" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                                                </div>
                                                <p class="mt-3 text-[10px] text-blue-600/70 font-medium italic text-center">Format suggéré: PNG ou SVG transparent (Max 2Mo)</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between pt-8 border-t border-slate-100">
                                        <div class="text-xs text-slate-400 flex items-center gap-2">
                                            <i class="fas fa-info-circle"></i>
                                            Dernière mise à jour: Aujourd'hui
                                        </div>
                                        <button type="submit" :disabled="generalForm.processing" class="inline-flex items-center px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-95 disabled:opacity-50">
                                            <i v-if="generalForm.processing" class="fas fa-spinner fa-spin mr-2"></i>
                                            Enregistrer les modifications
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- ========== HERO / PAGE D'ACCUEIL ========== -->
                            <div v-if="activeTab === 'hero'" class="animate-in fade-in slide-in-from-bottom-2 duration-300">
                                <form @submit.prevent="submitHero" class="space-y-8">
                                    <!-- Hero Content -->
                                    <div>
                                        <h3 class="flex items-center gap-2 text-sm font-bold text-cyan-700 pb-2 border-b border-cyan-50 mb-6">
                                            <i class="fas fa-image text-cyan-500"></i>
                                            Section Hero
                                        </h3>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                            <div class="space-y-5">
                                                <div>
                                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Titre principal (optionnel)</label>
                                                    <input v-model="heroForm.hero_title" type="text" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-cyan-100 focus:border-cyan-500 transition-all outline-none" placeholder="Ex: CHU Mahavoky Atsimo">
                                                    <p class="mt-1 text-[10px] text-slate-400">Laisser vide pour utiliser le nom du site</p>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Sous-titre (optionnel)</label>
                                                    <input v-model="heroForm.hero_subtitle" type="text" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-cyan-100 focus:border-cyan-500 transition-all outline-none" placeholder="Ex: Mahajanga — Boeny">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Lien vidéo de présentation</label>
                                                    <div class="relative">
                                                        <i class="fas fa-video absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                                        <input v-model="heroForm.presentation_video" type="text" class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-cyan-100 focus:border-cyan-500 transition-all outline-none" placeholder="https://youtube.com/watch?v=...">
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="p-6 bg-cyan-50/50 rounded-2xl border border-cyan-100 relative overflow-hidden group">
                                                    <div class="absolute -right-4 -top-4 text-cyan-100 text-6xl rotate-12 transition-transform group-hover:scale-110">
                                                        <i class="fas fa-panorama"></i>
                                                    </div>
                                                    <label class="block text-sm font-bold text-cyan-900 mb-4 relative z-10">Image d'arrière-plan Hero</label>
                                                    <div class="flex flex-col items-center justify-center p-4 bg-white rounded-xl border-2 border-dashed border-cyan-200 transition-colors hover:border-cyan-400 relative z-10">
                                                        <div v-if="settings.hero_background_url" class="mb-4 w-full">
                                                            <img :src="settings.hero_background_url" class="w-full h-32 object-cover rounded-lg">
                                                        </div>
                                                        <div v-else class="mb-4 w-full h-32 bg-slate-100 rounded-lg flex items-center justify-center text-slate-300">
                                                            <i class="fas fa-mountain-sun text-3xl"></i>
                                                        </div>
                                                        <input type="file" @input="heroForm.hero_background = $event.target.files[0]" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-cyan-600 file:text-white hover:file:bg-cyan-700 cursor-pointer">
                                                    </div>
                                                    <p class="mt-3 text-[10px] text-cyan-600/70 font-medium italic text-center">Image large recommandée: 1920x800px (Max 5Mo)</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section Spécialités -->
                                    <div>
                                        <h3 class="flex items-center gap-2 text-sm font-bold text-cyan-700 pb-2 border-b border-cyan-50 mb-6">
                                            <i class="fas fa-stethoscope text-cyan-500"></i>
                                            Section "Nos Spécialités"
                                        </h3>
                                        <div class="space-y-4">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Étiquette</label>
                                                    <input v-model="heroForm.services_section_label" type="text" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-cyan-100 focus:border-cyan-500 transition-all outline-none" placeholder="Ex: Nos Spécialités">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Titre</label>
                                                    <input v-model="heroForm.services_section_title" type="text" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-cyan-100 focus:border-cyan-500 transition-all outline-none" placeholder="Ex: Excellence en Soins de Santé">
                                                </div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                                                <textarea v-model="heroForm.services_section_description" rows="2" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-cyan-100 focus:border-cyan-500 transition-all outline-none resize-none" placeholder="Description de la section..."></textarea>
                                            </div>
                                            <div class="p-3 bg-cyan-50/50 rounded-lg border border-cyan-100">
                                                <p class="text-[10px] text-cyan-700 italic flex items-center gap-2">
                                                    <i class="fas fa-info-circle"></i>
                                                    Les services affichés sont ceux marqués "Mis en avant" dans la gestion des Services Médicaux.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Stats -->
                                    <div>
                                        <h3 class="flex items-center gap-2 text-sm font-bold text-cyan-700 pb-2 border-b border-cyan-50 mb-6">
                                            <i class="fas fa-chart-bar text-cyan-500"></i>
                                            Chiffres clés (Compteur)
                                        </h3>
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                            <div class="p-4 bg-blue-50/50 rounded-xl border border-blue-100">
                                                <label class="block text-[10px] font-bold text-blue-800 uppercase tracking-wider mb-2">
                                                    <i class="fas fa-user-md mr-1"></i> Médecins
                                                </label>
                                                <input v-model="heroForm.stat_doctors" type="text" class="w-full px-3 py-2 bg-white border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition-all outline-none text-center font-bold text-lg text-blue-900" placeholder="47">
                                            </div>
                                            <div class="p-4 bg-emerald-50/50 rounded-xl border border-emerald-100">
                                                <label class="block text-[10px] font-bold text-emerald-800 uppercase tracking-wider mb-2">
                                                    <i class="fas fa-hospital mr-1"></i> Services
                                                </label>
                                                <input v-model="heroForm.stat_services" type="text" class="w-full px-3 py-2 bg-white border-emerald-200 rounded-lg focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-all outline-none text-center font-bold text-lg text-emerald-900" placeholder="12">
                                            </div>
                                            <div class="p-4 bg-amber-50/50 rounded-xl border border-amber-100">
                                                <label class="block text-[10px] font-bold text-amber-800 uppercase tracking-wider mb-2">
                                                    <i class="fas fa-bed mr-1"></i> Lits
                                                </label>
                                                <input v-model="heroForm.stat_beds" type="text" class="w-full px-3 py-2 bg-white border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-200 focus:border-amber-400 transition-all outline-none text-center font-bold text-lg text-amber-900" placeholder="150">
                                            </div>
                                            <div class="p-4 bg-red-50/50 rounded-xl border border-red-100">
                                                <label class="block text-[10px] font-bold text-red-800 uppercase tracking-wider mb-2">
                                                    <i class="fas fa-clock mr-1"></i> Urgences
                                                </label>
                                                <input v-model="heroForm.stat_emergency" type="text" class="w-full px-3 py-2 bg-white border-red-200 rounded-lg focus:ring-2 focus:ring-red-200 focus:border-red-400 transition-all outline-none text-center font-bold text-lg text-red-900" placeholder="24h/7j">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-end pt-8 border-t border-slate-100">
                                        <button type="submit" :disabled="heroForm.processing" class="px-8 py-3 bg-cyan-600 hover:bg-cyan-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-cyan-100 transition-all active:scale-95 disabled:opacity-50">
                                            <i v-if="heroForm.processing" class="fas fa-spinner fa-spin mr-2"></i>
                                            Enregistrer la page d'accueil
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- ========== DIRECTOR ========== -->
                            <div v-if="activeTab === 'director'" class="animate-in fade-in slide-in-from-bottom-2 duration-300">
                                <form @submit.prevent="submitDirector" class="space-y-8">
                                    <div class="flex flex-col md:flex-row gap-12">
                                        <div class="w-full md:w-64 flex-shrink-0">
                                            <label class="block text-sm font-semibold text-slate-700 mb-4 text-center md:text-left">Photo officielle</label>
                                            <div class="relative group mx-auto md:mx-0">
                                                <div class="aspect-[3/4] w-full bg-slate-100 rounded-2xl border-2 border-slate-200 overflow-hidden shadow-inner flex items-center justify-center transition-all group-hover:border-indigo-400">
                                                    <img v-if="settings.director_photo_url" :src="settings.director_photo_url" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                                    <div v-else class="text-center p-4">
                                                        <i class="fas fa-user-tie text-5xl text-slate-200 mb-3"></i>
                                                        <p class="text-[10px] text-slate-400 font-medium">Aucune photo</p>
                                                    </div>
                                                    <div class="absolute inset-0 bg-indigo-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                                        <span class="text-white text-xs font-bold px-3 py-1.5 bg-white/20 backdrop-blur-md rounded-full border border-white/30">Changer la photo</span>
                                                    </div>
                                                </div>
                                                <input type="file" @input="directorForm.director_photo = $event.target.files[0]" class="absolute inset-0 opacity-0 cursor-pointer">
                                            </div>
                                            <p class="mt-4 text-[10px] text-slate-400 text-center leading-relaxed">Format portrait recommandé.<br>Max: 2Mo.</p>
                                        </div>

                                        <div class="flex-1 space-y-6">
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                                <div>
                                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nom complet</label>
                                                    <input v-model="directorForm.director_name" type="text" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Titre / Fonction</label>
                                                    <input v-model="directorForm.director_title" type="text" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none" placeholder="Ex: Directeur Général">
                                                </div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold text-slate-700 mb-2">Mot du Directeur</label>
                                                <textarea v-model="directorForm.director_message" rows="8" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none resize-none" placeholder="Rédigez le message de bienvenue..."></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-end pt-8 border-t border-slate-100">
                                        <button type="submit" :disabled="directorForm.processing" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-100 transition-all active:scale-95 disabled:opacity-50">
                                            <i v-if="directorForm.processing" class="fas fa-spinner fa-spin mr-2"></i>
                                            Mettre à jour la direction
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- ========== CONTACT ========== -->
                            <div v-if="activeTab === 'contact'" class="animate-in fade-in slide-in-from-bottom-2 duration-300">
                                <form @submit.prevent="submitContact" class="space-y-8">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                                        <div class="space-y-6">
                                            <h3 class="flex items-center gap-2 text-sm font-bold text-emerald-700 pb-2 border-b border-emerald-50">
                                                <i class="fas fa-id-card text-emerald-500"></i>
                                                Informations de contact
                                            </h3>
                                            <div class="space-y-5">
                                                <div>
                                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Téléphone Accueil</label>
                                                    <div class="relative">
                                                        <i class="fas fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                                        <input v-model="contactForm.contact_phone" type="text" class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-emerald-100 focus:border-emerald-500 transition-all outline-none">
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-bold text-red-600 uppercase tracking-wider mb-2">Ligne d'Urgence (24/7)</label>
                                                    <div class="relative">
                                                        <i class="fas fa-ambulance absolute left-4 top-1/2 -translate-y-1/2 text-red-200"></i>
                                                        <input v-model="contactForm.contact_emergency" type="text" class="w-full pl-11 pr-4 py-2.5 bg-red-50/30 border-red-100 rounded-xl focus:bg-white focus:ring-4 focus:ring-red-100 focus:border-red-500 transition-all outline-none font-bold text-red-700">
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email de contact</label>
                                                    <div class="relative">
                                                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                                        <input v-model="contactForm.contact_email" type="email" class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-emerald-100 focus:border-emerald-500 transition-all outline-none">
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email Direction</label>
                                                    <div class="relative">
                                                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                                        <input v-model="contactForm.contact_direction_email" type="email" class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-emerald-100 focus:border-emerald-500 transition-all outline-none">
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Adresse postale</label>
                                                    <div class="relative">
                                                        <i class="fas fa-map-marker-alt absolute left-4 top-4 text-slate-300"></i>
                                                        <textarea v-model="contactForm.contact_address" rows="3" class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-emerald-100 focus:border-emerald-500 transition-all outline-none resize-none"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-6">
                                            <h3 class="flex items-center gap-2 text-sm font-bold text-emerald-700 pb-2 border-b border-emerald-50">
                                                <i class="fas fa-clock text-emerald-500"></i>
                                                Horaires d'ouverture
                                            </h3>
                                            <div class="p-6 bg-emerald-50 rounded-2xl border border-emerald-100 space-y-5">
                                                <div>
                                                    <label class="block text-xs font-bold text-emerald-800 mb-2">Jours ouvrables (Lun - Ven)</label>
                                                    <input v-model="contactForm.opening_hours" type="text" placeholder="Ex: 08:00 - 17:00" class="w-full px-4 py-2.5 bg-white border-emerald-200 rounded-xl focus:ring-4 focus:ring-emerald-200 focus:border-emerald-500 transition-all outline-none">
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-bold text-emerald-800 mb-2">Week-end et Fériés</label>
                                                    <input v-model="contactForm.weekend_hours" type="text" placeholder="Ex: Urgences uniquement" class="w-full px-4 py-2.5 bg-white border-emerald-200 rounded-xl focus:ring-4 focus:ring-emerald-200 focus:border-emerald-500 transition-all outline-none">
                                                </div>
                                                <div class="flex items-start gap-3 mt-4 text-emerald-700/70 italic">
                                                    <i class="fas fa-info-circle mt-1"></i>
                                                    <p class="text-[10px] leading-relaxed">Ces informations seront affichées dans le pied de page et sur la page de contact.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-end pt-8 border-t border-slate-100">
                                        <button type="submit" :disabled="contactForm.processing" class="px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-emerald-100 transition-all active:scale-95 disabled:opacity-50">
                                            <i v-if="contactForm.processing" class="fas fa-spinner fa-spin mr-2"></i>
                                            Enregistrer les coordonnées
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- ========== SOCIAL ========== -->
                            <div v-if="activeTab === 'social'" class="animate-in fade-in slide-in-from-bottom-2 duration-300">
                                <form @submit.prevent="submitSocial" class="space-y-8">
                                    <div class="max-w-xl space-y-5">
                                        <div>
                                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                                <i class="fab fa-facebook text-blue-600 mr-2"></i>Facebook
                                            </label>
                                            <input v-model="socialForm.facebook_url" type="text" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-pink-100 focus:border-pink-500 transition-all outline-none" placeholder="https://facebook.com/...">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                                <i class="fab fa-x-twitter text-slate-800 mr-2"></i>X (Twitter)
                                            </label>
                                            <input v-model="socialForm.twitter_url" type="text" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-pink-100 focus:border-pink-500 transition-all outline-none" placeholder="https://x.com/...">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                                <i class="fab fa-linkedin text-blue-700 mr-2"></i>LinkedIn
                                            </label>
                                            <input v-model="socialForm.linkedin_url" type="text" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-pink-100 focus:border-pink-500 transition-all outline-none" placeholder="https://linkedin.com/company/...">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                                <i class="fab fa-youtube text-red-600 mr-2"></i>YouTube
                                            </label>
                                            <input v-model="socialForm.youtube_url" type="text" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-pink-100 focus:border-pink-500 transition-all outline-none" placeholder="https://youtube.com/@...">
                                        </div>
                                    </div>

                                    <div class="flex justify-end pt-8 border-t border-slate-100">
                                        <button type="submit" :disabled="socialForm.processing" class="px-8 py-3 bg-pink-600 hover:bg-pink-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-pink-100 transition-all active:scale-95 disabled:opacity-50">
                                            <i v-if="socialForm.processing" class="fas fa-spinner fa-spin mr-2"></i>
                                            Enregistrer les réseaux sociaux
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- ========== DISPLAY ========== -->
                            <div v-if="activeTab === 'display'" class="animate-in fade-in slide-in-from-bottom-2 duration-300">
                                <form @submit.prevent="submitDisplay" class="space-y-8">
                                    <div class="max-w-2xl">
                                        <div class="bg-amber-50/50 p-8 rounded-2xl border border-amber-100">
                                            <div class="flex items-center gap-4 mb-8">
                                                <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center">
                                                    <i class="fas fa-layer-group"></i>
                                                </div>
                                                <div>
                                                    <h3 class="text-sm font-bold text-amber-900">Visibilité des sections</h3>
                                                    <p class="text-[11px] text-amber-700/70 mt-0.5">Activez ou masquez les sections de la page d'accueil</p>
                                                </div>
                                            </div>

                                            <div class="space-y-3">
                                                <div
                                                    v-for="toggle in sectionToggles"
                                                    :key="toggle.key"
                                                    class="flex items-center justify-between p-4 bg-white rounded-xl border border-amber-200/60 shadow-sm transition-all hover:shadow-md"
                                                >
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 flex-shrink-0">
                                                            <i :class="[toggle.icon, 'text-base']"></i>
                                                        </div>
                                                        <div>
                                                            <h4 class="text-sm font-bold text-slate-900">{{ toggle.label }}</h4>
                                                            <p class="text-[10px] text-slate-500 mt-0.5">{{ toggle.desc }}</p>
                                                        </div>
                                                    </div>

                                                    <button
                                                        type="button"
                                                        @click="displayForm[toggle.key] = !displayForm[toggle.key]"
                                                        :class="[
                                                            displayForm[toggle.key] ? 'bg-amber-500' : 'bg-slate-200',
                                                            'relative inline-flex h-7 w-12 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2'
                                                        ]"
                                                    >
                                                        <span
                                                            :class="[
                                                                displayForm[toggle.key] ? 'translate-x-5' : 'translate-x-0',
                                                                'pointer-events-none inline-block h-6 w-6 transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out flex items-center justify-center'
                                                            ]"
                                                        >
                                                            <i v-if="displayForm[toggle.key]" class="fas fa-check text-[10px] text-amber-600"></i>
                                                            <i v-else class="fas fa-times text-[10px] text-slate-400"></i>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="p-4 bg-amber-100/30 rounded-xl border border-dashed border-amber-200 mt-6">
                                                <p class="text-[10px] text-amber-800 text-center italic font-medium leading-relaxed">
                                                    Note: La désactivation d'une section la retire visuellement du site public, mais les données restent conservées en base de données.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-start pt-8 border-t border-slate-100">
                                        <button type="submit" :disabled="displayForm.processing" class="px-10 py-3 bg-amber-600 hover:bg-amber-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-amber-100 transition-all active:scale-95 disabled:opacity-50">
                                            <i v-if="displayForm.processing" class="fas fa-spinner fa-spin mr-2"></i>
                                            Appliquer les changements
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped>
.animate-in {
    animation-duration: 0.3s;
}
input, textarea {
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>
