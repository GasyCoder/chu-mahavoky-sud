<script setup>
import { Link } from '@inertiajs/vue3';
import SectionHeader from '@/Components/Ui/SectionHeader.vue';

const props = defineProps({
    doctors: {
        type: Array,
        default: () => []
    }
});

const defaultDoctors = [
    { id: 1, name: 'Dr. Sophie Martin', specialty: 'Cardiologue', image: '/assets/herobg.jpg' },
    { id: 2, name: 'Dr. Jean Rakoto', specialty: 'Pédiatre', image: '/assets/herobg.jpg' },
    { id: 3, name: 'Dr. Marie Andriana', specialty: 'Gynécologue', image: '/assets/herobg.jpg' },
    { id: 4, name: 'Dr. Pierre Razafy', specialty: 'Chirurgien', image: '/assets/herobg.jpg' }
];

const doctorsList = props.doctors.length > 0 ? props.doctors : defaultDoctors;

const handleImageError = (e) => {
    e.target.src = '/assets/herobg.jpg';
};
</script>

<template>
    <section class="py-20 lg:py-28 bg-background border-b border-border/40">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <SectionHeader
                label="Équipe Médicale"
                title="Nos Experts de Santé"
                description="Une équipe de médecins spécialistes dévoués à votre bien-être et à votre santé."
            />

            <!-- Doctors Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10">
                <div
                    v-for="(doctor, index) in doctorsList"
                    :key="doctor.id"
                    class="group flex flex-col items-center text-center"
                    data-aos="fade-up"
                    :data-aos-delay="index * 100"
                >
                    <!-- Photo circle -->
                    <div class="relative w-44 h-44 lg:w-48 lg:h-48 mb-6">
                        <div class="absolute inset-0 bg-primary/5 dark:bg-primary/10 rounded-full scale-110 group-hover:scale-[1.2] group-hover:bg-primary/10 dark:group-hover:bg-primary/20 transition-all duration-700"></div>
                        <div class="relative w-full h-full rounded-full overflow-hidden border-2 border-border group-hover:border-primary/40 shadow-lg group-hover:shadow-xl transition-all duration-500">
                            <img
                                :src="doctor.image_url || doctor.image"
                                :alt="doctor.name"
                                @error="handleImageError"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            />
                        </div>
                    </div>

                    <!-- Info -->
                    <h3 class="text-lg font-bold text-foreground tracking-tight group-hover:text-primary transition-colors duration-300">
                        {{ doctor.name }}
                    </h3>
                    <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-muted-foreground mt-1.5">
                        {{ doctor.specialty }}
                    </p>

                    <!-- Social links (reveal on hover) -->
                    <div class="mt-5 flex items-center justify-center gap-2.5 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                        <a
                            href="#"
                            class="w-8 h-8 rounded-full bg-muted flex items-center justify-center text-muted-foreground hover:bg-primary hover:text-primary-foreground transition-colors duration-300"
                        >
                            <i class="fab fa-linkedin-in text-xs"></i>
                        </a>
                        <a
                            href="#"
                            class="w-8 h-8 rounded-full bg-muted flex items-center justify-center text-muted-foreground hover:bg-primary hover:text-primary-foreground transition-colors duration-300"
                        >
                            <i class="fas fa-envelope text-xs"></i>
                        </a>
                        <Link
                            :href="route('contact')"
                            class="w-8 h-8 rounded-full bg-muted flex items-center justify-center text-muted-foreground hover:bg-primary hover:text-primary-foreground transition-colors duration-300"
                        >
                            <i class="far fa-calendar-alt text-xs"></i>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
