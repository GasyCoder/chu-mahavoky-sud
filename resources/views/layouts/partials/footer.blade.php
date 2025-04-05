<!-- Footer Section - Redesigned -->
<footer class="bg-gradient-to-r from-[#2a0a3c] to-[#0d3039] text-white">
    <!-- Newsletter Section -->
    <div class="container py-12 border-b border-gray-800">
        <div class="flex flex-col items-center justify-between gap-6 md:flex-row">
            <div class="text-center md:text-left">
                <h3 class="mb-1 text-xl font-bold text-white">
                    Restez informé
                </h3>
                <p class="text-sm text-gray-300">
                    Recevez nos dernières actualités et événements dans votre boîte mail
                </p>
            </div>

            <div class="flex-1 w-full max-w-md md:w-auto">
                <form class="relative">
                    <input
                        type="email"
                        class="w-full px-4 py-3 text-white transition bg-gray-800 border border-gray-700 rounded-lg placeholder:text-gray-400 focus:outline-none focus:border-turquoise"
                        placeholder="Entrez votre email"
                        required
                    />
                    <button
                        type="submit"
                        class="absolute right-1.5 top-1/2 -translate-y-1/2 px-4 py-1.5 bg-gradient-to-r from-purple to-turquoise rounded-md text-white text-sm font-medium hover:opacity-90 transition"
                    >
                        S'abonner
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Footer Content -->
    <div class="container py-12">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-4">
            <!-- Column 1: About -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    @if($settings['logo'])
                    <img src="{{ $settings['logo'] }}" alt="{{ $settings['site_name'] }}" class="w-10 h-10 p-1 bg-white rounded-full" />
                    @endif
                    <h6 class="font-bold text-white">{{ $settings['site_name'] }}</h5>
                </div>
                <p class="mb-6 text-sm text-gray-300">
                    {{ $settings['site_description'] }}
                </p>
                <div class="flex">
                    @if($settings['social']['facebook'])
                    <a href="{{ $settings['social']['facebook'] }}" target="_blank" class="flex items-center justify-center transition-colors bg-gray-800 rounded-full hover:bg-gray-700 h-9 w-9">
                        <i class="text-gray-300 fab fa-facebook-f"></i>
                    </a>
                    @endif
                    @if($settings['social']['linkedin'])
                    <a href="{{ $settings['social']['linkedin'] }}" target="_blank" class="flex items-center justify-center transition-colors bg-gray-800 rounded-full hover:bg-gray-700 h-9 w-9">
                        <i class="text-gray-300 fab fa-linkedin-in"></i>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Column 2: Links -->
            <div>
                <h6 class="relative inline-block mb-5 font-bold text-white">
                    Liens rapides
                    <span class="absolute left-0 bottom-0 w-8 h-0.5 bg-gradient-to-r from-purple to-turquoise"></span>
                </h6>
                <ul class="space-y-3">
                    <li>
                        <a href="/" class="flex items-center text-gray-300 transition-colors hover:text-white">
                            <i class="mr-2 text-xs fas fa-chevron-right text-purple"></i> Accueil
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="flex items-center text-gray-300 transition-colors hover:text-white">
                            <i class="mr-2 text-xs fas fa-chevron-right text-purple"></i> À propos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services') }}" class="flex items-center text-gray-300 transition-colors hover:text-white">
                            <i class="mr-2 text-xs fas fa-chevron-right text-purple"></i> Services
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('news') }}" class="flex items-center text-gray-300 transition-colors hover:text-white">
                            <i class="mr-2 text-xs fas fa-chevron-right text-purple"></i> Actualités
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="flex items-center text-gray-300 transition-colors hover:text-white">
                            <i class="mr-2 text-xs fas fa-chevron-right text-purple"></i> Contact
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 3: Services -->
            <div>
                <h6 class="relative inline-block mb-5 font-bold text-white">
                    Nos services
                    <span class="absolute left-0 bottom-0 w-8 h-0.5 bg-gradient-to-r from-purple to-turquoise"></span>
                </h6>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('services') }}" class="flex items-center text-gray-300 transition-colors hover:text-white">
                            <i class="mr-2 text-xs fas fa-chevron-right text-turquoise"></i> Service Technique
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="flex items-center text-gray-300 transition-colors hover:text-white">
                            <i class="mr-2 text-xs fas fa-chevron-right text-turquoise"></i> Service Administratifs
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 4: Contact -->
            <div>
                <h6 class="relative inline-block mb-5 font-bold text-white">
                    Contact
                    <span class="absolute left-0 bottom-0 w-8 h-0.5 bg-gradient-to-r from-purple to-turquoise"></span>
                </h6>
                <ul class="space-y-4">
                    <li class="flex">
                        <i class="mt-1 mr-3 fas fa-map-marker-alt text-purple"></i>
                        <span class="text-gray-300">{{ $settings['contact']['address'] }}</span>
                    </li>
                    <li class="flex">
                        <i class="mt-1 mr-3 fas fa-phone-alt text-purple"></i>
                        <span class="text-gray-300">
                            <a href="tel:{{ $settings['contact']['phone'] }}" class="transition-colors hover:text-white">{{ $settings['contact']['phone'] }}</a>
                        </span>
                    </li>
                    <li class="flex">
                        <i class="mt-1 mr-3 fas fa-envelope text-purple"></i>
                        <span class="text-gray-300">
                            <a href="mailto:{{ $settings['contact']['email'] }}" class="transition-colors hover:text-white">{{ $settings['contact']['email'] }}</a>
                        </span>
                    </li>
                    <li class="flex">
                        <i class="mt-1 mr-3 fas fa-clock text-purple"></i>
                        <span class="text-gray-300">
                            {{ $settings['hours']['weekdays'] }}<br>
                            Urgences: 24h/24, 7j/7
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

  <!-- Copyright Section -->
  <div class="bg-gradient-to-r from-black via-[#12121f] to-black py-5">
    <div class="container text-center md:text-left">
        <div class="flex flex-col items-center justify-between md:flex-row">
            <div class="text-sm text-gray-light">
                &copy; <span id="year">2023</span> {{ $settings['site_name'] }} - Tous droits réservés
            </div>
            <div class="flex items-center mt-3 space-x-4 md:mt-0">
                <a href="#" class="text-xs transition-colors text-gray-light hover:text-white">
                    Mentions légales
                </a>
                <span class="text-gray-dark">|</span>
                <a href="#" class="text-xs transition-colors text-gray-light hover:text-white">
                    Politique de confidentialité
                </a>
                <span class="text-gray-dark">|</span>
                <a href="https://gasycoder.com" target="_blank" class="flex items-center text-xs transition-colors text-gray-light hover:text-turquoise">
                    <span>Développé par</span>
                    <span class="ml-1 font-medium text-turquoise">GasyCoder</span>
                </a>
            </div>
        </div>
    </div>
  </div>

    <!-- Script pour mettre à jour l'année automatiquement -->
    <script>
        document.getElementById('year').innerHTML = new Date().getFullYear();
    </script>
  </footer>
