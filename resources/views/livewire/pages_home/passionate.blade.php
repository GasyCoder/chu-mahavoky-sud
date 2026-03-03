<!-- Section partenariats - Design moderne avec effets visuels -->
<section class="relative py-20 md:py-28 bg-center bg-no-repeat bg-fixed overflow-hidden" style="background-image: url({{ asset('assets/compassionate-healthcare-bg.jpeg') }})">
    <!-- Overlay avec gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900/90 via-slate-900/80 to-primary/20"></div>
    
    <!-- Particules lumineuses -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 right-1/4 w-64 h-64 bg-primary/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 left-1/4 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1.5s;"></div>
    </div>

    <div class="container relative z-10">
        <div class="flex flex-col items-stretch gap-10 lg:flex-row lg:items-center">
            <!-- Colonne gauche avec contenu texte -->
            <div class="w-full lg:w-1/2" data-aos="fade-right" data-aos-duration="1000">
                <div class="lg:pr-8">
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-4 py-2 mb-5">
                        <i class="fas fa-handshake text-primary text-sm"></i>
                        <span class="text-sm font-semibold text-white">CHU MAHAVOKY ATSIMO</span>
                    </div>

                    <!-- Titre avec gradient -->
                    <h2 class="mb-6 text-2xl md:text-3xl font-bold leading-tight text-white">
                        Nos <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-blue-400">partenariats</span> d'excellence
                    </h2>

                    <!-- Description -->
                    <p class="mb-8 leading-relaxed text-white/80 text-base md:text-lg">
                        Le CHU Mahavoky Atsimo a developpe un reseau solide de partenaires nationaux et internationaux pour offrir les meilleurs soins et developper l'expertise medicale. Notre vision collaborative nous permet d'innover constamment et d'ameliorer nos pratiques pour le bien-etre de nos patients.
                    </p>

                    <!-- Bouton CTA -->
                    <a href="#" class="group inline-flex items-center gap-3 px-7 py-3.5 bg-gradient-to-r from-primary to-primary/90 text-white font-semibold rounded-xl shadow-lg shadow-primary/30 hover:shadow-xl hover:shadow-primary/40 transition-all duration-300 hover:scale-105">
                        <span>En savoir plus</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Colonne droite - Cards avec glassmorphism -->
            <div class="w-full lg:w-1/2" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <div class="h-full rounded-3xl shadow-2xl bg-white/10 backdrop-blur-md border border-white/20 p-8 md:p-10">
                    <!-- Partenariats nationaux -->
                    <div class="group flex items-start gap-5 pb-8 mb-8 border-b border-white/10 hover:bg-white/5 rounded-2xl p-4 -mx-4 transition-all duration-300">
                        <div class="flex-shrink-0">
                            <div class="relative">
                                <div class="absolute inset-0 bg-primary/30 rounded-2xl blur-md group-hover:blur-lg transition-all duration-300"></div>
                                <div class="relative flex items-center justify-center w-16 h-16 bg-gradient-to-br from-primary to-blue-600 rounded-2xl shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-110">
                                    <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="1.5"/>
                                        <path d="M10.5 16H13.5C15.1569 16 16.5 14.6569 16.5 13V11C16.5 9.34315 15.1569 8 13.5 8H10.5C8.84315 8 7.5 9.34315 7.5 11V13C7.5 14.6569 8.84315 16 10.5 16Z" stroke="currentColor" stroke-width="1.5"/>
                                        <path d="M12 16V19" stroke="currentColor" stroke-width="1.5"/>
                                        <path d="M9 19H15" stroke="currentColor" stroke-width="1.5"/>
                                        <path d="M12 8V5" stroke="currentColor" stroke-width="1.5"/>
                                        <path d="M9 5H15" stroke="currentColor" stroke-width="1.5"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="flex-1">
                            <h4 class="mb-2 text-lg font-bold text-white">
                                Partenariats nationaux
                            </h4>
                            <p class="text-white/70 text-sm leading-relaxed">
                                Collaboration avec les institutions sanitaires et universites malgaches pour renforcer le systeme de sante national
                            </p>
                        </div>
                    </div>

                    <!-- Partenariats internationaux -->
                    <div class="group flex items-start gap-5 hover:bg-white/5 rounded-2xl p-4 -mx-4 transition-all duration-300">
                        <div class="flex-shrink-0">
                            <div class="relative">
                                <div class="absolute inset-0 bg-sky-500/30 rounded-2xl blur-md group-hover:blur-lg transition-all duration-300"></div>
                                <div class="relative flex items-center justify-center w-16 h-16 bg-gradient-to-br from-sky-500 to-blue-600 rounded-2xl shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-110">
                                    <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z" stroke="currentColor" stroke-width="1.5"/>
                                        <path d="M3.6 9H20.4" stroke="currentColor" stroke-width="1.5"/>
                                        <path d="M3.6 15H20.4" stroke="currentColor" stroke-width="1.5"/>
                                        <path d="M12 21C13.6569 21 15 16.9706 15 12C15 7.02944 13.6569 3 12 3C10.3431 3 9 7.02944 9 12C9 16.9706 10.3431 21 12 21Z" stroke="currentColor" stroke-width="1.5"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="flex-1">
                            <h4 class="mb-2 text-lg font-bold text-white">
                                Partenariats internationaux
                            </h4>
                            <p class="text-white/70 text-sm leading-relaxed">
                                Echanges avec des hopitaux et organisations de sante mondiales pour adopter les meilleures pratiques medicales
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
