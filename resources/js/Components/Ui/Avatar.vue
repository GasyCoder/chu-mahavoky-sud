<script setup>
import { computed } from 'vue';

const props = defineProps({
    src: { type: String, default: '' },
    alt: { type: String, default: '' },
    name: { type: String, default: '' },
    size: {
        type: String,
        default: 'md',
        validator: (v) => ['xs', 'sm', 'md', 'lg', 'xl'].includes(v)
    }
});

const initials = computed(() => {
    if (!props.name) return '?';
    return props.name.split(' ').map(n => n[0]).slice(0, 2).join('').toUpperCase();
});

const sizeClasses = {
    xs: 'w-6 h-6 text-[10px]',
    sm: 'w-8 h-8 text-xs',
    md: 'w-10 h-10 text-sm',
    lg: 'w-12 h-12 text-base',
    xl: 'w-16 h-16 text-lg',
};
</script>

<template>
    <div
        class="relative rounded-full overflow-hidden flex items-center justify-center flex-shrink-0 bg-primary/10 text-primary font-bold"
        :class="sizeClasses[size]"
    >
        <img
            v-if="src"
            :src="src"
            :alt="alt || name"
            class="w-full h-full object-cover"
            @error="$event.target.style.display = 'none'"
        />
        <span v-else>{{ initials }}</span>
    </div>
</template>
