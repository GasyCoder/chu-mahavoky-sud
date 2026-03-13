<script setup>
import { ref, watch, onMounted } from 'vue';
import { router, Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PageBanner from '@/Components/Ui/PageBanner.vue';
import Badge from '@/Components/Ui/Badge.vue';
import Tabs from '@/Components/Ui/Tabs.vue';

const props = defineProps({
    services: {
        type: Object,
        default: () => ({ data: [], last_page: 1, current_page: 1 })
    },
    technicalCategories: {
        type: Array,
        default: () => []
    },
    adminCategories: {
        type: Array,
        default: () => []
    },
    filters: {
        type: Object,
        default: () => ({ searchQuery: '', selectedCategoryId: null, activeTab: 'technical' })
    }
});

const searchQuery = ref(props.filters.searchQuery || '');
const selectedCategoryId = ref(props.filters.selectedCategoryId || ''); // Changé en chaîne vide pour le select
const activeTab = ref(props.filters.activeTab || 'technical');
const loading = ref(false);

const loadServices = () => {
    loading.value = true;
    router.get(route('services'), {
        searchQuery: searchQuery.value,
        selectedCategoryId: selectedCategoryId.value === '' ? null : selectedCategoryId.value,
        activeTab: activeTab.value,
    }, {
        preserveState: true,
        preserveScroll: true,
        onFinish: () => loading.value = false
    });
};

watch([searchQuery, selectedCategoryId, activeTab], () => {
    loadServices();
});

const switchTab = (tab) => {
    activeTab.value = tab;
    selectedCategoryId.value = ''; // Réinitialise au changement d'onglet
};

const resetSearch = () => {
    searchQuery.value = '';
    selectedCategoryId.value = '';
};

const serviceTabs = [
    { id: 'technical', label: 'Services Techniques', icon: 'fas fa-stethoscope' },
    { id: 'administrative', label: 'Services Administratifs', icon: 'fas fa-building' }
];
</script>

<template>
    <AppLayout title="Nos Services">
        <Head title="Nos Services Médicaux et Administratifs" />

        <!-- Banner -->
        <PageBanner
            title="Nos Services"
            description="L'excellence médicale et administrative au service de votre santé. Découvrez l'ensemble de nos spécialités."
            label="CHU Mahajanga"
            :breadcrumbs="[
                { label: 'Accueil', route: 'home' },
                { label: 'Services' }
            ]"
        />

        <!-- Sticky Controls Bar -->
        <section class="sticky top-16 z-30 bg-background/80 backdrop-blur-md border-b border-border/40 py-4">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                    <!-- Tabs -->
                    <Tabs
                        :tabs="serviceTabs"
                        :modelValue="activeTab"
                        @update:modelValue="switchTab"
                        variant="pills"
                    />

                    <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                        <!-- Search -->
                        <div class="relative w-full sm:w-64">
                            <input
                                v-model="searchQuery"
                                type="text"
                                placeholder="Rechercher..."
                                class="w-full bg-muted/50 border border-border/50 rounded-full pl-10 pr-4 py-2.5 text-sm text-foreground placeholder-muted-foreground focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                            />
                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>

                        <!-- Category Select -->
                        <div class="relative w-full sm:w-56">
                            <select
                                v-model="selectedCategoryId"
                                class="w-full bg-muted/50 border border-border/50 rounded-full pl-10 pr-10 py-2.5 text-sm text-foreground appearance-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all cursor-pointer"
                            >
                                <option value="">Toutes les catégories</option>
                                <option
                                    v-for="cat in (activeTab === 'technical' ? technicalCategories : adminCategories)"
                                    :key="cat.id"
                                    :value="cat.id"
                                >
                                    {{ cat.name }}
                                </option>
                            </select>
                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="py-16 bg-background min-h-[60vh]">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <!-- Results Grid -->
                <div v-if="services.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <article
                        v-for="(service, index) in services.data"
                        :key="service.id"
                        class="group flex flex-col h-full bg-card border border-border rounded-2xl overflow-hidden hover:border-primary/40 hover:shadow-elevated transition-all duration-500"
                        data-aos="fade-up"
                        :data-aos-delay="index * 60"
                    >
                        <!-- Technical Service: Image -->
                        <div v-if="activeTab === 'technical'" class="relative aspect-[16/10] overflow-hidden">
                            <img
                                v-if="service.image_url"
                                :src="service.image_url"
                                :alt="service.name"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            />
                            <div v-else class="w-full h-full bg-primary/5 dark:bg-primary/10 flex items-center justify-center">
                                <i :class="service.icon || 'fas fa-stethoscope'" class="text-4xl text-primary/20"></i>
                            </div>
                            <div class="absolute top-3 left-3">
                                <Badge variant="primary" size="xs">
                                    {{ service.category?.name }}
                                </Badge>
                            </div>
                        </div>

                        <!-- Administrative Service: Icon -->
                        <div v-else class="p-6 pb-0">
                            <div class="w-12 h-12 rounded-xl bg-primary/5 dark:bg-primary/10 flex items-center justify-center mb-4 group-hover:bg-primary/10 dark:group-hover:bg-primary/20 transition-colors">
                                <i :class="service.icon || 'fas fa-file-alt'" class="text-primary text-xl"></i>
                            </div>
                            <Badge variant="primary" size="xs">
                                {{ service.category?.name }}
                            </Badge>
                        </div>

                        <!-- Content -->
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="font-bold text-lg mb-3 text-foreground tracking-tight group-hover:text-primary transition-colors leading-tight">
                                {{ service.name }}
                            </h3>
                            <p class="text-muted-foreground text-sm leading-relaxed mb-5 line-clamp-3">
                                {{ service.short_description }}
                            </p>

                            <!-- Meta Info -->
                            <div class="space-y-2 mb-6">
                                <div v-if="service.phone" class="flex items-center text-xs text-muted-foreground font-medium">
                                    <i class="far fa-phone mr-2 text-primary/60 w-4 text-center"></i>
                                    {{ service.phone }}
                                </div>
                                <div v-if="service.location" class="flex items-center text-xs text-muted-foreground font-medium">
                                    <i class="far fa-map-marker-alt mr-2 text-primary/60 w-4 text-center"></i>
                                    {{ service.location }}
                                </div>
                            </div>

                            <Link
                                :href="route('services.show', service.slug)"
                                class="mt-auto inline-flex items-center text-xs font-bold uppercase tracking-widest text-primary group/link"
                            >
                                Voir les détails
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 ml-2 transition-transform group-hover/link:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </Link>
                        </div>
                    </article>
                </div>

                <!-- Empty State -->
                <div v-else class="py-20 text-center" data-aos="fade-up">
                    <div class="w-16 h-16 bg-muted rounded-full flex items-center justify-center mx-auto mb-6 text-muted-foreground">
                        <i class="fas fa-stethoscope text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-foreground mb-2">Aucun service trouvé</h3>
                    <p class="text-muted-foreground text-sm mb-8">Nous n'avons trouvé aucun service correspondant à vos critères.</p>
                    <button
                        @click="resetSearch"
                        class="px-6 py-2.5 bg-primary text-white text-xs font-bold uppercase tracking-widest rounded-full hover:bg-primary/90 transition-colors"
                    >
                        Réinitialiser les filtres
                    </button>
                </div>

                <!-- Pagination -->
                <div v-if="services.last_page > 1" class="mt-16 flex justify-center border-t border-border/40 pt-10">
                    <div class="flex items-center gap-1">
                        <Link
                            v-for="link in services.links"
                            :key="link.label"
                            :href="link.url || '#'"
                            class="px-4 py-2 text-xs font-semibold rounded-full transition-all"
                            :class="[
                                link.active
                                    ? 'bg-primary text-white shadow-md'
                                    : 'text-muted-foreground hover:bg-muted hover:text-foreground',
                                !link.url ? 'opacity-30 cursor-not-allowed pointer-events-none' : ''
                            ]"
                            v-html="link.label"
                        />
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
