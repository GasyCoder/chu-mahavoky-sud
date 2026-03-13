<script setup>
const props = defineProps({
    emergencyNumber: {
        type: String,
        default: '+261 20 00 000 00'
    }
});
</script>

<template>
    <section class="py-10 lg:py-12 bg-gradient-to-r from-red-600 via-red-500 to-red-600 dark:from-red-700 dark:via-red-600 dark:to-red-700 relative overflow-hidden">
        <!-- Cross pattern background -->
        <div class="absolute inset-0 opacity-[0.07]">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 lg:gap-8">
                <!-- Left: Icon + Text -->
                <div class="flex items-center gap-5" data-aos="fade-right">
                    <div class="relative flex-shrink-0">
                        <div class="absolute inset-0 bg-white/20 rounded-full blur-xl animate-pulse"></div>
                        <div class="relative w-14 h-14 lg:w-16 lg:h-16 bg-white rounded-full flex items-center justify-center shadow-lg shadow-red-900/30">
                            <i class="fas fa-ambulance text-2xl lg:text-3xl text-red-600"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl lg:text-2xl font-bold text-white mb-1 tracking-tight">
                            Urgence M&eacute;dicale ?
                        </h3>
                        <p class="text-red-100 text-sm lg:text-base">
                            Notre &eacute;quipe est disponible 24h/24 et 7j/7 pour vous porter assistance
                        </p>
                    </div>
                </div>

                <!-- Right: Phone + CTA -->
                <div class="flex items-center gap-5" data-aos="fade-left">
                    <div class="text-right hidden sm:block">
                        <p class="text-red-200 text-xs font-semibold uppercase tracking-wider mb-1">Appelez-nous maintenant</p>
                        <a
                            :href="`tel:${emergencyNumber}`"
                            class="text-2xl lg:text-3xl font-extrabold text-white hover:text-red-100 transition-colors tracking-tight"
                        >
                            {{ emergencyNumber }}
                        </a>
                    </div>
                    <a
                        :href="`tel:${emergencyNumber}`"
                        class="group inline-flex items-center gap-2.5 px-6 lg:px-8 py-3.5 lg:py-4 bg-white text-red-600 font-bold rounded-xl shadow-xl shadow-red-900/20 hover:shadow-2xl hover:shadow-red-900/30 transition-all duration-300 hover:scale-[1.03] active:scale-95"
                    >
                        <i class="fas fa-phone-alt text-lg animate-pulse"></i>
                        <span class="text-base font-extrabold">Appeler</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>
