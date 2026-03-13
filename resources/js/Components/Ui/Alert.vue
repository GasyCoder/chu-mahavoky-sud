<script setup>
import { ref } from 'vue';

const props = defineProps({
    variant: {
        type: String,
        default: 'info',
        validator: (v) => ['info', 'success', 'warning', 'danger'].includes(v)
    },
    title: { type: String, default: '' },
    dismissible: { type: Boolean, default: false }
});

const visible = ref(true);

const variantConfig = {
    info: { bg: 'bg-primary/5 border-primary/20', text: 'text-primary', icon: 'fas fa-info-circle' },
    success: { bg: 'bg-emerald-50 border-emerald-200 dark:bg-emerald-900/20 dark:border-emerald-800', text: 'text-emerald-700 dark:text-emerald-400', icon: 'fas fa-check-circle' },
    warning: { bg: 'bg-amber-50 border-amber-200 dark:bg-amber-900/20 dark:border-amber-800', text: 'text-amber-700 dark:text-amber-400', icon: 'fas fa-exclamation-triangle' },
    danger: { bg: 'bg-red-50 border-red-200 dark:bg-red-900/20 dark:border-red-800', text: 'text-red-700 dark:text-red-400', icon: 'fas fa-exclamation-circle' },
};
</script>

<template>
    <div
        v-if="visible"
        class="rounded-xl border px-4 py-3 animate-fade-in"
        :class="variantConfig[variant].bg"
        role="alert"
    >
        <div class="flex items-start gap-3">
            <i :class="[variantConfig[variant].icon, variantConfig[variant].text, 'mt-0.5 text-sm']"></i>
            <div class="flex-1 min-w-0">
                <p v-if="title" class="text-sm font-semibold" :class="variantConfig[variant].text">{{ title }}</p>
                <div class="text-sm" :class="[variantConfig[variant].text, 'opacity-90']">
                    <slot />
                </div>
            </div>
            <button
                v-if="dismissible"
                @click="visible = false"
                class="flex-shrink-0 p-0.5 rounded-md hover:bg-black/5 dark:hover:bg-white/5 transition-colors"
                :class="variantConfig[variant].text"
            >
                <i class="fas fa-times text-xs"></i>
            </button>
        </div>
    </div>
</template>
