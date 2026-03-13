<script setup>
import { computed } from 'vue';

const props = defineProps({
    modelValue: { type: String, default: '' },
    label: { type: String, default: '' },
    placeholder: { type: String, default: '' },
    error: { type: String, default: '' },
    hint: { type: String, default: '' },
    rows: { type: [Number, String], default: 4 },
    disabled: { type: Boolean, default: false },
    required: { type: Boolean, default: false }
});

const emit = defineEmits(['update:modelValue']);

const value = computed({
    get: () => props.modelValue,
    set: (val) => emit('update:modelValue', val)
});
</script>

<template>
    <div class="w-full">
        <label v-if="label" class="block mb-1.5 text-sm font-medium text-foreground">
            {{ label }}
            <span v-if="required" class="text-destructive ml-0.5">*</span>
        </label>

        <textarea
            v-model="value"
            :rows="rows"
            :placeholder="placeholder"
            :disabled="disabled"
            :required="required"
            class="w-full px-4 py-2.5 border rounded-lg bg-background text-foreground text-sm placeholder-muted-foreground resize-none transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary disabled:bg-muted disabled:cursor-not-allowed"
            :class="error ? 'border-destructive focus:ring-destructive/20 focus:border-destructive' : 'border-input'"
        ></textarea>

        <p v-if="error" class="mt-1.5 text-xs text-destructive flex items-center gap-1">
            <i class="fas fa-exclamation-circle text-[10px]"></i>
            {{ error }}
        </p>
        <p v-else-if="hint" class="mt-1.5 text-xs text-muted-foreground">{{ hint }}</p>
    </div>
</template>
