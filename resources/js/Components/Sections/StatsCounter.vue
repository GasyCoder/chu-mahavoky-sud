<script setup>
import { computed } from 'vue';

const props = defineProps({
    totalServices: {
        type: Number,
        default: 0
    },
    stats: {
        type: Object,
        default: () => ({})
    }
});

const statItems = computed(() => [
    { label: 'Médecins Experts', value: (props.stats?.doctors || '47') + '+', icon: 'fa-user-md' },
    { label: 'Services de Soins', value: (props.stats?.services || '12') + '+', icon: 'fa-hospital' },
    { label: 'Lits Disponibles', value: (props.stats?.beds || '150') + '+', icon: 'fa-bed' },
    { label: 'Urgences', value: props.stats?.emergency || '24h/7j', icon: 'fa-clock' },
]);
</script>

<template>
    <div class="relative z-20 -mt-10 max-w-7xl mx-auto px-6 lg:px-8">
        <div class="bg-card border border-border shadow-xl shadow-black/5 dark:shadow-black/20 rounded-2xl overflow-hidden">
            <div class="grid grid-cols-2 lg:grid-cols-4 divide-y lg:divide-y-0 lg:divide-x divide-border">
                <div
                    v-for="(stat, index) in statItems"
                    :key="index"
                    class="group flex items-center gap-4 px-6 lg:px-8 py-6 transition-colors duration-300 hover:bg-accent/50 cursor-default"
                    data-aos="fade-up"
                    :data-aos-delay="index * 80"
                >
                    <div class="w-11 h-11 rounded-xl bg-primary/5 dark:bg-primary/10 flex items-center justify-center flex-shrink-0 group-hover:bg-primary group-hover:shadow-lg group-hover:shadow-primary/20 transition-all duration-300">
                        <i :class="['fas', stat.icon, 'text-lg text-primary group-hover:text-primary-foreground transition-colors duration-300']"></i>
                    </div>
                    <div>
                        <div class="text-xl lg:text-2xl font-extrabold text-foreground leading-none mb-1 tracking-tight">
                            {{ stat.value }}
                        </div>
                        <div class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground">
                            {{ stat.label }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
