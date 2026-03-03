<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    siteInfo: {
        type: Object,
        default: () => ({})
    }
});
</script>

<template>
    <section class="relative min-h-[65vh] flex items-end overflow-hidden bg-background border-b border-border/40">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img :src="siteInfo.background || '/assets/herobg.jpg'" 
                 class="w-full h-full object-cover opacity-30 dark:opacity-20 transition-opacity duration-1000"
                 alt="CHU Mahajanga" />
            <!-- Gradient adjusted to be darker at the bottom for better text contrast -->
            <div class="absolute inset-0 bg-gradient-to-t from-background via-background/40 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-background/40 to-transparent"></div>
        </div>

        <!-- Decorative Glow -->
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[120px] -ml-64 -mb-32"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 pb-16 md:pb-20 w-full">
            <div class="max-w-4xl text-left" data-aos="fade-up" data-aos-duration="1000">
                <!-- Badge Slim - Très bas -->
                <div class="inline-flex items-center space-x-2 bg-primary/5 border border-primary/10 rounded-full px-4 py-1.5 mb-6">
                    <span class="text-[10px] font-bold uppercase tracking-[0.15em] text-primary">
                        Centre Hospitalier Universitaire - Mahajanga région Boeny
                    </span>
                </div>

                <!-- Main Titles -->
                <div class="mb-8">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-foreground leading-none">
                        CHU Mahavoky Atsimo
                    </h1>
                    <p class="text-xl md:text-2xl lg:text-3xl font-semibold text-primary/80 mt-2 tracking-tight">
                        Mahajanga ATSIMO
                    </p>
                </div>

                <!-- Slogan -->
                <p class="text-base md:text-lg text-muted-foreground font-medium mb-10 max-w-2xl leading-relaxed">
                    Excellence médicale au service de la vie. Des soins de qualité accessibles à tous.
                </p>

                <!-- CTA Button -->
                <div class="flex items-center justify-start gap-4">
                    <Link :href="route('contact')"
                        class="group relative inline-flex items-center px-8 py-3.5 bg-primary text-primary-foreground text-xs font-bold uppercase tracking-widest rounded-full shadow-lg shadow-primary/20 hover:shadow-xl hover:shadow-primary/30 transition-all hover:-translate-y-0.5 active:scale-95">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Prendre rendez-vous
                    </Link>

                    <Link :href="route('services')"
                        class="px-8 py-3.5 bg-background border border-border text-foreground text-xs font-bold uppercase tracking-widest rounded-full hover:bg-muted transition-all active:scale-95">
                        Nos Services
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>
