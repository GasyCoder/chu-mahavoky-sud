<script setup>
import { ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    categories: Array,
});

const isModalOpen = ref(false);
const isDeleteModalOpen = ref(false);
const itemToDelete = ref(null);

const colorOptions = [
    { value: 'blue', label: 'Bleu', bg: 'bg-blue-100', text: 'text-blue-700', dot: 'bg-blue-500' },
    { value: 'purple', label: 'Violet', bg: 'bg-purple-100', text: 'text-purple-700', dot: 'bg-purple-500' },
    { value: 'emerald', label: 'Vert', bg: 'bg-emerald-100', text: 'text-emerald-700', dot: 'bg-emerald-500' },
    { value: 'amber', label: 'Orange', bg: 'bg-amber-100', text: 'text-amber-700', dot: 'bg-amber-500' },
    { value: 'red', label: 'Rouge', bg: 'bg-red-100', text: 'text-red-700', dot: 'bg-red-500' },
    { value: 'pink', label: 'Rose', bg: 'bg-pink-100', text: 'text-pink-700', dot: 'bg-pink-500' },
    { value: 'cyan', label: 'Cyan', bg: 'bg-cyan-100', text: 'text-cyan-700', dot: 'bg-cyan-500' },
    { value: 'indigo', label: 'Indigo', bg: 'bg-indigo-100', text: 'text-indigo-700', dot: 'bg-indigo-500' },
    { value: 'slate', label: 'Gris', bg: 'bg-slate-100', text: 'text-slate-700', dot: 'bg-slate-500' },
];

const iconOptions = [
    'fa-newspaper', 'fa-calendar', 'fa-stethoscope', 'fa-cog', 'fa-heart',
    'fa-star', 'fa-bell', 'fa-flag', 'fa-bookmark', 'fa-tag',
    'fa-bullhorn', 'fa-trophy', 'fa-graduation-cap', 'fa-microscope',
    'fa-hospital', 'fa-ambulance', 'fa-user-md', 'fa-pills',
];

const form = useForm({
    id: null,
    name: '',
    color: 'blue',
    icon: 'fa-newspaper',
    order: 0,
    active: true,
});

const openModal = (category = null) => {
    if (category) {
        form.id = category.id;
        form.name = category.name;
        form.color = category.color;
        form.icon = category.icon;
        form.order = category.order;
        form.active = !!category.active;
    } else {
        form.reset();
        form.id = null;
        form.color = 'blue';
        form.icon = 'fa-newspaper';
        form.active = true;
        form.order = props.categories.length;
    }
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
    form.reset();
    form.clearErrors();
};

const save = () => {
    form.post(route('admin.news.categories.store'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
    });
};

const confirmDelete = (category) => {
    itemToDelete.value = category;
    isDeleteModalOpen.value = true;
};

const deleteCategory = () => {
    if (itemToDelete.value) {
        router.delete(route('admin.news.categories.destroy', itemToDelete.value.id), {
            preserveScroll: true,
            onSuccess: () => {
                isDeleteModalOpen.value = false;
                itemToDelete.value = null;
            }
        });
    }
};

const getColorClasses = (color) => {
    return colorOptions.find(c => c.value === color) || colorOptions[0];
};
</script>

