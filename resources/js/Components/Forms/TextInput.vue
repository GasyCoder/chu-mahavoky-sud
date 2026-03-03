<script setup>
import { computed } from 'vue';

const props = defineProps({
    modelValue: {
        type: [String, Number, Boolean],
        default: ''
    },
    type: {
        type: String,
        default: 'text'
    },
    label: {
        type: String,
        default: ''
    },
    placeholder: {
        type: String,
        default: ''
    },
    error: {
        type: String,
        default: ''
    },
    disabled: {
        type: Boolean,
        default: false
    },
    required: {
        type: Boolean,
        default: false
    }
});

const emit = defineEmits(['update:modelValue']);

const value = computed({
    get: () => props.modelValue,
    set: (value) => emit('update:modelValue', value)
});
</script>

<template>
    <div class="w-full">
        <label v-if="label" class="block mb-1 text-sm font-medium text-dark">
            {{ label }}
            <span v-if="required" class="text-red-500">*</span>
        </label>
        
        <input
            :type="type"
            v-model="value"
            :placeholder="placeholder"
            :disabled="disabled"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
            :class="{
                'border-gray-300': !error,
                'border-red-500': error,
                'bg-gray-100 cursor-not-allowed': disabled
            }"
        />
        
        <p v-if="error" class="mt-1 text-sm text-red-500">{{ error }}</p>
    </div>
</template>
