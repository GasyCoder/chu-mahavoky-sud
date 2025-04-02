<!-- Section passionate avec espacement préservé -->
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
                    
                    <h2 class="mb-5 text-2xl font-bold leading-tight">
                        Un environnement de soins de santé compatissants
                    </h2>
                    
                    <p class="leading-relaxed text-white">
                        De la médecine préventive aux traitements spécialisés, nous priorisons votre parcours de santé. Grâce à des technologies de pointe et des professionnels compatissants, nous nous efforçons d'assurer chaque étape de vos soins de santé avec excellence et humanité.
                    </p>
                </div>
            </div>
            
            <!-- Colonne de droite - Cartes d'avantages -->
            <div class="w-full lg:w-1/2">
                <div class="h-full rounded-lg shadow-lg bg-white/95 backdrop-blur-sm">
                    <!-- Carte 1 -->
                    <div class="flex items-center gap-5 p-6 border-b border-gray-100">
                        <!-- Icône plus grande et bien visible -->
                        <div class="flex-shrink-0 p-4 rounded-lg shadow-sm bg-purple">
                            <img 
                                src="{{ asset('assets/icons/stethoscope_arrow.svg') }}" 
                                alt="Expérience centrée sur le patient" 
                                class="object-contain w-10 h-10"
                            />
                        </div>
                        
                        <div>
                            <h4 class="mb-1 text-lg font-semibold text-gray-900">
                                Expérience centrée sur le patient
                            </h4>
                            <p class="text-gray-600">
                                Soins personnalisés assurant le bien-être holistique du patient
                            </p>
                        </div>
                    </div>
                    
                    <!-- Carte 2 -->
                    <div class="flex items-center gap-5 p-6">
                        <!-- Icône plus grande et bien visible -->
                        <div class="flex-shrink-0 p-4 rounded-lg shadow-sm bg-turquoise">
                            <img 
                                src="{{ asset('assets/icons/skeleton.svg') }}" 
                                alt="Soins de santé intégrés" 
                                class="object-contain w-10 h-10"
                            />
                        </div>
                        
                        <div>
                            <h4 class="mb-1 text-lg font-semibold text-gray-900">
                                Expérience de soins de santé intégrés
                            </h4>
                            <p class="text-gray-600">
                                Soins coordonnés et fluides à travers de multiples services de santé
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>