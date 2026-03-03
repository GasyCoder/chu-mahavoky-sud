<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
    totalServices: {
        type: Number,
        default: 0
    }
});

const counters = ref({
    value1: 0,
    value2: 0,
    value3: props.totalServices
});

const animateCounter = (target, refName, duration = 2000) => {
    const start = 0;
    const startTime = performance.now();

    const easeOutQuart = (t) => 1 - Math.pow(1 - t, 4);

    const updateCounter = (currentTime) => {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const easedProgress = easeOutQuart(progress);

        counters.value[refName] = Math.floor(start + (target - start) * easedProgress);

        if (progress < 1) {
            requestAnimationFrame(updateCounter);
        }
    };

    requestAnimationFrame(updateCounter);
};

onMounted(() => {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    animateCounter(47, 'value1', 2000);
                    animateCounter(15, 'value2', 2000);
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.5 }
    );

    const counterSection = document.getElementById('counter-section');
    if (counterSection) {
        observer.observe(counterSection);
    }

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
    <!-- Section statistiques -->
    <div id="counter-section" class="relative z-10 flex items-center h-full pb-10 text-white">
        <div class="container px-4 -mt-10 sm:px-4 sm:-mt-16 md:-mt-20">
            <div class="w-full">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                    <!-- Stat 1 - Medecins -->
                    <div class="bg-white rounded-2xl shadow-sm p-6 flex items-center gap-4" data-aos="fade-up">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-12 h-12 bg-primary/10 rounded-xl">
                                <i class="fa fa-user-md text-lg text-primary"></i>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-end">
                                <span class="text-2xl md:text-3xl font-bold text-dark">{{ counters.value1 }}</span>
                                <span class="text-xl font-bold text-primary ml-0.5">+</span>
                            </div>
                            <h5 class="text-sm font-medium text-dark">Medecins specialistes</h5>
                            <p class="text-gray-dark text-xs">Une equipe medicale qualifiee</p>
                        </div>
                    </div>

                    <!-- Stat 2 - Patients -->
                    <div class="bg-white rounded-2xl shadow-sm p-6 flex items-center gap-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-12 h-12 bg-primary/10 rounded-xl">
                                <i class="fa fa-procedures text-lg text-primary"></i>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-end">
                                <span class="text-2xl md:text-3xl font-bold text-dark">{{ counters.value2 }}</span>
                                <span class="text-xl font-bold text-primary ml-0.5">k+</span>
                            </div>
                            <h5 class="text-sm font-medium text-dark">Patients satisfaits</h5>
                            <p class="text-gray-dark text-xs">Des soins de qualite pour tous</p>
                        </div>
                    </div>

                    <!-- Stat 3 - Services -->
                    <div class="bg-white rounded-2xl shadow-sm p-6 flex items-center gap-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-12 h-12 bg-primary/10 rounded-xl">
                                <i class="fa fa-stethoscope text-lg text-primary"></i>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-end">
                                <span class="text-2xl md:text-3xl font-bold text-dark">{{ counters.value3 }}</span>
                            </div>
                            <h5 class="text-sm font-medium text-dark">Services</h5>
                            <p class="text-gray-dark text-xs">Departements et services</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
