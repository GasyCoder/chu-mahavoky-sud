<script setup>
defineProps({
    tabs: {
        type: Array,
        required: true
        // [{id: 'tab1', label: 'Tab 1', icon: 'fas fa-home'}]
    },
    modelValue: { type: String, required: true },
    variant: {
        type: String,
        default: 'pills',
        validator: (v) => ['pills', 'underline', 'boxed'].includes(v)
    }
});

defineEmits(['update:modelValue']);
</script>

<template>
    <!-- Pills variant -->
    <div v-if="variant === 'pills'" class="inline-flex bg-muted/50 rounded-xl p-1 border border-border/40">
        <button
            v-for="tab in tabs" :key="tab.id"
            @click="$emit('update:modelValue', tab.id)"
            class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex items-center gap-2"
            :class="modelValue === tab.id
                ? 'bg-white dark:bg-card text-foreground shadow-sm'
                : 'text-muted-foreground hover:text-foreground'"
        >
            <i v-if="tab.icon" :class="[tab.icon, 'text-xs']"></i>
            {{ tab.label }}
        </button>
    </div>

    <!-- Underline variant -->
    <div v-else-if="variant === 'underline'" class="flex border-b border-border">
        <button
            v-for="tab in tabs" :key="tab.id"
            @click="$emit('update:modelValue', tab.id)"
            class="px-4 py-3 text-sm font-medium border-b-2 -mb-px transition-all duration-200 flex items-center gap-2"
            :class="modelValue === tab.id
                ? 'border-primary text-primary'
                : 'border-transparent text-muted-foreground hover:text-foreground hover:border-border'"
        >
            <i v-if="tab.icon" :class="[tab.icon, 'text-xs']"></i>
            {{ tab.label }}
        </button>
    </div>

    <!-- Boxed variant -->
    <div v-else class="flex gap-2">
        <button
            v-for="tab in tabs" :key="tab.id"
            @click="$emit('update:modelValue', tab.id)"
            class="px-4 py-2 rounded-xl text-sm font-medium border transition-all duration-200 flex items-center gap-2"
            :class="modelValue === tab.id
                ? 'bg-primary text-primary-foreground border-primary shadow-sm'
                : 'bg-card text-muted-foreground border-border hover:text-foreground hover:border-foreground/20'"
        >
            <i v-if="tab.icon" :class="[tab.icon, 'text-xs']"></i>
            {{ tab.label }}
        </button>
    </div>
</template>
