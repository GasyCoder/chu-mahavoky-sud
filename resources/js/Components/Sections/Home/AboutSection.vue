<script setup>
defineProps({
    director: {
        type: Object,
        default: () => ({
            name: '',
            photo: '',
            message: ''
        })
    }
});
</script>

<template>
    <!-- Section directeur -->
    <section class="py-16 md:py-24 bg-gray-light">
        <div class="container px-4 mx-auto">
            <div class="flex flex-col items-start gap-10 md:flex-row">
                <!-- Photo directeur -->
                <div class="w-full md:w-3/12 lg:w-3/12">
                    <div class="relative mx-auto max-w-[200px] md:max-w-none">
                        <div class="relative overflow-hidden rounded-2xl shadow-lg">
                            <img
                                :src="director.photo || '/assets/about/directeur.png'"
                                :alt="director.name || 'Directeur'"
                                class="w-full h-auto object-cover aspect-[3/4]"
                            />
                        </div>

                        <!-- Nom directeur -->
                        <div class="p-3 mt-4 text-center">
                            <h4 class="text-base font-bold text-dark">
                                {{ director.name }}
                            </h4>
                            <p class="text-xs text-gray-dark">Directeur du CHU</p>
                        </div>
                    </div>
                </div>

                <!-- Contenu textuel -->
                <div class="w-full md:w-9/12 lg:w-9/12">
                    <div class="mb-4">
                        <div class="inline-block px-3 py-1 mb-3 rounded-lg bg-primary/10">
                            <span class="text-sm font-medium text-primary">Le mot du directeur</span>
                        </div>

                        <h2 class="mb-4 text-xl font-bold text-dark">
                            Engagement envers l'excellence <span class="text-primary">medicale</span>
                        </h2>
                    </div>

                    <!-- Message avec bordure gauche -->
                    <div class="relative pl-5 mb-6 border-l-4 border-primary">
                        <div class="leading-relaxed text-gray-dark">
                            <p style="text-align: justify">
                                {{ director.message }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
