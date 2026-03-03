<script setup>
const props = defineProps({
    emergencyNumber: {
        type: String,
        default: '+261 20 00 000 00'
    }
});
</script>

<template>
    <section class="py-12 bg-gradient-to-r from-red-600 via-red-500 to-red-600 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <!-- Content -->
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <div class="absolute inset-0 bg-white/30 rounded-full blur-xl animate-pulse"></div>
                        <div class="relative w-16 h-16 bg-white rounded-full flex items-center justify-center">
                            <i class="fas fa-ambulance text-3xl text-red-600"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-1">Urgence Médicale ?</h3>
                        <p class="text-red-100">Notre équipe est disponible 24h/24 et 7j/7 pour vous porter assistance</p>
                    </div>
                </div>

                <!-- Call Button -->
                <div class="flex items-center space-x-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-red-100 text-sm">Appelez-nous maintenant</p>
                        <a :href="`tel:${emergencyNumber}`" class="text-3xl font-bold text-white hover:text-red-100 transition-colors">
                            {{ emergencyNumber }}
                        </a>
                    </div>
                    <a :href="`tel:${emergencyNumber}`"
                        class="group flex items-center space-x-3 px-8 py-4 bg-white text-red-600 font-bold rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <i class="fas fa-phone-alt text-xl animate-pulse"></i>
                        <span class="text-lg">Appeler</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>
