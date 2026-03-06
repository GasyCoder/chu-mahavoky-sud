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
    <section class="relative h-[450px] lg:h-[550px] flex items-end bg-[#f4f7fa] dark:bg-slate-950 overflow-hidden pb-12 lg:pb-20">
        <!-- Image de fond fixée à DROITE -->
        <div class="absolute inset-y-0 right-0 w-full lg:w-1/2 z-0">
            <img :src="siteInfo.background || '/assets/herobg.jpg'" 
                 class="w-full h-full object-cover"
                 alt="CHU Mahavoky" />
            <!-- Dégradé de transition -->
            <div class="absolute inset-0 bg-gradient-to-r from-[#f4f7fa] via-[#f4f7fa]/30 to-transparent dark:from-slate-950 dark:via-slate-950/60"></div>
            <!-- Dégradé mobile -->
            <div class="lg:hidden absolute inset-0 bg-gradient-to-t from-[#f4f7fa] via-[#f4f7fa]/80 to-transparent dark:from-slate-950 dark:via-slate-950/80"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 w-full">
            <div class="max-w-xl animate-in fade-in slide-in-from-bottom-4 duration-700">
                <!-- Identifiant institutionnel -->
                <div class="flex items-center space-x-2 mb-4">
                    <span class="px-2 py-0.5 bg-blue-700 text-[9px] font-black text-white uppercase tracking-[0.2em] rounded-sm">
                        MINSANTÉ
                    </span>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-slate-500">
                        République de Madagascar
                    </span>
                </div>

                <!-- Titre avec Couleurs Spécifiques -->
                <h1 class="text-3xl md:text-4xl font-black leading-none mb-2 uppercase tracking-tighter">
                    <span class="text-blue-700">CHU Mahavoky</span> 
                    <span class="text-slate-900 dark:text-white ml-2">Atsimo</span>
                    <span class="block text-blue-600/70 text-lg md:text-xl mt-2 tracking-[0.1em] font-bold">
                        Mahajanga — Boeny
                    </span>
                </h1>
                
                <p class="text-[10px] md:text-[11px] font-bold text-slate-400 dark:text-slate-500 mb-6 uppercase tracking-[0.25em]">
                    {{ siteInfo.description }}
                </p>

                <div class="w-12 h-1 bg-blue-700 mb-6 opacity-50"></div>

                <p class="text-sm text-slate-600 dark:text-slate-300 mb-8 max-w-md leading-relaxed">
                    {{ siteInfo.slogan }}
                </p>

                <div class="flex flex-wrap gap-3">
                    <Link :href="route('contact')"
                        class="px-6 py-2.5 bg-blue-700 hover:bg-blue-800 text-white text-[10px] font-bold uppercase tracking-widest rounded shadow-md transition-all active:scale-95">
                        Prendre RDV
                    </Link>
                    <Link :href="route('services')"
                        class="px-6 py-2.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 text-[10px] font-bold uppercase tracking-widest rounded shadow-sm transition-all">
                        Nos Services
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>
