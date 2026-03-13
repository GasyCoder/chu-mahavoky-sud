<script setup>
import { computed } from 'vue';

const props = defineProps({
    modelValue: { type: [String, Number], default: '' },
    label: { type: String, default: '' },
    options: {
        type: Array,
        default: () => []
        // [{value: '', label: 'Select...'}]
    },
    error: { type: String, default: '' },
    disabled: { type: Boolean, default: false },
    required: { type: Boolean, default: false },
    placeholder: { type: String, default: '' },
    icon: { type: String, default: '' }
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

        <div class="relative">
            <div v-if="icon" class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i :class="[icon, 'text-muted-foreground text-sm']"></i>
            </div>

            <select
                v-model="value"
                :disabled="disabled"
                :required="required"
                class="w-full px-4 py-2.5 border rounded-lg bg-background text-foreground text-sm appearance-none transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary disabled:bg-muted disabled:cursor-not-allowed cursor-pointer"
                :class="[
                    icon ? 'pl-10' : '',
                    error ? 'border-destructive' : 'border-input',
                ]"
            >
                <option v-if="placeholder" value="" disabled>{{ placeholder }}</option>
                <option v-for="option in options" :key="option.value" :value="option.value">
                    {{ option.label }}
                </option>
            </select>

            <!-- Arrow icon -->
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>

        <p v-if="error" class="mt-1.5 text-xs text-destructive flex items-center gap-1">
            <i class="fas fa-exclamation-circle text-[10px]"></i>
            {{ error }}
        </p>
    </div>
</template>
