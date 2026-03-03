<script setup>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    siteInfo: {
        type: Object,
        default: () => ({})
    },
    showVideo: {
        type: Boolean,
        default: false
    }
});

const videoOpen = ref(false);
const videoUrl = ref('');

const openVideo = () => {
    videoOpen.value = true;
    if (props.siteInfo?.presentation_video) {
        videoUrl.value = props.siteInfo.presentation_video;
    }
};

const closeVideo = () => {
    videoOpen.value = false;
    videoUrl.value = '';
};

onMounted(() => {
    if (typeof AOS !== 'undefined') {
        AOS.init({
            once: true,
            duration: 800,
            offset: 50
        });
    }
});
</script>

<template>
    <!-- Hero Section - Taille réduite de 80vh à 50vh -->
    <header 
        class="relative h-[50vh] sm:h-[50vh] md:h-[50vh] bg-cover bg-center bg-no-repeat overflow-hidden"
        :style="{ backgroundImage: `url(${siteInfo?.background || '/assets/herobg.jpg'})` }"
    >
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900/70 to-primary/40"></div>

        <div class="relative z-10 flex items-center justify-center h-full">
            <div class="container px-4 py-12 md:py-16">
                <div class="max-w-3xl">
                    <!-- Badge description -->
                    <div 
                        class="inline-block bg-white/15 backdrop-blur-md rounded-xl px-4 py-2 mb-5" 
                        data-aos="fade-right" 
                        data-aos-duration="700"
                    >
                        <h4 class="text-lg font-medium tracking-wide text-white">
                            {{ siteInfo?.description || 'Centre Hospitalier Universitaire' }}
                        </h4>
                    </div>

                    <!-- Titre principal -->
                    <h1 
                        class="mb-5 text-3xl font-bold leading-tight tracking-wide text-white sm:text-4xl md:text-4xl lg:text-4xl" 
                        data-aos="fade-right" 
                        data-aos-duration="900"
                    >
                        {{ siteInfo?.name || 'MAHAVOKY ATSIMO' }}
                    </h1>

                    <!-- Slogan -->
                    <div 
                        class="max-w-2xl mb-8" 
                        data-aos="fade-right" 
                        data-aos-duration="1000" 
                        data-aos-delay="100"
                    >
                        <p class="text-lg leading-relaxed text-white/80">
                            {{ siteInfo?.slogan || 'Offrir des soins de qualite et une prise en charge optimale pour instaurer une confiance durable.' }}
                        </p>
                    </div>

                    <!-- CTAs -->
                    <div 
                        class="flex flex-wrap items-start justify-between sm:flex-row sm:items-center"
                        data-aos="fade-up"
                        data-aos-duration="800"
                    >
                        <div class="flex flex-wrap items-start gap-4">
                            <!-- CTA principal -->
                            <Link 
                                :href="route('services')"
                                class="inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-white transition-all duration-300 rounded-xl shadow-lg bg-primary hover:bg-primary/90 group"
                            >
                                <span>Nos services</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </Link>

                            <!-- Bouton video -->
                            <button 
                                v-if="showVideo"
                                @click="openVideo"
                                class="inline-flex items-center cursor-pointer group"
                            >
                                <div class="relative flex items-center justify-center mr-3">
                                    <div class="flex items-center justify-center w-12 h-12 transition-all duration-300 rounded-full bg-white/20 backdrop-blur-sm group-hover:bg-white/30">
                                        <span class="flex items-center justify-center w-9 h-9 bg-white rounded-full">
                                            <i class="text-sm text-primary fas fa-play ml-0.5"></i>
                                        </span>
                                    </div>
                                </div>
                                <span class="text-sm font-medium text-white/80 transition-colors duration-300 group-hover:text-white">Voir la presentation</span>
                            </button>
                        </div>

                        <!-- Logo ministere -->
                        <a 
                            :href="siteInfo?.ministry_url || 'https://www.msanp.gov.mg/'" 
                            target="_blank"
                            class="absolute right-10 sm:right-23 md:right-32 flex items-center justify-center p-1.5 transition-all duration-300 rounded-xl shadow-md bg-white/80 hover:bg-white opacity-70 hover:opacity-100"
                        >
                            <img :src="siteInfo?.ministry_logo || '/assets/minsante.png'" alt="Ministere de la Sante" class="h-14 md:h-16">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Modal Video -->
    <Teleport to="body">
        <div 
            v-if="videoOpen"
            class="fixed inset-0 z-[99999] flex items-center justify-center bg-black bg-opacity-80 backdrop-blur-sm"
            @click="closeVideo"
        >
            <div 
                class="relative aspect-[16/9] w-[95%] max-w-4xl rounded-2xl shadow-2xl"
                @click.stop
            >
                <button
                    @click="closeVideo"
                    class="absolute right-0 text-xl text-white transition-colors duration-300 cursor-pointer -top-10 hover:text-white/80"
                >
                    <i class="fa fa-times"></i>
                </button>
                <iframe
                    v-if="videoUrl"
                    :src="videoUrl"
                    class="w-full h-full rounded-2xl"
                    title="Video de presentation"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allowfullscreen
                ></iframe>
            </div>
        </div>
    </Teleport>
</template>
