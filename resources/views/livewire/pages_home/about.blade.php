<!-- Section directeur - Modern & Minimal avec design ameliore -->
<section class="py-20 md:py-28 bg-gradient-to-b from-gray-light to-white relative overflow-hidden">
    <!-- Elements decoratifs en arriere-plan -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl -mr-32 -mt-32"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl -ml-32 -mb-32"></div>
    
    <div class="container px-4 mx-auto relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">
            <!-- Photo directeur avec design moderne -->
            <div class="w-full lg:w-5/12" data-aos="fade-right" data-aos-duration="1000">
                <div class="relative mx-auto max-w-md">
                    <!-- Cadre decoratif derriere la photo -->
                    <div class="absolute top-4 -left-4 w-full h-full bg-gradient-to-br from-primary/20 to-blue-500/20 rounded-3xl -z-10"></div>
                    
                    <!-- Photo avec effet -->
                    <div class="relative overflow-hidden rounded-3xl shadow-2xl group">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent z-10 opacity-60"></div>
                        <img
                            src="{{ $settings['director']['photo'] ?? asset('assets/about/directeur.png') }}"
                            alt="{{ $settings['director']['name'] ?? 'Directeur' }} - {{ $settings['site_name'] }}"
                            class="w-full h-auto object-cover aspect-[3/4] transition-transform duration-700 group-hover:scale-105"
                        />
                        
                        <!-- Badge decoration -->
                        <div class="absolute bottom-4 right-4 z-20 bg-white/90 backdrop-blur-sm rounded-2xl px-4 py-2 shadow-lg">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                <span class="text-xs font-semibold text-dark">En fonction</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Nom et titre avec design -->
                    <div class="mt-6 text-center lg:text-left">
                        <h3 class="text-2xl font-bold text-dark mb-1">
                            {{ $settings['director']['name'] }}
                        </h3>
                        <p class="text-sm font-medium text-primary">Directeur General du CHU</p>
                    </div>
                </div>
            </div>

            <!-- Contenu textuel -->
            <div class="w-full lg:w-7/12" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 bg-primary/10 rounded-full px-4 py-2 mb-5">
                    <i class="fas fa-quote-left text-primary text-sm"></i>
                    <span class="text-sm font-semibold text-primary">Le mot du directeur</span>
                </div>

                <!-- Titre avec style -->
                <h2 class="mb-6 text-2xl md:text-3xl font-bold text-dark leading-tight">
                    Engagement envers l'<span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-blue-600">excellence</span> medicale
                </h2>

                <!-- Message avec bordure moderne -->
                <div class="relative pl-6 mb-8">
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-primary via-primary/80 to-blue-500 rounded-full"></div>
                    <div class="leading-relaxed text-gray-dark text-base">
                        <p class="mb-4 text-justify">
                            {{ $settings['director']['message'] }}
                        </p>
                    </div>
                </div>
                
                <!-- Signature stylisee -->
                <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                    <div class="w-12 h-12 bg-gradient-to-br from-primary to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-md">
                        {{ substr($settings['director']['name'] ?? 'D', 0, 1) }}
                    </div>
                    <div>
                        <p class="font-semibold text-dark text-sm">{{ $settings['director']['name'] }}</p>
                        <p class="text-xs text-gray-500">Directeur General</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
