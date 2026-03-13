<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    title: { type: String, required: true },
    description: { type: String, default: '' },
    label: { type: String, default: 'CHU Mahajanga' },
    breadcrumbs: {
        type: Array,
        default: () => []
        // [{label: 'Accueil', route: 'home'}, {label: 'Current'}]
    }
});
</script>

<template>
    <section class="relative pt-28 pb-14 bg-background border-b border-border/40 overflow-hidden">
        <!-- Subtle pattern -->
        <div class="absolute inset-0 z-0 opacity-[0.03]">
            <div class="absolute inset-0 bg-[radial-gradient(#0055A4_1px,transparent_1px)] [background-size:24px_24px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <div class="max-w-3xl" data-aos="fade-right">
                <span class="text-primary text-xs font-bold uppercase tracking-[0.2em]">{{ label }}</span>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mt-3 mb-4 tracking-tight text-foreground">{{ title }}</h1>
                <p v-if="description" class="text-muted-foreground text-base md:text-lg max-w-xl leading-relaxed">
                    {{ description }}
                </p>

                <!-- Breadcrumbs -->
                <nav v-if="breadcrumbs.length > 0" class="flex items-center gap-2 mt-6 text-xs font-medium text-muted-foreground">
                    <template v-for="(crumb, index) in breadcrumbs" :key="index">
                        <Link v-if="crumb.route" :href="route(crumb.route)" class="hover:text-primary transition-colors">
                            {{ crumb.label }}
                        </Link>
                        <span v-else class="text-primary font-semibold">{{ crumb.label }}</span>
                        <span v-if="index < breadcrumbs.length - 1" class="text-border">/</span>
                    </template>
                </nav>
            </div>
        </div>
    </section>
</template>
