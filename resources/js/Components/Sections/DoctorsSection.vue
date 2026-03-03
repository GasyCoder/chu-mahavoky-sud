<script setup>
import { Link } from '@inertiajs/vue3';

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
    <section class="py-24 bg-background border-b border-border/40">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Header Slim -->
            <div class="text-center max-w-2xl mx-auto mb-20" data-aos="fade-up">
                <span class="text-primary text-[10px] font-bold uppercase tracking-[0.2em]">Équipe Médicale</span>
                <h2 class="text-3xl lg:text-4xl font-bold mt-4 mb-6 tracking-tight text-foreground">Nos Experts de Santé</h2>
                <div class="w-12 h-1 bg-primary/20 mx-auto rounded-full"></div>
            </div>

            <!-- Doctors Grid Slim -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div v-for="(doctor, index) in doctorsList" :key="doctor.id"
                    class="group flex flex-col items-center text-center"
                    data-aos="fade-up" :data-aos-delay="index * 100">
                    
                    <div class="relative w-48 h-48 mb-6">
                        <div class="absolute inset-0 bg-primary/5 rounded-full scale-110 group-hover:scale-125 transition-transform duration-700"></div>
                        <div class="relative w-full h-full rounded-full overflow-hidden border border-border shadow-xl">
                            <img :src="doctor.image_url || doctor.image" :alt="doctor.name"
                                @error="handleImageError"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-foreground tracking-tight group-hover:text-primary transition-colors">{{ doctor.name }}</h3>
                    <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-muted-foreground mt-1">{{ doctor.specialty }}</p>
                    
                    <div class="mt-6 flex items-center justify-center space-x-3 opacity-0 group-hover:opacity-100 transition-all transform translate-y-2 group-hover:translate-y-0">
                        <a href="#" class="w-8 h-8 rounded-full bg-muted flex items-center justify-center text-muted-foreground hover:bg-primary hover:text-white transition-colors">
                            <i class="fab fa-linkedin-in text-xs"></i>
                        </a>
                        <Link :href="route('contact')" class="w-8 h-8 rounded-full bg-muted flex items-center justify-center text-muted-foreground hover:bg-primary hover:text-white transition-colors">
                            <i class="far fa-calendar-alt text-xs"></i>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
