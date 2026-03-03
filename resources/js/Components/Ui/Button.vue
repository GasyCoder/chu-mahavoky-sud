<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
        validator: (value) => ['button', 'submit', 'a'].includes(value)
    },
    variant: {
        type: String,
        default: 'primary',
        validator: (value) => ['primary', 'secondary', 'danger', 'success', 'outline'].includes(value)
    },
    size: {
        type: String,
        default: 'md',
        validator: (value) => ['sm', 'md', 'lg'].includes(value)
    },
    href: {
        type: String,
        default: null
    },
    disabled: {
        type: Boolean,
        default: false
    },
    loading: {
        type: Boolean,
        default: false
    }
});

const variantClasses = {
    primary: 'bg-primary text-white hover:bg-primary/90',
    secondary: 'bg-gray-600 text-white hover:bg-gray-700',
    danger: 'bg-red-600 text-white hover:bg-red-700',
    success: 'bg-green-600 text-white hover:bg-green-700',
    outline: 'border-2 border-primary text-primary hover:bg-primary hover:text-white'
};

const sizeClasses = {
    sm: 'px-3 py-1.5 text-sm',
    md: 'px-4 py-2 text-base',
    lg: 'px-6 py-3 text-lg'
};
</script>

<template>
    <component
        :is="type === 'a' ? 'a' : 'button'"
        :type="type === 'a' ? null : type"
        :href="href"
        :disabled="disabled || loading"
        class="inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-primary/50 disabled:opacity-50 disabled:cursor-not-allowed"
        :class="[variantClasses[variant], sizeClasses[size]]"
    >
        <i v-if="$slots.icon" class="mr-2"></i>
        <slot name="icon"></slot>
        <slot />
        <i v-if="loading" class="fas fa-spinner fa-spin ml-2"></i>
    </component>
</template>
