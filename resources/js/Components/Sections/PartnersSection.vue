<script setup>
const partners = [
    { name: 'Ministère de la Santé', logo: '/assets/minsante.png' },
    { name: 'OMS', logo: 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c5/WHO_logo.svg/200px-WHO_logo.svg.png' },
    { name: 'UNICEF', logo: 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/UNICEF_logo.svg/200px-UNICEF_logo.svg.png' },
    { name: 'Croix Rouge', logo: 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/94/ICRC_logo.svg/200px-ICRC_logo.svg.png' },
    { name: 'Médecins Sans Frontières', logo: 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/35/MSF_Logo.svg/200px-MSF_Logo.svg.png' },
    { name: 'Gavi', logo: 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/Gavi%2C_the_Vaccine_Alliance_logo.svg/200px-Gavi%2C_the_Vaccine_Alliance_logo.svg.png' },
];
</script>

<template>
    <section class="py-16 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12" data-aos="fade-up">
                <div class="inline-flex items-center space-x-2 bg-blue-100 rounded-full px-4 py-2 mb-4">
                    <i class="fas fa-handshake text-blue-600 text-sm"></i>
                    <span class="text-sm font-semibold text-blue-600">Nos Partenaires</span>
                </div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">
                    Ils nous font confiance
                </h2>
                <div class="flex items-center justify-center space-x-2">
                    <div class="w-12 h-1 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-full"></div>
                </div>
            </div>

            <!-- Partners Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                <div v-for="(partner, index) in partners" :key="index"
                    class="group bg-white rounded-2xl shadow-md shadow-slate-200/50 p-6 flex items-center justify-center hover:shadow-xl hover:shadow-blue-500/15 transition-all duration-300 hover:-translate-y-1"
                    :data-aos="`fade-up`"
                    :data-aos-delay="index * 50">
                    <img :src="partner.logo" :alt="partner.name"
                        class="max-h-12 w-auto object-contain opacity-60 group-hover:opacity-100 transition-opacity duration-300 grayscale group-hover:grayscale-0" />
                </div>
            </div>
        </div>
    </section>
</template>
