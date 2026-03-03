<script setup>
import { ref, watch } from 'vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import debounce from 'lodash/debounce';

const props = defineProps({
    services: Object,
    categories: Array,
    type: String,
    filters: Object,
});

const search = ref(props.filters.search || '');

const isModalOpen = ref(false);
const isDeleteModalOpen = ref(false);
const itemToDelete = ref(null);
const activeTab = ref('general');

const form = useForm({
    id: null,
    name: '',
    category_id: '',
    short_description: '',
    full_description: '',
    icon: 'fas fa-stethoscope',
    phone: '',
    email: '',
    location: '',
    working_hours: '',
    active: true,
    equipments: '',
    image: null,
    leader_photo: null,
    members_photos: [],
    team_members: {
        leader: { name: '', position: 'Chef de service', email: '', phone: '', isLead: true },
        members: []
    }
});

const fetchServices = debounce(() => {
    router.get(route('admin.services.' + (props.type === 'technical' ? 'medical' : 'administration')), {
        search: search.value,
    }, { preserveState: true, preserveScroll: true, replace: true });
}, 300);

watch(search, fetchServices);

const openModal = (service = null) => {
    activeTab.value = 'general';
    if (service) {
        form.id = service.id;
        form.name = service.name;
        form.category_id = service.category_id;
        form.short_description = service.short_description;
        form.full_description = service.full_description;
        form.icon = service.icon || 'fas fa-stethoscope';
        form.phone = service.phone || '';
        form.email = service.email || '';
        form.location = service.location || '';
        form.working_hours = service.working_hours || '';
        form.active = !!service.active;
        form.equipments = Array.isArray(service.equipments) ? service.equipments.join(', ') : (service.equipments || '');
        
        let team = service.team_members;
        if (typeof team === 'string') {
            try { team = JSON.parse(team); } catch (e) { team = null; }
        }
        
        form.team_members = team || { leader: { name: '', position: 'Chef de service', email: '', phone: '', isLead: true }, members: [] };
        
        form.image = null;
        form.leader_photo = null;
        form.members_photos = [];
    } else {
        form.reset();
        form.id = null;
        form.category_id = props.categories.length > 0 ? props.categories[0].id : '';
        form.team_members = { leader: { name: '', position: 'Chef de service', email: '', phone: '', isLead: true }, members: [] };
    }
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
    form.reset();
    form.clearErrors();
};

const saveService = () => {
    form.post(route('admin.services.store'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
    });
};

const confirmDelete = (service) => {
    itemToDelete.value = service;
    isDeleteModalOpen.value = true;
};

const deleteService = () => {
    if (itemToDelete.value) {
        router.delete(route('admin.services.destroy', itemToDelete.value.id), {
            preserveScroll: true,
            onSuccess: () => {
                isDeleteModalOpen.value = false;
                itemToDelete.value = null;
            }
        });
    }
};

const addTeamMember = () => {
    form.team_members.members.push({ name: '', position: 'Médecin spécialiste', isLead: false });
};

const removeTeamMember = (index) => {
    form.team_members.members.splice(index, 1);
};
</script>

