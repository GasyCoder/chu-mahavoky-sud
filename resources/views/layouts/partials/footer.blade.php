<!-- Footer Section - Redesigned -->
<footer class="bg-gradient-to-r from-[#2a0a3c] to-[#0d3039] text-white">
    <!-- Newsletter Section -->
    <div class="container py-12 border-b border-gray-800">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="text-center md:text-left">
                <h3 class="text-xl font-bold text-white mb-1">
                    Restez informé
                </h3>
                <p class="text-gray-300 text-sm">
                    Recevez nos dernières actualités et événements dans votre boîte mail
                </p>
            </div>

            <div class="w-full md:w-auto flex-1 max-w-md">
                <form class="relative">
                    <input
                        type="email"
                        class="w-full rounded-lg bg-gray-800 px-4 py-3 text-white placeholder:text-gray-400 border border-gray-700 focus:outline-none focus:border-turquoise transition"
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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <!-- Column 1: About -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    @if($settings['logo'])
                    <img src="{{ $settings['logo'] }}" alt="{{ $settings['site_name'] }}" class="w-10 h-10 bg-white p-1 rounded-full" />
                    @endif
                    <h6 class="text-white font-bold">{{ $settings['site_name'] }}</h5>
                </div>
                <p class="text-gray-300 text-sm mb-6">
                    {{ $settings['site_description'] }}
                </p>
                <div class="flex space-x-3">
                    @if($settings['social']['facebook'])
                    <a href="{{ $settings['social']['facebook'] }}" target="_blank" class="bg-gray-800 hover:bg-gray-700 h-9 w-9 rounded-full flex items-center justify-center transition-colors">
                        <i class="fab fa-facebook-f text-gray-300"></i>
                    </a>
                    @endif
                    @if($settings['social']['linkedin'])
                    <a href="{{ $settings['social']['linkedin'] }}" target="_blank" class="bg-gray-800 hover:bg-gray-700 h-9 w-9 rounded-full flex items-center justify-center transition-colors">
                        <i class="fab fa-linkedin-in text-gray-300"></i>
                    </a>
                    @endif
                    @if($settings['social']['twitter'])
                    <a href="{{ $settings['social']['twitter'] }}" target="_blank" class="bg-gray-800 hover:bg-gray-700 h-9 w-9 rounded-full flex items-center justify-center transition-colors">
                        <i class="fab fa-twitter text-gray-300"></i>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Column 2: Links -->
            <div>
                <h6 class="text-white font-bold mb-5 relative inline-block">
                    Liens rapides
                    <span class="absolute left-0 bottom-0 w-8 h-0.5 bg-gradient-to-r from-purple to-turquoise"></span>
                </h6>
                <ul class="space-y-3">
                    <li>
                        <a href="/" class="text-gray-300 hover:text-white transition-colors flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2 text-purple"></i> Accueil
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="text-gray-300 hover:text-white transition-colors flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2 text-purple"></i> À propos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services') }}" class="text-gray-300 hover:text-white transition-colors flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2 text-purple"></i> Services
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('news') }}" class="text-gray-300 hover:text-white transition-colors flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2 text-purple"></i> Actualités
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-gray-300 hover:text-white transition-colors flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2 text-purple"></i> Contact
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 3: Services -->
            <div>
                <h6 class="text-white font-bold mb-5 relative inline-block">
                    Nos services
                    <span class="absolute left-0 bottom-0 w-8 h-0.5 bg-gradient-to-r from-purple to-turquoise"></span>
                </h6>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('services') }}" class="text-gray-300 hover:text-white transition-colors flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2 text-turquoise"></i> Consultations
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-gray-300 hover:text-white transition-colors flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2 text-turquoise"></i> Urgences
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services') }}" class="text-gray-300 hover:text-white transition-colors flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2 text-turquoise"></i> Médecine générale
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services') }}" class="text-gray-300 hover:text-white transition-colors flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2 text-turquoise"></i> Radiologie
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 4: Contact -->
            <div>
                <h6 class="text-white font-bold mb-5 relative inline-block">
                    Contact
                    <span class="absolute left-0 bottom-0 w-8 h-0.5 bg-gradient-to-r from-purple to-turquoise"></span>
                </h6>
                <ul class="space-y-4">
                    <li class="flex">
                        <i class="fas fa-map-marker-alt text-purple mt-1 mr-3"></i>
                        <span class="text-gray-300">{{ $settings['contact']['address'] }}</span>
                    </li>
                    <li class="flex">
                        <i class="fas fa-phone-alt text-purple mt-1 mr-3"></i>
                        <span class="text-gray-300">
                            <a href="tel:{{ $settings['contact']['phone'] }}" class="hover:text-white transition-colors">{{ $settings['contact']['phone'] }}</a>
                        </span>
                    </li>
                    <li class="flex">
                        <i class="fas fa-envelope text-purple mt-1 mr-3"></i>
                        <span class="text-gray-300">
                            <a href="mailto:{{ $settings['contact']['email'] }}" class="hover:text-white transition-colors">{{ $settings['contact']['email'] }}</a>
                        </span>
                    </li>
                    <li class="flex">
                        <i class="fas fa-clock text-purple mt-1 mr-3"></i>
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
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="text-gray-light text-sm">
                &copy; <span id="year">2023</span> {{ $settings['site_name'] }} - Tous droits réservés
            </div>
            <div class="flex items-center space-x-4 mt-3 md:mt-0">
                <a href="#" class="text-gray-light hover:text-white text-xs transition-colors">
                    Mentions légales
                </a>
                <span class="text-gray-dark">|</span>
                <a href="#" class="text-gray-light hover:text-white text-xs transition-colors">
                    Politique de confidentialité
                </a>
                <span class="text-gray-dark">|</span>
                <a href="https://gasycoder.com" target="_blank" class="text-gray-light hover:text-turquoise text-xs transition-colors flex items-center">
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
