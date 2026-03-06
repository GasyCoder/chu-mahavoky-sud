<script setup>
const props = defineProps({
    totalServices: {
        type: Number,
        default: 0
    }
});

const stats = [
    { label: 'Médecins Experts', value: '47+', icon: 'fa-user-md' },
    { label: 'Services de Soins', value: '12+', icon: 'fa-hospital' },
    { label: 'Lits', value: '150+', icon: 'fa-bed' },
    { label: 'Urgences', value: '24h/7j', icon: 'fa-clock' },
];
</script>

<template>
    <div class="relative z-20 -mt-10 max-w-7xl mx-auto px-6 lg:px-8">
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-lg rounded-xl overflow-hidden">
            <div class="grid grid-cols-2 lg:grid-cols-4 divide-y lg:divide-y-0 lg:divide-x divide-slate-100 dark:divide-slate-800">
                <div v-for="(stat, index) in stats" :key="index" 
                    class="flex items-center gap-4 px-8 py-6 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50">
                    <div class="w-10 h-10 bg-blue-50 dark:bg-blue-900/20 rounded-lg flex items-center justify-center text-blue-600 flex-shrink-0">
                        <i :class="['fas', stat.icon, 'text-lg']"></i>
                    </div>
                    <div>
                        <div class="text-xl font-bold text-slate-900 dark:text-white leading-none mb-1">
                            {{ stat.value }}
                        </div>
                        <div class="text-[10px] font-bold uppercase tracking-widest text-slate-400">
                            {{ stat.label }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
