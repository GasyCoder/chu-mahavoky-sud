<!-- Section du directeur avec design amélioré - sans espace de transition -->
<section class="pt-0 pb-0 bg-gradient-to-b from-white to-gray-50 md:py-12">
    <div class="container">
        <div class="flex flex-col items-start justify-between mb-2 sm:flex-row sm:items-center sm:mb-10">
        <!-- Image du directeur avec design amélioré et taille réduite -->
        <div class="w-full lg:w-4/12">
          <div class="relative p-2 mx-auto overflow-hidden bg-white rounded-lg shadow-md lg:mx-0">
            <!-- Bordure décorative avec gradient -->
            <div class="absolute inset-0 p-0.5 rounded-lg bg-gradient-to-br from-purple-light via-turquoise to-purple opacity-50"></div>

            <!-- Image avec effet de profondeur et taille réduite -->
            <div class="relative overflow-hidden rounded-lg">
              <img
                src="{{ $settings['director']['photo'] ?? asset('assets/about/directeur.png') }}"
                alt="{{ $settings['director']['name'] ?? 'Directeur' }} - {{ $settings['site_name'] }}"
                class="w-full h-auto object-cover aspect-[3/4] transition-transform duration-700 hover:scale-105"
              />
            </div>
          </div>
        </div>

        <!-- Contenu textuel avec gradients subtils -->
        <div class="w-full px-4 mt-8 lg:w-8/12 lg:px-6 lg:mt-0">
          <!-- Badge avec gradient -->
          <div class="inline-block px-4 py-2 mb-3 rounded-full bg-gradient-to-r from-purple/10 to-turquoise/10">
            <div class="text-sm font-medium tracking-wider text-transparent uppercase bg-clip-text bg-gradient-to-r from-purple to-turquoise">
              Le mot du directeur de l'établissement
            </div>
          </div>

          <!-- Nom du directeur avec taille bien équilibrée et gradient élégant -->
          <h4 class="relative mb-3 text-xl font-bold md:text-xl">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple/90 to-dark">{{ $settings['director']['name'] }}</span>
            <!-- Élément décoratif sous le titre -->
            <span class="block h-0.5 w-16 mt-2 bg-gradient-to-r from-purple to-turquoise rounded-full"></span>
          </h4>

          <!-- Titre avec couleur subtile -->
          <div class="mb-4 text-base font-medium text-gray-dark">
            {{ $settings['director']['title'] }}
          </div>

          <!-- Message avec design amélioré -->
          <div class="relative">
            <!-- Élément décoratif -->
            <div class="absolute top-0 w-1 h-full rounded-full -left-4 bg-gradient-to-b from-purple/50 to-turquoise/50 opacity-30"></div>

            <!-- Texte avec typographie améliorée -->
            <div class="pl-1 mb-6 leading-relaxed text-gray-dark">
              <p class="relative">
                <span class="absolute top-0 font-serif text-xl -left-2 text-purple/10">"</span>
                <span class="relative">{{ $settings['director']['message'] }}</span>
              </p>
            </div>
          </div>

          <!-- Bouton avec animation et gradient -->
          <a href="{{ route('services') }}" class="inline-flex items-center gap-2 px-5 py-2 transition-all duration-300 rounded-full group bg-gradient-to-r from-purple/10 to-turquoise/10 hover:from-purple/20 hover:to-turquoise/20">
            <span class="font-medium text-transparent bg-clip-text bg-gradient-to-r from-purple to-turquoise">Découvrir nos services</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform duration-300 text-turquoise group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </a>
        </div>
      </div>
    </div>
</section>