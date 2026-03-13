<script setup>
import { ref } from 'vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    partners: Array,
});

const isEditing = ref(false);
const currentPartner = ref(null);

const form = useForm({
    name: '',
    logo: null,
    link: '',
    order: 0,
    is_active: true,
});

const openCreateModal = () => {
    isEditing.value = false;
    currentPartner.value = null;
    form.reset();
    document.getElementById('partner-modal').classList.remove('hidden');
};

const openEditModal = (partner) => {
    isEditing.value = true;
    currentPartner.value = partner;
    form.name = partner.name;
    form.link = partner.link || '';
    form.order = partner.order;
    form.is_active = partner.is_active;
    form.logo = null;
    document.getElementById('partner-modal').classList.remove('hidden');
};

const closeModal = () => {
    document.getElementById('partner-modal').classList.add('hidden');
};

const submit = () => {
    if (isEditing.value) {
        form.post(route('admin.partners.update', currentPartner.value.id), {
            onSuccess: () => closeModal(),
        });
    } else {
        form.post(route('admin.partners.store'), {
            onSuccess: () => closeModal(),
        });
    }
};

const deletePartner = (partner) => {
    if (confirm('Voulez-vous vraiment supprimer ce partenaire ?')) {
        router.delete(route('admin.partners.destroy', partner.id));
    }
};
</script>

<template>
    <AdminLayout title="Gestion des Partenaires">
        <template #actions>
            <button @click="openCreateModal" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-black uppercase tracking-widest rounded-xl shadow-lg shadow-blue-200 transition-all flex items-center gap-2 active:scale-95">
                <i class="fas fa-plus"></i> Nouveau Partenaire
            </button>
        </template>

        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                    <div>
                        <h2 class="text-lg font-black text-slate-900 tracking-tight">Liste des Partenaires</h2>
                        <p class="text-xs text-slate-500 font-medium mt-1">Gérez les logos et liens des établissements partenaires</p>
                    </div>
                    <div class="px-4 py-1.5 bg-blue-50 text-blue-700 rounded-full text-[10px] font-black uppercase tracking-widest">
                        {{ partners.length }} Partenaires
                    </div>
                </div>

                <!-- Conteneur avec Scrollbar si bcp de partenaires -->
                <div class="overflow-x-auto max-h-[600px] overflow-y-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse">
                        <thead class="sticky top-0 z-10 bg-slate-50 shadow-sm">
                            <tr>
                                <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Logo</th>
                                <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Nom du partenaire</th>
                                <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Lien Site Web</th>
                                <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Ordre</th>
                                <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr v-for="partner in partners" :key="partner.id" class="group hover:bg-blue-50/30 transition-all duration-300">
                                <td class="px-8 py-5">
                                    <div class="w-20 h-12 bg-white rounded-xl border border-slate-200 shadow-sm flex items-center justify-center p-2 group-hover:border-blue-200 transition-colors">
                                        <img :src="`/storage/${partner.logo}`" class="max-h-full max-w-full object-contain" />
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="text-sm font-black text-slate-800 tracking-tight">{{ partner.name }}</div>
                                    <div v-if="!partner.is_active" class="mt-1 inline-flex px-2 py-0.5 bg-red-50 text-red-500 text-[9px] font-bold rounded uppercase">Inactif</div>
                                </td>
                                <td class="px-8 py-5">
                                    <a v-if="partner.link" :href="partner.link" target="_blank" class="text-xs font-bold text-blue-600 hover:underline flex items-center gap-1">
                                        {{ partner.link }} <i class="fas fa-external-link-alt text-[9px]"></i>
                                    </a>
                                    <span v-else class="text-xs text-slate-300 italic">Aucun lien</span>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="inline-flex w-8 h-8 rounded-lg bg-slate-100 items-center justify-center text-xs font-black text-slate-600">
                                        {{ partner.order }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button @click="openEditModal(partner)" class="w-9 h-9 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-edit text-xs"></i>
                                        </button>
                                        <button @click="deletePartner(partner)" class="w-9 h-9 flex items-center justify-center bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="partners.length === 0">
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 mb-4">
                                            <i class="fas fa-handshake text-3xl"></i>
                                        </div>
                                        <p class="text-sm font-bold text-slate-400">Aucun partenaire enregistré</p>
                                        <button @click="openCreateModal" class="mt-4 text-blue-600 text-xs font-black uppercase tracking-widest hover:underline">
                                            Ajouter le premier partenaire
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        <!-- Modal (Agrandie pour une meilleure UX) -->
        <div id="partner-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-md hidden p-4">
            <div class="bg-white rounded-lg shadow-2xl border border-slate-200 w-full max-w-2xl overflow-hidden animate-in fade-in zoom-in-95 duration-300">
                <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between bg-white">
                    <h3 class="text-lg font-medium text-slate-900">
                        {{ isEditing ? 'Modifier Partenaire' : 'Ajouter un Partenaire' }}
                    </h3>
                    <button @click="closeModal" class="text-slate-400 hover:text-slate-500 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form @submit.prevent="submit">
                    <div class="px-6 py-6 space-y-5 bg-slate-50 max-h-[70vh] overflow-y-auto">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Nom de l'organisation <span class="text-red-500">*</span></label>
                            <input v-model="form.name" type="text" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Ex: Ministère de la Santé" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Logo officiel</label>
                            <div class="p-4 bg-white rounded-md border border-dashed border-slate-300">
                                <input type="file" @input="form.logo = $event.target.files[0]" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-slate-50 file:text-slate-700 hover:file:bg-slate-100 cursor-pointer">
                                <p class="mt-2 text-[10px] text-slate-400 italic">Format PNG transparent recommandé (Max 2Mo)</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Lien du site Web</label>
                            <div class="relative">
                                <i class="fas fa-link absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                                <input v-model="form.link" type="url" class="w-full pl-9 border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="https://www.exemple.com">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Ordre d'affichage</label>
                                <input v-model="form.order" type="number" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                            <div class="flex items-center mt-6">
                                <label class="flex items-center cursor-pointer group">
                                    <input v-model="form.is_active" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                                    <span class="ml-2 text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Partenaire Actif</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-100 px-6 py-3 sm:flex sm:flex-row-reverse border-t border-slate-200">
                        <button type="submit" :disabled="form.processing" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto disabled:opacity-50 transition-all">
                            <i v-if="form.processing" class="fas fa-circle-notch fa-spin mr-2"></i>
                            {{ isEditing ? 'Mettre à jour' : 'Enregistrer' }}
                        </button>
                        <button type="button" @click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto transition-all">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #e2e8f0;
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #cbd5e1;
}

.animate-in {
    animation-duration: 0.3s;
}
</style>