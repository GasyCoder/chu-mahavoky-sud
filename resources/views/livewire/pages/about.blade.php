<div>
    <!-- Bannière de la page À propos avec parallax -->
    <section class="relative h-80 bg-cover bg-center bg-fixed" style="background-image: url({{ asset('assets/about-banner.jpg') }})">
        <div class="absolute inset-0 bg-gradient-to-r from-purple/90 to-turquoise/80"></div>
        <div class="container relative flex h-full items-center justify-center">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up" data-aos-duration="1000">À propos du CHU</h1>
                <div class="h-1 w-20 bg-white mx-auto" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000"></div>
                <p class="mt-4 text-white max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                    Centre Hospitalier Universitaire Mahavoky Atsimo - Excellence médicale au service de tous
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
                <span class="text-gray-dark">À propos</span>
            </div>
        </div>
    </div>

    <!-- Section principale avec sidebar -->
    <section class="container py-16">
        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Sidebar -->
            <div class="w-full lg:w-1/4 order-2 lg:order-1">
                <div class="sticky top-24 rounded-lg bg-white p-6 shadow-lg">
                    <h3 class="mb-6 text-xl font-semibold text-purple border-b pb-3">Navigation</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="#histoire" class="flex items-center rounded-md p-2 text-dark hover:bg-purple/10 hover:text-purple transition-colors">
                                <i class="fas fa-history mr-3 w-5 text-center text-purple"></i> Notre histoire
                            </a>
                        </li>
                        <li>
                            <a href="#directeurs" class="flex items-center rounded-md p-2 text-dark hover:bg-purple/10 hover:text-purple transition-colors">
                                <i class="fas fa-user-md mr-3 w-5 text-center text-purple"></i> Directeurs
                            </a>
                        </li>
                        <li>
                            <a href="#organigramme" class="flex items-center rounded-md p-2 text-dark hover:bg-purple/10 hover:text-purple transition-colors">
                                <i class="fas fa-sitemap mr-3 w-5 text-center text-purple"></i> Organigramme
                            </a>
                        </li>
                        <li>
                            <a href="#staff" class="flex items-center rounded-md p-2 text-dark hover:bg-purple/10 hover:text-purple transition-colors">
                                <i class="fas fa-users mr-3 w-5 text-center text-purple"></i> Notre personnel
                            </a>
                        </li>
                        <li>
                            <a href="#decret" class="flex items-center rounded-md p-2 text-dark hover:bg-purple/10 hover:text-purple transition-colors">
                                <i class="fas fa-file-alt mr-3 w-5 text-center text-purple"></i> Textes & Décrets
                            </a>
                        </li>
                    </ul>

                    <!-- Ajout d'une section de contact rapide -->
                    <div class="mt-8 pt-6 border-t">
                        <h5 class="text-lg font-semibold text-dark mb-4">Besoin d'informations?</h5>
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-full bg-purple/10 flex items-center justify-center text-purple">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-dark">Appelez-nous</p>
                                <a href="tel:+261340000000" class="text-purple font-medium">+261 34 00 000 00</a>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-purple/10 flex items-center justify-center text-purple">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-dark">Email</p>
                                <a href="mailto:contact@chumahavaky.mg" class="text-purple font-medium">contact@chumahavaky.mg</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="w-full lg:w-3/4 order-1 lg:order-2">
                <!-- Notre histoire -->
                <section id="histoire" class="mb-16">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-4">
                            <i class="fas fa-history"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-dark">Notre histoire</h2>
                    </div>

                    <div class="prose max-w-none">
                        <p class="text-gray-dark leading-relaxed">Le Centre Hospitalier Universitaire Mahavoky Atsimo a été fondé en [année] avec pour mission de devenir un établissement de santé de référence à Madagascar. Depuis sa création, l'hôpital n'a cessé d'évoluer pour répondre aux besoins de santé croissants de la population.</p>

                        <p class="text-gray-dark leading-relaxed">Situé au cœur de Mahajanga, notre établissement a connu plusieurs phases d'agrandissement et de modernisation, avec l'ajout de nouveaux départements, l'acquisition d'équipements médicaux de pointe et le renforcement de nos équipes médicales et paramédicales.</p>

                        <p class="text-gray-dark leading-relaxed">Au fil des années, le CHU Mahavoky Atsimo s'est imposé comme un acteur majeur de la santé publique dans la région, formant des générations de professionnels de santé et participant activement à la recherche médicale.</p>
                    </div>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="overflow-hidden rounded-lg shadow-md" data-aos="fade-up" data-aos-duration="1000">
                            <img src="{{ asset('assets/about/history-1.jpg') }}" alt="Ancien bâtiment du CHU" class="w-full h-56 object-cover hover:scale-105 transition-transform duration-500">
                            <div class="p-3 bg-white">
                                <p class="text-sm text-center text-gray-dark">1985 - Fondation</p>
                            </div>
                        </div>
                        <div class="overflow-hidden rounded-lg shadow-md" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                            <img src="{{ asset('assets/about/history-2.jpg') }}" alt="CHU en développement" class="w-full h-56 object-cover hover:scale-105 transition-transform duration-500">
                            <div class="p-3 bg-white">
                                <p class="text-sm text-center text-gray-dark">2000 - Expansion</p>
                            </div>
                        </div>
                        <div class="overflow-hidden rounded-lg shadow-md" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                            <img src="{{ asset('assets/about/history-3.jpg') }}" alt="CHU aujourd'hui" class="w-full h-56 object-cover hover:scale-105 transition-transform duration-500">
                            <div class="p-3 bg-white">
                                <p class="text-sm text-center text-gray-dark">2020 - Modernisation</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Directeurs -->
                <section id="directeurs" class="mb-16">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-4">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-dark">Nos directeurs</h2>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-purple mb-4 flex items-center">
                            <span class="w-1 h-6 bg-purple rounded mr-2"></span>Directeur actuel
                        </h3>
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <div class="flex flex-col md:flex-row">
                                <div class="md:w-1/3 relative">
                                    <img src="{{ asset('assets/about/1.png') }}" alt="Dr. HABIB" class="w-full h-full object-cover">
                                    <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-purple/80 to-transparent p-4 text-white">
                                        <h4 class="text-xl font-bold">Dr. HABIB</h4>
                                        <p>Directeur général depuis 2020</p>
                                    </div>
                                </div>
                                <div class="md:w-2/3 p-6">
                                    <div class="flex items-center mb-4">
                                        <div class="bg-purple/10 text-purple p-2 rounded-full mr-3">
                                            <i class="fas fa-quote-left"></i>
                                        </div>
                                        <h5 class="text-lg font-semibold text-dark">Vision & leadership</h5>
                                    </div>
                                    <p class="text-gray-dark mb-4">Médecin spécialiste en administration de la santé, le Dr. HABIB a apporté une vision nouvelle pour le développement du CHU Mahavoky Atsimo, basée sur l'excellence médicale, l'humanisation des soins et l'accessibilité pour tous.</p>
                                    <div class="flex mt-6">
                                        <a href="#" class="inline-flex items-center gap-2 bg-purple text-white px-4 py-2 rounded-md hover:bg-turquoise transition-colors">
                                            <i class="fas fa-envelope"></i> Contact
                                        </a>
                                        <a href="#" class="inline-flex items-center gap-2 bg-transparent text-purple px-4 py-2 rounded-md ml-3 hover:bg-purple/10 transition-colors">
                                            <i class="fas fa-info-circle"></i> Plus d'informations
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-xl font-semibold text-purple mb-4 flex items-center">
                        <span class="w-1 h-6 bg-purple rounded mr-2"></span>Anciens directeurs
                    </h3>

                    <!-- Carrousel des anciens directeurs -->
                    <div class="swiper-container former-directors-carousel mb-8 p-2 overflow-hidden relative">
                        <div class="swiper-wrapper">
                            <!-- Directeur 1 -->
                            <div class="swiper-slide px-2">
                                <div class="bg-white rounded-lg shadow-md overflow-hidden h-full hover:shadow-lg transition-shadow">
                                    <div class="relative">
                                        <img src="{{ asset('assets/about/1.png') }}" alt="Dr. RAKOTO" class="w-full h-52 object-cover">
                                        <div class="absolute top-0 right-0 bg-purple/90 text-white px-2 py-1 text-sm rounded-bl-lg">2015 - 2020</div>
                                    </div>
                                    <div class="p-4">
                                        <h4 class="font-bold text-base text-dark mb-1">Dr. RAKOTO</h4>
                                        <p class="text-gray-dark text-sm mb-3">A supervisé l'expansion du département de chirurgie et modernisé les services d'urgence.</p>
                                        <div class="flex items-center text-purple">
                                            <i class="fas fa-award mr-2 text-xs"></i>
                                            <span class="text-xs font-medium">Médaille nationale de santé</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Directeur 2 -->
                            <div class="swiper-slide px-2">
                                <div class="bg-white rounded-lg shadow-md overflow-hidden h-full hover:shadow-lg transition-shadow">
                                    <div class="relative">
                                        <img src="{{ asset('assets/about/2.png') }}" alt="Dr. RAZAFY" class="w-full h-52 object-cover">
                                        <div class="absolute top-0 right-0 bg-turquoise/90 text-white px-2 py-1 text-sm rounded-bl-lg">2008 - 2015</div>
                                    </div>
                                    <div class="p-4">
                                        <h4 class="font-bold text-base text-dark mb-1">Dr. RAZAFY</h4>
                                        <p class="text-gray-dark text-sm mb-3">A développé le volet universitaire et les partenariats internationaux du CHU.</p>
                                        <div class="flex items-center text-turquoise">
                                            <i class="fas fa-globe-africa mr-2 text-xs"></i>
                                            <span class="text-xs font-medium">Relations internationales</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Directeur 3 -->
                            <div class="swiper-slide px-2">
                                <div class="bg-white rounded-lg shadow-md overflow-hidden h-full hover:shadow-lg transition-shadow">
                                    <div class="relative">
                                        <img src="{{ asset('assets/about/3.jpg') }}" alt="Dr. ANDRIAMAHEFA" class="w-full h-52 object-cover">
                                        <div class="absolute top-0 right-0 bg-purple/90 text-white px-2 py-1 text-sm rounded-bl-lg">2000 - 2008</div>
                                    </div>
                                    <div class="p-4">
                                        <h4 class="font-bold text-base text-dark mb-1">Dr. ANDRIAMAHEFA</h4>
                                        <p class="text-gray-dark text-sm mb-3">A jeté les bases de la transformation du centre hospitalier en CHU.</p>
                                        <div class="flex items-center text-purple">
                                            <i class="fas fa-building mr-2 text-xs"></i>
                                            <span class="text-xs font-medium">Fondateur du CHU moderne</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contrôles de navigation corrigés -->
                        <div class="swiper-pagination mt-4"></div>
                        <div class="swiper-button-next text-purple !absolute !top-1/2 !-mt-6 !right-1 z-10 w-8 h-8 bg-white rounded-full shadow-md flex items-center justify-center after:content-none">
                            <i class="fas fa-arrow-right text-sm"></i>
                        </div>
                        <div class="swiper-button-prev text-purple !absolute !top-1/2 !-mt-6 !left-1 z-10 w-8 h-8 bg-white rounded-full shadow-md flex items-center justify-center after:content-none">
                            <i class="fas fa-arrow-left text-sm"></i>
                        </div>
                    </div>
                </section>

                <!-- Organigramme -->
                <section id="organigramme" class="mb-16">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-4">
                            <i class="fas fa-sitemap"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-dark">Organigramme</h2>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex flex-col items-center">
                            <div class="max-w-md mx-auto overflow-hidden">
                                <img src="{{ asset('assets/about/organigramme.png') }}" alt="Organigramme du CHU" class="w-full object-contain max-h-96">
                            </div>

                            <div class="flex flex-wrap justify-center gap-4 mt-6">
                                <a href="{{ asset('assets/about/organigramme.pdf') }}" target="_blank" class="inline-flex items-center bg-purple text-white px-4 py-2 rounded-md hover:bg-turquoise transition-colors">
                                    <i class="fas fa-download mr-2"></i> Télécharger
                                </a>
                                <button class="inline-flex items-center bg-gray-light text-dark px-4 py-2 rounded-md hover:bg-gray transition-colors" onclick="document.getElementById('organigrammeModal').classList.remove('hidden')">
                                    <i class="fas fa-search-plus mr-2"></i> Agrandir
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal pour l'organigramme -->
                    <div id="organigrammeModal" class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 hidden">
                        <div class="relative bg-white p-4 rounded-lg max-w-5xl w-full max-h-screen overflow-auto">
                            <button onclick="document.getElementById('organigrammeModal').classList.add('hidden')" class="absolute top-2 right-2 text-dark hover:text-purple text-xl">
                                <i class="fas fa-times"></i>
                            </button>
                            <h3 class="text-2xl font-bold mb-4 text-dark">Organigramme du CHU Mahavoky Atsimo</h3>
                            <img src="{{ asset('assets/about/organigramme.png') }}" alt="Organigramme du CHU" class="max-w-full">
                        </div>
                    </div>
                </section>

                <!-- Notre personnel -->
                <section id="staff" class="mb-16">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-4">
                            <i class="fas fa-users"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-dark">Notre personnel</h2>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-purple mb-4 flex items-center">
                            <span class="w-1 h-6 bg-purple rounded mr-2"></span>Équipe dirigeante
                        </h3>

                        <!-- Carrousel pour l'équipe dirigeante -->
                        <div class="swiper-container team-carousel mb-8 relative">
                            <div class="swiper-wrapper">
                                <!-- Membre 1 -->
                                <div class="swiper-slide px-2">
                                    <div class="bg-white rounded-lg shadow-md overflow-hidden h-full hover:shadow-lg transition-shadow">
                                        <div class="relative">
                                            <img src="{{ asset('assets/about/1.png') }}" alt="Dr. RANAIVO" class="w-full h-56 object-cover">
                                            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-purple/80 to-transparent p-4 text-white">
                                                <h4 class="font-bold">Dr. RANAIVO</h4>
                                                <p>Directeur médical</p>
                                            </div>
                                        </div>
                                        <div class="p-4 text-center">
                                            <p class="text-gray-dark text-sm">Responsable de la qualité des soins et de la coordination des services médicaux.</p>
                                            <div class="mt-4 flex justify-center gap-3">
                                                <a href="#" class="w-8 h-8 rounded-full bg-purple/10 flex items-center justify-center text-purple hover:bg-purple hover:text-white transition-colors">
                                                    <i class="fas fa-envelope text-sm"></i>
                                                </a>
                                                <a href="#" class="w-8 h-8 rounded-full bg-purple/10 flex items-center justify-center text-purple hover:bg-purple hover:text-white transition-colors">
                                                    <i class="fab fa-linkedin-in text-sm"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Membre 2 -->
                                <div class="swiper-slide px-2">
                                    <div class="bg-white rounded-lg shadow-md overflow-hidden h-full hover:shadow-lg transition-shadow">
                                        <div class="relative">
                                            <img src="{{ asset('assets/about/2.png') }}" alt="Mme. RASOA" class="w-full h-56 object-cover">
                                            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-turquoise/80 to-transparent p-4 text-white">
                                                <h4 class="font-bold">Mme. RASOA</h4>
                                                <p>Directrice des soins</p>
                                            </div>
                                        </div>
                                        <div class="p-4 text-center">
                                            <p class="text-gray-dark text-sm">Supervise l'ensemble des équipes infirmières et paramédicales du CHU.</p>
                                            <div class="mt-4 flex justify-center gap-3">
                                                <a href="#" class="w-8 h-8 rounded-full bg-turquoise/10 flex items-center justify-center text-turquoise hover:bg-turquoise hover:text-white transition-colors">
                                                    <i class="fas fa-envelope text-sm"></i>
                                                </a>
                                                <a href="#" class="w-8 h-8 rounded-full bg-turquoise/10 flex items-center justify-center text-turquoise hover:bg-turquoise hover:text-white transition-colors">
                                                    <i class="fab fa-linkedin-in text-sm"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Membre 3 -->
                                <div class="swiper-slide px-2">
                                    <div class="bg-white rounded-lg shadow-md overflow-hidden h-full hover:shadow-lg transition-shadow">
                                        <div class="relative">
                                            <img src="{{ asset('assets/about/3.jpg') }}" alt="M. RANDRIA" class="w-full h-56 object-cover">
                                            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-purple/80 to-transparent p-4 text-white">
                                                <h4 class="font-bold">M. RANDRIA</h4>
                                                <p>Directeur administratif</p>
                                            </div>
                                        </div>
                                        <div class="p-4 text-center">
                                            <p class="text-gray-dark text-sm">Gère les aspects financiers, logistiques et les ressources humaines.</p>
                                            <div class="mt-4 flex justify-center gap-3">
                                                <a href="#" class="w-8 h-8 rounded-full bg-purple/10 flex items-center justify-center text-purple hover:bg-purple hover:text-white transition-colors">
                                                    <i class="fas fa-envelope text-sm"></i>
                                                </a>
                                                <a href="#" class="w-8 h-8 rounded-full bg-purple/10 flex items-center justify-center text-purple hover:bg-purple hover:text-white transition-colors">
                                                    <i class="fab fa-linkedin-in text-sm"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contrôles de navigation corrigés -->
                            <div class="swiper-pagination mt-4"></div>
                            <div class="swiper-button-next text-purple !absolute !top-1/2 !-mt-6 !right-1 z-10 w-8 h-8 bg-white rounded-full shadow-md flex items-center justify-center after:content-none">
                                <i class="fas fa-arrow-right text-sm"></i>
                            </div>
                            <div class="swiper-button-prev text-purple !absolute !top-1/2 !-mt-6 !left-1 z-10 w-8 h-8 bg-white rounded-full shadow-md flex items-center justify-center after:content-none">
                                <i class="fas fa-arrow-left text-sm"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-purple mb-4 flex items-center">
                            <span class="w-1 h-6 bg-purple rounded mr-2"></span>Nos chiffres
                        </h3>
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                                <div class="text-center" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-purple/10 text-purple mb-3">
                                        <i class="fas fa-user-md text-2xl"></i>
                                    </div>
                                    <div class="text-3xl font-bold text-purple mb-1"><span id="value1" class="counter">0</span></div>
                                    <p class="text-dark">Médecins</p>
                                </div>
                                <div class="text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-turquoise/10 text-turquoise mb-3">
                                        <i class="fas fa-heartbeat text-2xl"></i>
                                    </div>
                                    <div class="text-3xl font-bold text-turquoise mb-1"><span id="value2" class="counter">0</span></div>
                                    <p class="text-dark">Infirmiers</p>
                                </div>
                                <div class="text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-purple/10 text-purple mb-3">
                                        <i class="fas fa-microscope text-2xl"></i>
                                    </div>
                                    <div class="text-3xl font-bold text-purple mb-1">32</div>
                                    <p class="text-dark">Techniciens</p>
                                </div>
                                <div class="text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-turquoise/10 text-turquoise mb-3">
                                        <i class="fas fa-hospital-user text-2xl"></i>
                                    </div>
                                    <div class="text-3xl font-bold text-turquoise mb-1">51</div>
                                    <p class="text-dark">Personnel de soutien</p>
                                </div>
                            </div>

                            <div class="mt-8 pt-6 border-t">
                                <h4 class="text-lg font-semibold text-dark mb-3">Évolution du personnel</h4>
                                <div class="h-64 bg-white p-2 rounded">
                                    <canvas id="staffChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Textes & Décrets -->
                <section id="decret" class="mb-16">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-4">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-dark">Textes & Décrets</h2>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <p class="mb-6 text-gray-dark">Consultez ci-dessous les textes officiels et décrets relatifs au CHU Mahavoky Atsimo :</p>

                        <div class="space-y-6">
                            <div class="bg-gray-light p-4 rounded-lg hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-start">
                                        <div class="bg-purple/10 p-3 rounded-lg text-purple mr-4">
                                            <i class="fas fa-file-pdf text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-dark">Décret de création du CHU</h4>
                                            <p class="text-sm text-gray-dark mt-1">Décret n° 2000-456 du 17 juin 2000</p>
                                            <p class="text-xs text-purple mt-2">2.3 MB - PDF</p>
                                        </div>
                                    </div>
                                    <a href="#" class="bg-purple text-white p-2 rounded-full hover:bg-turquoise transition-colors">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="bg-gray-light p-4 rounded-lg hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-start">
                                        <div class="bg-turquoise/10 p-3 rounded-lg text-turquoise mr-4">
                                            <i class="fas fa-file-pdf text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-dark">Statuts du CHU</h4>
                                            <p class="text-sm text-gray-dark mt-1">Dernière mise à jour: 12 mars 2018</p>
                                            <p class="text-xs text-turquoise mt-2">1.8 MB - PDF</p>
                                        </div>
                                    </div>
                                    <a href="#" class="bg-turquoise text-white p-2 rounded-full hover:bg-purple transition-colors">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="bg-gray-light p-4 rounded-lg hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-start">
                                        <div class="bg-purple/10 p-3 rounded-lg text-purple mr-4">
                                            <i class="fas fa-file-pdf text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-dark">Règlement intérieur</h4>
                                            <p class="text-sm text-gray-dark mt-1">Version actuelle approuvée le 5 septembre 2022</p>
                                            <p class="text-xs text-purple mt-2">3.1 MB - PDF</p>
                                        </div>
                                    </div>
                                    <a href="#" class="bg-purple text-white p-2 rounded-full hover:bg-turquoise transition-colors">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="bg-gray-light p-4 rounded-lg hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-start">
                                        <div class="bg-turquoise/10 p-3 rounded-lg text-turquoise mr-4">
                                            <i class="fas fa-file-pdf text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-dark">Convention universitaire</h4>
                                            <p class="text-sm text-gray-dark mt-1">Convention avec l'Université de Mahajanga, 2019</p>
                                            <p class="text-xs text-turquoise mt-2">1.5 MB - PDF</p>
                                        </div>
                                    </div>
                                    <a href="#" class="bg-turquoise text-white p-2 rounded-full hover:bg-purple transition-colors">
                                        <i class="fas fa-download"></i>
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
