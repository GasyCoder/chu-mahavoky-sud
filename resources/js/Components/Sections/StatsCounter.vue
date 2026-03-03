<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
    totalServices: {
        type: Number,
        default: 0
    }
});

const stats = [
    { label: 'Médecins Experts', value: '47+', icon: 'stethoscope' },
    { label: 'Services de Soins', value: '12+', icon: 'hospital' },
    { label: 'Lits d\'Hospitalisation', value: '150+', icon: 'bed' },
    { label: 'Urgence 24h/24', value: '7j/7', icon: 'clock' },
];
</script>

<template>
    <div class="relative z-20 -mt-16 max-w-7xl mx-auto px-6 lg:px-8">
        <div class="bg-card border border-border shadow-xl shadow-foreground/5 rounded-3xl p-8 lg:p-10 backdrop-blur-xl bg-card/80">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-0 divide-y lg:divide-y-0 lg:divide-x divide-border">
                <div v-for="(stat, index) in stats" :key="index" 
                    class="flex flex-col items-center justify-center space-y-2 py-4 lg:py-0"
                    data-aos="fade-up" :data-aos-delay="index * 100">
                    <span class="text-3xl lg:text-4xl font-bold tracking-tight text-foreground">{{ stat.value }}</span>
                    <span class="text-[10px] lg:text-xs font-bold uppercase tracking-widest text-muted-foreground">{{ stat.label }}</span>
                </div>
            </div>
        </div>
    </div>
</template>
