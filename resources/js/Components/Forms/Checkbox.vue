<script setup>
defineProps({
    modelValue: {
        type: Boolean,
        default: false
    },
    label: {
        type: String,
        default: ''
    },
    error: {
        type: String,
        default: ''
    }
});

const emit = defineEmits(['update:modelValue']);
</script>

<template>
    <div class="flex items-start">
        <div class="flex items-center h-5">
            <input
                :id="label"
                type="checkbox"
                :checked="modelValue"
                @change="emit('update:modelValue', $event.target.checked)"
                class="w-4 h-4 border border-gray-300 rounded text-primary focus:ring-primary"
            />
        </div>
        
        <div class="ml-2">
            <label :for="label" class="text-sm text-dark cursor-pointer">
                {{ label }}
            </label>
            <p v-if="error" class="mt-1 text-sm text-red-500">{{ error }}</p>
        </div>
    </div>
</template>
