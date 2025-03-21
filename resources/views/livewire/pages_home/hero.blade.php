<!-- Header spécialement optimisé pour mobile -->
<header class="relative h-screen sm:h-[80vh] bg-cover bg-no-repeat bg-center" style="background-image: url({{ asset('assets/herobg.jpg') }})">
  <!-- Overlay avec gradient optimisé -->
  <div class="absolute inset-0 bg-gradient-to-r from-purple/70 to-turquoise/60"></div>

  <!-- Contenu centré avec meilleures marges pour mobile -->
  <div class="relative flex h-full items-center text-white z-10">
    <div class="container px-4">
      <div class="w-full">
        <!-- Badge responsive mobile-first -->
        <div class="inline-block bg-white/10 backdrop-blur-sm px-3 py-1.5 sm:px-4 sm:py-2 rounded-md sm:rounded-lg border border-white/10 shadow-sm mb-3 sm:mb-4" data-aos="fade-right" data-aos-duration="800">
          <h5 class="text-white text-xs sm:text-sm md:text-base font-medium tracking-wide">Centre Hospitalier Universitaire</h5>
        </div>

        <!-- Titre principal optimisé pour mobile -->
        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-3 sm:mb-4 leading-tight drop-shadow-md" data-aos="fade-right" data-aos-duration="1000">
          MAHAVOKY ATSIMO
        </h2>

        <!-- Description plus compacte sur mobile -->
        <div class="bg-black/10 backdrop-blur-sm rounded-md sm:rounded-lg p-2.5 sm:p-3 md:p-4 mb-5 sm:mb-6 md:mb-8 max-w-2xl" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
          <p class="text-white text-sm sm:text-base md:text-lg leading-relaxed">
            Offrir des soins de qualité et une prise en charge optimale pour instaurer une confiance durable entre patients et soignants.
          </p>
        </div>

        <!-- CTAs adaptés au mobile -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-6" data-aos="fade-up" data-aos-duration="800">
          <!-- Bouton principal avec taille adaptée -->
          <a href="{{ route ('services') }}" class="inline-flex items-center justify-center px-5 sm:px-6 py-2.5 sm:py-3 bg-gradient-to-r from-purple to-turquoise rounded-md sm:rounded-lg text-white text-sm sm:text-base font-medium shadow-md hover:shadow-lg transition-all">
            <span>Nos services</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </a>

          <!-- Bouton vidéo avec taille réduite sur mobile -->
          <label for="video-check" class="cursor-pointer inline-flex items-center text-white text-sm sm:text-base font-medium group">
            <div class="flex h-9 w-9 sm:h-10 sm:w-10 md:h-12 md:w-12 items-center justify-center rounded-full bg-white/20 backdrop-blur-sm mr-2 sm:mr-3 relative">
              <span class="absolute inset-0 rounded-full bg-white/40 animate-ping opacity-75" style="animation-duration: 2s;"></span>
              <span class="relative flex h-7 w-7 sm:h-8 sm:w-8 md:h-10 md:w-10 items-center justify-center rounded-full bg-white">
                <i class="fas fa-play text-purple text-[10px] sm:text-xs md:text-sm"></i>
              </span>
            </div>
            <span class="group-hover:text-white/80 transition-colors">Voir la présentation</span>
          </label>
        </div>
      </div>
    </div>
  </div>

  <!-- Vague avec meilleure adaptation mobile -->
  <div class="absolute bottom-0 left-0 right-0 text-white">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" class="w-full h-auto" preserveAspectRatio="none">
      <path fill="currentColor" fill-opacity="1" d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,100L1360,100C1280,100,1120,100,960,100C800,100,640,100,480,100C320,100,160,100,80,100L0,100Z"></path>
    </svg>
  </div>
</header>

