<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import SectionHeader from '@/Components/Ui/SectionHeader.vue';

const props = defineProps({
    services: {
        type: Array,
        default: () => []
    },
    sectionInfo: {
        type: Object,
        default: () => ({})
    }
});

const defaultServices = [
    { name: 'Cardiologie', short_description: 'Soins cardiaques avancés, diagnostics et suivis personnalisés pour la santé de votre coeur.', icon: 'heart', slug: null },
    { name: 'Pédiatrie', short_description: 'Soins complets et bienveillants pour les enfants et nourrissons, du nouveau-né à l\'adolescent.', icon: 'child', slug: null },
    { name: 'Chirurgie', short_description: 'Interventions chirurgicales de pointe dans un environnement sécurisé et stérile.', icon: 'scissors', slug: null },
    { name: 'Maternité', short_description: 'Accompagnement complet de la grossesse, accouchement et suivi postnatal.', icon: 'baby', slug: null },
    { name: 'Radiologie', short_description: 'Imagerie médicale haute définition : radiographie, échographie et scanner.', icon: 'microscope', slug: null },
    { name: 'Urgences', short_description: 'Prise en charge vitale 24h/24 et 7j/7 par une équipe réactive et expérimentée.', icon: 'ambulance', slug: null },
];

const displayServices = computed(() =>
    props.services.length > 0 ? props.services : defaultServices
);
</script>

<template>
    <section class="py-20 lg:py-28 bg-background border-b border-border/40">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <SectionHeader
                :label="sectionInfo?.label || 'Nos Spécialités'"
                :title="sectionInfo?.title || 'Excellence en Soins de Santé'"
                :description="sectionInfo?.description || 'Notre établissement propose une gamme complète de spécialités médicales avec des équipements modernes et une équipe de professionnels qualifiés.'"
            />

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <div
                    v-for="(service, index) in displayServices"
                    :key="service.slug || index"
                    class="group relative p-7 bg-card border border-border rounded-2xl hover:border-primary/40 transition-all duration-500 hover:shadow-xl hover:shadow-primary/5 hover:-translate-y-1"
                    data-aos="fade-up"
                    :data-aos-delay="index * 60"
                >
                    <!-- Icon -->
                    <div class="w-12 h-12 rounded-xl bg-primary/5 dark:bg-primary/10 flex items-center justify-center mb-5 group-hover:bg-primary group-hover:shadow-lg group-hover:shadow-primary/25 transition-all duration-500">
                        <i :class="`fas fa-${service.icon || 'stethoscope'} text-primary group-hover:text-primary-foreground transition-colors duration-500`"></i>
                    </div>

                    <!-- Content -->
                    <h3 class="text-lg font-bold text-foreground mb-2.5 tracking-tight group-hover:text-primary transition-colors duration-300">
                        {{ service.name }}
                    </h3>
                    <p class="text-muted-foreground text-sm leading-relaxed mb-6">
                        {{ service.short_description }}
                    </p>

                    <!-- Link -->
                    <Link
                        :href="service.slug ? route('services.show', service.slug) : route('services')"
                        class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-primary hover:gap-3 transition-all duration-300"
                    >
                        En savoir plus
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>
