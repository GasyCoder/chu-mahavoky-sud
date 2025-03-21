<!-- Navbar optimisée avec menu mobile, bouton d'urgence et indicateur de connexion -->
<nav class="sticky top-0 z-50 bg-white shadow-[0_0_40px_0_#2B245D21]" id="navbar-container">
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
          <!-- Indicateur de connexion mobile -->
          @auth
            <div class="flex items-center gap-1">
              <span class="inline-block h-2 w-2 rounded-full bg-green-500"></span>
              <span class="text-xs">
                @if(auth()->user()->isAdmin())
                  Admin
                @else
                  Connecté
                @endif
              </span>
            </div>
          @endauth

          <!-- Bouton d'urgence visible sur mobile -->
          <a href="{{ route('contact') }}"
             class="flex h-8 items-center justify-center gap-1 rounded border border-purple bg-white px-3 py-1 text-xs text-purple hover:bg-purple hover:text-white transition-colors duration-300">
            <i class="fa fa-ambulance"></i>
            <span class="hidden sm:inline">Urgence</span>
          </a>

          <!-- Menu hamburger -->
          <button id="menu-toggle" class="cursor-pointer focus:outline-none">
            <i class="fa fa-bars text-purple"></i>
          </button>
        </div>

        <!-- Menu mobile -->
        <div id="mobile-menu" class="fixed inset-0 z-50 hidden">
          <!-- Overlay semi-transparent -->
          <div class="absolute inset-0 bg-black/50" id="mobile-overlay"></div>

          <!-- Contenu du menu -->
          <div class="absolute right-0 top-0 h-full w-full max-w-xs transform bg-white shadow-xl transition-transform duration-300 translate-x-full" id="mobile-content">
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
              <button id="close-menu" class="text-lg text-purple focus:outline-none">
                <i class="fa fa-times"></i>
              </button>
            </div>

            <ul class="flex flex-col">
              <!-- Informations utilisateur si connecté -->
              @auth
              <li class="border-b bg-gray-50">
                <div class="flex items-center gap-2 py-3 px-4">
                  <span class="inline-block h-2 w-2 rounded-full bg-green-500"></span>
                  <span class="text-sm font-medium">
                    @if(auth()->user()->isAdmin())
                      Connecté en tant qu'Admin
                    @else
                      Connecté en tant qu'Utilisateur
                    @endif
                  </span>
                </div>
              </li>
              @endauth

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

              <!-- Options d'authentification -->
              @auth
              @if(auth()->user()->isAdmin())
              <li class="border-b">
                <a href="{{ route('admin.dashboard') }}" class="mobile-link block py-3 px-4 {{ request()->routeIs('admin.dashboard') ? 'text-purple font-medium' : 'text-dark' }} transition-colors">
                  Dashboard Admin
                </a>
              </li>
              @endif
              <li class="border-b">
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="w-full text-left py-3 px-4 text-dark hover:text-purple transition-colors">
                    Déconnexion
                  </button>
                </form>
              </li>
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
        </ul>

        <div class="hidden lg:flex items-center gap-4">
          <!-- Indicateur de connexion desktop -->
          @auth
            <div class="flex items-center gap-2 px-3 py-1.5 bg-gray-50 rounded-full">
              <span class="inline-block h-2 w-2 rounded-full bg-green-500"></span>
              <span class="text-sm font-medium">
                @if(auth()->user()->isAdmin())
                  Admin
                @else
                  Connecté
                @endif
              </span>
              <div class="relative group">
                <button class="focus:outline-none">
                  <i class="fa fa-chevron-down text-xs text-gray-500"></i>
                </button>
                <div class="absolute right-0 top-full mt-1 w-48 rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                  @if(auth()->user()->isAdmin())
                  <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard Admin</a>
                  @endif
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                      Déconnexion
                    </button>
                  </form>
                </div>
              </div>
            </div>
          @endauth

          <!-- Bouton d'urgence desktop -->
          <a href="{{ route('contact') }}"
            class="group relative hidden lg:flex h-10 w-32 overflow-hidden rounded border-2 border-purple bg-transparent px-6 py-1.5 text-purple transition duration-300 hover:text-white items-center justify-center"
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
