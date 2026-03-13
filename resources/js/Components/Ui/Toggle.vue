<script setup>
defineProps({
    modelValue: { type: Boolean, default: false },
    label: { type: String, default: '' },
    description: { type: String, default: '' },
    disabled: { type: Boolean, default: false }
});

defineEmits(['update:modelValue']);
</script>

<template>
    <label class="flex items-center justify-between cursor-pointer group" :class="{ 'opacity-50 cursor-not-allowed': disabled }">
        <div v-if="label || description" class="mr-4">
            <span v-if="label" class="text-sm font-medium text-foreground">{{ label }}</span>
            <p v-if="description" class="text-xs text-muted-foreground mt-0.5">{{ description }}</p>
        </div>
        <button
            type="button"
            role="switch"
            :aria-checked="modelValue"
            :disabled="disabled"
            @click="!disabled && $emit('update:modelValue', !modelValue)"
            class="relative inline-flex h-6 w-11 flex-shrink-0 rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary/50 focus:ring-offset-2 focus:ring-offset-background"
            :class="modelValue ? 'bg-primary' : 'bg-muted-foreground/30'"
        >
            <span
                class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out"
                :class="modelValue ? 'translate-x-5' : 'translate-x-0'"
            ></span>
        </button>
    </label>
</template>
