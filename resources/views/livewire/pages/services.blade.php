<div>
    <!-- Bannière de la page Services avec parallax -->
    <section class="relative h-80 bg-cover bg-center bg-fixed" style="background-image: url({{ asset('assets/services-banner.jpg') }})">
        <div class="absolute inset-0 bg-gradient-to-r from-purple/90 to-turquoise/80"></div>
        <div class="container relative flex h-full items-center justify-center">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up" data-aos-duration="1000">Nos Services</h1>
                <div class="h-1 w-20 bg-white mx-auto" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000"></div>
                <p class="mt-4 text-white max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                    L'excellence médicale et administrative au service de votre santé
                </p>
            </div>
        </div>
    </section>

    <!-- Fil d'Ariane -->
    <div class="bg-gray-light py-3">
        <div class="container">
            <div class="flex items-center text-sm">
                <a href="/" class="text-purple hover:text-turquoise transition-colors">Accueil</a>
                <span class="mx-2 text-gray-dark">/</span>
                <span class="text-gray-dark">Services</span>
            </div>
        </div>
    </div>

    <!-- Section principale avec navigation par onglets -->
    <section class="container py-16">
        <!-- Navigation par onglets -->
        <div class="mb-12 border-b border-gray" data-aos="fade-up" data-aos-duration="1000">
            <div class="flex flex-wrap -mb-px">
                <button id="tab-medical" onclick="switchTab('medical')" class="text-center py-4 px-6 text-lg font-medium border-b-2 border-purple text-purple">
                    <i class="fas fa-stethoscope mr-2"></i>Services Médicaux
                </button>
                <button id="tab-admin" onclick="switchTab('admin')" class="text-center py-4 px-6 text-lg font-medium border-b-2 border-transparent text-gray-dark hover:text-purple">
                    <i class="fas fa-briefcase mr-2"></i>Services Administratifs
                </button>
            </div>
        </div>

        <!-- Contenu des onglets -->
        <div id="content-medical" class="tab-content">
            <!-- Introduction aux services médicaux -->
            <div class="mb-10 text-center" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="text-3xl font-bold text-dark mb-4">Services Médicaux</h2>
                <p class="max-w-3xl mx-auto text-gray-dark">
                    Le CHU Mahavoky Atsimo offre une large gamme de services médicaux de pointe, assurés par des médecins spécialistes et des équipes soignantes hautement qualifiées. Nos installations modernes nous permettent de fournir des soins de qualité dans de nombreuses spécialités.
                </p>
            </div>

            <!-- Navigation services médicaux -->
            <div class="flex overflow-x-auto py-4 mb-8 scrollbar-hide" data-aos="fade-up" data-aos-duration="1000">
                <div class="flex space-x-2">
                    <a href="#cardiologie" class="whitespace-nowrap px-4 py-2 rounded-full bg-purple text-white hover:bg-turquoise transition-colors">Cardiologie</a>
                    <a href="#chirurgie" class="whitespace-nowrap px-4 py-2 rounded-full bg-gray-light text-dark hover:bg-purple hover:text-white transition-colors">Chirurgie</a>
                    <a href="#pediatrie" class="whitespace-nowrap px-4 py-2 rounded-full bg-gray-light text-dark hover:bg-purple hover:text-white transition-colors">Pédiatrie</a>
                    <a href="#gynecologie" class="whitespace-nowrap px-4 py-2 rounded-full bg-gray-light text-dark hover:bg-purple hover:text-white transition-colors">Gynécologie</a>
                    <a href="#neurologie" class="whitespace-nowrap px-4 py-2 rounded-full bg-gray-light text-dark hover:bg-purple hover:text-white transition-colors">Neurologie</a>
                    <a href="#dermatologie" class="whitespace-nowrap px-4 py-2 rounded-full bg-gray-light text-dark hover:bg-purple hover:text-white transition-colors">Dermatologie</a>
                    <a href="#ophtalmologie" class="whitespace-nowrap px-4 py-2 rounded-full bg-gray-light text-dark hover:bg-purple hover:text-white transition-colors">Ophtalmologie</a>
                    <a href="#orl" class="whitespace-nowrap px-4 py-2 rounded-full bg-gray-light text-dark hover:bg-purple hover:text-white transition-colors">ORL</a>
                    <a href="#urgences" class="whitespace-nowrap px-4 py-2 rounded-full bg-gray-light text-dark hover:bg-purple hover:text-white transition-colors">Urgences</a>
                </div>
            </div>

            <!-- Services médicaux -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                <!-- Cardiologie -->
                <div id="cardiologie" class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:-translate-y-2" data-aos="fade-up" data-aos-duration="1000">
                    <div class="relative h-48">
                        <img src="{{ asset('assets/services/cardiologie.jpg') }}" alt="Service de cardiologie" class="w-full h-full object-cover">
                        <div class="absolute top-0 right-0 bg-purple/90 text-white px-3 py-1 rounded-bl-lg">
                            <i class="fas fa-heartbeat mr-1"></i>Cardiologie
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-2 text-dark">Cardiologie</h3>
                        <p class="text-gray-dark text-sm mb-4">
                            Notre service de cardiologie assure la prise en charge des maladies cardiovasculaires avec des techniques diagnostiques et thérapeutiques avancées.
                        </p>
                        <div class="border-t border-gray-light pt-4 mt-4">
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="bg-purple/10 text-purple text-xs px-2 py-1 rounded-full">Électrocardiogramme</span>
                                <span class="bg-purple/10 text-purple text-xs px-2 py-1 rounded-full">Échocardiographie</span>
                                <span class="bg-purple/10 text-purple text-xs px-2 py-1 rounded-full">Holter</span>
                            </div>
                            <a href="#" class="inline-flex items-center text-purple hover:text-turquoise transition-colors">
                                <span>Plus de détails</span>
                                <i class="fas fa-arrow-right text-xs ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Afficher plus de services -->
            <div class="text-center mt-8 mb-16">
                <button class="px-6 py-3 bg-purple text-white rounded-md hover:bg-turquoise transition-colors">
                    <i class="fas fa-plus-circle mr-2"></i>Voir tous nos services médicaux
                </button>
            </div>
        </div>

        <!-- Services administratifs -->
        <div id="content-admin" class="tab-content hidden">
            <!-- Introduction aux services administratifs -->
            <div class="mb-10 text-center" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="text-3xl font-bold text-dark mb-4">Services Administratifs</h2>
                <p class="max-w-3xl mx-auto text-gray-dark">
                    Le CHU Mahavoky Atsimo dispose de services administratifs performants qui soutiennent les activités médicales et facilitent les démarches des patients et de leurs familles.
                </p>
            </div>

            <!-- Accordéon des services administratifs -->
            <div class="space-y-4 mb-16">
                <!-- Admission et sorties -->
                <div x-data="{ open: true }" class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up" data-aos-duration="1000">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-6 text-left focus:outline-none">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-4">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <h3 class="font-bold text-xl text-dark">Admission et sorties</h3>
                        </div>
                        <i class="fas" :class="open ? 'fa-chevron-up text-purple' : 'fa-chevron-down text-gray-dark'"></i>
                    </button>
                    <div x-show="open" class="px-6 pb-6">
                        <p class="text-gray-dark mb-4">
                            Notre service d'admission gère l'entrée et la sortie des patients, les formalités administratives et la coordination avec les différents services médicaux.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                            <div class="flex items-start">
                                <div class="text-purple mt-1 mr-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark mb-1">Horaires</h4>
                                    <p class="text-sm text-gray-dark">Lundi au vendredi: 8h - 16h</p>
                                    <p class="text-sm text-gray-dark">Samedi: 8h - 12h</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="text-purple mt-1 mr-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark mb-1">Documents nécessaires</h4>
                                    <p class="text-sm text-gray-dark">Pièce d'identité, carte d'assurance maladie, ordonnance médicale</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Facturation et paiement -->
                <div x-data="{ open: false }" class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-6 text-left focus:outline-none">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-turquoise/10 flex items-center justify-center text-turquoise mr-4">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                            <h3 class="font-bold text-xl text-dark">Facturation et paiement</h3>
                        </div>
                        <i class="fas" :class="open ? 'fa-chevron-up text-turquoise' : 'fa-chevron-down text-gray-dark'"></i>
                    </button>
                    <div x-show="open" class="px-6 pb-6">
                        <p class="text-gray-dark mb-4">
                            Notre service de facturation s'occupe de l'établissement des factures et des différentes modalités de paiement, y compris la coordination avec les assurances.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                            <div class="flex items-start">
                                <div class="text-turquoise mt-1 mr-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark mb-1">Moyens de paiement</h4>
                                    <p class="text-sm text-gray-dark">Espèces, cartes bancaires, chèques, virement bancaire</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="text-turquoise mt-1 mr-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark mb-1">Assurances partenaires</h4>
                                    <p class="text-sm text-gray-dark">Ny Havana, ARO, OSTIE, AMIT et autres mutuelles</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Archives médicales -->
                <div x-data="{ open: false }" class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-6 text-left focus:outline-none">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-4">
                                <i class="fas fa-folder-open"></i>
                            </div>
                            <h3 class="font-bold text-xl text-dark">Archives médicales</h3>
                        </div>
                        <i class="fas" :class="open ? 'fa-chevron-up text-purple' : 'fa-chevron-down text-gray-dark'"></i>
                    </button>
                    <div x-show="open" class="px-6 pb-6">
                        <p class="text-gray-dark mb-4">
                            Ce service gère la conservation et l'accès aux dossiers médicaux des patients, garantissant la confidentialité et la disponibilité des informations médicales.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                            <div class="flex items-start">
                                <div class="text-purple mt-1 mr-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark mb-1">Demande de copies</h4>
                                    <p class="text-sm text-gray-dark">Formulaire à remplir et présentation d'une pièce d'identité requise</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="text-purple mt-1 mr-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark mb-1">Délai de conservation</h4>
                                    <p class="text-sm text-gray-dark">Les dossiers sont conservés pendant 20 ans conformément à la législation</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service social -->
                <div x-data="{ open: false }" class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-6 text-left focus:outline-none">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-turquoise/10 flex items-center justify-center text-turquoise mr-4">
                                <i class="fas fa-hands-helping"></i>
                            </div>
                            <h3 class="font-bold text-xl text-dark">Service social</h3>
                        </div>
                        <i class="fas" :class="open ? 'fa-chevron-up text-turquoise' : 'fa-chevron-down text-gray-dark'"></i>
                    </button>
                    <div x-show="open" class="px-6 pb-6">
                        <p class="text-gray-dark mb-4">
                            Notre service social accompagne les patients et leurs familles dans les démarches administratives et l'accès aux aides disponibles en fonction de leur situation.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                            <div class="flex items-start">
                                <div class="text-turquoise mt-1 mr-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark mb-1">Assistance aux patients</h4>
                                    <p class="text-sm text-gray-dark">Aide à l'accès aux soins pour les patients en difficulté financière</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="text-turquoise mt-1 mr-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark mb-1">Coordination</h4>
                                    <p class="text-sm text-gray-dark">Liaison avec les services sociaux extérieurs et les organisations d'aide</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 </div>
