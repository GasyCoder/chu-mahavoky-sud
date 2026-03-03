<script setup>
defineProps({
    show: {
        type: Boolean,
        default: false
    },
    maxWidth: {
        type: String,
        default: 'lg',
        validator: (value) => ['sm', 'md', 'lg', 'xl', '2xl', '3xl'].includes(value)
    },
    closeable: {
        type: Boolean,
        default: true
    }
});

const emit = defineEmits(['close']);

const maxWidthClasses = {
    sm: 'max-w-sm',
    md: 'max-w-md',
    lg: 'max-w-lg',
    xl: 'max-w-xl',
    '2xl': 'max-w-2xl',
    '3xl': 'max-w-3xl'
};
</script>

<template>
    <Teleport to="body">
        <Transition leave-active-class="duration-200">
            <div v-if="show" class="fixed inset-0 z-50 overflow-y-auto" style="display: block;">
                <!-- Overlay -->
                <div 
                    class="fixed inset-0 transition-opacity bg-dark bg-opacity-50"
                    @click="closeable && emit('close')"
                ></div>

                <!-- Modal -->
                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                    <div 
                        class="relative inline-block w-full text-left transition-all transform bg-white rounded-lg shadow-xl"
                        :class="maxWidthClasses[maxWidth]"
                    >
                        <!-- Close button -->
                        <button 
                            v-if="closeable"
                            @click="emit('close')"
                            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600"
                        >
                            <i class="fas fa-times"></i>
                        </button>

                        <slot />
                    </div>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>
