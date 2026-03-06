<script setup>
import { computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import HeroSection from '@/Components/Sections/HeroSection.vue';
import StatsCounter from '@/Components/Sections/StatsCounter.vue';
import ServicesSection from '@/Components/Sections/ServicesSection.vue';
import AboutSection from '@/Components/Sections/AboutSection.vue';
import DoctorsSection from '@/Components/Sections/DoctorsSection.vue';
import EmergencyBanner from '@/Components/Sections/EmergencyBanner.vue';
import NewsSection from '@/Components/Sections/NewsSection.vue';
import InfrastructureSection from '@/Components/Sections/InfrastructureSection.vue';
import PartnersSection from '@/Components/Sections/PartnersSection.vue';

const props = defineProps({
    settings: {
        type: Object,
        default: () => ({})
    },
    latestNews: {
        type: Array,
        default: () => []
    },
    totalServices: {
        type: Number,
        default: 0
    }
});

const siteInfo = computed(() => ({
    name: props.settings?.site_name || 'CHU MAHAVOKY ATSIMO',
    description: props.settings?.site_description || 'Centre Hospitalier Universitaire',
    slogan: props.settings?.site_slogan || 'Excellence médicale au service de la vie. Des soins de qualité accessibles à tous.',
    background: props.settings?.hero_background || '/assets/herobg.jpg',
    ministry_url: props.settings?.ministry_url || 'https://www.msanp.gov.mg/',
    ministry_logo: props.settings?.ministry_logo || '/assets/minsante.png',
    presentation_video: props.settings?.presentation_video
}));

const director = computed(() => ({
    name: props.settings?.director?.name || 'Dr. HABIB',
    photo: props.settings?.director?.photo || '/assets/about/directeur.png',
    message: props.settings?.director?.message || 'Le Centre Hospitalier Universitaire Mahavoky Atsimo s\'engage à fournir des soins de santé de qualité à tous les patients.'
}));
</script>

<template>
    <AppLayout :title="settings?.site_name || 'Accueil'" :settings="settings" :showNavbar="true" :showFooter="true">
        <Head title="Accueil" />

        <!-- Hero Section -->
        <HeroSection :siteInfo="siteInfo" />

        <!-- Stats Counter (overlapping hero) -->
        <StatsCounter :totalServices="totalServices" />

        <!-- Services Section -->
        <ServicesSection />

        <!-- About Section (Director Message) -->
        <AboutSection :director="director" />

        <!-- Emergency Banner -->
        <EmergencyBanner :emergencyNumber="settings?.contact?.emergency || '+261 20 00 000 00'" />

        <!-- Doctors Section -->
        <DoctorsSection v-if="settings?.show_experts_section !== false" />

        <!-- Infrastructure Section -->
        <InfrastructureSection />

        <!-- News Section -->
        <NewsSection :news="latestNews" />

        <!-- Partners Section -->
        <PartnersSection v-if="settings?.show_partners_section !== false" />
    </AppLayout>
</template>
