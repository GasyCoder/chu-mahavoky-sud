<script setup>
import { ref, watch, onBeforeUnmount } from 'vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import debounce from 'lodash/debounce';
import { useEditor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import Underline from '@tiptap/extension-underline';
import Link from '@tiptap/extension-link';
import TextAlign from '@tiptap/extension-text-align';
import Placeholder from '@tiptap/extension-placeholder';

const props = defineProps({
    blogs: Object,
    categories: Object,
    statuses: Object,
    filters: Object,
});

const search = ref(props.filters.search || '');
const category = ref(props.filters.category || '');
const status = ref(props.filters.status || '');
const sortField = ref(props.filters.sortField || 'created_at');
const sortDirection = ref(props.filters.sortDirection || 'desc');
const perPage = ref(props.filters.perPage || 10);

const isModalOpen = ref(false);
const isDeleteModalOpen = ref(false);
const itemToDelete = ref(null);
const imagePreview = ref(null);

const form = useForm({
    id: null,
    title: '',
    slug: '',
    content: '',
    excerpt: '',
    category: 'Actualité',
    status: 'draft',
    is_featured: false,
    published_at: '',
    image: null,
    _method: 'post'
});

const fetchNews = debounce(() => {
    router.get(route('admin.news'), {
        search: search.value,
        category: category.value,
        status: status.value,
        sortField: sortField.value,
        sortDirection: sortDirection.value,
        perPage: perPage.value
    }, { preserveState: true, preserveScroll: true, replace: true });
}, 300);

watch([search, category, status, perPage], fetchNews);

const sortBy = (field) => {
    if (sortField.value === field) {
        sortDirection.value = sortDirection.value === 'asc' ? 'desc' : 'asc';
    } else {
        sortField.value = field;
        sortDirection.value = 'asc';
    }
    fetchNews();
};

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

const openModal = (blog = null) => {
    if (blog) {
        form.id = blog.id;
        form.title = blog.title;
        form.slug = blog.slug;
        form.content = blog.content;
        form.excerpt = blog.excerpt;
        form.category = blog.category;
        form.status = blog.status;
        form.is_featured = !!blog.is_featured;
        form.published_at = blog.published_at ? new Date(blog.published_at).toISOString().slice(0, 16) : '';
        form.image = null;
        form._method = 'post';
        imagePreview.value = blog.image_url || null;
    } else {
        form.reset();
        form.id = null;
        form.category = Object.keys(props.categories)[0] || 'Actualité';
        form.status = 'draft';
        form._method = 'post';
        imagePreview.value = null;
    }
    if (editor.value) {
        editor.value.commands.setContent(form.content || '');
    }
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
    imagePreview.value = null;
    form.reset();
    form.clearErrors();
    if (editor.value) {
        editor.value.commands.setContent('');
    }
};

const saveNews = () => {
    form.post(route('admin.news.store'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
    });
};

const confirmDelete = (blog) => {
    itemToDelete.value = blog;
    isDeleteModalOpen.value = true;
};

const deleteNews = () => {
    if (itemToDelete.value) {
        router.delete(route('admin.news.destroy', itemToDelete.value.id), {
            preserveScroll: true,
            onSuccess: () => {
                isDeleteModalOpen.value = false;
                itemToDelete.value = null;
            }
        });
    }
};

const formatDate = (dateString) => {
    if (!dateString) return '-';
    return new Date(dateString).toLocaleDateString('fr-FR', {
        day: '2-digit', month: 'short', year: 'numeric'
    });
};

const editor = useEditor({
    extensions: [
        StarterKit.configure({
            heading: { levels: [2, 3, 4] },
        }),
        Underline,
        Link.configure({
            openOnClick: false,
            HTMLAttributes: { class: 'text-blue-600 underline' },
        }),
        TextAlign.configure({
            types: ['heading', 'paragraph'],
        }),
        Placeholder.configure({
            placeholder: 'Rédigez votre article ici...',
        }),
    ],
    editorProps: {
        attributes: {
            class: 'prose prose-sm max-w-none focus:outline-none min-h-[300px] px-4 py-3',
        },
    },
    onUpdate: ({ editor: ed }) => {
        form.content = ed.getHTML();
    },
});

const setLink = () => {
    const url = window.prompt('URL du lien:', editor.value?.getAttributes('link').href || '');
    if (url === null) return;
    if (url === '') {
        editor.value?.chain().focus().extendMarkRange('link').unsetLink().run();
    } else {
        editor.value?.chain().focus().extendMarkRange('link').setLink({ href: url }).run();
    }
};

onBeforeUnmount(() => {
    editor.value?.destroy();
});
</script>

<template>
    <AdminLayout title="Gestion des actualités">
        <template #actions>
            <div class="flex items-center gap-3">
                <a :href="route('admin.news.categories')" class="inline-flex items-center px-4 py-2 border border-slate-300 rounded-md font-medium text-slate-700 text-sm hover:bg-slate-50 transition-colors">
                    <i class="fas fa-tags mr-2"></i> Catégories
                </a>
                <button @click="openModal()" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-white text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-colors">
                    <i class="fas fa-plus mr-2"></i> Ajouter un article
                </button>
            </div>
        </template>

        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
            <!-- Filters -->
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex flex-col sm:flex-row gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-slate-400"></i>
                    </div>
                    <input v-model="search" type="text" placeholder="Rechercher..." class="block w-full pl-10 pr-3 py-2 border border-slate-300 rounded-md leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="w-full sm:w-48">
                    <select v-model="category" class="block w-full pl-3 pr-10 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Toutes catégories</option>
                        <option v-for="(val, key) in categories" :key="key" :value="key">{{ val }}</option>
                    </select>
                </div>
                <div class="w-full sm:w-48">
                    <select v-model="status" class="block w-full pl-3 pr-10 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Tous les statuts</option>
                        <option v-for="(val, key) in statuses" :key="key" :value="key">{{ val }}</option>
                    </select>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider cursor-pointer group" @click="sortBy('title')">
                                Titre
                                <i v-if="sortField === 'title'" :class="['fas ml-1 text-blue-500', sortDirection === 'asc' ? 'fa-sort-up' : 'fa-sort-down']"></i>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Catégorie</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider cursor-pointer group" @click="sortBy('published_at')">
                                Date
                                <i v-if="sortField === 'published_at'" :class="['fas ml-1 text-blue-500', sortDirection === 'asc' ? 'fa-sort-up' : 'fa-sort-down']"></i>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        <tr v-for="blog in blogs.data" :key="blog.id" class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        <img v-if="blog.image_url" :src="blog.image_url" class="h-10 w-10 rounded object-cover border border-slate-200" alt="">
                                        <div v-else class="h-10 w-10 rounded bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-slate-900 max-w-xs truncate" :title="blog.title">{{ blog.title }}</div>
                                        <div v-if="blog.is_featured" class="text-xs text-amber-500 font-medium"><i class="fas fa-star mr-1"></i> À la une</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ blog.category }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                {{ formatDate(blog.published_at) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span v-if="blog.status === 'published'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Publié</span>
                                <span v-else class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-100 text-slate-800">Brouillon</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button @click="openModal(blog)" class="text-indigo-600 hover:text-indigo-900 mr-3"><i class="fas fa-edit"></i></button>
                                <button @click="confirmDelete(blog)" class="text-red-600 hover:text-red-900"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        <tr v-if="blogs.data.length === 0">
                            <td colspan="5" class="px-6 py-10 text-center text-slate-500">
                                Aucun article trouvé.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-white px-4 py-3 border-t border-slate-200 flex items-center justify-between sm:px-6">
                <div class="flex items-center gap-2">
                    <select v-model="perPage" class="border-slate-300 rounded text-sm text-slate-700 py-1 pl-2 pr-8 focus:ring-blue-500 focus:border-blue-500">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>
                <div class="flex space-x-1" v-if="blogs.links.length > 3">
                    <template v-for="(link, i) in blogs.links" :key="i">
                        <button v-if="link.url === null" class="px-3 py-1 text-sm rounded border border-slate-200 text-slate-400 bg-slate-50 cursor-not-allowed" v-html="link.label"></button>
                        <button v-else @click="router.get(link.url, { search, category, status, sortField, sortDirection, perPage }, { preserveState: true })" 
                            class="px-3 py-1 text-sm rounded border"
                            :class="link.active ? 'bg-blue-50 border-blue-500 text-blue-600 font-medium' : 'border-slate-300 text-slate-700 hover:bg-slate-50'" 
                            v-html="link.label">
                        </button>
                    </template>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div v-if="isModalOpen" class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="closeModal">
                    <div class="absolute inset-0 bg-slate-900 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-7xl w-full">
                    <form @submit.prevent="saveNews">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-slate-200">
                            <h3 class="text-lg leading-6 font-medium text-slate-900">
                                {{ form.id ? 'Modifier l\'article' : 'Nouvel article' }}
                            </h3>
                        </div>
                        <div class="px-6 py-6 max-h-[70vh] overflow-y-auto bg-slate-50">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="md:col-span-2 space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Titre <span class="text-red-500">*</span></label>
                                        <input v-model="form.title" type="text" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <p v-if="form.errors.title" class="text-red-500 text-xs mt-1">{{ form.errors.title }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Slug</label>
                                        <input v-model="form.slug" type="text" placeholder="genere-automatiquement" class="w-full border-slate-300 rounded-md shadow-sm bg-slate-100 text-slate-500 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Résumé</label>
                                        <textarea v-model="form.excerpt" rows="2" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Contenu <span class="text-red-500">*</span></label>
                                        <div class="border border-slate-300 rounded-md shadow-sm overflow-hidden bg-white">
                                            <!-- Toolbar -->
                                            <div v-if="editor" class="flex flex-wrap items-center gap-0.5 px-2 py-1.5 border-b border-slate-200 bg-slate-50">
                                                <button type="button" @click="editor.chain().focus().toggleBold().run()" :class="{ 'bg-slate-200': editor.isActive('bold') }" class="p-1.5 rounded hover:bg-slate-200 text-slate-600 transition-colors" title="Gras">
                                                    <i class="fas fa-bold text-xs"></i>
                                                </button>
                                                <button type="button" @click="editor.chain().focus().toggleItalic().run()" :class="{ 'bg-slate-200': editor.isActive('italic') }" class="p-1.5 rounded hover:bg-slate-200 text-slate-600 transition-colors" title="Italique">
                                                    <i class="fas fa-italic text-xs"></i>
                                                </button>
                                                <button type="button" @click="editor.chain().focus().toggleUnderline().run()" :class="{ 'bg-slate-200': editor.isActive('underline') }" class="p-1.5 rounded hover:bg-slate-200 text-slate-600 transition-colors" title="Souligné">
                                                    <i class="fas fa-underline text-xs"></i>
                                                </button>
                                                <button type="button" @click="editor.chain().focus().toggleStrike().run()" :class="{ 'bg-slate-200': editor.isActive('strike') }" class="p-1.5 rounded hover:bg-slate-200 text-slate-600 transition-colors" title="Barré">
                                                    <i class="fas fa-strikethrough text-xs"></i>
                                                </button>
                                                <div class="w-px h-5 bg-slate-300 mx-1"></div>
                                                <button type="button" @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="{ 'bg-slate-200': editor.isActive('heading', { level: 2 }) }" class="p-1.5 rounded hover:bg-slate-200 text-slate-600 transition-colors text-xs font-bold" title="Titre 2">
                                                    H2
                                                </button>
                                                <button type="button" @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" :class="{ 'bg-slate-200': editor.isActive('heading', { level: 3 }) }" class="p-1.5 rounded hover:bg-slate-200 text-slate-600 transition-colors text-xs font-bold" title="Titre 3">
                                                    H3
                                                </button>
                                                <div class="w-px h-5 bg-slate-300 mx-1"></div>
                                                <button type="button" @click="editor.chain().focus().toggleBulletList().run()" :class="{ 'bg-slate-200': editor.isActive('bulletList') }" class="p-1.5 rounded hover:bg-slate-200 text-slate-600 transition-colors" title="Liste à puces">
                                                    <i class="fas fa-list-ul text-xs"></i>
                                                </button>
                                                <button type="button" @click="editor.chain().focus().toggleOrderedList().run()" :class="{ 'bg-slate-200': editor.isActive('orderedList') }" class="p-1.5 rounded hover:bg-slate-200 text-slate-600 transition-colors" title="Liste numérotée">
                                                    <i class="fas fa-list-ol text-xs"></i>
                                                </button>
                                                <div class="w-px h-5 bg-slate-300 mx-1"></div>
                                                <button type="button" @click="editor.chain().focus().setTextAlign('left').run()" :class="{ 'bg-slate-200': editor.isActive({ textAlign: 'left' }) }" class="p-1.5 rounded hover:bg-slate-200 text-slate-600 transition-colors" title="Aligner à gauche">
                                                    <i class="fas fa-align-left text-xs"></i>
                                                </button>
                                                <button type="button" @click="editor.chain().focus().setTextAlign('center').run()" :class="{ 'bg-slate-200': editor.isActive({ textAlign: 'center' }) }" class="p-1.5 rounded hover:bg-slate-200 text-slate-600 transition-colors" title="Centrer">
                                                    <i class="fas fa-align-center text-xs"></i>
                                                </button>
                                                <button type="button" @click="editor.chain().focus().setTextAlign('right').run()" :class="{ 'bg-slate-200': editor.isActive({ textAlign: 'right' }) }" class="p-1.5 rounded hover:bg-slate-200 text-slate-600 transition-colors" title="Aligner à droite">
                                                    <i class="fas fa-align-right text-xs"></i>
                                                </button>
                                                <div class="w-px h-5 bg-slate-300 mx-1"></div>
                                                <button type="button" @click="setLink" :class="{ 'bg-slate-200': editor.isActive('link') }" class="p-1.5 rounded hover:bg-slate-200 text-slate-600 transition-colors" title="Lien">
                                                    <i class="fas fa-link text-xs"></i>
                                                </button>
                                                <button type="button" @click="editor.chain().focus().toggleBlockquote().run()" :class="{ 'bg-slate-200': editor.isActive('blockquote') }" class="p-1.5 rounded hover:bg-slate-200 text-slate-600 transition-colors" title="Citation">
                                                    <i class="fas fa-quote-right text-xs"></i>
                                                </button>
                                                <button type="button" @click="editor.chain().focus().setHorizontalRule().run()" class="p-1.5 rounded hover:bg-slate-200 text-slate-600 transition-colors" title="Ligne horizontale">
                                                    <i class="fas fa-minus text-xs"></i>
                                                </button>
                                                <div class="w-px h-5 bg-slate-300 mx-1"></div>
                                                <button type="button" @click="editor.chain().focus().undo().run()" class="p-1.5 rounded hover:bg-slate-200 text-slate-600 transition-colors" title="Annuler">
                                                    <i class="fas fa-undo text-xs"></i>
                                                </button>
                                                <button type="button" @click="editor.chain().focus().redo().run()" class="p-1.5 rounded hover:bg-slate-200 text-slate-600 transition-colors" title="Rétablir">
                                                    <i class="fas fa-redo text-xs"></i>
                                                </button>
                                            </div>
                                            <!-- Editor -->
                                            <EditorContent :editor="editor" class="tiptap-editor" />
                                        </div>
                                        <p v-if="form.errors.content" class="text-red-500 text-xs mt-1">{{ form.errors.content }}</p>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div class="bg-white p-4 rounded border border-slate-200 shadow-sm space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-1">Catégorie <span class="text-red-500">*</span></label>
                                            <select v-model="form.category" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                <option v-for="(val, key) in categories" :key="key" :value="key">{{ val }}</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-1">Statut</label>
                                            <select v-model="form.status" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                <option v-for="(val, key) in statuses" :key="key" :value="key">{{ val }}</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-1">Date de publication</label>
                                            <input v-model="form.published_at" type="datetime-local" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        </div>
                                        <div class="flex items-center">
                                            <input v-model="form.is_featured" id="is_featured" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                                            <label for="is_featured" class="ml-2 block text-sm text-slate-700">Mettre à la une</label>
                                        </div>
                                    </div>
                                    <div class="bg-white p-4 rounded border border-slate-200 shadow-sm">
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Image</label>
                                        <!-- Preview -->
                                        <div v-if="imagePreview" class="relative mb-3 group">
                                            <img :src="imagePreview" alt="Aperçu" class="w-full h-40 object-cover rounded-lg border border-slate-200">
                                            <button type="button" @click="removeImage" class="absolute top-2 right-2 w-7 h-7 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-lg hover:bg-red-600">
                                                <i class="fas fa-times text-xs"></i>
                                            </button>
                                        </div>
                                        <input type="file" accept="image/*" @input="handleImageSelect" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-slate-50 file:text-slate-700 hover:file:bg-slate-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-100 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200">
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
                                <h3 class="text-lg leading-6 font-medium text-slate-900">Supprimer l'article</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500">Êtes-vous sûr de vouloir supprimer cet article ? Cette action est irréversible.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200">
                        <button type="button" @click="deleteNews" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
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
