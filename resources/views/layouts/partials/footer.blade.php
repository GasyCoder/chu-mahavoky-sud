<!-- Footer Section - Design moderne avec newsletter amelioree -->
<footer class="bg-slate-900 text-white relative overflow-hidden">
    <!-- Elements decoratifs en arriere-plan -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl -mr-48 -mt-48"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl -ml-32 -mb-32"></div>
    
    <!-- Newsletter Section avec design moderne -->
    <div class="container relative z-10 py-16">
        <div class="bg-gradient-to-r from-primary to-blue-600 rounded-3xl p-8 md:p-12 shadow-2xl shadow-primary/20" data-aos="fade-up">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                <div class="text-center lg:text-left">
                    <div class="flex items-center justify-center lg:justify-start gap-3 mb-3">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="far fa-envelope text-2xl text-white"></i>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold text-white">
                            Restez informe
                        </h3>
                    </div>
                    <p class="text-white/80 text-sm md:text-base max-w-md">
                        Recevez nos dernieres actualites, evenements et conseils sante directement dans votre boite mail
                    </p>
                </div>

                <div class="w-full max-w-md lg:w-auto">
                    <form class="relative flex flex-col sm:flex-row gap-3">
                        <div class="relative flex-1">
                            <input
                                type="email"
                                class="w-full px-5 py-4 pl-12 text-white bg-white/10 border border-white/20 rounded-2xl placeholder:text-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 focus:bg-white/20 transition-all duration-300"
                                placeholder="Votre adresse email"
                                required
                            />
                            <i class="far fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-white/50"></i>
                        </div>
                        <button
                            type="submit"
                            class="px-8 py-4 bg-white text-primary font-semibold rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 whitespace-nowrap"
                        >
                            S'abonner
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </form>
                    <p class="text-white/60 text-xs mt-3 text-center lg:text-left">
                        <i class="fas fa-shield-alt mr-1"></i>
                        Vos donnees sont protegees et ne seront jamais partagees
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Footer Content -->
    <div class="container relative z-10 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12">
            <!-- Column 1: About -->
            <div>
                <div class="flex items-center gap-3 mb-6">
                    @if($settings['logo'])
                    <div class="relative">
                        <div class="absolute inset-0 bg-primary/20 rounded-xl blur-md"></div>
                        <img src="{{ $settings['logo'] }}" alt="{{ $settings['site_name'] }}" class="relative w-12 h-12 p-1.5 bg-white rounded-xl" />
                    </div>
                    @endif
                    <h6 class="font-bold text-white text-lg">{{ $settings['site_name'] }}</h6>
                </div>
                <p class="mb-6 text-sm text-slate-400 leading-relaxed">
                    {{ $settings['site_description'] }}
                </p>
                
                <!-- Reseaux sociaux -->
                <div class="flex gap-3">
                    @if($settings['social']['facebook'])
                    <a href="{{ $settings['social']['facebook'] }}" target="_blank" class="group flex items-center justify-center transition-all bg-slate-800 rounded-xl hover:bg-primary h-11 w-11 hover:shadow-lg hover:shadow-primary/30 hover:-translate-y-1">
                        <i class="fab fa-facebook-f text-slate-400 group-hover:text-white text-sm"></i>
                    </a>
                    @endif
                    @if($settings['social']['linkedin'])
                    <a href="{{ $settings['social']['linkedin'] }}" target="_blank" class="group flex items-center justify-center transition-all bg-slate-800 rounded-xl hover:bg-primary h-11 w-11 hover:shadow-lg hover:shadow-primary/30 hover:-translate-y-1">
                        <i class="fab fa-linkedin-in text-slate-400 group-hover:text-white text-sm"></i>
                    </a>
                    @endif
                    @if($settings['social']['twitter'])
                    <a href="{{ $settings['social']['twitter'] }}" target="_blank" class="group flex items-center justify-center transition-all bg-slate-800 rounded-xl hover:bg-primary h-11 w-11 hover:shadow-lg hover:shadow-primary/30 hover:-translate-y-1">
                        <i class="fab fa-twitter text-slate-400 group-hover:text-white text-sm"></i>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Column 2: Liens rapides -->
            <div>
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-1 h-6 bg-primary rounded-full"></div>
                    <h6 class="font-bold text-white text-base">Liens rapides</h6>
                </div>
                <ul class="space-y-3">
                    <li>
                        <a href="/" class="group flex items-center text-slate-400 transition-all hover:text-white text-sm hover:translate-x-1">
                            <i class="far fa-chevron-right w-4 text-xs text-primary opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            <span>Accueil</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="group flex items-center text-slate-400 transition-all hover:text-white text-sm hover:translate-x-1">
                            <i class="far fa-chevron-right w-4 text-xs text-primary opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            <span>A propos</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services') }}" class="group flex items-center text-slate-400 transition-all hover:text-white text-sm hover:translate-x-1">
                            <i class="far fa-chevron-right w-4 text-xs text-primary opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            <span>Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('news') }}" class="group flex items-center text-slate-400 transition-all hover:text-white text-sm hover:translate-x-1">
                            <i class="far fa-chevron-right w-4 text-xs text-primary opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            <span>Actualites</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="group flex items-center text-slate-400 transition-all hover:text-white text-sm hover:translate-x-1">
                            <i class="far fa-chevron-right w-4 text-xs text-primary opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            <span>Contact</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 3: Services -->
            <div>
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-1 h-6 bg-primary rounded-full"></div>
                    <h6 class="font-bold text-white text-base">Nos services</h6>
                </div>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('services') }}" class="group flex items-center text-slate-400 transition-all hover:text-white text-sm hover:translate-x-1">
                            <i class="far fa-chevron-right w-4 text-xs text-primary opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            <span>Service Technique</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="group flex items-center text-slate-400 transition-all hover:text-white text-sm hover:translate-x-1">
                            <i class="far fa-chevron-right w-4 text-xs text-primary opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            <span>Service Administratif</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="group flex items-center text-slate-400 transition-all hover:text-white text-sm hover:translate-x-1">
                            <i class="far fa-chevron-right w-4 text-xs text-primary opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            <span>Urgences 24h/24</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services') }}" class="group flex items-center text-slate-400 transition-all hover:text-white text-sm hover:translate-x-1">
                            <i class="far fa-chevron-right w-4 text-xs text-primary opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            <span>Consultations</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services') }}" class="group flex items-center text-slate-400 transition-all hover:text-white text-sm hover:translate-x-1">
                            <i class="far fa-chevron-right w-4 text-xs text-primary opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            <span>Laboratoire</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 4: Contact -->
            <div>
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-1 h-6 bg-primary rounded-full"></div>
                    <h6 class="font-bold text-white text-base">Contact</h6>
                </div>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 group">
                        <div class="w-9 h-9 bg-slate-800 rounded-lg flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-300 flex-shrink-0">
                            <i class="far fa-map-marker-alt text-sm"></i>
                        </div>
                        <span class="text-slate-400 text-sm group-hover:text-white transition-colors">{{ $settings['contact']['address'] }}</span>
                    </li>
                    <li class="flex items-start gap-3 group">
                        <div class="w-9 h-9 bg-slate-800 rounded-lg flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-300 flex-shrink-0">
                            <i class="far fa-phone text-sm"></i>
                        </div>
                        <a href="tel:{{ $settings['contact']['phone'] }}" class="text-slate-400 text-sm transition-colors hover:text-white">{{ $settings['contact']['phone'] }}</a>
                    </li>
                    <li class="flex items-start gap-3 group">
                        <div class="w-9 h-9 bg-slate-800 rounded-lg flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-300 flex-shrink-0">
                            <i class="far fa-envelope text-sm"></i>
                        </div>
                        <a href="mailto:{{ $settings['contact']['email'] }}" class="text-slate-400 text-sm transition-colors hover:text-white">{{ $settings['contact']['email'] }}</a>
                    </li>
                    <li class="flex items-start gap-3 group">
                        <div class="w-9 h-9 bg-slate-800 rounded-lg flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-300 flex-shrink-0">
                            <i class="far fa-clock text-sm"></i>
                        </div>
                        <div class="text-slate-400 text-sm">
                            <p>{{ $settings['hours']['weekdays'] }}</p>
                            <p class="text-primary font-medium mt-1">Urgences: 24h/24, 7j/7</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Copyright Section avec design -->
    <div class="bg-slate-950 py-6">
        <div class="container">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="text-sm text-slate-500 text-center md:text-left">
                    <p>&copy; <span id="year">2023</span> <span class="text-primary font-medium">{{ $settings['site_name'] }}</span> - Tous droits reserves</p>
                </div>
                <div class="flex items-center flex-wrap justify-center gap-2 text-xs">
                    <a href="#" class="px-3 py-1.5 rounded-lg text-slate-500 hover:text-white hover:bg-slate-800 transition-all">
                        Mentions legales
                    </a>
                    <span class="text-slate-700">•</span>
                    <a href="#" class="px-3 py-1.5 rounded-lg text-slate-500 hover:text-white hover:bg-slate-800 transition-all">
                        Politique de confidentialite
                    </a>
                    <span class="text-slate-700">•</span>
                    <a href="https://gasycoder.com" target="_blank" class="flex items-center gap-1 px-3 py-1.5 rounded-lg text-slate-500 hover:text-primary hover:bg-slate-800 transition-all">
                        <i class="fas fa-code"></i>
                        <span>Developpe par <span class="font-medium text-primary">GasyCoder</span></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bouton retour en haut integre au footer -->
    <button id="backToTop" class="fixed bottom-8 right-8 z-50 opacity-0 pointer-events-none transition-all duration-300 hover:scale-110">
        <div class="relative group">
            <div class="absolute inset-0 bg-primary/30 rounded-full blur-md group-hover:blur-lg transition-all duration-300"></div>
            <div class="relative w-12 h-12 bg-gradient-to-br from-primary to-blue-600 rounded-full flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
                <i class="fas fa-arrow-up text-white text-sm"></i>
            </div>
        </div>
    </button>

    <script>
        document.getElementById('year').innerHTML = new Date().getFullYear();
        
        // Back to top button functionality
        const backToTopBtn = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                backToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
                backToTopBtn.classList.add('opacity-100', 'pointer-events-auto');
            } else {
                backToTopBtn.classList.add('opacity-0', 'pointer-events-none');
                backToTopBtn.classList.remove('opacity-100', 'pointer-events-auto');
            }
        });
        
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</footer>
