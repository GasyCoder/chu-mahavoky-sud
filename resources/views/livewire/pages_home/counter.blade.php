<!-- Section des statistiques - spécialement adaptée pour mobile -->
<div class="relative z-10 flex items-center h-full pb-10 text-white">
    <div class="container px-4 -mt-10 sm:px-4 sm:-mt-16 md:-mt-20">
        <div class="w-full">
        <!-- Conteneur de statistiques optimisé pour mobile -->
            <div class="w-full overflow-hidden bg-white rounded shadow-md">
                <!-- Barre décorative fine -->
                <div class="h-0.5 w-full bg-gradient-to-r from-purple via-turquoise to-purple"></div>
        
                <!-- Statistiques empilées sur mobile -->
                <div class="grid grid-cols-1 gap-2 p-3 sm:grid-cols-3 sm:gap-3 sm:p-4 md:p-5">
                <!-- Stat 1 - Médecins - Version très compacte sur mobile -->
                <div class="flex items-center p-1.5 sm:p-2">
                    <!-- Icône compacte -->
                    <div class="flex-shrink-0 mr-3">
                    <div class="p-2 sm:p-2.5 bg-purple/5 rounded">
                        <i class="text-base fa fa-user-md sm:text-lg md:text-xl text-purple"></i>
                    </div>
                    </div>
        
                    <div>
                    <!-- Compteur plus petit -->
                    <div class="flex items-end">
                        <span id="value1" class="text-lg font-bold sm:text-xl md:text-2xl text-purple counter" data-count="47" data-suffix="">0</span>
                        <span class="text-base sm:text-lg font-bold text-purple ml-0.5">+</span>
                    </div>
                    <!-- Texte ultra-compact pour mobile -->
                    <h5 class="text-xs font-medium text-dark sm:text-sm">Médecins spécialistes</h5>
                    <p class="text-gray-dark text-[10px] sm:text-xs">Une équipe médicale qualifiée</p>
                    </div>
                </div>
        
                <!-- Stat 2 - Patients - Version très compacte sur mobile -->
                <div class="flex items-center p-1.5 sm:p-2">
                    <!-- Icône compacte -->
                    <div class="flex-shrink-0 mr-3">
                    <div class="p-2 sm:p-2.5 bg-turquoise/5 rounded">
                        <i class="text-base fa fa-procedures sm:text-lg md:text-xl text-turquoise"></i>
                    </div>
                    </div>
        
                    <div>
                    <!-- Compteur plus petit -->
                    <div class="flex items-end">
                        <span id="value2" class="text-lg font-bold sm:text-xl md:text-2xl text-turquoise counter" data-count="15" data-suffix="k">0</span>
                        <span class="text-base sm:text-lg font-bold text-turquoise ml-0.5">+</span>
                    </div>
                    <!-- Texte ultra-compact pour mobile -->
                    <h5 class="text-xs font-medium text-dark sm:text-sm">Patients satisfaits</h5>
                    <p class="text-gray-dark text-[10px] sm:text-xs">Des soins de qualité pour tous</p>
                    </div>
                </div>
        
                <!-- Stat 3 - Services - Version très compacte sur mobile -->
                <div class="flex items-center p-1.5 sm:p-2">
                    <!-- Icône compacte -->
                    <div class="flex-shrink-0 mr-3">
                    <div class="p-2 sm:p-2.5 bg-gradient-to-br from-purple/5 to-turquoise/5 rounded">
                        <i class="text-base text-transparent fa fa-stethoscope sm:text-lg md:text-xl bg-clip-text bg-gradient-to-r from-purple to-turquoise"></i>
                    </div>
                    </div>
        
                    <div>
                    <!-- Compteur plus petit avec variable Laravel préservée -->
                    <div class="flex items-end">
                        <span class="text-lg font-bold text-transparent sm:text-xl md:text-2xl bg-clip-text bg-gradient-to-r from-purple to-turquoise counter" data-count="{{ \App\Models\Service::count() }}" data-suffix="">{{ \App\Models\Service::count() }}</span>
                    </div>
                    <!-- Texte ultra-compact pour mobile -->
                    <h5 class="text-xs font-medium text-dark sm:text-sm">Services</h5>
                    <p class="text-gray-dark text-[10px] sm:text-xs">Départements et services</p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>