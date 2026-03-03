<script setup>
defineProps({
    title: {
        type: String,
        default: ''
    },
    description: {
        type: String,
        default: ''
    }
});
</script>

<template>
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div v-if="title || description" class="px-6 py-4 border-b border-gray-200">
            <h3 v-if="title" class="text-lg font-semibold text-dark">{{ title }}</h3>
            <p v-if="description" class="mt-1 text-sm text-gray-600">{{ description }}</p>
        </div>
        
        <div class="p-6">
            <slot />
        </div>
    </div>
</template>
