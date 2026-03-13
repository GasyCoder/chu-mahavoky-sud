<script setup>
import { ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    equipments: Array,
});

const isModalOpen = ref(false);
const isDeleteModalOpen = ref(false);
const itemToDelete = ref(null);
const imagePreview = ref(null);

const iconOptions = [
    'fa-microscope', 'fa-procedures', 'fa-x-ray', 'fa-cog', 'fa-heartbeat',
    'fa-syringe', 'fa-pills', 'fa-stethoscope', 'fa-hospital', 'fa-ambulance',
    'fa-thermometer', 'fa-dna', 'fa-flask', 'fa-laptop-medical', 'fa-tooth',
    'fa-lungs', 'fa-brain', 'fa-eye',
];

const form = useForm({
    id: null,
    name: '',
    description: '',
    icon: 'fa-cog',
    order: 0,
    status: true,
    image: null,
});

const handleImageSelect = (event) => {
    const file = event.target.files[0];
    form.image = file;
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => { imagePreview.value = e.target.result; };
        reader.readAsDataURL(file);
    } else {
        imagePreview.value = null;
    }
};

const removeImage = () => {
    form.image = null;
    imagePreview.value = null;
};

const openModal = (equipment = null) => {
    if (equipment) {
        form.id = equipment.id;
        form.name = equipment.name;
        form.description = equipment.description;
        form.icon = equipment.icon;
        form.order = equipment.order;
        form.status = !!equipment.status;
        form.image = null;
        imagePreview.value = equipment.image_url || null;
    } else {
        form.reset();
        form.id = null;
        form.icon = 'fa-cog';
        form.status = true;
        form.order = props.equipments.length;
        imagePreview.value = null;
    }
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
    imagePreview.value = null;
    form.reset();
    form.clearErrors();
};

const save = () => {
    form.post(route('admin.equipments.store'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
    });
};

const confirmDelete = (equipment) => {
    itemToDelete.value = equipment;
    isDeleteModalOpen.value = true;
};

const deleteEquipment = () => {
    if (itemToDelete.value) {
        router.delete(route('admin.equipments.destroy', itemToDelete.value.id), {
            preserveScroll: true,
            onSuccess: () => {
                isDeleteModalOpen.value = false;
                itemToDelete.value = null;
            }
        });
    }
};
</script>

<template>
    <AdminLayout title="Gestion des équipements">
        <template #actions>
            <button @click="openModal()" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-white text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-colors">
                <i class="fas fa-plus mr-2"></i> Ajouter un équipement
            </button>
        </template>

        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Ordre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Équipement</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        <tr v-for="eq in equipments" :key="eq.id" class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-mono">
                                {{ eq.order }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center">
                                        <i :class="['fas', eq.icon, 'text-blue-600 text-sm']"></i>
                                    </div>
                                    <span class="text-sm font-medium text-slate-900">{{ eq.name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500 max-w-xs truncate">
                                {{ eq.description || '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img v-if="eq.image_url" :src="eq.image_url" class="h-10 w-14 rounded object-cover border border-slate-200" alt="">
                                <span v-else class="text-xs text-slate-400">Aucune</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span v-if="eq.status" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Actif</span>
                                <span v-else class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-100 text-slate-800">Inactif</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button @click="openModal(eq)" class="text-indigo-600 hover:text-indigo-900 mr-3" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button @click="confirmDelete(eq)" class="text-red-600 hover:text-red-900" title="Supprimer">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr v-if="equipments.length === 0">
                            <td colspan="6" class="px-6 py-10 text-center text-slate-500">
                                Aucun équipement trouvé.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div v-if="isModalOpen" class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" @click="closeModal">
                    <div class="absolute inset-0 bg-slate-900 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full">
                    <form @submit.prevent="save">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-slate-200">
                            <h3 class="text-lg leading-6 font-medium text-slate-900">
                                {{ form.id ? 'Modifier l\'équipement' : 'Nouvel équipement' }}
                            </h3>
                        </div>
                        <div class="px-6 py-6 space-y-5 bg-slate-50 max-h-[70vh] overflow-y-auto">
                            <!-- Name -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Nom <span class="text-red-500">*</span></label>
                                <input v-model="form.name" type="text" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Ex: Laboratoire Moderne">
                                <p v-if="form.errors.name" class="text-red-500 text-xs mt-1">{{ form.errors.name }}</p>
                            </div>

                            <!-- Description -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                                <textarea v-model="form.description" rows="3" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Brève description de l'équipement..."></textarea>
                            </div>

                            <!-- Icon -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Icône</label>
                                <div class="flex flex-wrap gap-2">
                                    <button
                                        v-for="icon in iconOptions"
                                        :key="icon"
                                        type="button"
                                        @click="form.icon = icon"
                                        class="w-9 h-9 rounded-lg flex items-center justify-center transition-all border-2 bg-white"
                                        :class="form.icon === icon ? 'border-blue-400 ring-2 ring-offset-1 ring-blue-200 text-blue-600' : 'border-slate-200 text-slate-400 hover:border-slate-300 hover:text-slate-600'"
                                    >
                                        <i :class="['fas', icon, 'text-sm']"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Image -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Image</label>
                                <div v-if="imagePreview" class="relative mb-3 group">
                                    <img :src="imagePreview" alt="Aperçu" class="w-full h-40 object-cover rounded-lg border border-slate-200">
                                    <button type="button" @click="removeImage" class="absolute top-2 right-2 w-7 h-7 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-lg hover:bg-red-600">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </div>
                                <input type="file" accept="image/*" @input="handleImageSelect" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-slate-50 file:text-slate-700 hover:file:bg-slate-100">
                            </div>

                            <!-- Order + Status -->
                            <div class="flex items-center gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Ordre</label>
                                    <input v-model="form.order" type="number" min="0" class="w-24 border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div class="flex items-center pt-5">
                                    <input v-model="form.status" id="eq_status" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                                    <label for="eq_status" class="ml-2 block text-sm text-slate-700">Actif</label>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-100 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200">
                            <button type="submit" :disabled="form.processing" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50">
                                {{ form.id ? 'Mettre à jour' : 'Créer' }}
                            </button>
                            <button type="button" @click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div v-if="isDeleteModalOpen" class="fixed inset-0 z-[60] overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" @click="isDeleteModalOpen = false">
                    <div class="absolute inset-0 bg-slate-900 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-exclamation-triangle text-red-600"></i>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-slate-900">Supprimer l'équipement</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500">
                                        Êtes-vous sûr de vouloir supprimer <strong>{{ itemToDelete?.name }}</strong> ? Cette action est irréversible.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200">
                        <button type="button" @click="deleteEquipment" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">
                            Supprimer
                        </button>
                        <button type="button" @click="isDeleteModalOpen = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Annuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