<!-- Section des statistiques - spécialement adaptée pour mobile -->
<div class="container relative z-20">
  <div class="px-3 sm:px-4 -mt-10 sm:-mt-16 md:-mt-20">
    <!-- Conteneur de statistiques optimisé pour mobile -->
    <div class="bg-white rounded shadow-md overflow-hidden w-full">
      <!-- Barre décorative fine -->
      <div class="h-0.5 w-full bg-gradient-to-r from-purple via-turquoise to-purple"></div>

      <!-- Statistiques empilées sur mobile -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 sm:gap-3 p-3 sm:p-4 md:p-5">
        <!-- Stat 1 - Médecins - Version très compacte sur mobile -->
        <div class="flex items-center p-1.5 sm:p-2">
          <!-- Icône compacte -->
          <div class="flex-shrink-0 mr-3">
            <div class="p-2 sm:p-2.5 bg-purple/5 rounded">
              <i class="fa fa-user-md text-base sm:text-lg md:text-xl text-purple"></i>
            </div>
          </div>

          <div>
            <!-- Compteur plus petit -->
            <div class="flex items-end">
              <span id="value1" class="text-lg sm:text-xl md:text-2xl font-bold text-purple counter" data-count="47" data-suffix="">0</span>
              <span class="text-base sm:text-lg font-bold text-purple ml-0.5">+</span>
            </div>
            <!-- Texte ultra-compact pour mobile -->
            <h5 class="font-medium text-dark text-xs sm:text-sm">Médecins spécialistes</h5>
            <p class="text-gray-dark text-[10px] sm:text-xs">Une équipe médicale qualifiée</p>
          </div>
        </div>

        <!-- Stat 2 - Patients - Version très compacte sur mobile -->
        <div class="flex items-center p-1.5 sm:p-2">
          <!-- Icône compacte -->
          <div class="flex-shrink-0 mr-3">
            <div class="p-2 sm:p-2.5 bg-turquoise/5 rounded">
              <i class="fa fa-procedures text-base sm:text-lg md:text-xl text-turquoise"></i>
            </div>
          </div>

          <div>
            <!-- Compteur plus petit -->
            <div class="flex items-end">
              <span id="value2" class="text-lg sm:text-xl md:text-2xl font-bold text-turquoise counter" data-count="15" data-suffix="k">0</span>
              <span class="text-base sm:text-lg font-bold text-turquoise ml-0.5">+</span>
            </div>
            <!-- Texte ultra-compact pour mobile -->
            <h5 class="font-medium text-dark text-xs sm:text-sm">Patients satisfaits</h5>
            <p class="text-gray-dark text-[10px] sm:text-xs">Des soins de qualité pour tous</p>
          </div>
        </div>

        <!-- Stat 3 - Services - Version très compacte sur mobile -->
        <div class="flex items-center p-1.5 sm:p-2">
          <!-- Icône compacte -->
          <div class="flex-shrink-0 mr-3">
            <div class="p-2 sm:p-2.5 bg-gradient-to-br from-purple/5 to-turquoise/5 rounded">
              <i class="fa fa-stethoscope text-base sm:text-lg md:text-xl text-transparent bg-clip-text bg-gradient-to-r from-purple to-turquoise"></i>
            </div>
          </div>

          <div>
            <!-- Compteur plus petit avec variable Laravel préservée -->
            <div class="flex items-end">
              <span class="text-lg sm:text-xl md:text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple to-turquoise counter" data-count="{{ \App\Models\Service::count() }}" data-suffix="">{{ \App\Models\Service::count() }}</span>
            </div>
            <!-- Texte ultra-compact pour mobile -->
            <h5 class="font-medium text-dark text-xs sm:text-sm">Services</h5>
            <p class="text-gray-dark text-[10px] sm:text-xs">Départements et services</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal vidéo optimisé pour mobile -->
<input class="hidden peer" type="checkbox" id="video-check" />
<label
  for="video-check"
  class="pointer-events-none fixed left-0 top-0 z-[99999999999] flex h-screen w-screen items-center justify-center bg-black bg-opacity-50 opacity-0 transition delay-200 duration-1000 peer-checked:opacity-100 peer-checked:pointer-events-auto"
  id="video"
>
  <div class="relative aspect-[16/9] w-[95%] max-w-4xl rounded shadow-xl">
    <label
      for="video-check"
      class="absolute -top-8 right-0 cursor-pointer text-xl text-white">
      <i class="fa fa-times"></i>
    </label>
    <iframe
      class="h-full w-full rounded scale-0 transition-transform duration-500 peer-checked:scale-100"
      title="YouTube video player"
      frameborder="0"
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
      referrerpolicy="strict-origin-when-cross-origin"
      allowfullscreen>
    </iframe>
  </div>
</label>
