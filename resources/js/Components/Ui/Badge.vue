<script setup>
defineProps({
    variant: {
        type: String,
        default: 'default',
        validator: (v) => ['default', 'primary', 'secondary', 'success', 'warning', 'danger', 'outline'].includes(v)
    },
    size: {
        type: String,
        default: 'sm',
        validator: (v) => ['xs', 'sm', 'md'].includes(v)
    }
});

const variantClasses = {
    default: 'bg-muted text-muted-foreground',
    primary: 'bg-primary/10 text-primary border-primary/20',
    secondary: 'bg-secondary/10 text-secondary border-secondary/20',
    success: 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-900/20 dark:text-emerald-400 dark:border-emerald-800',
    warning: 'bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-900/20 dark:text-amber-400 dark:border-amber-800',
    danger: 'bg-red-50 text-red-700 border-red-200 dark:bg-red-900/20 dark:text-red-400 dark:border-red-800',
    outline: 'bg-transparent text-foreground border-border',
};

const sizeClasses = {
    xs: 'px-1.5 py-0.5 text-[10px]',
    sm: 'px-2.5 py-0.5 text-xs',
    md: 'px-3 py-1 text-sm',
};
</script>

<template>
    <span
        class="inline-flex items-center font-semibold rounded-full border leading-none whitespace-nowrap"
        :class="[variantClasses[variant], sizeClasses[size]]"
    >
        <slot />
    </span>
</template>
