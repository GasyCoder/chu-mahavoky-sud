<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

defineProps({
    align: {
        type: String,
        default: 'right',
        validator: (v) => ['left', 'right'].includes(v)
    },
    width: {
        type: String,
        default: '48'
    }
});

const open = ref(false);
const dropdownRef = ref(null);

const close = (e) => {
    if (dropdownRef.value && !dropdownRef.value.contains(e.target)) {
        open.value = false;
    }
};

onMounted(() => document.addEventListener('click', close));
onUnmounted(() => document.removeEventListener('click', close));

const widthClasses = {
    '36': 'w-36',
    '48': 'w-48',
    '56': 'w-56',
    '64': 'w-64',
};
</script>

<template>
    <div class="relative" ref="dropdownRef">
        <div @click="open = !open">
            <slot name="trigger" />
        </div>

        <Transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-150"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <div
                v-show="open"
                class="absolute z-50 mt-2 rounded-xl bg-popover border border-border shadow-elevated overflow-hidden"
                :class="[
                    widthClasses[width] || 'w-48',
                    align === 'right' ? 'right-0' : 'left-0'
                ]"
            >
                <slot name="content" :close="() => open = false" />
            </div>
        </Transition>
    </div>
</template>
