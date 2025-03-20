<header class="relative h-[80vh] bg-cover bg-no-repeat bg-center" style="background-image: url({{ asset('assets/herobg.jpg') }})">
  <div class="flex h-full items-center bg-gradient-to-r from-purple/60 to-turquoise/50 text-white">
    <div class="container">
      <div class="lg:w-8/12">
        <div class="max-w-3xl">
          <!-- Badge du titre principal avec taille de texte augmentée -->
          <div class="inline-block bg-purple/80 px-4 py-2 rounded mb-3" data-aos="fade-right" data-aos-duration="800">
            <h5 class="uppercase text-white text-base md:text-lg font-medium tracking-wider">Centre Hospitalier Universitaire</h5>
          </div>
          
          <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 leading-tight" data-aos="fade-right" data-aos-duration="1000">
            MAHAVOKY ATSIMO
          </h1>

        <p class="text-white/90 text-lg mb-10 max-w-2xl leading-relaxed" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
          Offrir des soins de qualité et une prise en charge optimale pour instaurer une confiance durable entre patients et soignants.
        </p>

        <!-- CTA mieux positionnés et plus accessibles -->
        <div class="flex flex-wrap items-center gap-6 md:gap-8" data-aos="fade-up" data-aos-duration="800">
          <a href="#services" class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-purple to-turquoise rounded-lg text-white font-medium shadow-lg hover:shadow-xl transition-shadow group">
            <span>Nos services</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </a>

          <label for="video-check" class="cursor-pointer inline-flex items-center text-white font-medium group">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white/20 backdrop-blur-sm mr-3 relative">
              <!-- Animation d'onde plus subtile -->
              <span class="absolute inset-0 rounded-full bg-white/40 animate-ping opacity-75" style="animation-duration: 2s;"></span>
              <span class="relative flex h-10 w-10 items-center justify-center rounded-full bg-white">
                <i class="fas fa-play text-purple text-sm"></i>
              </span>
            </div>
            <span class="group-hover:text-white/80 transition-colors">Voir la présentation</span>
          </label>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Vague décorative au bas de la section hero -->
  <div class="absolute bottom-0 left-0 right-0 text-white">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" class="w-full h-auto">
      <path fill="currentColor" fill-opacity="1" d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,100L1360,100C1280,100,1120,100,960,100C800,100,640,100,480,100C320,100,160,100,80,100L0,100Z"></path>
    </svg>
  </div>
</header>

<!-- Section des statistiques - Redesignée et repositionnée -->
<div class="container relative z-20">
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 -mt-20 bg-white rounded-lg shadow-xl p-8 mx-4 lg:mx-auto">
    <!-- Stat 1 - Médecins -->
    <div class="flex p-3 items-center">
      <div class="flex-shrink-0 mr-5">
        <div class="p-4 bg-purple/10 rounded-lg">
          <i class="fa fa-user-md text-3xl text-purple"></i>
        </div>
      </div>
      <div>
        <div class="flex items-end mb-1">
          <span id="value1" class="text-3xl font-bold text-purple counter">0</span>
          <span class="text-xl font-bold text-purple ml-1">+</span>
        </div>
        <h5 class="font-medium text-dark">Médecins spécialistes</h5>
        <p class="text-gray-dark text-sm">Une équipe médicale hautement qualifiée</p>
      </div>
    </div>
    
    <!-- Stat 2 - Patients -->
    <div class="flex p-3 items-center">
      <div class="flex-shrink-0 mr-5">
        <div class="p-4 bg-turquoise/10 rounded-lg">
          <i class="fa fa-procedures text-3xl text-turquoise"></i>
        </div>
      </div>
      <div>
        <div class="flex items-end mb-1">
          <span id="value2" class="text-3xl font-bold text-turquoise counter">0</span>
          <span class="text-xl font-bold text-turquoise ml-1">k+</span>
        </div>
        <h5 class="font-medium text-dark">Patients satisfaits</h5>
        <p class="text-gray-dark text-sm">Des soins de santé de qualité pour tous</p>
      </div>
    </div>
    
    <!-- Stat 3 - Services -->
    <div class="flex p-3 items-center">
      <div class="flex-shrink-0 mr-5">
        <div class="p-4 bg-gradient-to-br from-purple/10 to-turquoise/10 rounded-lg">
          <i class="fa fa-stethoscope text-3xl text-transparent bg-clip-text bg-gradient-to-r from-purple to-turquoise"></i>
        </div>
      </div>
      <div>
        <div class="flex items-end mb-1">
          <span class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple to-turquoise counter">{{ \App\Models\Service::count() }}</span>
        </div>
        <h5 class="font-medium text-dark">Services</h5>
        <p class="text-gray-dark text-sm">Départements médicaux et services administratifs</p>
      </div>
    </div>
  </div>
</div>

<input class="hidden" type="checkbox" id="video-check" />
<label
  for="video-check"
  class="pointer-events-none fixed left-0 top-0 z-[99999999999] flex h-screen w-screen items-center justify-center bg-black bg-opacity-50 opacity-0 transition delay-200 duration-1000"
  id="video"
>
  <div class="relative aspect-[16/9] w-11/12 rounded-md shadow-[0_0_3rem_#333] lg:w-1/2">
    <label
      for="video-check"
      class="absolute -top-14 right-0 cursor-pointer text-3xl text-white lg:-right-10 lg:-top-12">
      <i class="fa fa-times"></i>
    </label>
    <iframe
      class="h-full w-full rounded-md scale-0 transition-transform duration-500 video-check:scale-100"
      title="YouTube video player"
      frameborder="0"
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
      referrerpolicy="strict-origin-when-cross-origin"
      allowfullscreen>
    </iframe>
  </div>
</label>
