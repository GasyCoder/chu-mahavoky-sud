<script setup>
defineProps({
    label: { type: String, default: '' },
    title: { type: String, required: true },
    description: { type: String, default: '' },
    align: {
        type: String,
        default: 'center',
        validator: (v) => ['left', 'center'].includes(v)
    }
});
</script>

<template>
    <div
        :class="[align === 'center' ? 'text-center max-w-2xl mx-auto' : 'max-w-3xl']"
        class="mb-16"
        data-aos="fade-up"
    >
        <span v-if="label" class="text-primary text-xs font-bold uppercase tracking-[0.2em]">{{ label }}</span>
        <h2 class="text-3xl lg:text-4xl font-bold mt-3 mb-4 tracking-tight text-foreground">{{ title }}</h2>
        <p v-if="description" class="text-muted-foreground text-base leading-relaxed">{{ description }}</p>
        <div v-if="align === 'center'" class="w-12 h-1 bg-primary/20 mx-auto rounded-full mt-6"></div>
    </div>
</template>
