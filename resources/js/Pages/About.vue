<script setup>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PageBanner from '@/Components/Ui/PageBanner.vue';
import Card from '@/Components/Ui/Card.vue';

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
        <PageBanner
            title="A propos du CHU"
            description="Centre Hospitalier Universitaire Mahavoky Atsimo - Excellence medicale au service de tous"
            label="CHU Mahajanga"
            :breadcrumbs="[
                { label: 'Accueil', route: 'home' },
                { label: 'A propos' }
            ]"
        />

        <!-- Section principale -->
        <section class="py-12 md:py-16 bg-background">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex flex-col-reverse lg:flex-row gap-8">
                    <!-- Sidebar -->
                    <div class="w-full lg:w-1/4">
                        <div class="sticky top-28">
                            <Card :padding="false">
                                <nav class="p-4">
                                    <ul class="space-y-1">
                                        <li>
                                            <a
                                                href="#histoire"
                                                class="flex items-center rounded-lg p-2.5 text-sm text-foreground hover:bg-primary/5 hover:text-primary transition-colors"
                                            >
                                                <i class="far fa-history mr-3 w-4 text-center text-primary text-xs"></i>
                                                Notre histoire
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                href="#directeurs"
                                                class="flex items-center rounded-lg p-2.5 text-sm text-foreground hover:bg-primary/5 hover:text-primary transition-colors"
                                            >
                                                <i class="far fa-user-md mr-3 w-4 text-center text-primary text-xs"></i>
                                                Directeurs
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                href="#organigramme"
                                                class="flex items-center rounded-lg p-2.5 text-sm text-foreground hover:bg-primary/5 hover:text-primary transition-colors"
                                            >
                                                <i class="far fa-sitemap mr-3 w-4 text-center text-primary text-xs"></i>
                                                Organigramme
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                href="#decret"
                                                class="flex items-center rounded-lg p-2.5 text-sm text-foreground hover:bg-primary/5 hover:text-primary transition-colors"
                                            >
                                                <i class="far fa-file-alt mr-3 w-4 text-center text-primary text-xs"></i>
                                                Textes & Decrets
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </Card>
                        </div>
                    </div>

                    <!-- Contenu principal -->
                    <div class="w-full lg:w-3/4 space-y-12">
                        <!-- Notre histoire -->
                        <section id="histoire" data-aos="fade-up">
                            <h4 class="text-2xl font-bold text-foreground mb-2">Notre histoire</h4>
                            <div class="w-10 h-1 bg-primary rounded-full mb-6"></div>

                            <div class="prose dark:prose-invert max-w-none">
                                <p class="text-muted-foreground text-sm leading-relaxed mb-3">
                                    Le Centre Hospitalier Universitaire Mahavoky Atsimo a ete fonde en [annee] avec pour mission de devenir un etablissement de sante de reference a Madagascar. Depuis sa creation, l'hopital n'a cesse d'evoluer pour repondre aux besoins de sante croissants de la population.
                                </p>

                                <p class="text-muted-foreground text-sm leading-relaxed mb-3">
                                    Situe au coeur de Mahajanga, notre etablissement a connu plusieurs phases d'agrandissement et de modernisation, avec l'ajout de nouveaux departements, l'acquisition d'equipements medicaux de pointe et le renforcement de nos equipes medicales et paramedicales.
                                </p>

                                <p class="text-muted-foreground text-sm leading-relaxed">
                                    Au fil des annees, le CHU Mahavoky Atsimo s'est impose comme un acteur majeur de la sante publique dans la region, formant des generations de professionnels de sante et participant activement a la recherche medicale.
                                </p>
                            </div>
                        </section>

                        <!-- Directeurs -->
                        <section id="directeurs" data-aos="fade-up">
                            <h4 class="text-2xl font-bold text-foreground mb-2">Nos directeurs</h4>
                            <div class="w-10 h-1 bg-primary rounded-full mb-6"></div>

                            <div class="mb-6">
                                <h3 class="text-base font-medium text-primary mb-3 flex items-center">
                                    <span class="w-1 h-4 bg-primary rounded mr-2"></span>Directeur actuel
                                </h3>
                                <Card :padding="false" hoverable>
                                    <div class="flex flex-col md:flex-row">
                                        <div class="md:w-1/3 relative">
                                            <img
                                                :src="director.photo"
                                                :alt="director.name"
                                                class="w-full h-full object-cover min-h-[240px]"
                                            />
                                            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/70 to-transparent p-4 text-white">
                                                <h4 class="text-lg font-bold">{{ director.name }}</h4>
                                                <p class="text-sm text-white/80">Directeur general depuis 2020</p>
                                            </div>
                                        </div>
                                        <div class="md:w-2/3 p-5 md:p-6">
                                            <div class="flex items-center mb-3">
                                                <div class="bg-primary/10 text-primary p-1.5 rounded-lg mr-2">
                                                    <i class="fas fa-quote-left text-xs"></i>
                                                </div>
                                                <h5 class="text-base font-medium text-foreground">Vision & leadership</h5>
                                            </div>
                                            <p class="text-muted-foreground text-sm mb-4 leading-relaxed">
                                                Medecin specialiste en administration de la sante, le Dr. HABIB a apporte une vision nouvelle pour le developpement du CHU Mahavoky Atsimo, basee sur l'excellence medicale, l'humanisation des soins et l'accessibilite pour tous.
                                            </p>
                                            <div class="flex mt-4 gap-2">
                                                <Link
                                                    href="/contact"
                                                    class="inline-flex items-center gap-1.5 bg-primary text-white text-xs px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors font-medium"
                                                >
                                                    <i class="far fa-envelope"></i> Contact
                                                </Link>
                                                <Link
                                                    href="/a-propos"
                                                    class="inline-flex items-center gap-1.5 border border-border text-foreground text-xs px-4 py-2 rounded-lg hover:bg-muted transition-colors font-medium"
                                                >
                                                    <i class="far fa-info-circle"></i> Plus d'informations
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                </Card>
                            </div>
                        </section>

                        <!-- Organigramme -->
                        <section id="organigramme" data-aos="fade-up">
                            <h4 class="text-2xl font-bold text-foreground mb-2">Organigramme</h4>
                            <div class="w-10 h-1 bg-primary rounded-full mb-6"></div>

                            <Card>
                                <div class="text-center py-8">
                                    <div class="w-16 h-16 bg-muted rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-sitemap text-2xl text-muted-foreground"></i>
                                    </div>
                                    <p class="text-muted-foreground text-sm">L'organigramme sera bientot disponible.</p>
                                </div>
                            </Card>
                        </section>

                        <!-- Textes & Decrets -->
                        <section id="decret" data-aos="fade-up">
                            <h4 class="text-2xl font-bold text-foreground mb-2">Textes & Decrets</h4>
                            <div class="w-10 h-1 bg-primary rounded-full mb-6"></div>

                            <Card>
                                <div class="text-center py-8">
                                    <div class="w-16 h-16 bg-muted rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-file-alt text-2xl text-muted-foreground"></i>
                                    </div>
                                    <p class="text-muted-foreground text-sm">Les textes et decrets seront bientot disponibles.</p>
                                </div>
                            </Card>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
