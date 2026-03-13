<script setup>
defineProps({
    modelValue: { type: Boolean, default: false },
    label: { type: String, default: '' },
    error: { type: String, default: '' },
    description: { type: String, default: '' }
});

const emit = defineEmits(['update:modelValue']);
</script>

<template>
    <div class="flex items-start gap-3">
        <div class="flex items-center h-5 mt-0.5">
            <input
                :id="label"
                type="checkbox"
                :checked="modelValue"
                @change="emit('update:modelValue', $event.target.checked)"
                class="w-4 h-4 border-input rounded text-primary bg-background focus:ring-primary/30 focus:ring-2 focus:ring-offset-0 transition-colors cursor-pointer"
            />
        </div>

        <div class="flex-1">
            <label :for="label" class="text-sm text-foreground cursor-pointer leading-snug">
                <slot>{{ label }}</slot>
            </label>
            <p v-if="description" class="text-xs text-muted-foreground mt-0.5">{{ description }}</p>
            <p v-if="error" class="mt-1 text-xs text-destructive">{{ error }}</p>
        </div>
    </div>
</template>
