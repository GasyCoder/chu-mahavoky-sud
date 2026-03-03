<!-- Navbar moderne & minimaliste avec effets de scroll -->
<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md transition-all duration-300" 
     id="navbar-container"
     x-data="{ 
       mobileMenuOpen: false, 
       scrolled: false,
       init() {
         window.addEventListener('scroll', () => {
           this.scrolled = window.scrollY > 20
         })
       }
     }"
     :class="{ 'shadow-lg bg-white': scrolled, 'shadow-sm bg-white/80': !scrolled }">
    <div class="container">
      <div class="flex items-center justify-between py-4">
        <!-- Logo avec animation -->
        <a href="/" class="group flex items-center gap-2.5 transition-transform duration-300 hover:scale-[1.02]">
          @if($settings['logo'])
          <div class="relative">
            <div class="absolute inset-0 bg-primary/10 rounded-xl blur-md opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <img
              src="{{ $settings['logo'] }}"
              alt="{{ $settings['site_name'] }}"
              class="relative aspect-square w-8 md:w-9 transition-transform duration-300 group-hover:scale-110"
            />
          </div>
          @endif
          <h6 class="font-bold text-primary text-base md:text-lg">{{ $settings['site_name'] }}</h6>
        </a>

        <!-- Menu hamburger et bouton d'urgence pour mobile -->
        <div class="flex items-center gap-2.5 lg:hidden">
          <!-- Bouton d'urgence avec pulse animation -->
          <a href="{{ route('contact') }}"
             class="relative flex h-9 items-center justify-center gap-1.5 rounded-xl bg-gradient-to-r from-red-500 to-red-600 px-3.5 py-2 text-xs text-white shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105">
            <span class="absolute inset-0 rounded-xl bg-red-400 opacity-30 animate-ping"></span>
            <i class="fa fa-ambulance relative z-10"></i>
            <span class="hidden sm:inline relative z-10 font-medium">Urgence</span>
          </a>

          <!-- Menu hamburger avec animation -->
          <button @click="mobileMenuOpen = !mobileMenuOpen" 
                  class="relative cursor-pointer focus:outline-none p-2.5 rounded-xl hover:bg-gray-light transition-colors duration-300 group">
            <div class="relative w-5 h-5">
              <span class="absolute top-1.5 left-0 w-5 h-0.5 bg-dark rounded-full transition-all duration-300 group-hover:bg-primary"
                    :class="{ 'rotate-45 top-2.5': mobileMenuOpen }"></span>
              <span class="absolute top-2.5 left-0 w-5 h-0.5 bg-dark rounded-full transition-all duration-300"
                    :class="{ 'opacity-0': mobileMenuOpen }"></span>
              <span class="absolute bottom-1.5 left-0 w-5 h-0.5 bg-dark rounded-full transition-all duration-300 group-hover:bg-primary"
                    :class="{ '-rotate-45 bottom-2.5': mobileMenuOpen }"></span>
            </div>
          </button>
        </div>

        <!-- Menu mobile drawer ameliore -->
        <div x-show="mobileMenuOpen" 
             x-cloak
             class="fixed inset-0 z-50 lg:hidden" 
             style="display: none;">
          <!-- Overlay avec blur -->
          <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" 
               @click="mobileMenuOpen = false"
               x-show="mobileMenuOpen"
               x-transition:enter="transition ease-out duration-300"
               x-transition:enter-start="opacity-0"
               x-transition:enter-end="opacity-100"
               x-transition:leave="transition ease-in duration-300"
               x-transition:leave-start="opacity-100"
               x-transition:leave-end="opacity-0"></div>

          <!-- Drawer avec animation -->
          <div x-show="mobileMenuOpen"
               x-transition:enter="transition ease-out duration-300"
               x-transition:enter-start="translate-x-full"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transition ease-in duration-300"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="translate-x-full"
               class="absolute right-0 top-0 h-full w-full max-w-[85%] sm:max-w-sm bg-white shadow-2xl">
            <!-- Header du drawer -->
            <div class="relative overflow-hidden bg-gradient-to-r from-primary to-primary/80 px-6 py-5">
              <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
              <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full -ml-12 -mb-12"></div>
              <div class="relative flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                  @if($settings['logo'])
                  <img
                    src="{{ $settings['logo'] }}"
                    alt="{{ $settings['site_name'] }}"
                    class="aspect-square w-8 bg-white rounded-lg p-0.5"
                  />
                  @endif
                  <div>
                    <h6 class="font-bold text-white text-base">{{ $settings['site_name'] }}</h6>
                    <p class="text-xs text-white/70">Excellence & Soin</p>
                  </div>
                </div>
                <button @click="mobileMenuOpen = false" class="relative z-10 text-white/80 hover:text-white p-2 rounded-lg hover:bg-white/10 transition-all">
                  <i class="fa fa-times text-lg"></i>
                </button>
              </div>
            </div>

            <!-- Menu items -->
            <div class="overflow-y-auto h-[calc(100%-140px)] py-4">
              <ul class="space-y-1 px-3">
                <li>
                  <a href="/" class="group flex items-center gap-3 py-3.5 px-4 rounded-xl {{ request()->is('/') ? 'bg-primary/10 text-primary font-semibold' : 'text-dark hover:bg-gray-light' }} transition-all duration-300">
                    <i class="far fa-home w-5 text-center {{ request()->is('/') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }}"></i>
                    <span>Accueil</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('about') }}" class="group flex items-center gap-3 py-3.5 px-4 rounded-xl {{ request()->routeIs('about') ? 'bg-primary/10 text-primary font-semibold' : 'text-dark hover:bg-gray-light' }} transition-all duration-300">
                    <i class="far fa-info-circle w-5 text-center {{ request()->routeIs('about') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }}"></i>
                    <span>A propos</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('services') }}" class="group flex items-center gap-3 py-3.5 px-4 rounded-xl {{ request()->routeIs('services') ? 'bg-primary/10 text-primary font-semibold' : 'text-dark hover:bg-gray-light' }} transition-all duration-300">
                    <i class="far fa-stethoscope w-5 text-center {{ request()->routeIs('services') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }}"></i>
                    <span>Services</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('news', [], false) }}" class="group flex items-center gap-3 py-3.5 px-4 rounded-xl {{ request()->routeIs('news') ? 'bg-primary/10 text-primary font-semibold' : 'text-dark hover:bg-gray-light' }} transition-all duration-300">
                    <i class="far fa-newspaper w-5 text-center {{ request()->routeIs('news') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }}"></i>
                    <span>Actualites</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('contact') }}" class="group flex items-center gap-3 py-3.5 px-4 rounded-xl {{ request()->routeIs('contact') ? 'bg-primary/10 text-primary font-semibold' : 'text-dark hover:bg-gray-light' }} transition-all duration-300">
                    <i class="far fa-envelope w-5 text-center {{ request()->routeIs('contact') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }}"></i>
                    <span>Contact</span>
                  </a>
                </li>

                @auth
                  @if(auth()->user()->isAdmin())
                  <li class="border-t border-gray-100 mt-3 pt-3">
                    <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-3 py-3.5 px-4 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-primary/10 text-primary font-semibold' : 'text-dark hover:bg-gray-light' }} transition-all duration-300">
                      <i class="far fa-lock w-5 text-center {{ request()->routeIs('admin.dashboard') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }}"></i>
                      <span>Administration</span>
                    </a>
                  </li>
                  @endif
                @endauth
              </ul>
            </div>

            <!-- Bouton urgence en bas -->
            <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-white via-white to-transparent">
              <a href="{{ route('contact') }}" class="flex items-center justify-center gap-2.5 w-full py-3.5 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:scale-[1.02] transition-all duration-300">
                <i class="fa fa-ambulance"></i>
                Urgence 24h/24
              </a>
            </div>
          </div>
        </div>

        <!-- Navigation desktop amelioree -->
        <ul class="hidden lg:flex lg:items-center lg:gap-1 font-poppins font-medium" id="navbar">
          @php
            $menuItems = [
              ['url' => '/', 'label' => 'Accueil', 'icon' => 'fa-home'],
              ['url' => route('about'), 'label' => 'A propos', 'icon' => 'fa-info-circle'],
              ['url' => route('services'), 'label' => 'Services', 'icon' => 'fa-stethoscope'],
              ['url' => route('news', [], false), 'label' => 'Actualites', 'icon' => 'fa-newspaper'],
            ];
          @endphp
          @foreach($menuItems as $item)
          <li class="group relative">
            <a href="{{ $item['url'] }}" 
               class="relative flex items-center gap-2 py-3 px-4 text-dark hover:text-primary transition-colors duration-300 {{ request()->is($item['url']) || request()->routeIs(str_replace(route('about'), 'about', str_replace(route('services'), 'services', $item['url']))) ? 'text-primary font-semibold' : '' }}">
              <span class="relative z-10">{{ $item['label'] }}</span>
              <span class="absolute bottom-0 left-0 h-0.5 bg-primary rounded-full transition-all duration-300"
                    :class="{ 'w-full': {{ request()->is($item['url']) || request()->routeIs(str_replace(route('about'), 'about', str_replace(route('services'), 'services', $item['url']))) ? 'true' : 'false' }} }"
                    style="width: {{ request()->is($item['url']) || request()->routeIs(str_replace(route('about'), 'about', str_replace(route('services'), 'services', $item['url']))) ? '100%' : '0%' }}"></span>
            </a>
          </li>
          @endforeach
        </ul>

        <!-- Actions desktop -->
        <div class="hidden lg:flex items-center gap-3">
          @auth
            @if(auth()->user()->isAdmin())
              <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-2 px-4 py-2.5 bg-primary text-white rounded-xl hover:bg-primary/90 hover:shadow-md transition-all duration-300 text-sm font-medium hover:scale-105">
                <i class="far fa-user-shield group-hover:rotate-12 transition-transform duration-300"></i>
                <span>Admin</span>
              </a>
            @endif
          @endauth

          <!-- Bouton urgence desktop avec effet -->
          <a href="{{ route('contact') }}"
             class="group relative flex items-center justify-center gap-2.5 h-11 px-6 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl hover:shadow-lg hover:shadow-red-500/30 transition-all duration-300 font-medium text-sm overflow-hidden hover:scale-105">
            <span class="absolute inset-0 bg-gradient-to-r from-red-600 to-red-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            <i class="fa fa-ambulance group-hover:rotate-12 transition-transform duration-300 relative z-10"></i>
            <span class="relative z-10">Urgence</span>
          </a>
        </div>
      </div>
    </div>
  </nav>

  <style>
    [x-cloak] { display: none !important; }
  </style>
