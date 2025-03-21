<!-- Navbar optimisée avec menu mobile, bouton d'urgence et indicateur de connexion -->
<nav class="sticky top-0 z-50 bg-white shadow-[0_0_40px_0_#2B245D21]" id="navbar-container"
x-data="{ mobileMenuOpen: false }">
    <div class="container">
      <div class="flex items-center justify-between py-3">
        <!-- Logo avec design plus compact -->
        <a href="/" class="flex items-center gap-2">
          @if($settings['logo'])
          <img
            src="{{ $settings['logo'] }}"
            alt="{{ $settings['site_name'] }}"
            class="aspect-square w-6 md:w-7"
          />
          @endif
          <h6 class="font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple to-turquoise">{{ $settings['site_name'] }}</h6>
        </a>

        <!-- Menu hamburger et bouton d'urgence pour mobile -->
        <div class="flex items-center gap-3 lg:hidden">
          <!-- Bouton d'urgence visible sur mobile -->
          <a href="{{ route('contact') }}"
             class="flex h-8 items-center justify-center gap-1 rounded border border-purple bg-white px-3 py-1 text-xs text-purple hover:bg-purple hover:text-white transition-colors duration-300">
            <i class="fa fa-ambulance"></i>
            <span class="hidden sm:inline">Urgence</span>
          </a>

          <!-- Menu hamburger -->
          <button @click="mobileMenuOpen = !mobileMenuOpen" class="cursor-pointer focus:outline-none p-2">
            <i class="fa fa-bars text-purple"></i>
          </button>
        </div>

        <!-- Menu mobile -->
        <div x-show="mobileMenuOpen" class="fixed inset-0 z-50" style="display: none;">
          <!-- Overlay semi-transparent -->
          <div class="absolute inset-0 bg-black/50" @click="mobileMenuOpen = false"></div>

          <!-- Contenu du menu -->
          <div x-show="mobileMenuOpen"
               x-transition:enter="transition ease-out duration-300"
               x-transition:enter-start="translate-x-full"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transition ease-in duration-300"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="translate-x-full"
               class="absolute right-0 top-0 h-full w-full max-w-xs bg-white shadow-xl">
            <div class="flex items-center justify-between border-b p-4">
              <div class="flex items-center gap-2">
                @if($settings['logo'])
                <img
                  src="{{ $settings['logo'] }}"
                  alt="{{ $settings['site_name'] }}"
                  class="aspect-square w-6"
                />
                @endif
                <h6 class="font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple to-turquoise">{{ $settings['site_name'] }}</h6>
              </div>
              <button @click="mobileMenuOpen = false" class="text-lg text-purple focus:outline-none p-2">
                <i class="fa fa-times"></i>
              </button>
            </div>

            <ul class="flex flex-col">
              <li class="border-b">
                <a href="/" class="mobile-link block py-3 px-4 {{ request()->is('/') ? 'text-purple font-medium' : 'text-dark' }} transition-colors">
                  Accueil
                </a>
              </li>
              <li class="border-b">
                <a href="{{ route('about') }}" class="mobile-link block py-3 px-4 {{ request()->routeIs('about') ? 'text-purple font-medium' : 'text-dark' }} transition-colors">
                  À propos
                </a>
              </li>
              <li class="border-b">
                <a href="{{ route('services') }}" class="mobile-link block py-3 px-4 {{ request()->routeIs('services') ? 'text-purple font-medium' : 'text-dark' }} transition-colors">
                  Services
                </a>
              </li>
              <li class="border-b">
                <a href="{{ route('news', [], false) }}" class="mobile-link block py-3 px-4 {{ request()->routeIs('news') ? 'text-purple font-medium' : 'text-dark' }} transition-colors">
                  Actualités
                </a>
              </li>

              <!-- Lien Admin Dashboard si admin -->
              @auth
                @if(auth()->user()->isAdmin())
                <li class="border-b">
                  <a href="{{ route('admin.dashboard') }}" class="mobile-link block py-3 px-4 {{ request()->routeIs('admin.dashboard') ? 'text-purple font-medium' : 'text-dark' }} transition-colors">
                    <i class="fa fa-lock mr-1"></i> Administration
                  </a>
                </li>
                @endif
              @endauth

              <!-- Bouton d'urgence dans le menu mobile -->
              <li class="p-4">
                <a href="{{ route('contact') }}" class="flex items-center justify-center gap-2 w-full py-3 px-4 bg-gradient-to-r from-purple to-turquoise text-white font-medium rounded shadow-sm">
                  <i class="fa fa-ambulance"></i>
                  Urgence
                </a>
              </li>
            </ul>
          </div>
        </div>

        <!-- Navigation principale pour desktop -->
        <ul
          class="hidden lg:flex lg:items-center lg:gap-10 font-poppins font-medium"
          id="navbar"
        >
          <!-- Élément Accueil - avec détection de route active -->
          <li class="group {{ request()->is('/') ? 'active' : '' }}">
            <a href="/" class="{{ request()->is('/') ? 'text-purple' : 'text-dark hover:text-purple' }} transition-colors">Accueil</a>
            <div
              class="ml-auto h-[1.3px] {{ request()->is('/') ? 'w-full ml-0' : 'w-0' }} bg-purple transition-[width] duration-150 group-hover:ml-0 group-hover:w-full"
            ></div>
          </li>

          <!-- Élément À propos - avec détection de route active -->
          <li class="group {{ request()->routeIs('about') ? 'active' : '' }}">
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-purple' : 'text-dark hover:text-purple' }} transition-colors">À propos</a>
            <div
              class="ml-auto h-[1.3px] {{ request()->routeIs('about') ? 'w-full ml-0' : 'w-0' }} bg-purple transition-[width] duration-150 group-hover:ml-0 group-hover:w-full"
            ></div>
          </li>

          <!-- Élément Services - avec détection de route active -->
          <li class="group {{ request()->routeIs('services') ? 'active' : '' }}">
            <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'text-purple' : 'text-dark hover:text-purple' }} transition-colors">Services</a>
            <div
              class="ml-auto h-[1.3px] {{ request()->routeIs('services') ? 'w-full ml-0' : 'w-0' }} bg-purple transition-[width] duration-150 group-hover:ml-0 group-hover:w-full"
            ></div>
          </li>

          <!-- Élément Actualités - avec détection de route active -->
          <li class="group {{ request()->routeIs('news') ? 'active' : '' }}">
            <a href="{{ route('news', [], false) }}" class="{{ request()->routeIs('news') ? 'text-purple' : 'text-dark hover:text-purple' }} transition-colors">Actualités</a>
            <div
              class="ml-auto h-[1.3px] {{ request()->routeIs('news') ? 'w-full ml-0' : 'w-0' }} bg-purple transition-[width] duration-150 group-hover:ml-0 group-hover:w-full"
            ></div>
          </li>

          <!-- Élément Admin - visible uniquement pour les administrateurs -->
          @auth
            @if(auth()->user()->isAdmin())
            <li class="group {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
              <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'text-purple' : 'text-dark hover:text-purple' }} transition-colors">
                <i class="fa fa-lock mr-1"></i> Admin
              </a>
              <div
                class="ml-auto h-[1.3px] {{ request()->routeIs('admin.dashboard') ? 'w-full ml-0' : 'w-0' }} bg-purple transition-[width] duration-150 group-hover:ml-0 group-hover:w-full"
              ></div>
            </li>
            @endif
          @endauth
        </ul>

        <div class="hidden lg:flex items-center gap-4">
          <!-- Indicateur de connexion desktop simplifié -->
          @auth
            @if(auth()->user()->isAdmin())
              <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-1.5 bg-purple text-white rounded-full hover:bg-purple/90 transition-colors">
                <i class="fa fa-user-shield"></i>
                <span class="text-sm font-medium">Admin</span>
              </a>
            @else
              <span class="flex items-center gap-2 px-3 py-1.5 bg-gray-100 rounded-full">
                <span class="inline-block h-2 w-2 rounded-full bg-green-500"></span>
                <span class="text-sm font-medium">Connecté</span>
              </span>
            @endif
          @endauth

          <!-- Bouton d'urgence desktop -->
          <a href="{{ route('contact') }}"
            class="group relative flex h-10 w-32 overflow-hidden rounded border-2 border-purple bg-transparent px-6 py-1.5 text-purple transition duration-300 hover:text-white items-center justify-center"
          >
            <span
              class="absolute bottom-0 left-0 right-0 top-0 z-10 m-auto inline-flex items-center justify-center gap-1.5"
            >
              <i class="fa fa-ambulance"></i>
              Urgence
            </span>
            <div
              class="absolute left-0 top-0 z-0 h-full w-0 rounded-r-full bg-purple transition-[width] duration-300 group-hover:w-44"
            ></div>
          </a>
        </div>
      </div>
    </div>
  </nav>
