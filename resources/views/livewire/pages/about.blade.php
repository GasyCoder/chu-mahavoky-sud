<div>
    <!-- Bannière de la page À propos avec parallax - design plus épuré -->
    <section class="relative h-60 sm:h-64 md:h-72 bg-cover bg-center bg-fixed" style="background-image: url({{ asset('assets/about-banner.jpg') }})">
        <div class="absolute inset-0 bg-gradient-to-r from-purple/85 to-turquoise/75"></div>
        <div class="container relative flex h-full items-center justify-center">
            <div class="text-center">
                <h1 class="text-xl md:text-xl font-bold text-white mb-3" data-aos="fade-up" data-aos-duration="1000">À propos du CHU</h1>
                <div class="h-0.5 w-16 bg-white mx-auto" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000"></div>
                <p class="mt-3 text-sm md:text-base text-white/90 max-w-lg mx-auto px-4" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                    Centre Hospitalier Universitaire Mahavoky Atsimo - Excellence médicale au service de tous
                </p>
            </div>
        </div>
    </section>

    <!-- Fil d'Ariane - style plus compact -->
    <div class="bg-gray-light py-2">
        <div class="container">
            <div class="flex items-center text-xs">
                <a href="/" class="text-purple hover:text-turquoise transition-colors">Accueil</a>
                <span class="mx-2 text-gray-dark">/</span>
                <span class="text-gray-dark">À propos</span>
            </div>
        </div>
    </div>

    <!-- Section principale avec sidebar -->
    <section class="container py-10 md:py-12">
        <div class="flex flex-col-reverse lg:flex-row gap-8">
            <!-- Sidebar - design plus léger et compact -->
            <div class="w-full lg:w-1/4">
                <div class="sticky top-24 rounded-md bg-white p-5 shadow-md">

                    <ul class="space-y-1">
                        <li>
                            <a href="#histoire" class="flex items-center rounded-md p-2 text-sm text-dark hover:bg-purple/5 hover:text-purple transition-colors">
                                <i class="fas fa-history mr-3 w-4 text-center text-purple text-xs"></i> Notre histoire
                            </a>
                        </li>
                        <li>
                            <a href="#directeurs" class="flex items-center rounded-md p-2 text-sm text-dark hover:bg-purple/5 hover:text-purple transition-colors">
                                <i class="fas fa-user-md mr-3 w-4 text-center text-purple text-xs"></i> Directeurs
                            </a>
                        </li>
                        <li>
                            <a href="#organigramme" class="flex items-center rounded-md p-2 text-sm text-dark hover:bg-purple/5 hover:text-purple transition-colors">
                                <i class="fas fa-sitemap mr-3 w-4 text-center text-purple text-xs"></i> Organigramme
                            </a>
                        </li>
                        <li>
                            <a href="#decret" class="flex items-center rounded-md p-2 text-sm text-dark hover:bg-purple/5 hover:text-purple transition-colors">
                                <i class="fas fa-file-alt mr-3 w-4 text-center text-purple text-xs"></i> Textes & Décrets
                            </a>
                        </li>
                    </ul>

                    <!-- Contact rapide avec design plus léger -->
                    <div class="mt-6 pt-4 border-t border-gray-100">
                        <h5 class="text-base font-medium text-dark mb-3">Besoin d'informations?</h5>
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-8 h-8 rounded-full bg-purple/10 flex items-center justify-center text-purple">
                                <i class="fas fa-phone text-xs"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-dark">Appelez-nous</p>
                                <a href="tel:+261340000000" class="text-purple text-sm font-medium">+261 34 00 000 00</a>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-purple/10 flex items-center justify-center text-purple">
                                <i class="fas fa-envelope text-xs"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-dark">Email</p>
                                <a href="mailto:contact@chumahavaky.mg" class="text-purple text-sm font-medium">contact@chumahavaky.mg</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenu principal - titres réduits et espacement optimisé -->
            <div class="w-full lg:w-3/4">
                <!-- Notre histoire -->
                <section id="histoire" class="mb-12">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-3">
                            <i class="fas fa-history text-sm"></i>
                        </div>
                        <h4 class="text-sm md:text-sm font-bold text-dark">Notre histoire</h4>
                    </div>

                    <div class="prose max-w-none">
                        <p class="text-gray-dark text-sm leading-relaxed mb-3">Le Centre Hospitalier Universitaire Mahavoky Atsimo a été fondé en [année] avec pour mission de devenir un établissement de santé de référence à Madagascar. Depuis sa création, l'hôpital n'a cessé d'évoluer pour répondre aux besoins de santé croissants de la population.</p>

                        <p class="text-gray-dark text-sm leading-relaxed mb-3">Situé au cœur de Mahajanga, notre établissement a connu plusieurs phases d'agrandissement et de modernisation, avec l'ajout de nouveaux départements, l'acquisition d'équipements médicaux de pointe et le renforcement de nos équipes médicales et paramédicales.</p>

                        <p class="text-gray-dark text-sm leading-relaxed">Au fil des années, le CHU Mahavoky Atsimo s'est imposé comme un acteur majeur de la santé publique dans la région, formant des générations de professionnels de santé et participant activement à la recherche médicale.</p>
                    </div>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="overflow-hidden rounded-md shadow-sm" data-aos="fade-up" data-aos-duration="1000">
                            <img src="{{ asset('assets/about/history-1.jpg') }}" alt="Ancien bâtiment du CHU" class="w-full h-48 object-cover hover:scale-105 transition-transform duration-500">
                            <div class="p-2 bg-white">
                                <p class="text-xs text-center text-gray-dark">1985 - Fondation</p>
                            </div>
                        </div>
                        <div class="overflow-hidden rounded-md shadow-sm" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                            <img src="{{ asset('assets/about/history-2.jpg') }}" alt="CHU en développement" class="w-full h-48 object-cover hover:scale-105 transition-transform duration-500">
                            <div class="p-2 bg-white">
                                <p class="text-xs text-center text-gray-dark">2000 - Expansion</p>
                            </div>
                        </div>
                        <div class="overflow-hidden rounded-md shadow-sm" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                            <img src="{{ asset('assets/about/history-3.jpg') }}" alt="CHU aujourd'hui" class="w-full h-48 object-cover hover:scale-105 transition-transform duration-500">
                            <div class="p-2 bg-white">
                                <p class="text-xs text-center text-gray-dark">2020 - Modernisation</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Directeurs -->
                <section id="directeurs" class="mb-12">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-3">
                            <i class="fas fa-user-md text-sm"></i>
                        </div>
                        <h4 class="text-sm md:text-sm font-bold text-dark">Nos directeurs</h4>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-base font-medium text-purple mb-3 flex items-center">
                            <span class="w-1 h-4 bg-purple rounded mr-2"></span>Directeur actuel
                        </h3>
                        <div class="bg-white rounded-md shadow-md overflow-hidden">
                            <div class="flex flex-col md:flex-row">
                                <div class="md:w-1/3 relative">
                                    <img  src="{{ $settings['director']['photo'] ?? asset('assets/about/directeur.png') }}"
                                    alt="{{ $settings['director']['name'] ?? 'Directeur' }} - {{ $settings['site_name'] }}"
                                    class="w-full h-full object-cover">
                                    <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-purple/80 to-transparent p-3 text-white">
                                        <h4 class="text-lg font-bold">{{ $settings['director']['name'] }}</h4>
                                        <p class="text-sm">Directeur général depuis 2020</p>
                                    </div>
                                </div>
                                <div class="md:w-2/3 p-4 md:p-5">
                                    <div class="flex items-center mb-3">
                                        <div class="bg-purple/10 text-purple p-1.5 rounded-full mr-2">
                                            <i class="fas fa-quote-left text-xs"></i>
                                        </div>
                                        <h5 class="text-base font-medium text-dark">Vision & leadership</h5>
                                    </div>
                                    <p class="text-gray-dark text-sm mb-4">Médecin spécialiste en administration de la santé, le Dr. HABIB a apporté une vision nouvelle pour le développement du CHU Mahavoky Atsimo, basée sur l'excellence médicale, l'humanisation des soins et l'accessibilité pour tous.</p>
                                    <div class="flex mt-4">
                                        <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 bg-purple text-white text-xs px-3 py-1.5 rounded hover:bg-turquoise transition-colors">
                                            <i class="fas fa-envelope"></i> Contact
                                        </a>
                                        <a href="{{ route('about') }}" class="inline-flex items-center gap-1.5 bg-transparent text-purple text-xs px-3 py-1.5 rounded ml-2 hover:bg-purple/10 transition-colors">
                                            <i class="fas fa-info-circle"></i> Plus d'informations
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-base font-medium text-purple mb-3 flex items-center">
                        <span class="w-1 h-4 bg-purple rounded mr-2"></span>Anciens directeurs
                    </h3>

                    <!-- Carrousel des anciens directeurs - style plus compact -->
                    <div class="swiper-container former-directors-carousel mb-6 p-1 overflow-hidden relative">
                        <div class="swiper-wrapper">
                            <!-- Directeur 1 -->
                            <div class="swiper-slide px-1.5">
                                <div class="bg-white rounded-md shadow-sm overflow-hidden h-full hover:shadow transition-shadow">
                                    <div class="relative">
                                        <img src="{{ asset('assets/about/1.png') }}" alt="Dr. RAKOTO" class="w-full h-44 object-cover">
                                        <div class="absolute top-0 right-0 bg-purple/90 text-white px-2 py-0.5 text-xs rounded-bl">2015 - 2020</div>
                                    </div>
                                    <div class="p-3">
                                        <h4 class="font-medium text-sm text-dark mb-1">Dr. RAKOTO</h4>
                                        <p class="text-gray-dark text-xs mb-2">A supervisé l'expansion du département de chirurgie et modernisé les services d'urgence.</p>
                                        <div class="flex items-center text-purple">
                                            <i class="fas fa-award mr-1.5 text-[10px]"></i>
                                            <span class="text-[10px] font-medium">Médaille nationale de santé</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Directeur 2 -->
                            <div class="swiper-slide px-1.5">
                                <div class="bg-white rounded-md shadow-sm overflow-hidden h-full hover:shadow transition-shadow">
                                    <div class="relative">
                                        <img src="{{ asset('assets/about/2.png') }}" alt="Dr. RAZAFY" class="w-full h-44 object-cover">
                                        <div class="absolute top-0 right-0 bg-turquoise/90 text-white px-2 py-0.5 text-xs rounded-bl">2008 - 2015</div>
                                    </div>
                                    <div class="p-3">
                                        <h4 class="font-medium text-sm text-dark mb-1">Dr. RAZAFY</h4>
                                        <p class="text-gray-dark text-xs mb-2">A développé le volet universitaire et les partenariats internationaux du CHU.</p>
                                        <div class="flex items-center text-turquoise">
                                            <i class="fas fa-globe-africa mr-1.5 text-[10px]"></i>
                                            <span class="text-[10px] font-medium">Relations internationales</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Directeur 3 -->
                            <div class="swiper-slide px-1.5">
                                <div class="bg-white rounded-md shadow-sm overflow-hidden h-full hover:shadow transition-shadow">
                                    <div class="relative">
                                        <img src="{{ asset('assets/about/3.jpg') }}" alt="Dr. ANDRIAMAHEFA" class="w-full h-44 object-cover">
                                        <div class="absolute top-0 right-0 bg-purple/90 text-white px-2 py-0.5 text-xs rounded-bl">2000 - 2008</div>
                                    </div>
                                    <div class="p-3">
                                        <h4 class="font-medium text-sm text-dark mb-1">Dr. ANDRIAMAHEFA</h4>
                                        <p class="text-gray-dark text-xs mb-2">A jeté les bases de la transformation du centre hospitalier en CHU.</p>
                                        <div class="flex items-center text-purple">
                                            <i class="fas fa-building mr-1.5 text-[10px]"></i>
                                            <span class="text-[10px] font-medium">Fondateur du CHU moderne</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contrôles de navigation avec icônes standards -->
                        <div class="swiper-pagination mt-3"></div>

                        <!-- Bouton suivant normalisé - taille fixe, couleur contrôlée -->
                        <div class="swiper-button-next !absolute !top-1/2 !-mt-4 !right-1 !w-8 !h-8 !bg-white !rounded-full !shadow-sm !flex !items-center !justify-center">
                            <!-- Important: suppression complète du contenu par défaut -->
                            <span class="!text-purple !text-xs after:!content-none">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </div>

                        <!-- Bouton précédent normalisé - taille fixe, couleur contrôlée -->
                        <div class="swiper-button-prev !absolute !top-1/2 !-mt-4 !left-1 !w-8 !h-8 !bg-white !rounded-full !shadow-sm !flex !items-center !justify-center">
                            <!-- Important: suppression complète du contenu par défaut -->
                            <span class="!text-purple !text-xs after:!content-none">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        </div>
                    </div>
                </section>

                <!-- Organigramme -->
                <section id="organigramme" class="mb-12">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-3">
                            <i class="fas fa-sitemap text-sm"></i>
                        </div>
                        <h4 class="text-sm md:text-sm font-bold text-dark">Organigramme</h4>
                    </div>

                    <div class="bg-white p-4 rounded-md shadow-sm">
                        <div class="flex flex-col items-center">
                            <div class="max-w-md mx-auto overflow-hidden">
                                <img src="{{ asset('assets/about/organigramme.png') }}" alt="Organigramme du CHU" class="w-full object-contain max-h-72">
                            </div>

                            <div class="flex flex-wrap justify-center gap-3 mt-4">
                                <a href="{{ asset('assets/about/organigramme.pdf') }}" target="_blank" class="inline-flex items-center bg-purple text-white text-xs px-3 py-1.5 rounded hover:bg-turquoise transition-colors">
                                    <i class="fas fa-download mr-1.5"></i> Télécharger
                                </a>
                                <button class="inline-flex items-center bg-gray-light text-dark text-xs px-3 py-1.5 rounded hover:bg-gray transition-colors" onclick="document.getElementById('organigrammeModal').classList.remove('hidden')">
                                    <i class="fas fa-search-plus mr-1.5"></i> Agrandir
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal pour l'organigramme -->
                    <div id="organigrammeModal" class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 hidden">
                        <div class="relative bg-white p-3 md:p-4 rounded-md max-w-4xl w-full max-h-screen overflow-auto">
                            <button onclick="document.getElementById('organigrammeModal').classList.add('hidden')" class="absolute top-2 right-2 text-dark hover:text-purple text-lg">
                                <i class="fas fa-times"></i>
                            </button>
                            <h3 class="text-xl font-bold mb-3 text-dark">Organigramme du CHU Mahavoky Atsimo</h3>
                            <img src="{{ asset('assets/about/organigramme.png') }}" alt="Organigramme du CHU" class="max-w-full">
                        </div>
                    </div>
                </section>

                <!-- Textes & Décrets -->
                <section id="decret">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-3">
                            <i class="fas fa-file-alt text-sm"></i>
                        </div>
                        <h4 class="text-sm md:text-sm font-bold text-dark">Textes & Décrets</h4>
                    </div>

                    <div class="bg-white rounded-md shadow-sm p-4">
                        <p class="mb-4 text-gray-dark text-sm">Consultez ci-dessous les textes officiels et décrets relatifs au CHU Mahavoky Atsimo :</p>

                        <div class="space-y-3">
                            <div class="bg-gray-light p-3 rounded hover:shadow-sm transition-shadow">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-start">
                                        <div class="bg-purple/10 p-2 rounded text-purple mr-3">
                                            <i class="fas fa-file-pdf text-base"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-sm text-dark">Décret de création du CHU</h4>
                                            <p class="text-xs text-gray-dark mt-0.5">Décret n° 2000-456 du 17 juin 2000</p>
                                            <p class="text-[10px] text-purple mt-1">2.3 MB - PDF</p>
                                        </div>
                                    </div>
                                    <a href="#" class="text-white p-1.5 rounded-full hover:bg-turquoise transition-colors">
                                        <i class="fas fa-download text-xs"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="bg-gray-light p-3 rounded hover:shadow-sm transition-shadow">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-start">
                                        <div class="bg-turquoise/10 p-2 rounded text-turquoise mr-3">
                                            <i class="fas fa-file-pdf text-base"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-sm text-dark">Statuts du CHU</h4>
                                            <p class="text-xs text-gray-dark mt-0.5">Dernière mise à jour: 12 mars 2018</p>
                                            <p class="text-[10px] text-turquoise mt-1">1.8 MB - PDF</p>
                                        </div>
                                    </div>
                                    <a href="#" class="text-white p-1.5 rounded-full hover:bg-purple transition-colors">
                                        <i class="fas fa-download text-xs"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="bg-gray-light p-3 rounded hover:shadow-sm transition-shadow">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-start">
                                        <div class="bg-purple/10 p-2 rounded text-purple mr-3">
                                            <i class="fas fa-file-pdf text-base"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-sm text-dark">Règlement intérieur</h4>
                                            <p class="text-xs text-gray-dark mt-0.5">Version actuelle approuvée le 5 septembre 2022</p>
                                            <p class="text-[10px] text-purple mt-1">3.1 MB - PDF</p>
                                        </div>
                                    </div>
                                    <a href="#" class="text-white p-1.5 rounded-full hover:bg-turquoise transition-colors">
                                        <i class="fas fa-download text-xs"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="bg-gray-light p-3 rounded hover:shadow-sm transition-shadow">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-start">
                                        <div class="bg-turquoise/10 p-2 rounded text-turquoise mr-3">
                                            <i class="fas fa-file-pdf text-base"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-sm text-dark">Convention universitaire</h4>
                                            <p class="text-xs text-gray-dark mt-0.5">Convention avec l'Université de Mahajanga, 2019</p>
                                            <p class="text-[10px] text-turquoise mt-1">1.5 MB - PDF</p>
                                        </div>
                                    </div>
                                    <a href="#" class="text-white p-1.5 rounded-full hover:bg-purple transition-colors">
                                        <i class="fas fa-download text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>
