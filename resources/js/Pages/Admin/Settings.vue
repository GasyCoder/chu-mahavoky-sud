<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    settings: Object,
});

const activeTab = ref('general');

const tabs = [
    { id: 'general', label: 'Général', icon: 'fas fa-sliders-h' },
    { id: 'director', label: 'Direction', icon: 'fas fa-user-tie' },
    { id: 'contact', label: 'Contact & Horaires', icon: 'fas fa-address-book' },
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

const submitGeneral = () => {
    generalForm.post(route('admin.settings.general'), { preserveScroll: true });
};

const submitDirector = () => {
    directorForm.post(route('admin.settings.director'), { preserveScroll: true });
};

const submitContact = () => {
    contactForm.post(route('admin.settings.contact'), { preserveScroll: true });
};
</script>

<template>
    <AdminLayout title="Paramètres du site">
        <div class="max-w-5xl mx-auto">
            
            <div class="bg-white rounded-lg shadow-sm border border-slate-200">
                <!-- Navigation Tabs -->
                <div class="border-b border-slate-200 bg-slate-50 rounded-t-lg">
                    <nav class="flex -mb-px px-6">
                        <button 
                            v-for="tab in tabs" 
                            :key="tab.id"
                            @click="activeTab = tab.id"
                            :class="[
                                activeTab === tab.id 
                                    ? 'border-blue-500 text-blue-600 bg-white' 
                                    : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300',
                                'whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-colors flex items-center gap-2 mt-1 rounded-t-md'
                            ]"
                        >
                            <i :class="tab.icon"></i>
                            {{ tab.label }}
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="p-6 sm:p-8">
                    
                    <!-- General Settings -->
                    <div v-show="activeTab === 'general'">
                        <form @submit.prevent="submitGeneral" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-5">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Nom du site</label>
                                        <input v-model="generalForm.site_name" type="text" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <p v-if="generalForm.errors.site_name" class="mt-1 text-sm text-red-600">{{ generalForm.errors.site_name }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Description courte</label>
                                        <textarea v-model="generalForm.site_description" rows="3" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Slogan</label>
                                        <input v-model="generalForm.site_slogan" type="text" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>
                                </div>
                                
                                <div class="space-y-6 bg-slate-50 p-6 rounded-lg border border-slate-200">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-3">Logo Principal</label>
                                        <div class="flex items-center gap-6">
                                            <div class="w-24 h-24 bg-white rounded-md border border-slate-300 flex items-center justify-center p-2 shadow-sm">
                                                <img v-if="settings.logo_url" :src="settings.logo_url" class="max-w-full max-h-full object-contain">
                                                <i v-else class="fas fa-image text-3xl text-slate-300"></i>
                                            </div>
                                            <input type="file" @input="generalForm.logo = $event.target.files[0]" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end pt-5 border-t border-slate-200">
                                <button type="submit" :disabled="generalForm.processing" class="inline-flex justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 transition-colors">
                                    <i v-if="generalForm.processing" class="fas fa-circle-notch fa-spin mr-2"></i>
                                    Sauvegarder Général
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Director Settings -->
                    <div v-show="activeTab === 'director'">
                        <form @submit.prevent="submitDirector" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                <div class="md:col-span-1">
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Photo officielle</label>
                                    <div class="aspect-square w-full max-w-[200px] bg-slate-100 rounded-lg border border-slate-300 flex items-center justify-center overflow-hidden shadow-inner mb-4">
                                        <img v-if="settings.director_photo_url" :src="settings.director_photo_url" class="w-full h-full object-cover">
                                        <i v-else class="fas fa-user-tie text-5xl text-slate-300"></i>
                                    </div>
                                    <input type="file" @input="directorForm.director_photo = $event.target.files[0]" class="block w-full text-xs text-slate-500 file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                                </div>
                                
                                <div class="md:col-span-2 space-y-5">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-1">Nom du Directeur</label>
                                            <input v-model="directorForm.director_name" type="text" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-1">Titre</label>
                                            <input v-model="directorForm.director_title" type="text" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Message de direction</label>
                                        <textarea v-model="directorForm.director_message" rows="6" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end pt-5 border-t border-slate-200">
                                <button type="submit" :disabled="directorForm.processing" class="inline-flex justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 transition-colors">
                                    Sauvegarder Direction
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Contact Settings -->
                    <div v-show="activeTab === 'contact'">
                        <form @submit.prevent="submitContact" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-5 bg-slate-50 p-6 rounded-lg border border-slate-200">
                                    <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2 mb-4 border-b border-slate-200 pb-2">
                                        <i class="fas fa-phone-alt text-blue-500"></i> Coordonnées
                                    </h3>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-700 mb-1">Téléphone Principal</label>
                                        <input v-model="contactForm.contact_phone" type="text" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-700 mb-1">Téléphone Urgence (24/7)</label>
                                        <input v-model="contactForm.contact_emergency" type="text" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-700 mb-1">Email Contact</label>
                                        <input v-model="contactForm.contact_email" type="email" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-700 mb-1">Adresse Physique</label>
                                        <textarea v-model="contactForm.contact_address" rows="2" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                                    </div>
                                </div>

                                <div class="space-y-5 bg-slate-50 p-6 rounded-lg border border-slate-200">
                                    <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2 mb-4 border-b border-slate-200 pb-2">
                                        <i class="far fa-clock text-blue-500"></i> Heures d'ouverture
                                    </h3>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-700 mb-1">Jours de semaine</label>
                                        <input v-model="contactForm.opening_hours" type="text" placeholder="Ex: 08:00 - 17:00" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-700 mb-1">Week-end</label>
                                        <input v-model="contactForm.weekend_hours" type="text" placeholder="Ex: Urgences 24/7" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end pt-5 border-t border-slate-200">
                                <button type="submit" :disabled="contactForm.processing" class="inline-flex justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 transition-colors">
                                    Sauvegarder Contacts
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </AdminLayout>
</template>
