<script setup>
const features = [
    {
        icon: 'fa-microscope',
        title: 'Laboratoire Moderne',
        description: 'Équipements de pointe pour des analyses précises et rapides',
        image: 'https://images.unsplash.com/photo-1579154204601-01588f351e67?w=600&h=400&fit=crop'
    },
    {
        icon: 'fa-procedures',
        title: 'Blocs Opératoires',
        description: 'Salles d\'opération stériles avec technologies avancées',
        image: 'https://images.unsplash.com/photo-1551076805-e1869033e561?w=600&h=400&fit=crop'
    },
    {
        icon: 'fa-x-ray',
        title: 'Imagerie Médicale',
        description: 'Scanner, IRM et radiologie numérique de dernière génération',
        image: 'https://images.unsplash.com/photo-1530497610245-94d3c16cda28?w=600&h=400&fit=crop'
    }
];
</script>

<template>
    <section class="py-20 md:py-28 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="inline-flex items-center space-x-2 bg-blue-100 rounded-full px-4 py-2 mb-4">
                    <i class="fas fa-hospital-alt text-blue-600 text-sm"></i>
                    <span class="text-sm font-semibold text-blue-600">Infrastructure</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Nos <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-600">Équipements</span>
                </h2>
                <div class="flex items-center justify-center space-x-2 mb-4">
                    <div class="w-16 h-1 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-full"></div>
                </div>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Des technologies médicales de pointe pour un diagnostic et un traitement optimaux
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div v-for="(feature, index) in features" :key="index"
                    class="group relative overflow-hidden rounded-3xl shadow-lg"
                    :data-aos="`fade-up`"
                    :data-aos-delay="index * 150">
                    <!-- Image -->
                    <div class="aspect-[4/3] overflow-hidden">
                        <img :src="feature.image" :alt="feature.title"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent"></div>
                    </div>

                    <!-- Content Overlay -->
                    <div class="absolute inset-0 flex flex-col justify-end p-6">
                        <div class="relative">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl flex items-center justify-center shadow-lg">
                                    <i :class="`fas ${feature.icon} text-white text-lg`"></i>
                                </div>
                                <h3 class="text-xl font-bold text-white">{{ feature.title }}</h3>
                            </div>
                            <p class="text-gray-300 text-sm leading-relaxed">
                                {{ feature.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="450">
                <a href="#contact"
                    class="inline-flex items-center space-x-2 px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-2xl shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 transition-all duration-300 hover:scale-105">
                    <span>Visiter nos installations</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>
</template>
