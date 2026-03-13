<script setup>
import { watch } from 'vue';

const props = defineProps({
    show: { type: Boolean, default: false },
    maxWidth: {
        type: String,
        default: 'lg',
        validator: (value) => ['sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', 'full'].includes(value)
    },
    closeable: { type: Boolean, default: true },
    title: { type: String, default: '' }
});

const emit = defineEmits(['close']);

const maxWidthClasses = {
    sm: 'max-w-sm',
    md: 'max-w-md',
    lg: 'max-w-lg',
    xl: 'max-w-xl',
    '2xl': 'max-w-2xl',
    '3xl': 'max-w-3xl',
    '4xl': 'max-w-4xl',
    'full': 'max-w-[calc(100vw-2rem)]',
};

watch(() => props.show, (val) => {
    document.body.style.overflow = val ? 'hidden' : '';
});
</script>

<template>
    <Teleport to="body">
        <Transition
            enter-active-class="duration-200 ease-out"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="duration-150 ease-in"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div v-if="show" class="fixed inset-0 z-50 overflow-y-auto">
                <!-- Overlay -->
                <div
                    class="fixed inset-0 bg-foreground/60 backdrop-blur-sm"
                    @click="closeable && emit('close')"
                ></div>

                <!-- Modal -->
                <div class="flex min-h-full items-center justify-center p-4">
                    <Transition
                        enter-active-class="duration-200 ease-out"
                        enter-from-class="opacity-0 scale-95 translate-y-2"
                        enter-to-class="opacity-100 scale-100 translate-y-0"
                        leave-active-class="duration-150 ease-in"
                        leave-from-class="opacity-100 scale-100"
                        leave-to-class="opacity-0 scale-95"
                    >
                        <div
                            v-if="show"
                            class="relative w-full bg-popover rounded-2xl shadow-2xl border border-border overflow-hidden"
                            :class="maxWidthClasses[maxWidth]"
                        >
                            <!-- Header -->
                            <div v-if="title || closeable || $slots.header" class="flex items-center justify-between px-6 py-4 border-b border-border">
                                <slot name="header">
                                    <h3 v-if="title" class="text-lg font-semibold text-foreground">{{ title }}</h3>
                                </slot>
                                <button
                                    v-if="closeable"
                                    @click="emit('close')"
                                    class="flex-shrink-0 w-8 h-8 rounded-lg flex items-center justify-center text-muted-foreground hover:bg-muted hover:text-foreground transition-colors"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Body -->
                            <div class="max-h-[calc(100vh-12rem)] overflow-y-auto">
                                <slot />
                            </div>

                            <!-- Footer -->
                            <div v-if="$slots.footer" class="px-6 py-4 border-t border-border bg-muted/30 flex items-center justify-end gap-3">
                                <slot name="footer" />
                            </div>
                        </div>
                    </Transition>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>
