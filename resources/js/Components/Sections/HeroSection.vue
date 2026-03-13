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
    <section class="relative min-h-[420px] lg:h-[500px] flex items-end bg-background overflow-hidden pb-14 lg:pb-20">
        <!-- Background image pinned right -->
        <div class="absolute inset-y-0 right-0 w-full lg:w-[55%] z-0">
            <img
                :src="siteInfo.background || '/assets/herobg.jpg'"
                class="w-full h-full object-cover"
                alt="CHU Mahavoky Atsimo"
            />
            <!-- Desktop gradient fade -->
            <div class="absolute inset-0 bg-gradient-to-r from-background via-background/50 to-transparent"></div>
            <!-- Mobile gradient fade -->
            <div class="lg:hidden absolute inset-0 bg-gradient-to-t from-background via-background/85 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 w-full">
            <div class="max-w-xl" data-aos="fade-up" data-aos-duration="700">
                <!-- Institutional badge -->
                <div class="flex items-center gap-2.5 mb-5">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-primary text-primary-foreground text-[10px] font-bold uppercase tracking-[0.15em] rounded">
                        <i class="fas fa-shield-alt text-[9px]"></i>
                        MINSANT&Eacute;
                    </span>
                    <span class="text-[10px] font-semibold uppercase tracking-widest text-muted-foreground">
                        R&eacute;publique de Madagascar
                    </span>
                </div>

                <!-- Title block -->
                <h1 class="text-3xl md:text-4xl lg:text-[2.75rem] font-extrabold leading-[1.1] tracking-tight mb-3">
                    <span class="text-primary">{{ siteInfo.name }}</span>
                    <span v-if="siteInfo.hero_subtitle" class="block text-lg md:text-xl mt-2.5 font-semibold tracking-wide text-emerald-600 dark:text-emerald-400">
                        {{ siteInfo.hero_subtitle }}
                    </span>
                </h1>

                <p class="text-[11px] font-semibold text-muted-foreground mb-5 uppercase tracking-[0.2em]">
                    {{ siteInfo.description }}
                </p>

                <div class="w-10 h-[3px] rounded-full bg-primary/30 mb-5"></div>

                <p class="text-sm md:text-base text-muted-foreground mb-8 max-w-md leading-relaxed">
                    {{ siteInfo.slogan }}
                </p>

                <!-- CTA buttons -->
                <div class="flex flex-wrap gap-3">
                    <Link
                        :href="route('contact')"
                        class="inline-flex items-center gap-2 px-6 py-2.5 bg-primary hover:bg-primary/90 text-primary-foreground text-xs font-bold uppercase tracking-widest rounded-lg shadow-md shadow-primary/20 transition-all duration-300 active:scale-95"
                    >
                        <i class="far fa-calendar-check text-sm"></i>
                        Prendre RDV
                    </Link>
                    <Link
                        :href="route('services')"
                        class="inline-flex items-center gap-2 px-6 py-2.5 bg-card hover:bg-accent text-foreground border border-border text-xs font-bold uppercase tracking-widest rounded-lg shadow-sm transition-all duration-300"
                    >
                        Nos Services
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>
