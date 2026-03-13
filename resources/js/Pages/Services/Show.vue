<script setup>
import { ref, computed, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PageBanner from '@/Components/Ui/PageBanner.vue';
import Badge from '@/Components/Ui/Badge.vue';
import Card from '@/Components/Ui/Card.vue';

const props = defineProps({
    service: {
        type: Object,
        required: true
    },
    relatedServices: {
        type: Array,
        default: () => []
    }
});

const lightboxOpen = ref(false);
const currentImageIndex = ref(0);

const images = computed(() => props.service.images_urls || []);

const openLightbox = (index) => {
    currentImageIndex.value = index;
    lightboxOpen.value = true;
    document.body.style.overflow = 'hidden';
};

const closeLightbox = () => {
    lightboxOpen.value = false;
    document.body.style.overflow = 'auto';
};

const prevImage = () => {
    currentImageIndex.value = (currentImageIndex.value - 1 + images.value.length) % images.value.length;
};

const nextImage = () => {
    currentImageIndex.value = (currentImageIndex.value + 1) % images.value.length;
};

const hasTeamLeader = computed(() => {
    return props.service.team_members?.leader?.name;
});

const hasTeamMembers = computed(() => {
    return props.service.team_members?.members &&
           Array.isArray(props.service.team_members.members) &&
           props.service.team_members.members.length > 0;
});
</script>

<template>
    <AppLayout :title="service.name">
        <Head :title="service.name" />

        <!-- Banner -->
        <PageBanner
            :title="service.name"
            :label="service.category?.name"
            :breadcrumbs="[
                { label: 'Accueil', route: 'home' },
                { label: 'Services', route: 'services' },
                { label: service.name }
            ]"
        />

        <!-- Main Content -->
        <section class="py-16 bg-background min-h-[60vh]">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                    <!-- Content Area -->
                    <div class="lg:col-span-2 space-y-12">
                        <!-- Main Info Card -->
                        <Card :padding="false" data-aos="fade-up">
                            <div v-if="service.image_url" class="relative aspect-video overflow-hidden border-b border-border">
                                <img :src="service.image_url" :alt="service.name" class="w-full h-full object-cover" />
                            </div>

                            <div class="p-6 md:p-8">
                                <div class="prose prose-sm md:prose-base dark:prose-invert max-w-none text-muted-foreground leading-relaxed">
                                    <h2 class="text-2xl font-bold text-foreground mb-6 tracking-tight">A propos du service</h2>
                                    <div v-html="service.full_description"></div>
                                </div>

                                <!-- Equipments -->
                                <div v-if="service.equipments && service.equipments.length > 0" class="mt-10 pt-10 border-t border-border">
                                    <h3 class="text-sm font-bold uppercase tracking-wider text-foreground mb-6">Équipements & Technologies</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <div
                                            v-for="(equipment, index) in service.equipments"
                                            :key="index"
                                            class="flex items-center p-3 rounded-xl bg-muted/30 dark:bg-muted/10 border border-border/40"
                                        >
                                            <div class="w-2 h-2 rounded-full bg-primary mr-3 shrink-0"></div>
                                            <span class="text-sm font-medium text-foreground/80">{{ equipment }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </Card>

                        <!-- Photo Gallery -->
                        <div v-if="images.length > 0" class="space-y-6" data-aos="fade-up">
                            <h3 class="text-sm font-bold uppercase tracking-wider text-foreground">Galerie Photos</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div
                                    v-for="(imageUrl, index) in images"
                                    :key="index"
                                    @click="openLightbox(index)"
                                    class="relative aspect-square overflow-hidden rounded-2xl border border-border cursor-pointer group"
                                >
                                    <img :src="imageUrl" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                                    <div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Team Section -->
                        <div v-if="hasTeamLeader || hasTeamMembers" class="space-y-8" data-aos="fade-up">
                            <h3 class="text-sm font-bold uppercase tracking-wider text-foreground">Notre Équipe</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                <!-- Leader (highlighted) -->
                                <div v-if="hasTeamLeader" class="p-6 bg-card border-2 border-primary/20 rounded-2xl text-center shadow-sm">
                                    <div class="w-20 h-20 rounded-full overflow-hidden mx-auto mb-4 border-2 border-primary/20 p-1">
                                        <img
                                            v-if="service.team_members.leader.photo_url || service.team_members.leader.photo"
                                            :src="service.team_members.leader.photo_url || service.team_members.leader.photo"
                                            class="w-full h-full object-cover rounded-full"
                                        />
                                        <div v-else class="w-full h-full bg-primary/5 dark:bg-primary/10 flex items-center justify-center rounded-full">
                                            <i class="fas fa-user-md text-primary/40"></i>
                                        </div>
                                    </div>
                                    <h4 class="font-bold text-foreground leading-tight">{{ service.team_members.leader.name }}</h4>
                                    <p class="text-xs font-semibold text-primary mt-1">{{ service.team_members.leader.position || 'Chef de Service' }}</p>
                                    <Badge variant="primary" size="xs" class="mt-3">Chef de service</Badge>
                                </div>

                                <!-- Members -->
                                <div
                                    v-for="member in service.team_members?.members"
                                    :key="member.name"
                                    class="p-6 bg-card border border-border rounded-2xl text-center hover:border-primary/20 transition-colors"
                                >
                                    <div class="w-16 h-16 rounded-full overflow-hidden mx-auto mb-4 border border-border p-1">
                                        <img
                                            v-if="member.photo_url || member.photo"
                                            :src="member.photo_url || member.photo"
                                            class="w-full h-full object-cover rounded-full"
                                        />
                                        <div v-else class="w-full h-full bg-muted flex items-center justify-center rounded-full text-muted-foreground/40">
                                            <i class="fas fa-user-nurse"></i>
                                        </div>
                                    </div>
                                    <h4 class="font-bold text-foreground text-sm leading-tight">{{ member.name }}</h4>
                                    <p class="text-xs text-muted-foreground mt-1">{{ member.position || 'Praticien' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-8">
                        <!-- Practical Info -->
                        <Card :padding="false" data-aos="fade-left">
                            <div class="p-6 border-b border-border">
                                <h3 class="text-sm font-bold uppercase tracking-wider text-foreground">Infos Pratiques</h3>
                            </div>
                            <div class="p-6 space-y-6">
                                <div v-if="service.phone" class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-primary/5 dark:bg-primary/10 flex items-center justify-center shrink-0 border border-primary/10">
                                        <i class="far fa-phone text-primary text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-muted-foreground mb-0.5">Téléphone</p>
                                        <a :href="`tel:${service.phone}`" class="text-sm font-bold text-foreground hover:text-primary transition-colors">{{ service.phone }}</a>
                                    </div>
                                </div>

                                <div v-if="service.working_hours" class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-primary/5 dark:bg-primary/10 flex items-center justify-center shrink-0 border border-primary/10">
                                        <i class="far fa-clock text-primary text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-muted-foreground mb-0.5">Horaires</p>
                                        <p class="text-sm font-bold text-foreground">{{ service.working_hours }}</p>
                                    </div>
                                </div>

                                <div v-if="service.location" class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-primary/5 dark:bg-primary/10 flex items-center justify-center shrink-0 border border-primary/10">
                                        <i class="far fa-map-marker-alt text-primary text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-muted-foreground mb-0.5">Localisation</p>
                                        <p class="text-sm font-bold text-foreground">{{ service.location }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- RDV Button -->
                            <div class="p-6 pt-0">
                                <Link
                                    :href="route('contact')"
                                    class="w-full flex items-center justify-center px-6 py-3 bg-primary text-white text-sm font-bold rounded-full shadow-lg shadow-primary/20 hover:shadow-xl hover:bg-primary/90 transition-all active:scale-95"
                                >
                                    <i class="far fa-calendar-check mr-2"></i>
                                    Prendre Rendez-vous
                                </Link>
                            </div>
                        </Card>

                        <!-- Related Services -->
                        <Card v-if="relatedServices.length > 0" :padding="false" data-aos="fade-left" data-aos-delay="100">
                            <div class="p-6 border-b border-border">
                                <h3 class="text-sm font-bold uppercase tracking-wider text-foreground">Services Associés</h3>
                            </div>
                            <div class="p-6 space-y-3">
                                <Link
                                    v-for="related in relatedServices"
                                    :key="related.id"
                                    :href="route('services.show', related.slug)"
                                    class="group flex items-center gap-4 p-2 rounded-xl hover:bg-muted transition-colors"
                                >
                                    <div class="w-10 h-10 rounded-xl bg-primary/5 dark:bg-primary/10 flex items-center justify-center shrink-0 border border-primary/10 group-hover:bg-primary/10 dark:group-hover:bg-primary/20 transition-colors">
                                        <i :class="related.icon || 'fas fa-stethoscope'" class="text-primary text-xs"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="text-sm font-semibold text-foreground group-hover:text-primary transition-colors leading-snug truncate">{{ related.name }}</h4>
                                        <p class="text-xs text-muted-foreground">{{ related.category?.name }}</p>
                                    </div>
                                </Link>
                            </div>
                        </Card>
                    </div>
                </div>
            </div>
        </section>

        <!-- Lightbox -->
        <Teleport to="body">
            <Transition
                enter-active-class="transition-opacity duration-300"
                leave-active-class="transition-opacity duration-300"
                enter-from-class="opacity-0"
                leave-to-class="opacity-0"
            >
                <div v-if="lightboxOpen" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/90 backdrop-blur-md px-6" @click.self="closeLightbox">
                    <!-- Close Button -->
                    <button @click="closeLightbox" class="absolute top-6 right-6 p-3 text-white/80 hover:text-white hover:bg-white/10 rounded-full transition-colors z-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Counter -->
                    <div class="absolute top-6 left-6 text-white/60 text-sm font-medium z-10">
                        {{ currentImageIndex + 1 }} / {{ images.length }}
                    </div>

                    <!-- Image -->
                    <div class="relative w-full max-w-5xl aspect-video overflow-hidden rounded-2xl">
                        <img :src="images[currentImageIndex]" class="w-full h-full object-contain" />
                    </div>

                    <!-- Navigation -->
                    <div v-if="images.length > 1" class="absolute inset-x-0 top-1/2 -translate-y-1/2 flex justify-between px-4 max-w-6xl mx-auto">
                        <button @click="prevImage" class="p-3 bg-white/10 backdrop-blur-md rounded-full border border-white/20 text-white hover:bg-white/20 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button @click="nextImage" class="p-3 bg-white/10 backdrop-blur-md rounded-full border border-white/20 text-white hover:bg-white/20 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </Transition>
        </Teleport>
    </AppLayout>
</template>
