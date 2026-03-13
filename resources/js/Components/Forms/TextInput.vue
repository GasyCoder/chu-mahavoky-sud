<script setup>
import { computed } from 'vue';

const props = defineProps({
    modelValue: { type: [String, Number, Boolean], default: '' },
    type: { type: String, default: 'text' },
    label: { type: String, default: '' },
    placeholder: { type: String, default: '' },
    error: { type: String, default: '' },
    hint: { type: String, default: '' },
    disabled: { type: Boolean, default: false },
    required: { type: Boolean, default: false },
    icon: { type: String, default: '' },
    size: {
        type: String,
        default: 'md',
        validator: (v) => ['sm', 'md', 'lg'].includes(v)
    }
});

const emit = defineEmits(['update:modelValue']);

const value = computed({
    get: () => props.modelValue,
    set: (value) => emit('update:modelValue', value)
});

const sizeClasses = {
    sm: 'px-3 py-1.5 text-sm',
    md: 'px-4 py-2.5 text-sm',
    lg: 'px-4 py-3 text-base',
};
</script>

<template>
    <div class="w-full">
        <label v-if="label" class="block mb-1.5 text-sm font-medium text-foreground">
            {{ label }}
            <span v-if="required" class="text-destructive ml-0.5">*</span>
        </label>

        <div class="relative">
            <div v-if="icon" class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i :class="[icon, 'text-muted-foreground text-sm']"></i>
            </div>

            <input
                :type="type"
                v-model="value"
                :placeholder="placeholder"
                :disabled="disabled"
                :required="required"
                class="w-full border rounded-lg bg-background text-foreground placeholder-muted-foreground transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary disabled:bg-muted disabled:cursor-not-allowed"
                :class="[
                    sizeClasses[size],
                    icon ? 'pl-10' : '',
                    error ? 'border-destructive focus:ring-destructive/20 focus:border-destructive' : 'border-input',
                ]"
            />
        </div>

        <p v-if="error" class="mt-1.5 text-xs text-destructive flex items-center gap-1">
            <i class="fas fa-exclamation-circle text-[10px]"></i>
            {{ error }}
        </p>
        <p v-else-if="hint" class="mt-1.5 text-xs text-muted-foreground">{{ hint }}</p>
    </div>
</template>
