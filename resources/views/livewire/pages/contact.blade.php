<div>
    <!-- Banner -->
    <section class="relative h-[40vh] bg-cover bg-center bg-fixed" style="background-image: url({{ asset('assets/contact-banner.jpg') }})">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/80 to-primary/50"></div>
        <div class="container relative flex h-full items-center justify-center">
            <div class="text-center">
                <h3 class="text-4xl font-bold text-white mb-4" data-aos="fade-up" data-aos-duration="1000">Contactez-nous</h3>
                <p class="mt-4 text-white/70 max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                    Nous sommes a votre disposition pour repondre a toutes vos questions
                </p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-gray-light py-3">
        <div class="container">
            <div class="flex items-center text-sm">
                <a href="/" class="text-primary hover:text-primary/80 transition-colors">Accueil</a>
                <span class="mx-2 text-gray-dark">/</span>
                <span class="text-gray-dark">Contact</span>
            </div>
        </div>
    </div>

    <!-- Alerte urgence -->
    <div class="container mt-8">
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r-xl" data-aos="fade-up" data-aos-duration="1000">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-red-700">Urgences medicales</h3>
                    <div class="mt-2 text-sm text-red-600">
                        <p>Pour toute urgence medicale, appelez immediatement le <a href="tel:{{ $settings['contact']['emergency'] }}" class="font-semibold text-red-700">{{ $settings['contact']['emergency'] }}</a> ou rendez-vous directement au service des urgences du {{ $settings['site_name'] }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Coordonnees et formulaire -->
    <section class="container py-16">
        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Coordonnees -->
            <div class="w-full lg:w-1/3" data-aos="fade-right" data-aos-duration="1000">
                <h2 class="text-xl font-bold text-dark mb-6">Nos coordonnees</h2>

                <!-- Adresse -->
                <div class="bg-white rounded-2xl shadow-sm p-6 mb-4">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary mr-4">
                            <i class="far fa-map-marker-alt text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-dark text-lg mb-1">Adresse</h3>
                            <p class="text-gray-dark text-sm">{{ $settings['site_name'] }}</p>
                            <p class="text-gray-dark text-sm">{{ $settings['contact']['address'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Telephone -->
                <div class="bg-white rounded-2xl shadow-sm p-6 mb-4">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary mr-4">
                            <i class="far fa-phone text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-dark text-lg mb-1">Telephone</h3>
                            <p class="text-gray-dark text-sm">Accueil: <a href="tel:{{ $settings['contact']['phone'] }}" class="text-primary hover:underline transition-colors">{{ $settings['contact']['phone'] }}</a></p>
                            <p class="text-gray-dark text-sm">Urgences (24h/24): <a href="tel:{{ $settings['contact']['emergency'] }}" class="text-primary hover:underline transition-colors">{{ $settings['contact']['emergency'] }}</a></p>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="bg-white rounded-2xl shadow-sm p-6 mb-4">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary mr-4">
                            <i class="far fa-envelope text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-dark text-lg mb-1">Email</h3>
                            <p class="text-gray-dark text-sm">Informations: <a href="mailto:{{ $settings['contact']['email'] }}" class="text-primary hover:underline transition-colors">{{ $settings['contact']['email'] }}</a></p>
                            <p class="text-gray-dark text-sm">Direction: <a href="mailto:{{ $settings['contact']['direction_email'] }}" class="text-primary hover:underline transition-colors">{{ $settings['contact']['direction_email'] }}</a></p>
                        </div>
                    </div>
                </div>

                <!-- Horaires -->
                <div class="bg-white rounded-2xl shadow-sm p-6 mb-4">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary mr-4">
                            <i class="far fa-clock text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-dark text-lg mb-1">Horaires d'ouverture</h3>
                            <p class="text-gray-dark text-sm">{{ $settings['hours']['weekdays'] }}</p>
                            <p class="text-gray-dark text-sm">{{ $settings['hours']['weekend'] }}</p>
                            <p class="text-gray-dark text-sm">Urgences: 24h/24, 7j/7</p>
                        </div>
                    </div>
                </div>

                <!-- Reseaux sociaux -->
                <div class="mt-8">
                    <h3 class="font-semibold text-dark text-lg mb-4">Suivez-nous</h3>
                    <div class="flex space-x-3">
                        @if($settings['social']['facebook'])
                        <a href="{{ $settings['social']['facebook'] }}" class="w-10 h-10 bg-gray-light rounded-full flex items-center justify-center text-gray-dark hover:bg-primary hover:text-white transition-all">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        @endif

                        @if($settings['social']['twitter'])
                        <a href="{{ $settings['social']['twitter'] }}" class="w-10 h-10 bg-gray-light rounded-full flex items-center justify-center text-gray-dark hover:bg-primary hover:text-white transition-all">
                            <i class="fab fa-twitter"></i>
                        </a>
                        @endif

                        @if($settings['social']['linkedin'])
                        <a href="{{ $settings['social']['linkedin'] }}" class="w-10 h-10 bg-gray-light rounded-full flex items-center justify-center text-gray-dark hover:bg-primary hover:text-white transition-all">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        @endif

                        @if($settings['social']['youtube'])
                        <a href="{{ $settings['social']['youtube'] }}" class="w-10 h-10 bg-gray-light rounded-full flex items-center justify-center text-gray-dark hover:bg-primary hover:text-white transition-all">
                            <i class="fab fa-youtube"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Formulaire et carte -->
            <div class="w-full lg:w-2/3" data-aos="fade-left" data-aos-duration="1000">
                <h2 class="text-xl font-bold text-dark mb-6">Envoyez-nous un message</h2>

                <div class="bg-white p-8 rounded-2xl shadow-sm mb-10">
                    @livewire('contact-form')
                </div>

                <!-- Carte -->
                <div class="rounded-2xl overflow-hidden shadow-sm">
                    <h3 class="font-semibold text-dark text-lg mb-4">Notre emplacement</h3>
                    <div class="h-80 w-full">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3822.7!2d46.3!3d-15.7!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTXCsDQyJzU4LjMiUyA0NsKwMTcnNTEuMiJF!5e0!3m2!1sfr!2smg!4v1616000000000!5m2!1sfr!2smg" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" class="rounded-2xl"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section urgences -->
    <section class="bg-primary py-16">
        <div class="container">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="flex flex-col lg:flex-row">
                    <div class="lg:w-1/2 p-8 lg:p-12" data-aos="fade-right" data-aos-duration="1000">
                        <h2 class="text-xl font-bold text-dark mb-6">Urgences medicales</h2>
                        <p class="text-gray-dark mb-6">
                            Notre service d'urgences est ouvert 24h/24 et 7j/7 pour accueillir et traiter toutes les situations medicales urgentes. Une equipe de professionnels qualifies est toujours presente pour vous prendre en charge rapidement.
                        </p>

                        <div class="mb-6">
                            <h3 class="font-semibold text-dark text-lg mb-2">Quand consulter les urgences ?</h3>
                            <ul class="space-y-2 text-gray-dark">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-primary mt-1 mr-2"></i>
                                    <span>Douleur thoracique ou difficultes respiratoires</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-primary mt-1 mr-2"></i>
                                    <span>Perte de conscience ou confusion soudaine</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-primary mt-1 mr-2"></i>
                                    <span>Blessures graves ou saignements abondants</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-primary mt-1 mr-2"></i>
                                    <span>Fractures ou traumatismes</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-primary mt-1 mr-2"></i>
                                    <span>Fievre elevee ne repondant pas aux medicaments</span>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-8">
                            <a href="tel:{{ $settings['contact']['emergency'] }}" class="inline-flex items-center justify-center gap-2 bg-primary text-white px-6 py-3 rounded-xl hover:bg-primary/90 transition-colors font-medium">
                                <i class="fas fa-phone-alt"></i>
                                Appeler les urgences
                            </a>
                        </div>
                    </div>

                    <div class="lg:w-1/2 relative">
                        <img src="{{ asset('assets/urgences.jpg') }}" alt="Service des urgences" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                            <div class="text-center p-6">
                                <div class="bg-white/90 rounded-2xl p-6 max-w-md mx-auto">
                                    <h3 class="text-xl font-bold text-primary mb-3">Numero d'urgence</h3>
                                    <p class="text-xl font-bold text-primary mb-4">{{ $settings['contact']['emergency'] }}</p>
                                    <p class="text-gray-dark text-sm">Notre equipe d'urgence est disponible 24h/24 et 7j/7 pour vous porter assistance.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="container py-16">
        <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="1000">
            <h2 class="text-xl font-bold text-dark mb-4">Questions frequentes</h2>
            <div class="w-12 h-1 bg-primary rounded-full mx-auto mb-4"></div>
            <p class="max-w-xl mx-auto text-gray-dark">
                Retrouvez les reponses aux questions les plus courantes concernant nos services et modalites de contact.
            </p>
        </div>

        <div class="max-w-3xl mx-auto space-y-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
            <div x-data="{ open: true }" class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <button @click="open = !open" class="w-full flex justify-between items-center p-6 text-left">
                    <h3 class="font-bold text-lg text-dark">Comment prendre rendez-vous avec un medecin ?</h3>
                    <i class="fas transition-transform duration-200" :class="open ? 'fa-chevron-up text-primary' : 'fa-chevron-down text-gray-dark'"></i>
                </button>
                <div x-show="open" class="px-6 pb-6">
                    <p class="text-gray-dark">
                        Vous pouvez prendre rendez-vous par telephone au {{ $settings['contact']['phone'] }}, en vous presentant directement au bureau des rendez-vous dans le hall principal du {{ $settings['site_name'] }}, ou en envoyant un email a {{ $settings['contact']['email'] }} en precisant votre nom, la specialite souhaitee et vos disponibilites.
                    </p>
                </div>
            </div>

            <div x-data="{ open: false }" class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <button @click="open = !open" class="w-full flex justify-between items-center p-6 text-left">
                    <h3 class="font-bold text-lg text-dark">Quels sont les horaires de visite pour les patients hospitalises ?</h3>
                    <i class="fas transition-transform duration-200" :class="open ? 'fa-chevron-up text-primary' : 'fa-chevron-down text-gray-dark'"></i>
                </button>
                <div x-show="open" class="px-6 pb-6">
                    <p class="text-gray-dark">
                        Les visites aux patients hospitalises sont autorisees tous les jours de 13h a 18h. Pour les services de soins intensifs et la pediatrie, des horaires specifiques sont en place. Nous vous recommandons de contacter le service concerne pour plus d'informations.
                    </p>
                </div>
            </div>

            <div x-data="{ open: false }" class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <button @click="open = !open" class="w-full flex justify-between items-center p-6 text-left">
                    <h3 class="font-bold text-lg text-dark">Comment obtenir mes resultats d'examens medicaux ?</h3>
                    <i class="fas transition-transform duration-200" :class="open ? 'fa-chevron-up text-primary' : 'fa-chevron-down text-gray-dark'"></i>
                </button>
                <div x-show="open" class="px-6 pb-6">
                    <p class="text-gray-dark">
                        Les resultats d'examens peuvent etre recuperes au service qui a realise l'examen ou au bureau des archives medicales. Vous devez presenter votre piece d'identite et le bon d'examen. Certains resultats peuvent egalement etre envoyes par email sur demande prealable et apres verification de votre identite.
                    </p>
                </div>
            </div>

            <div x-data="{ open: false }" class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <button @click="open = !open" class="w-full flex justify-between items-center p-6 text-left">
                    <h3 class="font-bold text-lg text-dark">Comment faire une reclamation ou une suggestion ?</h3>
                    <i class="fas transition-transform duration-200" :class="open ? 'fa-chevron-up text-primary' : 'fa-chevron-down text-gray-dark'"></i>
                </button>
                <div x-show="open" class="px-6 pb-6">
                    <p class="text-gray-dark">
                        Pour toute reclamation ou suggestion, vous pouvez remplir le formulaire disponible a l'accueil du {{ $settings['site_name'] }}, envoyer un email a {{ $settings['contact']['email'] }}, ou utiliser le formulaire de contact sur cette page. Toutes les reclamations sont traitees avec la plus grande attention.
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
