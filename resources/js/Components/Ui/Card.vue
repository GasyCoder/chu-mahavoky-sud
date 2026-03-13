<script setup>
defineProps({
    title: { type: String, default: '' },
    description: { type: String, default: '' },
    padding: { type: Boolean, default: true },
    hoverable: { type: Boolean, default: false }
});
</script>

<template>
    <div
        class="bg-card border border-border rounded-2xl overflow-hidden transition-all duration-300"
        :class="[
            hoverable ? 'hover:shadow-elevated hover:border-primary/30 hover:-translate-y-0.5' : 'shadow-card'
        ]"
    >
        <div v-if="title || description || $slots.header" class="px-6 py-4 border-b border-border">
            <slot name="header">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 v-if="title" class="text-base font-semibold text-foreground">{{ title }}</h3>
                        <p v-if="description" class="mt-0.5 text-sm text-muted-foreground">{{ description }}</p>
                    </div>
                    <slot name="header-actions" />
                </div>
            </slot>
        </div>

        <div :class="padding ? 'p-6' : ''">
            <slot />
        </div>

        <div v-if="$slots.footer" class="px-6 py-4 border-t border-border bg-muted/30">
            <slot name="footer" />
        </div>
    </div>
</template>
