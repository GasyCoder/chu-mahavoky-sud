<script setup>
import { ref, onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    settings: {
        type: Object,
        default: () => ({})
    }
});

const director = ref(props.settings?.director || {
    name: 'Dr. HABIB',
    photo: '/assets/about/directeur.png'
});

onMounted(() => {
    // Initialiser AOS pour les animations
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
    <AppLayout 
        title="A propos du CHU"
        :settings="settings"
    >
        <!-- Banner -->
        <section 
            class="relative h-[40vh] bg-cover bg-center bg-fixed"
            :style="{ backgroundImage: `url(${ '/assets/about-banner.jpg' })` }"
        >
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900/80 to-primary/50"></div>
            <div class="container relative flex h-full items-center justify-center">
                <div class="text-center">
                    <h1 
                        class="text-4xl font-bold text-white mb-3" 
                        data-aos="fade-up" 
                        data-aos-duration="1000"
                    >
                        A propos du CHU
                    </h1>
                    <p 
                        class="mt-3 text-sm md:text-base text-white/70 max-w-lg mx-auto px-4" 
                        data-aos="fade-up" 
                        data-aos-delay="400" 
                        data-aos-duration="1000"
                    >
                        Centre Hospitalier Universitaire Mahavoky Atsimo - Excellence medicale au service de tous
                    </p>
                </div>
            </div>
        </section>

        <!-- Breadcrumb -->
        <div class="bg-gray-light py-2">
            <div class="container">
                <div class="flex items-center text-xs">
                    <Link href="/" class="text-primary hover:text-primary/80 transition-colors">Accueil</Link>
                    <span class="mx-2 text-gray-dark">/</span>
                    <span class="text-gray-dark">A propos</span>
                </div>
            </div>
        </div>

        <!-- Section principale -->
        <section class="container py-12 md:py-16">
            <div class="flex flex-col-reverse lg:flex-row gap-8">
                <!-- Sidebar -->
                <div class="w-full lg:w-1/4">
                    <div class="sticky top-24 rounded-2xl bg-white p-4 shadow-sm">
                        <ul class="space-y-1">
                            <li>
                                <a 
                                    href="#histoire" 
                                    class="flex items-center rounded-lg p-2.5 text-sm text-dark hover:bg-primary/5 hover:text-primary transition-colors"
                                >
                                    <i class="far fa-history mr-3 w-4 text-center text-primary text-xs"></i> 
                                    Notre histoire
                                </a>
                            </li>
                            <li>
                                <a 
                                    href="#directeurs" 
                                    class="flex items-center rounded-lg p-2.5 text-sm text-dark hover:bg-primary/5 hover:text-primary transition-colors"
                                >
                                    <i class="far fa-user-md mr-3 w-4 text-center text-primary text-xs"></i> 
                                    Directeurs
                                </a>
                            </li>
                            <li>
                                <a 
                                    href="#organigramme" 
                                    class="flex items-center rounded-lg p-2.5 text-sm text-dark hover:bg-primary/5 hover:text-primary transition-colors"
                                >
                                    <i class="far fa-sitemap mr-3 w-4 text-center text-primary text-xs"></i> 
                                    Organigramme
                                </a>
                            </li>
                            <li>
                                <a 
                                    href="#decret" 
                                    class="flex items-center rounded-lg p-2.5 text-sm text-dark hover:bg-primary/5 hover:text-primary transition-colors"
                                >
                                    <i class="far fa-file-alt mr-3 w-4 text-center text-primary text-xs"></i> 
                                    Textes & Decrets
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Contenu principal -->
                <div class="w-full lg:w-3/4">
                    <!-- Notre histoire -->
                    <section id="histoire" class="mb-12">
                        <h4 class="text-2xl font-bold text-dark mb-2">Notre histoire</h4>
                        <div class="w-10 h-1 bg-primary rounded-full mb-6"></div>

                        <div class="prose max-w-none">
                            <p class="text-gray-dark text-sm leading-relaxed mb-3">
                                Le Centre Hospitalier Universitaire Mahavoky Atsimo a ete fonde en [annee] avec pour mission de devenir un etablissement de sante de reference a Madagascar. Depuis sa creation, l'hopital n'a cesse d'evoluer pour repondre aux besoins de sante croissants de la population.
                            </p>

                            <p class="text-gray-dark text-sm leading-relaxed mb-3">
                                Situe au coeur de Mahajanga, notre etablissement a connu plusieurs phases d'agrandissement et de modernisation, avec l'ajout de nouveaux departements, l'acquisition d'equipements medicaux de pointe et le renforcement de nos equipes medicales et paramedicales.
                            </p>

                            <p class="text-gray-dark text-sm leading-relaxed">
                                Au fil des annees, le CHU Mahavoky Atsimo s'est impose comme un acteur majeur de la sante publique dans la region, formant des generations de professionnels de sante et participant activement a la recherche medicale.
                            </p>
                        </div>
                    </section>

                    <!-- Directeurs -->
                    <section id="directeurs" class="mb-12">
                        <h4 class="text-2xl font-bold text-dark mb-2">Nos directeurs</h4>
                        <div class="w-10 h-1 bg-primary rounded-full mb-6"></div>

                        <div class="mb-6">
                            <h3 class="text-base font-medium text-primary mb-3 flex items-center">
                                <span class="w-1 h-4 bg-primary rounded mr-2"></span>Directeur actuel
                            </h3>
                            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                                <div class="flex flex-col md:flex-row">
                                    <div class="md:w-1/3 relative">
                                        <img 
                                            :src="director.photo"
                                            :alt="director.name"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-slate-900/70 to-transparent p-3 text-white">
                                            <h4 class="text-lg font-bold">{{ director.name }}</h4>
                                            <p class="text-sm">Directeur general depuis 2020</p>
                                        </div>
                                    </div>
                                    <div class="md:w-2/3 p-5 md:p-6">
                                        <div class="flex items-center mb-3">
                                            <div class="bg-primary/10 text-primary p-1.5 rounded-lg mr-2">
                                                <i class="fas fa-quote-left text-xs"></i>
                                            </div>
                                            <h5 class="text-base font-medium text-dark">Vision & leadership</h5>
                                        </div>
                                        <p class="text-gray-dark text-sm mb-4">
                                            Medecin specialiste en administration de la sante, le Dr. HABIB a apporte une vision nouvelle pour le developpement du CHU Mahavoky Atsimo, basee sur l'excellence medicale, l'humanisation des soins et l'accessibilite pour tous.
                                        </p>
                                        <div class="flex mt-4 gap-2">
                                            <Link 
                                                href="/contact" 
                                                class="inline-flex items-center gap-1.5 bg-primary text-white text-xs px-4 py-2 rounded-xl hover:bg-primary/90 transition-colors"
                                            >
                                                <i class="far fa-envelope"></i> Contact
                                            </Link>
                                            <Link 
                                                href="/a-propos" 
                                                class="inline-flex items-center gap-1.5 bg-transparent text-primary text-xs px-4 py-2 rounded-xl hover:bg-primary/10 transition-colors"
                                            >
                                                <i class="far fa-info-circle"></i> Plus d'informations
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
