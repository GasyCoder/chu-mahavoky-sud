<!-- Header spécialement optimisé pour mobile -->
<header class="relative h-screen sm:h-[80vh] bg-cover bg-no-repeat bg-center" style="background-image: url({{ asset('assets/herobg.jpg') }})">
  <!-- Overlay avec gradient optimisé -->
  <div class="absolute inset-0 bg-gradient-to-r from-purple/70 to-turquoise/60"></div>
  <!-- Contenu centré avec meilleures marges pour mobile -->
  <div class="relative z-10 flex items-center h-full text-white">
    <div class="container px-4">
      <div class="w-full">
        <!-- Badge responsive mobile-first -->
        <div class="inline-block bg-white/10 backdrop-blur-sm px-3 py-1.5 sm:px-4 sm:py-2 rounded-md sm:rounded-lg border border-white/10 shadow-sm mb-3 sm:mb-4" data-aos="fade-right" data-aos-duration="800">
          <h5 class="text-xs font-medium tracking-wide text-white sm:text-sm md:text-base">Centre Hospitalier Universitaire</h5>
        </div>

        <!-- Titre principal optimisé pour mobile -->
        <h2 class="mb-3 text-2xl font-bold leading-tight text-white sm:text-3xl md:text-4xl lg:text-5xl sm:mb-4 drop-shadow-md" data-aos="fade-right" data-aos-duration="1000">
          MAHAVOKY ATSIMO
        </h2>

        <!-- Description plus compacte sur mobile -->
        <div class="bg-black/10 backdrop-blur-sm rounded-md sm:rounded-lg p-2.5 sm:p-3 md:p-4 mb-5 sm:mb-6 md:mb-8 max-w-2xl" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
          <p class="text-sm leading-relaxed text-white sm:text-base md:text-lg">
            Offrir des soins de qualité et une prise en charge optimale pour instaurer une confiance durable entre patients et soignants.
          </p>
        </div>

        <!-- CTAs adaptés au mobile -->
        <div class="flex flex-col items-start gap-4 sm:flex-row sm:items-center sm:gap-6" data-aos="fade-up" data-aos-duration="800">
          <!-- Bouton principal avec taille adaptée -->
          <a href="{{ route ('services') }}" class="inline-flex items-center justify-center px-5 sm:px-6 py-2.5 sm:py-3 bg-gradient-to-r from-purple to-turquoise rounded-md sm:rounded-lg text-white text-sm sm:text-base font-medium shadow-md hover:shadow-lg transition-all">
            <span>Nos services</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 transition-transform sm:h-5 sm:w-5 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </a>

          <!-- Bouton vidéo avec taille réduite sur mobile -->
          <label for="video-check" class="inline-flex items-center text-sm font-medium text-white cursor-pointer sm:text-base group">
            <div class="relative flex items-center justify-center mr-2 rounded-full h-9 w-9 sm:h-10 sm:w-10 md:h-12 md:w-12 bg-white/20 backdrop-blur-sm sm:mr-3">
              <span class="absolute inset-0 rounded-full opacity-75 bg-white/40 animate-ping" style="animation-duration: 2s;"></span>
              <span class="relative flex items-center justify-center bg-white rounded-full h-7 w-7 sm:h-8 sm:w-8 md:h-10 md:w-10">
                <i class="fas fa-play text-purple text-[10px] sm:text-xs md:text-sm"></i>
              </span>
            </div>
            <span class="transition-colors group-hover:text-white/80">Voir la présentation</span>
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

@include('livewire.pages_home.counter')

<!-- Modal vidéo optimisé pour mobile -->
<input class="hidden peer" type="checkbox" id="video-check" />
<label
  for="video-check"
  class="pointer-events-none fixed left-0 top-0 z-[99999999999] flex h-screen w-screen items-center justify-center bg-black bg-opacity-50 opacity-0 transition delay-200 duration-1000 peer-checked:opacity-100 peer-checked:pointer-events-auto"
  id="video">
  <div class="relative aspect-[16/9] w-[95%] max-w-4xl rounded shadow-xl">
    <label
      for="video-check"
      class="absolute right-0 text-xl text-white cursor-pointer -top-8">
      <i class="fa fa-times"></i>
    </label>
    <iframe
      class="w-full h-full transition-transform duration-500 scale-0 rounded peer-checked:scale-100"
      title="YouTube video player"
      frameborder="0"
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
      referrerpolicy="strict-origin-when-cross-origin"
      allowfullscreen>
    </iframe>
  </div>
</label>
