<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import SectionHeader from '@/Components/Ui/SectionHeader.vue';

const props = defineProps({
    equipments: {
        type: Array,
        default: () => []
    }
});

const defaultFeatures = [
    {
        icon: 'fa-microscope',
        name: 'Laboratoire Moderne',
        description: 'Équipements de pointe pour des analyses précises et rapides',
        image_url: null
    },
    {
        icon: 'fa-procedures',
        name: 'Blocs Opératoires',
        description: 'Salles d\'opération stériles avec technologies avancées',
        image_url: null
    },
    {
        icon: 'fa-x-ray',
        name: 'Imagerie Médicale',
        description: 'Scanner, IRM et radiologie numérique de dernière génération',
        image_url: null
    }
];

const displayFeatures = computed(() =>
    props.equipments.length > 0 ? props.equipments : defaultFeatures
);
</script>

<template>
    <section class="py-20 lg:py-28 bg-background border-b border-border/40 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <SectionHeader
                label="Infrastructure"
                title="Nos Équipements"
                description="Des technologies médicales de pointe pour un diagnostic et un traitement optimaux."
            />

            <!-- Features Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                <div
                    v-for="(feature, index) in displayFeatures"
                    :key="feature.id || index"
                    class="group relative overflow-hidden rounded-2xl border border-border shadow-lg hover:shadow-2xl transition-all duration-500"
                    data-aos="fade-up"
                    :data-aos-delay="index * 120"
                >
                    <!-- Image or Placeholder -->
                    <div class="aspect-[4/3] overflow-hidden">
                        <img
                            v-if="feature.image_url"
                            :src="feature.image_url"
                            :alt="feature.name"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        />
                        <div v-else class="w-full h-full bg-gradient-to-br from-primary/20 via-primary/10 to-secondary/20 flex items-center justify-center">
                            <i :class="`fas ${feature.icon} text-primary/30 text-6xl`"></i>
                        </div>
                        <!-- Dark overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent group-hover:from-black/85 transition-colors duration-500"></div>
                    </div>

                    <!-- Content overlay -->
                    <div class="absolute inset-0 flex flex-col justify-end p-6">
                        <div class="transform transition-transform duration-500 group-hover:-translate-y-1">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-11 h-11 bg-primary rounded-xl flex items-center justify-center shadow-lg shadow-primary/30">
                                    <i :class="`fas ${feature.icon} text-primary-foreground text-base`"></i>
                                </div>
                                <h3 class="text-lg font-bold text-white tracking-tight">{{ feature.name }}</h3>
                            </div>
                            <p class="text-gray-300 text-sm leading-relaxed">
                                {{ feature.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="text-center mt-14" data-aos="fade-up" data-aos-delay="400">
                <Link
                    :href="route('contact')"
                    class="inline-flex items-center gap-2.5 px-8 py-3.5 bg-primary hover:bg-primary/90 text-primary-foreground font-bold text-sm rounded-xl shadow-lg shadow-primary/20 hover:shadow-xl hover:shadow-primary/30 transition-all duration-300 hover:scale-[1.02] active:scale-95"
                >
                    <span>Visiter nos installations</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </Link>
            </div>
        </div>
    </section>
</template>
