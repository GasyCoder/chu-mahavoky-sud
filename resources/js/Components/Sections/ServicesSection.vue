<script setup>
import { Link } from '@inertiajs/vue3';

const services = [
    { title: 'Cardiologie', desc: 'Soins cardiaques avancés et diagnostics.', icon: 'heart' },
    { title: 'Pédiatrie', desc: 'Soins complets pour les enfants et nourrissons.', icon: 'child' },
    { title: 'Chirurgie', desc: 'Interventions chirurgicales de pointe.', icon: 'scissors' },
    { title: 'Maternité', desc: 'Accompagnement de la grossesse et accouchement.', icon: 'baby' },
    { title: 'Radiologie', desc: 'Imagerie médicale haute définition.', icon: 'microscope' },
    { title: 'Urgences', desc: 'Prise en charge vitale 24h/24 et 7j/7.', icon: 'ambulance' },
];
</script>

<template>
    <section class="py-24 bg-background border-b border-border/40">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Section Header Slim -->
            <div class="text-center max-w-2xl mx-auto mb-20" data-aos="fade-up">
                <span class="text-primary text-[10px] font-bold uppercase tracking-[0.2em]">Nos Spécialités</span>
                <h2 class="text-3xl lg:text-4xl font-bold mt-4 mb-6 tracking-tight">Excellence en Soins de Santé</h2>
                <div class="w-12 h-1 bg-primary/20 mx-auto rounded-full"></div>
            </div>

            <!-- Services Grid Slim -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div v-for="(service, index) in services" :key="index"
                    class="group p-8 bg-card border border-border rounded-3xl hover:border-primary/50 transition-all duration-500 hover:shadow-2xl hover:shadow-primary/5 hover:-translate-y-1"
                    data-aos="fade-up" :data-aos-delay="index * 50">
                    
                    <div class="w-12 h-12 rounded-2xl bg-primary/5 flex items-center justify-center mb-6 group-hover:bg-primary transition-colors duration-500">
                        <i :class="`fas fa-${service.icon} text-primary group-hover:text-white transition-colors duration-500`"></i>
                    </div>

                    <h3 class="text-xl font-bold mb-3 tracking-tight">{{ service.title }}</h3>
                    <p class="text-muted-foreground text-sm leading-relaxed mb-6">{{ service.desc }}</p>

                    <Link :href="route('services')" class="inline-flex items-center text-xs font-bold uppercase tracking-widest text-primary hover:translate-x-1 transition-transform">
                        En savoir plus
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>