<template>
    <AdminLayout :title="type === 'technical' ? 'Services Médicaux' : 'Services Administratifs'">
        <template #actions>
            <button @click="openModal()" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-white text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-colors">
                <i class="fas fa-plus mr-2"></i> Ajouter un service
            </button>
        </template>

        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
            <!-- Filters -->
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex flex-col sm:flex-row gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-slate-400"></i>
                    </div>
                    <input v-model="search" type="text" placeholder="Rechercher un service..." class="block w-full pl-10 pr-3 py-2 border border-slate-300 rounded-md leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Service</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Catégorie</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Responsable</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        <tr v-for="service in services.data" :key="service.id" class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-blue-50 rounded-lg text-blue-600">
                                        <i :class="service.icon || 'fas fa-stethoscope'"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-slate-900">{{ service.name }}</div>
                                        <div class="text-xs text-slate-500"><i class="fas fa-phone mr-1"></i> {{ service.phone || 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-100 text-slate-800">
                                    {{ service.category?.name || 'Général' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-slate-900">
                                    {{ (typeof service.team_members === 'string' ? JSON.parse(service.team_members) : service.team_members)?.leader?.name || 'Non assigné' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span v-if="service.active" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Actif</span>
                                <span v-else class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-100 text-slate-800">Inactif</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button @click="openModal(service)" class="text-indigo-600 hover:text-indigo-900 mr-3"><i class="fas fa-edit"></i></button>
                                <button @click="confirmDelete(service)" class="text-red-600 hover:text-red-900"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        <tr v-if="services.data.length === 0">
                            <td colspan="5" class="px-6 py-10 text-center text-slate-500">
                                Aucun service trouvé.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="bg-white px-4 py-3 border-t border-slate-200 flex items-center justify-center sm:px-6">
                <div class="flex space-x-1" v-if="services.links.length > 3">
                    <template v-for="(link, i) in services.links" :key="i">
                        <button v-if="link.url === null" class="px-3 py-1 text-sm rounded border border-slate-200 text-slate-400 bg-slate-50 cursor-not-allowed" v-html="link.label"></button>
                        <button v-else @click="router.get(link.url, { search }, { preserveState: true })" 
                            class="px-3 py-1 text-sm rounded border"
                            :class="link.active ? 'bg-blue-50 border-blue-500 text-blue-600 font-medium' : 'border-slate-300 text-slate-700 hover:bg-slate-50'" 
                            v-html="link.label">
                        </button>
                    </template>
                </div>
            </div>
        </div>

        <!-- Modal Form -->
        <div v-if="isModalOpen" class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="closeModal">
                    <div class="absolute inset-0 bg-slate-900 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl w-full">
                    <form @submit.prevent="saveService">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-slate-200 flex justify-between items-center">
                            <h3 class="text-lg leading-6 font-medium text-slate-900">
                                {{ form.id ? 'Modifier le service' : 'Ajouter un service' }}
                            </h3>
                            <button type="button" @click="closeModal" class="text-slate-400 hover:text-slate-500">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        
                        <!-- Tabs -->
                        <div class="border-b border-slate-200 bg-slate-50">
                            <nav class="flex -mb-px px-6">
                                <button type="button" @click="activeTab = 'general'" :class="[activeTab === 'general' ? 'border-blue-500 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300', 'whitespace-nowrap py-3 px-4 border-b-2 font-medium text-sm transition-colors']">Général</button>
                                <button type="button" @click="activeTab = 'team'" :class="[activeTab === 'team' ? 'border-blue-500 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300', 'whitespace-nowrap py-3 px-4 border-b-2 font-medium text-sm transition-colors']">Équipe</button>
                                <button type="button" @click="activeTab = 'contact'" :class="[activeTab === 'contact' ? 'border-blue-500 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300', 'whitespace-nowrap py-3 px-4 border-b-2 font-medium text-sm transition-colors']">Contact & Horaires</button>
                            </nav>
                        </div>

                        <div class="px-6 py-6 max-h-[60vh] overflow-y-auto">
                            
                            <!-- General Tab -->
                            <div v-show="activeTab === 'general'" class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Nom du service <span class="text-red-500">*</span></label>
                                        <input v-model="form.name" type="text" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Catégorie <span class="text-red-500">*</span></label>
                                        <select v-model="form.category_id" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Description courte <span class="text-red-500">*</span></label>
                                    <textarea v-model="form.short_description" rows="2" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Description détaillée <span class="text-red-500">*</span></label>
                                    <textarea v-model="form.full_description" rows="5" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Équipements (séparés par des virgules)</label>
                                        <input v-model="form.equipments" type="text" placeholder="Ex: Scanner, Bloc opératoire" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>
                                    <div class="flex items-center pt-6">
                                        <input v-model="form.active" id="active" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                                        <label for="active" class="ml-2 block text-sm text-slate-700">Service actif et visible</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Team Tab -->
                            <div v-show="activeTab === 'team'" class="space-y-6">
                                <div class="bg-slate-50 p-4 rounded-md border border-slate-200">
                                    <h4 class="text-sm font-bold text-slate-800 mb-3">Responsable</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-700 mb-1">Nom complet</label>
                                            <input v-model="form.team_members.leader.name" type="text" class="w-full border-slate-300 rounded-md shadow-sm sm:text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-700 mb-1">Titre / Rôle</label>
                                            <input v-model="form.team_members.leader.position" type="text" class="w-full border-slate-300 rounded-md shadow-sm sm:text-sm">
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-medium text-slate-700 mb-1">Photo (optionnel)</label>
                                            <input type="file" @input="form.leader_photo = $event.target.files[0]" class="block w-full text-sm text-slate-500 file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:bg-slate-200 file:text-slate-700">
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="text-sm font-bold text-slate-800">Autres membres</h4>
                                        <button type="button" @click="addTeamMember" class="text-xs font-medium text-blue-600 hover:text-blue-700 bg-blue-50 px-2 py-1 rounded">
                                            <i class="fas fa-plus mr-1"></i> Ajouter
                                        </button>
                                    </div>
                                    
                                    <div class="space-y-3">
                                        <div v-for="(member, index) in form.team_members.members" :key="index" class="flex gap-3 items-start p-3 bg-white border border-slate-200 rounded-md shadow-sm">
                                            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-3">
                                                <input v-model="member.name" type="text" placeholder="Nom" class="w-full border-slate-300 rounded-md shadow-sm sm:text-sm">
                                                <input v-model="member.position" type="text" placeholder="Spécialité" class="w-full border-slate-300 rounded-md shadow-sm sm:text-sm">
                                                <div class="md:col-span-2">
                                                    <input type="file" @input="form.members_photos[index] = $event.target.files[0]" class="block w-full text-xs text-slate-500 file:mr-4 file:py-1 file:px-2 file:rounded file:border-0 file:bg-slate-100">
                                                </div>
                                            </div>
                                            <button type="button" @click="removeTeamMember(index)" class="text-red-500 hover:text-red-700 p-1">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <div v-if="form.team_members.members.length === 0" class="text-center py-4 text-slate-500 text-sm border border-dashed border-slate-300 rounded-md bg-slate-50">
                                            Aucun membre supplémentaire.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Tab -->
                            <div v-show="activeTab === 'contact'" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Téléphone</label>
                                    <input v-model="form.phone" type="text" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                                    <input v-model="form.email" type="email" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Localisation</label>
                                    <input v-model="form.location" type="text" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Horaires</label>
                                    <input v-model="form.working_hours" type="text" placeholder="Lun-Ven: 8h-16h" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Icône (FontAwesome)</label>
                                    <input v-model="form.icon" type="text" placeholder="fas fa-stethoscope" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm font-mono">
                                </div>
                            </div>

                        </div>
                        
                        <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200">
                            <button type="submit" :disabled="form.processing" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50">
                                {{ form.id ? 'Mettre à jour' : 'Enregistrer' }}
                            </button>
                            <button type="button" @click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
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
                                <h3 class="text-lg leading-6 font-medium text-slate-900">Supprimer le service</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500">Êtes-vous sûr de vouloir supprimer le service "{{ itemToDelete?.name }}" ?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200">
                        <button type="button" @click="deleteService" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Supprimer
                        </button>
                        <button type="button" @click="isDeleteModalOpen = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Annuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
