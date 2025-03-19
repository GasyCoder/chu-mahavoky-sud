<div>
    <!-- Bannière de la page Contact avec parallax -->
    <section class="relative h-80 bg-cover bg-center bg-fixed" style="background-image: url({{ asset('assets/contact-banner.jpg') }})">
        <div class="absolute inset-0 bg-gradient-to-r from-purple/90 to-turquoise/80"></div>
        <div class="container relative flex h-full items-center justify-center">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up" data-aos-duration="1000">Contactez-nous</h1>
                <div class="h-1 w-20 bg-white mx-auto" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000"></div>
                <p class="mt-4 text-white max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                    Nous sommes à votre disposition pour répondre à toutes vos questions
                </p>
            </div>
        </div>
    </section>

    <!-- Fil d'Ariane -->
    <div class="bg-gray-light py-3">
        <div class="container">
            <div class="flex items-center text-sm">
                <a href="/" class="text-purple hover:text-turquoise transition-colors">Accueil</a>
                <span class="mx-2 text-gray-dark">/</span>
                <span class="text-gray-dark">Contact</span>
            </div>
        </div>
    </div>

    <!-- Notification d'urgence -->
    <div class="container mt-8">
        <div class="bg-purple/10 border-l-4 border-purple p-4 rounded-r-lg" data-aos="fade-up" data-aos-duration="1000">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-purple text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-purple">Urgences médicales</h3>
                    <div class="mt-2 text-sm text-gray-dark">
                        <p>Pour toute urgence médicale, appelez immédiatement le <a href="tel:+261340000000" class="font-semibold text-purple">+261 34 00 000 00</a> ou rendez-vous directement au service des urgences du CHU Mahavoky Atsimo.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Coordonnées et formulaire de contact -->
    <section class="container py-16">
        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Coordonnées et informations -->
            <div class="w-full lg:w-1/3" data-aos="fade-right" data-aos-duration="1000">
                <h2 class="text-3xl font-bold text-dark mb-6">Nos coordonnées</h2>

                <!-- Adresse -->
                <div class="mb-8">
                    <div class="flex items-start">
                        <div class="w-12 h-12 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-4">
                            <i class="fas fa-map-marker-alt text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-dark text-lg mb-1">Adresse</h3>
                            <p class="text-gray-dark">CHU Mahavoky Atsimo</p>
                            <p class="text-gray-dark">Mahavoky Atsimo, Mahajanga</p>
                            <p class="text-gray-dark">Madagascar</p>
                        </div>
                    </div>
                </div>

                <!-- Téléphone -->
                <div class="mb-8">
                    <div class="flex items-start">
                        <div class="w-12 h-12 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-4">
                            <i class="fas fa-phone text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-dark text-lg mb-1">Téléphone</h3>
                            <p class="text-gray-dark">Accueil: <a href="tel:+261340000000" class="text-purple hover:text-turquoise transition-colors">+261 34 00 000 00</a></p>
                            <p class="text-gray-dark">Urgences (24h/24): <a href="tel:+261340000001" class="text-purple hover:text-turquoise transition-colors">+261 34 00 000 01</a></p>
                            <p class="text-gray-dark">Rendez-vous: <a href="tel:+261340000002" class="text-purple hover:text-turquoise transition-colors">+261 34 00 000 02</a></p>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-8">
                    <div class="flex items-start">
                        <div class="w-12 h-12 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-4">
                            <i class="fas fa-envelope text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-dark text-lg mb-1">Email</h3>
                            <p class="text-gray-dark">Informations générales: <a href="mailto:contact@chumahavaky.mg" class="text-purple hover:text-turquoise transition-colors">contact@chumahavaky.mg</a></p>
                            <p class="text-gray-dark">Rendez-vous: <a href="mailto:rdv@chumahavaky.mg" class="text-purple hover:text-turquoise transition-colors">rdv@chumahavaky.mg</a></p>
                            <p class="text-gray-dark">Direction: <a href="mailto:direction@chumahavaky.mg" class="text-purple hover:text-turquoise transition-colors">direction@chumahavaky.mg</a></p>
                        </div>
                    </div>
                </div>

                <!-- Horaires -->
                <div class="mb-8">
                    <div class="flex items-start">
                        <div class="w-12 h-12 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-4">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-dark text-lg mb-1">Horaires d'ouverture</h3>
                            <p class="text-gray-dark">Consultations: Lundi au vendredi, 8h - 16h</p>
                            <p class="text-gray-dark">Laboratoire: Lundi au samedi, 7h - 18h</p>
                            <p class="text-gray-dark">Urgences: 24h/24, 7j/7</p>
                            <p class="text-gray-dark">Admissions: Lundi au vendredi, 8h - 16h</p>
                        </div>
                    </div>
                </div>

                <!-- Réseaux sociaux -->
                <div class="mt-10">
                    <h3 class="font-semibold text-dark text-lg mb-4">Suivez-nous</h3>
                    <div class="flex space-x-3">
                        <a href="#" class="w-10 h-10 bg-purple rounded-full flex items-center justify-center text-white hover:bg-turquoise transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-purple rounded-full flex items-center justify-center text-white hover:bg-turquoise transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-purple rounded-full flex items-center justify-center text-white hover:bg-turquoise transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-purple rounded-full flex items-center justify-center text-white hover:bg-turquoise transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Formulaire de contact et carte -->
            <div class="w-full lg:w-2/3" data-aos="fade-left" data-aos-duration="1000">
                <h2 class="text-3xl font-bold text-dark mb-6">Envoyez-nous un message</h2>

                <!-- Formulaire de contact -->
                <div class="bg-white p-8 rounded-lg shadow-md mb-10">
                    <form>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="name" class="block text-dark mb-2">Nom complet <span class="text-purple">*</span></label>
                                <input type="text" id="name" class="w-full rounded-md border border-gray p-3 focus:border-purple focus:ring focus:ring-purple/20 focus:outline-none" required>
                            </div>
                            <div>
                                <label for="email" class="block text-dark mb-2">Email <span class="text-purple">*</span></label>
                                <input type="email" id="email" class="w-full rounded-md border border-gray p-3 focus:border-purple focus:ring focus:ring-purple/20 focus:outline-none" required>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="phone" class="block text-dark mb-2">Téléphone</label>
                            <input type="tel" id="phone" class="w-full rounded-md border border-gray p-3 focus:border-purple focus:ring focus:ring-purple/20 focus:outline-none">
                        </div>

                        <div class="mb-6">
                            <label for="subject" class="block text-dark mb-2">Sujet <span class="text-purple">*</span></label>
                            <select id="subject" class="w-full rounded-md border border-gray p-3 focus:border-purple focus:ring focus:ring-purple/20 focus:outline-none" required>
                                <option value="">Sélectionnez un sujet</option>
                                <option value="info">Demande d'informations</option>
                                <option value="appointment">Rendez-vous</option>
                                <option value="careers">Carrières</option>
                                <option value="feedback">Commentaires</option>
                                <option value="other">Autre</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="message" class="block text-dark mb-2">Message <span class="text-purple">*</span></label>
                            <textarea id="message" rows="6" class="w-full rounded-md border border-gray p-3 focus:border-purple focus:ring focus:ring-purple/20 focus:outline-none" required></textarea>
                        </div>

                        <div class="mb-6">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="privacy" type="checkbox" class="w-4 h-4 rounded border border-gray focus:ring-purple" required>
                                </div>
                                <label for="privacy" class="ml-2 text-sm text-gray-dark">
                                    J'accepte que mes données soient traitées conformément à la politique de confidentialité du CHU Mahavoky Atsimo.
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-purple to-turquoise text-white py-3 rounded-md hover:opacity-90 transition-opacity font-medium">
                            Envoyer le message
                        </button>
                    </form>
                </div>

                <!-- Carte -->
                <div class="rounded-lg overflow-hidden shadow-md">
                    <h3 class="font-semibold text-dark text-lg mb-4">Notre emplacement</h3>
                    <div class="h-80 w-full">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3822.7!2d46.3!3d-15.7!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTXCsDQyJzU4LjMiUyA0NsKwMTcnNTEuMiJF!5e0!3m2!1sfr!2smg!4v1616000000000!5m2!1sfr!2smg" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" class="rounded-lg"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section urgences -->
    <section class="bg-gradient-to-r from-purple to-turquoise py-16">
        <div class="container">
            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <div class="flex flex-col lg:flex-row">
                    <div class="lg:w-1/2 p-8 lg:p-12" data-aos="fade-right" data-aos-duration="1000">
                        <h2 class="text-3xl font-bold text-dark mb-6">Urgences médicales</h2>
                        <p class="text-gray-dark mb-6">
                            Notre service d'urgences est ouvert 24h/24 et 7j/7 pour accueillir et traiter toutes les situations médicales urgentes. Une équipe de professionnels qualifiés est toujours présente pour vous prendre en charge rapidement.
                        </p>

                        <div class="mb-6">
                            <h3 class="font-semibold text-dark text-lg mb-2">Quand consulter les urgences ?</h3>
                            <ul class="space-y-2 text-gray-dark">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-purple mt-1 mr-2"></i>
                                    <span>Douleur thoracique ou difficultés respiratoires</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-purple mt-1 mr-2"></i>
                                    <span>Perte de conscience ou confusion soudaine</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-purple mt-1 mr-2"></i>
                                    <span>Blessures graves ou saignements abondants</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-purple mt-1 mr-2"></i>
                                    <span>Fractures ou traumatismes</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-purple mt-1 mr-2"></i>
                                    <span>Fièvre élevée ne répondant pas aux médicaments</span>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-8">
                            <a href="tel:+261340000001" class="inline-flex items-center justify-center gap-2 bg-purple text-white px-6 py-3 rounded-md hover:bg-turquoise transition-colors font-medium">
                                <i class="fas fa-phone-alt"></i>
                                Appeler les urgences
                            </a>
                        </div>
                    </div>

                    <div class="lg:w-1/2 relative">
                        <img src="{{ asset('assets/urgences.jpg') }}" alt="Service des urgences" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                            <div class="text-center p-6">
                                <div class="bg-white/90 rounded-lg p-6 max-w-md mx-auto">
                                    <h3 class="text-2xl font-bold text-purple mb-3">Numéro d'urgence</h3>
                                    <p class="text-4xl font-bold text-purple mb-4">+261 34 00 000 01</p>
                                    <p class="text-gray-dark">Notre équipe d'urgence est disponible 24h/24 et 7j/7 pour vous porter assistance.</p>
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
            <h2 class="text-3xl font-bold text-dark mb-4">Questions fréquentes</h2>
            <p class="max-w-3xl mx-auto text-gray-dark">
                Retrouvez les réponses aux questions les plus courantes concernant nos services et modalités de contact.
            </p>
        </div>

        <div class="max-w-3xl mx-auto space-y-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
            <div x-data="{ open: true }" class="bg-white rounded-lg shadow-md overflow-hidden">
                <button @click="open = !open" class="w-full flex justify-between items-center p-6 text-left">
                    <h3 class="font-bold text-lg text-dark">Comment prendre rendez-vous avec un médecin ?</h3>
                    <i class="fas" :class="open ? 'fa-minus text-purple' : 'fa-plus text-gray-dark'"></i>
                </button>
                <div x-show="open" class="px-6 pb-6">
                    <p class="text-gray-dark">
                        Vous pouvez prendre rendez-vous par téléphone au +261 34 00 000 02, en vous présentant directement au bureau des rendez-vous dans le hall principal du CHU, ou en envoyant un email à rdv@chumahavaky.mg en précisant votre nom, la spécialité souhaitée et vos disponibilités.
                    </p>
                </div>
            </div>

            <div x-data="{ open: false }" class="bg-white rounded-lg shadow-md overflow-hidden">
                <button @click="open = !open" class="w-full flex justify-between items-center p-6 text-left">
                    <h3 class="font-bold text-lg text-dark">Quels sont les horaires de visite pour les patients hospitalisés ?</h3>
                    <i class="fas" :class="open ? 'fa-minus text-purple' : 'fa-plus text-gray-dark'"></i>
                </button>
                <div x-show="open" class="px-6 pb-6">
                    <p class="text-gray-dark">
                        Les visites aux patients hospitalisés sont autorisées tous les jours de 13h à 18h. Pour les services de soins intensifs et la pédiatrie, des horaires spécifiques sont en place. Nous vous recommandons de contacter le service concerné pour plus d'informations.
                    </p>
                </div>
            </div>

            <div x-data="{ open: false }" class="bg-white rounded-lg shadow-md overflow-hidden">
                <button @click="open = !open" class="w-full flex justify-between items-center p-6 text-left">
                    <h3 class="font-bold text-lg text-dark">Comment obtenir mes résultats d'examens médicaux ?</h3>
                    <i class="fas" :class="open ? 'fa-minus text-purple' : 'fa-plus text-gray-dark'"></i>
                </button>
                <div x-show="open" class="px-6 pb-6">
                    <p class="text-gray-dark">
                        Les résultats d'examens peuvent être récupérés au service qui a réalisé l'examen ou au bureau des archives médicales. Vous devez présenter votre pièce d'identité et le bon d'examen. Certains résultats peuvent également être envoyés par email sur demande préalable et après vérification de votre identité.
                    </p>
                </div>
            </div>

            <div x-data="{ open: false }" class="bg-white rounded-lg shadow-md overflow-hidden">
                <button @click="open = !open" class="w-full flex justify-between items-center p-6 text-left">
                    <h3 class="font-bold text-lg text-dark">Comment faire une réclamation ou une suggestion ?</h3>
                    <i class="fas" :class="open ? 'fa-minus text-purple' : 'fa-plus text-gray-dark'"></i>
                </button>
                <div x-show="open" class="px-6 pb-6">
                    <p class="text-gray-dark">
                        Pour toute réclamation ou suggestion, vous pouvez remplir le formulaire disponible à l'accueil du CHU, envoyer un email à contact@chumahavaky.mg, ou utiliser le formulaire de contact sur cette page. Toutes les réclamations sont traitées avec la plus grande attention.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bouton retour en haut -->
    <button id="backToTop" class="fixed bottom-8 right-8 z-50 hidden h-12 w-12 rounded-full bg-purple shadow-lg transition-all duration-300 hover:bg-turquoise">
        <i class="fas fa-arrow-up text-white"></i>
    </button>
</div>
