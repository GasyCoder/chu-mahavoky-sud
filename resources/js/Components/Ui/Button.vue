<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    type: {
        type: String,
        default: 'button',
        validator: (value) => ['button', 'submit', 'a', 'link'].includes(value)
    },
    variant: {
        type: String,
        default: 'primary',
        validator: (value) => ['primary', 'secondary', 'danger', 'success', 'outline', 'ghost', 'link'].includes(value)
    },
    size: {
        type: String,
        default: 'md',
        validator: (value) => ['xs', 'sm', 'md', 'lg'].includes(value)
    },
    href: { type: String, default: null },
    disabled: { type: Boolean, default: false },
    loading: { type: Boolean, default: false },
    rounded: { type: Boolean, default: false }
});

const variantClasses = {
    primary: 'bg-primary text-white hover:bg-primary-600 shadow-sm hover:shadow-md active:shadow-sm',
    secondary: 'bg-secondary text-white hover:bg-secondary-600 shadow-sm hover:shadow-md',
    danger: 'bg-red-600 text-white hover:bg-red-700 shadow-sm',
    success: 'bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm',
    outline: 'border-2 border-primary text-primary hover:bg-primary hover:text-white',
    ghost: 'text-foreground hover:bg-muted',
    link: 'text-primary hover:underline p-0 h-auto',
};

const sizeClasses = {
    xs: 'px-2.5 py-1 text-xs gap-1.5',
    sm: 'px-3 py-1.5 text-sm gap-1.5',
    md: 'px-5 py-2.5 text-sm gap-2',
    lg: 'px-7 py-3.5 text-base gap-2',
};
</script>

<template>
    <component
        :is="type === 'link' ? Link : (type === 'a' ? 'a' : 'button')"
        :type="['a', 'link'].includes(type) ? null : type"
        :href="href"
        :disabled="disabled || loading"
        class="inline-flex items-center justify-center font-semibold transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/50 focus-visible:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed active:scale-[0.98]"
        :class="[
            variantClasses[variant],
            sizeClasses[size],
            rounded ? 'rounded-full' : 'rounded-lg'
        ]"
    >
        <svg v-if="loading" class="animate-spin -ml-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <slot name="icon" />
        <slot />
    </component>
</template>