<template>
    <AdminLayout title="Catégories d'articles">
        <template #actions>
            <div class="flex items-center gap-3">
                <a :href="route('admin.news')" class="inline-flex items-center px-4 py-2 border border-slate-300 rounded-md font-medium text-slate-700 text-sm hover:bg-slate-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Retour aux articles
                </a>
                <button @click="openModal()" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-white text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-colors">
                    <i class="fas fa-plus mr-2"></i> Nouvelle catégorie
                </button>
            </div>
        </template>

        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Ordre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Catégorie</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Couleur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Articles</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        <tr v-for="cat in categories" :key="cat.id" class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-mono">
                                {{ cat.order }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" :class="getColorClasses(cat.color).bg">
                                        <i :class="['fas', cat.icon || 'fa-tag', 'text-xs', getColorClasses(cat.color).text]"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-slate-900">{{ cat.name }}</div>
                                        <div class="text-xs text-slate-400">{{ cat.slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium" :class="[getColorClasses(cat.color).bg, getColorClasses(cat.color).text]">
                                    <span class="w-2 h-2 rounded-full" :class="getColorClasses(cat.color).dot"></span>
                                    {{ colorOptions.find(c => c.value === cat.color)?.label || cat.color }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                {{ cat.blogs_count || 0 }} article{{ (cat.blogs_count || 0) > 1 ? 's' : '' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span v-if="cat.active" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                <span v-else class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-100 text-slate-800">Inactive</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button @click="openModal(cat)" class="text-indigo-600 hover:text-indigo-900 mr-3" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button @click="confirmDelete(cat)" class="text-red-600 hover:text-red-900" title="Supprimer">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr v-if="categories.length === 0">
                            <td colspan="6" class="px-6 py-10 text-center text-slate-500">
                                Aucune catégorie trouvée.
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
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                    <form @submit.prevent="save">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-slate-200">
                            <h3 class="text-lg leading-6 font-medium text-slate-900">
                                {{ form.id ? 'Modifier la catégorie' : 'Nouvelle catégorie' }}
                            </h3>
                        </div>
                        <div class="px-6 py-6 space-y-5 bg-slate-50">
                            <!-- Name -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Nom <span class="text-red-500">*</span></label>
                                <input v-model="form.name" type="text" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Ex: Actualité">
                                <p v-if="form.errors.name" class="text-red-500 text-xs mt-1">{{ form.errors.name }}</p>
                            </div>

                            <!-- Color -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Couleur</label>
                                <div class="flex flex-wrap gap-2">
                                    <button
                                        v-for="color in colorOptions"
                                        :key="color.value"
                                        type="button"
                                        @click="form.color = color.value"
                                        class="w-9 h-9 rounded-lg flex items-center justify-center transition-all border-2"
                                        :class="[
                                            color.bg,
                                            form.color === color.value ? 'border-slate-400 ring-2 ring-offset-1 ring-slate-300 scale-110' : 'border-transparent hover:scale-105'
                                        ]"
                                        :title="color.label"
                                    >
                                        <span class="w-3.5 h-3.5 rounded-full" :class="color.dot"></span>
                                    </button>
                                </div>
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

                            <!-- Order -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Ordre</label>
                                <input v-model="form.order" type="number" min="0" class="w-24 border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>

                            <!-- Active -->
                            <div class="flex items-center">
                                <input v-model="form.active" id="cat_active" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                                <label for="cat_active" class="ml-2 block text-sm text-slate-700">Catégorie active</label>
                            </div>

                            <!-- Preview -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Aperçu</label>
                                <div class="flex items-center gap-3 p-3 bg-white rounded-lg border border-slate-200">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" :class="getColorClasses(form.color).bg">
                                        <i :class="['fas', form.icon || 'fa-tag', 'text-xs', getColorClasses(form.color).text]"></i>
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium" :class="[getColorClasses(form.color).bg, getColorClasses(form.color).text]">
                                        {{ form.name || 'Catégorie' }}
                                    </span>
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
                                <h3 class="text-lg leading-6 font-medium text-slate-900">Supprimer la catégorie</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500">
                                        Êtes-vous sûr de vouloir supprimer la catégorie <strong>{{ itemToDelete?.name }}</strong> ?
                                        <span v-if="itemToDelete?.blogs_count > 0" class="block mt-1 text-red-600 font-medium">
                                            Cette catégorie contient {{ itemToDelete.blogs_count }} article(s) et ne peut pas être supprimée.
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200">
                        <button type="button" @click="deleteCategory" :disabled="itemToDelete?.blogs_count > 0" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed">
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
