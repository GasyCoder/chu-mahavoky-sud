<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';

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
    <section v-if="partners.length > 0" class="py-16 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12" data-aos="fade-up">
                <div class="inline-flex items-center space-x-2 bg-blue-100 rounded-full px-4 py-2 mb-4">
                    <i class="fas fa-handshake text-blue-600 text-sm"></i>
                    <span class="text-sm font-semibold text-blue-600">Nos Partenaires</span>
                </div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">
                    Ils nous font confiance
                </h2>
                <div class="flex items-center justify-center space-x-2">
                    <div class="w-12 h-1 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-full"></div>
                </div>
            </div>

            <!-- Partners Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                <a v-for="(partner, index) in partners" 
                    :key="partner.id"
                    :href="partner.link || '#'"
                    :target="partner.link ? '_blank' : '_self'"
                    class="group bg-white rounded-2xl shadow-md shadow-slate-200/50 p-6 flex items-center justify-center hover:shadow-xl hover:shadow-blue-500/15 transition-all duration-300 hover:-translate-y-1"
                    :data-aos="`fade-up`"
                    :data-aos-delay="index * 50">
                    <img :src="`/storage/${partner.logo}`" :alt="partner.name"
                        class="max-h-12 w-auto object-contain opacity-60 group-hover:opacity-100 transition-opacity duration-300 grayscale group-hover:grayscale-0" />
                </a>
            </div>
        </div>
    </section>
</template>
