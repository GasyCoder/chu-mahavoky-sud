@php
    $siteInfo = [
        'name' => \App\Helpers\SettingHelper::get('site_name', 'MAHAVOKY ATSIMO'),
        'description' => \App\Helpers\SettingHelper::get('site_description', 'Centre Hospitalier Universitaire'),
        'slogan' => \App\Helpers\SettingHelper::get('site_slogan', 'Offrir des soins de qualite et une prise en charge optimale pour instaurer une confiance durable.'),
        'background' => \App\Helpers\SettingHelper::getImage('hero_background', asset('assets/herobg.jpg')),
        'ministry_url' => \App\Helpers\SettingHelper::get('ministry_url', 'https://www.msanp.gov.mg/'),
        'ministry_logo' => \App\Helpers\SettingHelper::getImage('ministry_logo', asset('assets/minsante.png')),
        'presentation_video' => \App\Helpers\SettingHelper::get('presentation_video'),
    ];
@endphp

<header class="relative h-screen min-h-[700px] bg-fixed bg-center bg-cover overflow-hidden"
        style="background-image: url({{ $siteInfo['background'] }})">
    <!-- Overlay gradient ameliore -->
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900/80 via-slate-900/60 to-primary/30"></div>
    
    <!-- Particules decoratives -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-primary/5 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>

    <div class="relative z-10 flex items-center justify-center h-full text-white">
      <div class="container px-4 py-12 md:py-16">
        <div class="max-w-4xl mx-auto text-center">
          <!-- Badge description avec effet glassmorphism -->
          <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-5 py-2.5 mb-8 shadow-lg" 
               data-aos="fade-down" 
               data-aos-duration="800">
            <span class="relative flex h-2.5 w-2.5">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
            </span>
            <h4 class="text-sm md:text-base font-medium tracking-wide text-white">{{ $siteInfo['description'] }}</h4>
          </div>

          <!-- Titre principal avec gradient -->
          <h1 class="mb-6 text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-extrabold leading-tight tracking-tight text-white" 
              data-aos="fade-up" 
              data-aos-duration="900"
              data-aos-delay="100">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-white via-white to-primary/80">
              {{ $siteInfo['name'] }}
            </span>
          </h1>

          <!-- Slogan avec typographie amelioree -->
          <div class="max-w-2xl mx-auto mb-10" 
               data-aos="fade-up" 
               data-aos-duration="1000" 
               data-aos-delay="200">
            <p class="text-lg md:text-xl leading-relaxed text-white/85 font-light">
              {{ $siteInfo['slogan'] }}
            </p>
          </div>

          <!-- CTAs avec design moderne -->
          <div class="flex flex-col sm:flex-row items-center justify-center gap-4"
                data-aos="fade-up"
                data-aos-duration="800"
                data-aos-delay="300">
                <!-- CTA principal avec glow effect -->
                <a href="{{ route('services') }}"
                    class="group relative inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-white rounded-2xl shadow-xl shadow-primary/30 bg-gradient-to-r from-primary to-primary/90 hover:shadow-2xl hover:shadow-primary/40 transition-all duration-300 overflow-hidden hover:scale-105">
                    <span class="absolute inset-0 bg-gradient-to-r from-primary/80 to-primary transition-all duration-300 translate-y-full group-hover:translate-y-0"></span>
                    <span class="relative z-10 flex items-center gap-2.5">
                        <span>Nos services</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </span>
                </a>

                <!-- Bouton video avec effet glassmorphism -->
                @if($siteInfo['presentation_video'])
                <label for="video-check" class="group inline-flex items-center cursor-pointer gap-3 px-6 py-4 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl hover:bg-white/15 transition-all duration-300 hover:scale-105">
                    <div class="relative flex items-center justify-center">
                        <div class="absolute inset-0 bg-primary/20 rounded-full blur-md group-hover:blur-lg transition-all duration-300"></div>
                        <div class="relative flex items-center justify-center w-14 h-14 bg-white rounded-full shadow-lg group-hover:shadow-xl transition-all duration-300">
                            <i class="text-lg text-primary fas fa-play ml-1 group-hover:scale-110 transition-transform duration-300"></i>
                        </div>
                    </div>
                    <span class="text-sm font-medium text-white">Voir la presentation</span>
                </label>
                @endif
            </div>

            <!-- Stats rapides -->
            <div class="grid grid-cols-3 gap-4 md:gap-8 max-w-2xl mx-auto mt-16 pt-8 border-t border-white/10"
                 data-aos="fade-up"
                 data-aos-duration="800"
                 data-aos-delay="400">
                <div class="text-center">
                    <div class="text-2xl md:text-3xl font-bold text-white mb-1">47+</div>
                    <div class="text-xs md:text-sm text-white/60">Medecins</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl md:text-3xl font-bold text-white mb-1">15k+</div>
                    <div class="text-xs md:text-sm text-white/60">Patients</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl md:text-3xl font-bold text-white mb-1">24/7</div>
                    <div class="text-xs md:text-sm text-white/60">Urgences</div>
                </div>
            </div>
        </div>

        <!-- Logo ministere positionne -->
        <a href="{{ $siteInfo['ministry_url'] }}" target="_blank"
            class="absolute bottom-8 right-4 md:bottom-12 md:right-12 lg:right-20 group flex items-center justify-center p-2 transition-all duration-300 rounded-2xl shadow-lg bg-white/90 hover:bg-white hover:shadow-xl hover:scale-105">
            <img src="{{ $siteInfo['ministry_logo'] }}" alt="Ministere de la Sante" class="h-12 md:h-14 lg:h-16 object-contain">
        </a>
      </div>
    </div>

    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 animate-bounce hidden md:block">
        <div class="flex flex-col items-center gap-2 text-white/50">
            <span class="text-xs font-medium">Scroll</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>
</header>

@include('livewire.pages_home.counter')

@if($siteInfo['presentation_video'])
<input class="hidden peer" type="checkbox" id="video-check" />
<label
  for="video-check"
  class="pointer-events-none fixed left-0 top-0 z-[99999999999] flex h-screen w-screen items-center justify-center bg-black bg-opacity-0 opacity-0 transition-all duration-500 peer-checked:bg-opacity-80 peer-checked:opacity-100 peer-checked:pointer-events-auto backdrop-blur-none peer-checked:backdrop-blur-sm"
  id="video">
  <div class="relative aspect-[16/9] w-[95%] max-w-4xl rounded-2xl shadow-2xl transform scale-95 transition-all duration-500 peer-checked:scale-100">
    <label
      for="video-check"
      class="absolute right-0 text-xl text-white transition-colors duration-300 cursor-pointer -top-10 hover:text-white/80">
      <i class="fa fa-times"></i>
    </label>
    <iframe
      class="w-full h-full transition-all duration-700 scale-0 rounded-2xl peer-checked:scale-100"
      title="YouTube video player"
      frameborder="0"
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
      referrerpolicy="strict-origin-when-cross-origin"
      allowfullscreen>
    </iframe>
  </div>
</label>
@endif
