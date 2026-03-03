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
    <section class="py-24 bg-background border-b border-border/40 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Image Slim -->
                <div class="relative group" data-aos="fade-right">
                    <div class="absolute -inset-4 bg-primary/5 rounded-[2rem] scale-95 group-hover:scale-100 transition-transform duration-700"></div>
                    <div class="relative aspect-[4/5] overflow-hidden rounded-2xl border border-border shadow-2xl">
                        <img :src="directorInfo.photo" :alt="directorInfo.name" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                    </div>
                </div>

                <!-- Content Slim -->
                <div data-aos="fade-left">
                    <span class="text-primary text-[10px] font-bold uppercase tracking-[0.2em]">Direction Générale</span>
                    <h2 class="text-3xl lg:text-4xl font-bold mt-4 mb-8 tracking-tight leading-tight">
                        Engagement envers l'excellence médicale
                    </h2>
                    
                    <div class="relative pl-8 border-l border-primary/20 mb-12">
                        <p class="text-lg text-muted-foreground leading-relaxed italic">
                            "{{ directorInfo.message }}"
                        </p>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                            {{ directorInfo.name.charAt(0) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-foreground">{{ directorInfo.name }}</h4>
                            <p class="text-xs text-muted-foreground uppercase tracking-widest font-semibold">Directeur Général</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
