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
    },
    featuredServices: {
        type: Array,
        default: () => []
    },
    equipments: {
        type: Array,
        default: () => []
    }
});

const siteInfo = computed(() => ({
    name: props.settings?.hero_title || props.settings?.site_name || 'CHU MAHAVOKY ATSIMO',
    hero_subtitle: props.settings?.hero_subtitle || 'Mahajanga — Boeny',
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
        <StatsCounter v-if="settings?.show_stats_section !== false" :totalServices="totalServices" :stats="settings?.stats" />

        <!-- Services Section -->
        <ServicesSection v-if="settings?.show_services_section !== false" :services="featuredServices" :sectionInfo="settings?.services_section" />

        <!-- About Section (Director Message) -->
        <AboutSection v-if="settings?.show_about_section !== false" :director="director" />

        <!-- Emergency Banner -->
        <EmergencyBanner v-if="settings?.show_emergency_section !== false" :emergencyNumber="settings?.contact?.emergency || '+261 20 00 000 00'" />

        <!-- Doctors Section -->
        <DoctorsSection v-if="settings?.show_experts_section !== false" />

        <!-- Infrastructure Section -->
        <InfrastructureSection v-if="settings?.show_infrastructure_section !== false" :equipments="equipments" />

        <!-- News Section -->
        <NewsSection v-if="settings?.show_news_section !== false" :news="latestNews" />

        <!-- Partners Section -->
        <PartnersSection v-if="settings?.show_partners_section !== false" />
    </AppLayout>
</template>
