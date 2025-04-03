<!-- Section partenariats avec espacement préservé -->
<section class="relative py-16 bg-center bg-no-repeat bg-cover" style="background-image: url({{ asset('assets/compassionate-healthcare-bg.jpeg') }})">
    <!-- Overlay plus léger pour que l'image d'arrière-plan soit plus visible -->
    <div class="absolute inset-0 bg-gradient-to-r from-purple/75 to-turquoise/65"></div>

    <div class="container relative z-10">
        <div class="flex flex-col items-stretch gap-8 lg:flex-row">
            <!-- Colonne de gauche - Contenu textuel -->
            <div class="w-full text-white lg:w-1/2">
                <div class="lg:pr-8">
                    <p class="mb-2 font-medium">
                        CHU MAHAVOKY ATSIMO
                    </p>

                    <h2 class="mb-5 text-xl font-bold leading-tight">
                        Nos partenariats d'excellence
                    </h2>

                    <p class="mb-4 leading-relaxed text-white">
                        Le CHU Mahavoky Atsimo a développé un réseau solide de partenaires nationaux et internationaux pour offrir les meilleurs soins et développer l'expertise médicale. Notre vision collaborative nous permet d'innover constamment et d'améliorer nos pratiques pour le bien-être de nos patients.
                    </p>

                    <!-- Bouton en savoir plus -->
                    <a href="#" class="inline-flex items-center px-5 py-3 mt-4 text-sm font-medium transition-all duration-300 transform bg-white rounded-lg shadow-md text-purple hover:shadow-lg hover:-translate-y-1">
                        En savoir plus
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Colonne de droite - Cartes de partenariats -->
            <div class="w-full lg:w-1/2">
                <div class="h-full rounded-lg shadow-lg bg-white/95 backdrop-blur-sm">
                    <!-- Carte 1 - Partenariats nationaux -->
                    <div class="flex items-center gap-5 p-6 border-b border-gray-100">
                        <!-- Icône représentant les partenariats nationaux -->
                        <div class="flex-shrink-0 p-4 rounded-lg shadow-sm bg-purple">
                            <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M10.5 16H13.5C15.1569 16 16.5 14.6569 16.5 13V11C16.5 9.34315 15.1569 8 13.5 8H10.5C8.84315 8 7.5 9.34315 7.5 11V13C7.5 14.6569 8.84315 16 10.5 16Z" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M12 16V19" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M9 19H15" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M12 8V5" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M9 5H15" stroke="currentColor" stroke-width="1.5"/>
                            </svg>
                        </div>

                        <div>
                            <h4 class="mb-1 text-lg font-semibold text-gray-900">
                                Partenariats nationaux
                            </h4>
                            <p class="text-gray-600">
                                Collaboration avec les institutions sanitaires et universités malgaches pour renforcer le système de santé national
                            </p>
                        </div>
                    </div>

                    <!-- Carte 2 - Partenariats internationaux -->
                    <div class="flex items-center gap-5 p-6">
                        <!-- Icône représentant les partenariats internationaux -->
                        <div class="flex-shrink-0 p-4 rounded-lg shadow-sm bg-turquoise">
                            <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M3.6 9H20.4" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M3.6 15H20.4" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M12 21C13.6569 21 15 16.9706 15 12C15 7.02944 13.6569 3 12 3C10.3431 3 9 7.02944 9 12C9 16.9706 10.3431 21 12 21Z" stroke="currentColor" stroke-width="1.5"/>
                            </svg>
                        </div>

                        <div>
                            <h4 class="mb-1 text-lg font-semibold text-gray-900">
                                Partenariats internationaux
                            </h4>
                            <p class="text-gray-600">
                                Échanges avec des hôpitaux et organisations de santé mondiales pour adopter les meilleures pratiques médicales
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
