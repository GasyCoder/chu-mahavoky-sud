<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';
import SectionHeader from '@/Components/Ui/SectionHeader.vue';

const partners = ref([]);
const loading = ref(true);

const fetchPartners = async () => {
    try {
        const response = await axios.get('/api/partners');
        partners.value = response.data;
    } catch (error) {
        console.error('Erreur lors du chargement des partenaires:', error);
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchPartners();
});
</script>

<template>
    <section v-if="partners.length > 0" class="py-16 lg:py-20 bg-background border-b border-border/40">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <SectionHeader
                label="Nos Partenaires"
                title="Ils nous font confiance"
                description="Nous collaborons avec des institutions de renom pour offrir des soins de qualité."
            />

            <!-- Partners Logo Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-5 lg:gap-6">
                <a
                    v-for="(partner, index) in partners"
                    :key="partner.id"
                    :href="partner.link || '#'"
                    :target="partner.link ? '_blank' : '_self'"
                    rel="noopener noreferrer"
                    class="group bg-card border border-border rounded-xl p-5 lg:p-6 flex items-center justify-center hover:border-primary/30 hover:shadow-lg hover:shadow-primary/5 transition-all duration-300 hover:-translate-y-0.5"
                    data-aos="fade-up"
                    :data-aos-delay="index * 50"
                >
                    <img
                        :src="`/storage/${partner.logo}`"
                        :alt="partner.name"
                        class="max-h-12 w-auto object-contain grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-400"
                    />
                </a>
            </div>
        </div>
    </section>
</template>
