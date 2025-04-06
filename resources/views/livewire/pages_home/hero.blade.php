@php
    // Récupérer les données pertinentes en une seule fois
    $siteInfo = [
        'name' => \App\Helpers\SettingHelper::get('site_name', 'MAHAVOKY ATSIMO'),
        'description' => \App\Helpers\SettingHelper::get('site_description', 'Centre Hospitalier Universitaire'),
        'slogan' => \App\Helpers\SettingHelper::get('site_slogan', 'Offrir des soins de qualité et une prise en charge optimale pour instaurer une confiance durable.'),
        'background' => \App\Helpers\SettingHelper::getImage('hero_background', asset('assets/herobg.jpg')),
        'ministry_url' => \App\Helpers\SettingHelper::get('ministry_url', 'https://www.msanp.gov.mg/'),
        'ministry_logo' => \App\Helpers\SettingHelper::getImage('ministry_logo', asset('assets/minsante.png')),
        'presentation_video' => \App\Helpers\SettingHelper::get('presentation_video'),
    ];
@endphp

<!-- Header optimisé avec Tailwind CSS et valeurs dynamiques depuis Settings -->
<header class="relative h-[80vh] sm:h-[80vh] md:h-[80vh] bg-cover bg-center bg-no-repeat overflow-hidden"
        style="background-image: url({{ $siteInfo['background'] }})">
    <!-- Overlay avec gradient amélioré -->
    <div class="absolute inset-0 bg-gradient-to-br from-purple/80 via-purple/70 to-turquoise/60"></div>
    <!-- Contenu centré avec meilleure hiérarchie visuelle -->
    <div class="relative z-10 flex items-center justify-center h-full text-white">
      <div class="container px-4 py-12 md:py-16">
        <div class="max-w-3xl">
          <!-- Badge avec effet amélioré -->
          <div class="inline-block px-2 py-2 mb-4 transition-all duration-300 border rounded-lg shadow-lg bg-white/8 border-white/0" data-aos="fade-right" data-aos-duration="700">
            <h4 class="text-xl font-medium tracking-wide text-white sm:text-2xl md:text-2xl">{{ $siteInfo['description'] }}</h4>
          </div>

          <!-- Titre principal plus imposant -->
          <h1 class="mb-4 text-2xl font-bold leading-tight tracking-wide text-white sm:text-3xl md:text-3xl lg:text-3xl" data-aos="fade-right" data-aos-duration="900">
            {{ $siteInfo['name'] }}
          </h1>

          <!-- Description avec meilleur contraste -->
          <div class="max-w-2xl p-4 mb-6 transition-all duration-300 rounded-lg shadow-md " data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
            <p class="text-base leading-relaxed text-white md:text-lg">
              {{ $siteInfo['slogan'] }}
            </p>
          </div>

          <!-- CTAs avec meilleure disposition -->
          <div class="flex flex-wrap items-start justify-between sm:flex-row sm:items-center"
                data-aos="fade-up"
                data-aos-duration="800">
                <div class="flex flex-wrap items-start gap-4">
                    <!-- Bouton principal avec effet au survol amélioré -->
                    <a href="{{ route ('services') }}"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-white transition-all duration-300 transform rounded-lg shadow-lg bg-gradient-to-r from-purple to-turquoise hover:from-purple-dark hover:to-turquoise-dark hover:shadow-xl hover:-translate-y-1 group">
                        <span>Nos services</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>

                    <!-- Bouton vidéo avec animation ping améliorée (affiché seulement si une vidéo est configurée) -->
                    @if($siteInfo['presentation_video'])
                    <label for="video-check" class="inline-flex items-center cursor-pointer group">
                        <div class="relative flex items-center justify-center mr-3">
                            <div class="absolute w-10 h-10 rounded-full opacity-75 bg-white/30 animate-ping"></div>
                            <div class="flex items-center justify-center w-10 h-10 transition-all duration-300 rounded-full bg-white/20 backdrop-blur-sm group-hover:bg-white/30">
                                <span class="flex items-center justify-center w-8 h-8 transition-transform duration-300 bg-white rounded-full group-hover:scale-105">
                                    <i class="text-sm text-purple fas fa-play"></i>
                                </span>
                            </div>
                        </div>
                        <span class="text-sm font-medium transition-colors duration-300 group-hover:text-white/80">Voir la présentation</span>
                    </label>
                    @endif
                </div>

                <!-- Logo ministère repositionné pour ne pas dépasser la ligne rouge -->
                <a href="{{ $siteInfo['ministry_url'] }}" target="_blank"
                    class="absolute right-10 sm:right-23 md:right-32 flex items-center justify-center p-1.5 transition-all duration-300 transform rounded-lg shadow-md bg-white/90 hover:bg-white hover:shadow-lg hover:-translate-y-1">
                    <img src="{{ $siteInfo['ministry_logo'] }}" alt="Ministère de la Santé" class="h-16 md:h-18">
                </a>
            </div>
        </div>
      </div>
    </div>
</header>


@include('livewire.pages_home.counter')

@if($siteInfo['presentation_video'])
<!-- Modal vidéo optimisé avec transitions améliorées -->
<input class="hidden peer" type="checkbox" id="video-check" />
<label
  for="video-check"
  class="pointer-events-none fixed left-0 top-0 z-[99999999999] flex h-screen w-screen items-center justify-center bg-black bg-opacity-0 opacity-0 transition-all duration-500 peer-checked:bg-opacity-80 peer-checked:opacity-100 peer-checked:pointer-events-auto backdrop-blur-none peer-checked:backdrop-blur-sm"
  id="video">
  <div class="relative aspect-[16/9] w-[95%] max-w-4xl rounded-lg shadow-2xl transform scale-95 transition-all duration-500 peer-checked:scale-100">
    <label
      for="video-check"
      class="absolute right-0 text-xl text-white transition-colors duration-300 cursor-pointer -top-10 hover:text-white/80">
      <i class="fa fa-times"></i>
    </label>
    <iframe
      class="w-full h-full transition-all duration-700 scale-0 rounded-lg peer-checked:scale-100"
      title="YouTube video player"
      frameborder="0"
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
      referrerpolicy="strict-origin-when-cross-origin"
      allowfullscreen>
    </iframe>
  </div>
</label>
@endif
