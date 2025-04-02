<!-- Espace vertical optimisé -->
<div class="container">
    <div class="py-6 md:py-8"></div>
  </div>

  <!-- Section du directeur avec design amélioré -->
  <section class="bg-gradient-to-b from-white to-gray-50 py-12 md:py-16">
    <div class="container">
      <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-12 max-w-5xl mx-auto">
        <!-- Image du directeur avec design amélioré -->
        <div class="lg:w-5/12 w-full">
          <div class="relative rounded-lg overflow-hidden shadow-md mx-auto lg:mx-0 bg-white p-3">
            <!-- Bordure décorative avec gradient -->
            <div class="absolute inset-0 p-0.5 rounded-lg bg-gradient-to-br from-purple-light via-turquoise to-purple opacity-50"></div>

            <!-- Image avec effet de profondeur -->
            <div class="relative rounded-lg overflow-hidden">
              <img
                src="{{ $settings['director']['photo'] ?? asset('assets/about/directeur.png') }}"
                alt="{{ $settings['director']['name'] ?? 'Directeur' }} - {{ $settings['site_name'] }}"
                class="w-full h-auto object-cover aspect-[4/5] transition-transform duration-700 hover:scale-105"
              />
            </div>
          </div>
        </div>

        <!-- Contenu textuel avec gradients subtils -->
        <div class="lg:w-7/12 w-full px-4 lg:px-6">
          <!-- Badge avec gradient -->
          <div class="inline-block bg-gradient-to-r from-purple/10 to-turquoise/10 px-4 py-2 rounded-full mb-3">
            <div class="text-transparent bg-clip-text bg-gradient-to-r from-purple to-turquoise uppercase text-sm font-medium tracking-wider">
              Le mot du directeur de l'établissement
            </div>
          </div>

          <!-- Nom du directeur avec taille bien équilibrée et gradient élégant -->
          <h4 class="text-xl md:text-xl font-bold mb-3 relative">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple/90 to-dark">{{ $settings['director']['name'] }}</span>
            <!-- Élément décoratif sous le titre -->
            <span class="block h-0.5 w-16 mt-2 bg-gradient-to-r from-purple to-turquoise rounded-full"></span>
          </h4>

          <!-- Titre avec couleur subtile -->
          <div class="text-gray-dark text-base mb-4 font-medium">
            {{ $settings['director']['title'] }}
          </div>

          <!-- Message avec design amélioré -->
          <div class="relative">
            <!-- Élément décoratif -->
            <div class="absolute -left-4 top-0 w-1 h-full bg-gradient-to-b from-purple/50 to-turquoise/50 rounded-full opacity-30"></div>

            <!-- Texte avec typographie améliorée -->
            <div class="text-gray-dark leading-relaxed mb-6 pl-1">
              <p class="relative">
                <span class="absolute -left-2 top-0 text-xl text-purple/10 font-serif">"</span>
                <span class="relative">{{ $settings['director']['message'] }}</span>
              </p>
            </div>
          </div>

          <!-- Bouton avec animation et gradient -->
          <a href="{{ route('services') }}" class="group inline-flex items-center gap-2 px-5 py-2 rounded-full bg-gradient-to-r from-purple/10 to-turquoise/10 hover:from-purple/20 hover:to-turquoise/20 transition-all duration-300">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple to-turquoise font-medium">Découvrir nos services</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-turquoise transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </a>
        </div>
      </div>
    </div>
  </section>
