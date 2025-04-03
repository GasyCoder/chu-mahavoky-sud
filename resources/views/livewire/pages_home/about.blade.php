<!-- Section du directeur avec design simplifié mais élégant -->
<section class="relative py-10 bg-gradient-to-r from-purple/5 to-turquoise/5">
    <!-- Motif de fond subtil -->
    <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

    <div class="container px-4 mx-auto">
        <div class="flex flex-col items-start gap-8 md:flex-row">
            <!-- Colonne gauche: Image avec cadre amélioré -->
            <div class="w-full md:w-3/12 lg:w-3/12">
                <div class="relative mx-auto max-w-[200px] md:max-w-none">
                    <!-- Fond dégradé pour la photo -->
                    <div class="absolute inset-0 transform rounded-md bg-gradient-to-br from-purple/20 to-turquoise/20 blur-md -rotate-3"></div>

                    <!-- Cadre avec bordure dégradée -->
                    <div class="relative p-2 transform rotate-0 bg-white border rounded-md shadow-md border-purple/30">
                        <!-- Image avec taille contrôlée -->
                        <div class="relative overflow-hidden rounded-md">
                            <img
                                src="{{ $settings['director']['photo'] ?? asset('assets/about/directeur.png') }}"
                                alt="{{ $settings['director']['name'] ?? 'Directeur' }} - {{ $settings['site_name'] }}"
                                class="w-full h-auto object-cover aspect-[3/4]"
                            />
                        </div>
                    </div>

                    <!-- Badge avec le nom du directeur -->
                    <div class="p-2 mt-3 text-center">
                        <h4 class="text-base font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple to-turquoise">
                            {{ $settings['director']['name'] }}
                        </h4>
                        <p class="text-xs text-dark">Directeur du CHU</p>
                    </div>
                </div>
            </div>

            <!-- Colonne droite: Contenu textuel avec effets de dégradé -->
            <div class="w-full md:w-9/12 lg:w-9/12">
                <!-- En-tête avec badge dégradé -->
                <div class="mb-4">
                    <div class="inline-block px-3 py-1 mb-2 rounded-md bg-gradient-to-r from-purple/10 to-turquoise/10">
                        <div class="text-sm font-medium text-transparent bg-clip-text bg-gradient-to-r from-purple to-turquoise">
                            Le mot du directeur
                        </div>
                    </div>

                    <!-- Titre avec dégradé -->
                    <h2 class="mb-3 text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple to-dark">Engagement envers l'excellence médicale</h2>
                </div>

                <!-- Message du directeur avec bordure dégradée -->
                <div class="relative pl-4 mb-6 border-l-2 border-gradient-to-b" style="border-image: linear-gradient(to bottom, #8E2E9B, #5ECCC1) 1 100%;">
                    <!-- Contenu du message avec effet de texte -->
                    <div class="leading-relaxed text-gray-dark">
                        <p style="text-align: justify">
                            {{ $settings['director']['message'] }}
                        </p>
                    </div>

                    <!-- Signature avec effet dégradé -->
                    {{-- <div class="flex items-center mt-4">
                        <div class="h-0.5 w-8 bg-gradient-to-r from-purple to-turquoise rounded-full mr-2"></div>
                        <p class="font-medium text-transparent bg-clip-text bg-gradient-to-r from-purple to-turquoise">
                            {{ $settings['director']['name'] }}
                        </p>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
