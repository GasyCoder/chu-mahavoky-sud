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
    { id: 'director', label: 'Direction', icon: 'fas fa-user-tie', color: 'indigo' },
    { id: 'contact', label: 'Contact & Horaires', icon: 'fas fa-address-book', color: 'emerald' },
    { id: 'display', label: 'Affichage', icon: 'fas fa-desktop', color: 'amber' },
];

const generalForm = useForm({
    site_name: props.settings.site_name || '',
    site_description: props.settings.site_description || '',
    site_slogan: props.settings.site_slogan || '',
    logo: null,
    favicon: null,
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

const displayForm = useForm({
    show_experts_section: props.settings.show_experts_section,
});

const submitGeneral = () => {
    generalForm.post(route('admin.settings.general'), { 
        preserveScroll: true,
        onSuccess: () => {
            // Optional: visual feedback
        }
    });
};

const submitDirector = () => {
    directorForm.post(route('admin.settings.director'), { preserveScroll: true });
};

const submitContact = () => {
    contactForm.post(route('admin.settings.contact'), { preserveScroll: true });
};

const submitDisplay = () => {
    displayForm.post(route('admin.settings.display'), { preserveScroll: true });
};
</script>

<template>
    <AdminLayout title="Configuration du portail">
        <div class="max-w-6xl mx-auto pb-12">
            
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
                                <div :class="`w-12 h-12 rounded-xl bg-${tabs.find(t => t.id === activeTab).color}-100 text-${tabs.find(t => t.id === activeTab).color}-600 flex items-center justify-center text-xl shadow-sm` ">
                                    <i :class="tabs.find(t => t.id === activeTab).icon"></i>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-slate-900">{{ tabs.find(t => t.id === activeTab).label }}</h2>
                                    <p class="text-sm text-slate-500 mt-0.5">Gérez les informations relatives à la section {{ tabs.find(t => t.id === activeTab).label.toLowerCase() }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-8">
                            <!-- transition wrapper could be added here for tab changes -->
                            
                            <!-- General Settings -->
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
                                                    
                                                    <input type="file" @input="generalForm.logo = $event.target.files[0]" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
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
                                        <button 
                                            type="submit" 
                                            :disabled="generalForm.processing" 
                                            class="inline-flex items-center px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-95 disabled:opacity-50"
                                        >
                                            <i v-if="generalForm.processing" class="fas fa-spinner fa-spin mr-2"></i>
                                            Enregistrer les modifications
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Director Settings -->
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
                                                    <!-- Hover Overlay -->
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
                                            Mettre à jour la direction
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Contact Settings -->
                            <div v-if="activeTab === 'contact'" class="animate-in fade-in slide-in-from-bottom-2 duration-300">
                                <form @submit.prevent="submitContact" class="space-y-8">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                                        <!-- Coordonnées -->
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
                                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 text-red-600">Ligne d'Urgence (24/7)</label>
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
                                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Adresse postale</label>
                                                    <div class="relative">
                                                        <i class="fas fa-map-marker-alt absolute left-4 top-4 text-slate-300"></i>
                                                        <textarea v-model="contactForm.contact_address" rows="3" class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-emerald-100 focus:border-emerald-500 transition-all outline-none resize-none"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Horaires -->
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
                                            Enregistrer les coordonnées
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Display Settings -->
                            <div v-if="activeTab === 'display'" class="animate-in fade-in slide-in-from-bottom-2 duration-300">
                                <form @submit.prevent="submitDisplay" class="space-y-8">
                                    <div class="max-w-2xl">
                                        <div class="bg-amber-50/50 p-8 rounded-2xl border border-amber-100">
                                            <div class="flex items-center gap-4 mb-8">
                                                <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center">
                                                    <i class="fas fa-layer-group"></i>
                                                </div>
                                                <h3 class="text-sm font-bold text-amber-900">Visibilité des éléments dynamiques</h3>
                                            </div>
                                            
                                            <div class="space-y-4">
                                                <div class="flex items-center justify-between p-5 bg-white rounded-2xl border border-amber-200 shadow-sm transition-all hover:shadow-md">
                                                    <div class="flex items-center gap-4">
                                                        <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                                                            <i class="fas fa-user-md text-xl"></i>
                                                        </div>
                                                        <div>
                                                            <h4 class="text-sm font-bold text-slate-900">Nos Experts de Santé</h4>
                                                            <p class="text-[11px] text-slate-500 mt-0.5">Activer/Masquer la section sur la page d'accueil</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <button 
                                                        type="button"
                                                        @click="displayForm.show_experts_section = !displayForm.show_experts_section"
                                                        :class="[
                                                            displayForm.show_experts_section ? 'bg-amber-500' : 'bg-slate-200',
                                                            'relative inline-flex h-7 w-12 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2'
                                                        ]"
                                                    >
                                                        <span 
                                                            :class="[
                                                                displayForm.show_experts_section ? 'translate-x-5' : 'translate-x-0',
                                                                'pointer-events-none inline-block h-6 w-6 transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out flex items-center justify-center'
                                                            ]"
                                                        >
                                                            <i v-if="displayForm.show_experts_section" class="fas fa-check text-[10px] text-amber-600"></i>
                                                            <i v-else class="fas fa-times text-[10px] text-slate-400"></i>
                                                        </span>
                                                    </button>
                                                </div>
                                                
                                                <!-- Add more toggles here as needed -->
                                                <div class="p-4 bg-amber-100/30 rounded-xl border border-dashed border-amber-200 mt-6">
                                                    <p class="text-[10px] text-amber-800 text-center italic font-medium leading-relaxed">
                                                        Note: La désactivation d'une section la retire visuellement du site public, mais les données restent conservées en base de données.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="flex justify-start pt-8 border-t border-slate-100">
                                        <button type="submit" :disabled="displayForm.processing" class="px-10 py-3 bg-amber-600 hover:bg-amber-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-amber-100 transition-all active:scale-95 disabled:opacity-50">
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

/* Tailwind handles most, but specific hover transitions help */
input, textarea {
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>