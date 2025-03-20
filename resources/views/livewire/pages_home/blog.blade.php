<!-- Section "À la une" redesignée -->
<section class="py-10 bg-white relative">
    <!-- Lignes de séparation décoratives -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute left-0 top-0 w-full h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
        <div class="absolute left-1/4 top-0 bottom-0 w-px bg-gradient-to-b from-transparent via-gray-100 to-transparent opacity-70"></div>
        <div class="absolute right-1/4 top-0 bottom-0 w-px bg-gradient-to-b from-transparent via-gray-100 to-transparent opacity-70"></div>
    </div>

    <div class="container relative">
        <!-- En-tête de section plus sobre -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h3 class="text-xl font-semibold text-dark relative inline-block">
                    À la une
                    <span class="absolute -bottom-1 left-0 w-12 h-0.5 bg-purple"></span>
                </h3>
                <p class="text-gray-600 mt-1">Actualités et événements importants</p>
            </div>
            
            <a href="!#" class="text-purple text-sm font-medium hover:text-purple-dark transition-colors flex items-center">
                Toutes les actualités
                <i class="fas fa-chevron-right ml-1 text-xs"></i>
            </a>
        </div>
        
        <!-- Grille d'articles plus compacte -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <!-- Article 1 -->
            <article class="bg-white border border-gray-100 rounded overflow-hidden group hover:shadow-md transition-shadow">
                <div class="h-44 overflow-hidden relative">
                    <img src="{{ asset('assets/news/actualite1.jpg') }}" alt="Journée mondiale de la santé" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-0 right-0 m-3">
                        <span class="bg-purple/90 text-white px-2 py-1 text-xs rounded-sm">Événement</span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="text-gray-500 text-xs mb-2 flex items-center">
                        <i class="far fa-calendar-alt mr-1"></i>
                        23 mars 2025
                    </div>
                    <h4 class="font-medium text-dark mb-2 line-clamp-2">Journée mondiale de la santé</h4>
                    <p class="text-gray-600 text-sm line-clamp-3 mb-3">Notre établissement organise une journée portes ouvertes avec consultations gratuites et ateliers de sensibilisation.</p>
                    <a href="#" class="text-purple text-sm font-medium hover:text-purple-dark transition-colors">
                        Lire plus
                    </a>
                </div>
            </article>
            
            <!-- Article 2 -->
            <article class="bg-white border border-gray-100 rounded overflow-hidden group hover:shadow-md transition-shadow">
                <div class="h-44 overflow-hidden relative">
                    <img src="{{ asset('assets/news/service1.jpg') }}" alt="Nouveau service de neurologie" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-0 right-0 m-3">
                        <span class="bg-turquoise/90 text-white px-2 py-1 text-xs rounded-sm">Service</span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="text-gray-500 text-xs mb-2 flex items-center">
                        <i class="far fa-calendar-alt mr-1"></i>
                        15 mars 2025
                    </div>
                    <h4 class="font-medium text-dark mb-2 line-clamp-2">Ouverture du service de neurologie</h4>
                    <p class="text-gray-600 text-sm line-clamp-3 mb-3">Notre équipe s'agrandit avec l'arrivée d'un service complet dédié aux pathologies neurologiques.</p>
                    <a href="#" class="text-turquoise text-sm font-medium hover:text-turquoise-dark transition-colors">
                        En savoir plus
                    </a>
                </div>
            </article>
            
            <!-- Article 3 -->
            <article class="bg-white border border-gray-100 rounded overflow-hidden group hover:shadow-md transition-shadow">
                <div class="h-44 overflow-hidden relative">
                    <img src="{{ asset('assets/news/equipement1.jpg') }}" alt="Équipement d'imagerie médicale" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-0 right-0 m-3">
                        <span class="bg-purple/90 text-white px-2 py-1 text-xs rounded-sm">Équipement</span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="text-gray-500 text-xs mb-2 flex items-center">
                        <i class="far fa-calendar-alt mr-1"></i>
                        10 mars 2025
                    </div>
                    <h4 class="font-medium text-dark mb-2 line-clamp-2">Nouvel équipement d'imagerie médicale</h4>
                    <p class="text-gray-600 text-sm line-clamp-3 mb-3">Le CHU renforce ses capacités diagnostiques avec l'acquisition d'un scanner de dernière génération.</p>
                    <a href="#" class="text-purple text-sm font-medium hover:text-purple-dark transition-colors">
                        Découvrir
                    </a>
                </div>
            </article>
        </div>
    </div>
</section>