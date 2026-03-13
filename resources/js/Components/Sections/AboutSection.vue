<script setup>
const props = defineProps({
    director: {
        type: Object,
        default: () => ({})
    }
});

const directorInfo = {
    name: props.director?.name || 'Dr. HABIB',
    photo: props.director?.photo || '/assets/about/directeur.png',
    message: props.director?.message || 'Le Centre Hospitalier Universitaire Mahavoky Atsimo s\'engage à fournir des soins de santé de qualité à tous les patients. Notre équipe de professionnels dévoués travaille sans relâche pour assurer votre bien-être et votre satisfaction.'
};
</script>

<template>
    <section class="py-20 lg:py-28 bg-background border-b border-border/40 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <!-- Photo -->
                <div class="relative group" data-aos="fade-right" data-aos-duration="800">
                    <div class="absolute -inset-3 bg-primary/5 dark:bg-primary/10 rounded-[2rem] scale-95 group-hover:scale-100 transition-transform duration-700"></div>
                    <div class="relative aspect-[4/5] overflow-hidden rounded-2xl border border-border shadow-2xl shadow-black/10 dark:shadow-black/30">
                        <img
                            :src="directorInfo.photo"
                            :alt="directorInfo.name"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        />
                        <!-- Subtle overlay gradient at bottom -->
                        <div class="absolute inset-x-0 bottom-0 h-1/4 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                    <!-- Decorative element -->
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 border-2 border-primary/20 rounded-2xl -z-10"></div>
                </div>

                <!-- Content -->
                <div data-aos="fade-left" data-aos-duration="800">
                    <span class="inline-block text-primary text-xs font-bold uppercase tracking-[0.2em] mb-3">
                        Direction Générale
                    </span>
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight leading-tight text-foreground mb-8">
                        Engagement envers l'excellence médicale
                    </h2>

                    <!-- Director quote -->
                    <div class="relative pl-6 border-l-[3px] border-primary/30 mb-10">
                        <svg class="absolute -top-2 -left-1 w-6 h-6 text-primary/15" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                        </svg>
                        <p class="text-base lg:text-lg text-muted-foreground leading-relaxed italic">
                            "{{ directorInfo.message }}"
                        </p>
                    </div>

                    <!-- Director info -->
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-primary/10 dark:bg-primary/20 flex items-center justify-center text-primary font-bold text-lg">
                            {{ directorInfo.name.charAt(0) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-foreground text-base">{{ directorInfo.name }}</h4>
                            <p class="text-xs text-muted-foreground uppercase tracking-widest font-semibold mt-0.5">
                                Directeur Général
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
