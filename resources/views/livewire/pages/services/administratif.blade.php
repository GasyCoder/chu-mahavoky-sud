        <!-- Services administratifs -->
        <div id="content-admin" class="tab-content hidden">
            <!-- Introduction aux services administratifs -->
            <div class="mb-10 text-center" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="text-3xl font-bold text-dark mb-4">Services Administratifs</h2>
                <p class="max-w-3xl mx-auto text-gray-dark">
                    Le CHU Mahavoky Atsimo dispose de services administratifs performants qui soutiennent les activités médicales et facilitent les démarches des patients et de leurs familles.
                </p>
            </div>

            <!-- Accordéon des services administratifs -->
            <div class="space-y-4 mb-16">
                <!-- Admission et sorties -->
                <div x-data="{ open: true }" class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up" data-aos-duration="1000">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-6 text-left focus:outline-none">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-4">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <h3 class="font-bold text-xl text-dark">Admission et sorties</h3>
                        </div>
                        <i class="fas" :class="open ? 'fa-chevron-up text-purple' : 'fa-chevron-down text-gray-dark'"></i>
                    </button>
                    <div x-show="open" class="px-6 pb-6">
                        <p class="text-gray-dark mb-4">
                            Notre service d'admission gère l'entrée et la sortie des patients, les formalités administratives et la coordination avec les différents services médicaux.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                            <div class="flex items-start">
                                <div class="text-purple mt-1 mr-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark mb-1">Horaires</h4>
                                    <p class="text-sm text-gray-dark">Lundi au vendredi: 8h - 16h</p>
                                    <p class="text-sm text-gray-dark">Samedi: 8h - 12h</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="text-purple mt-1 mr-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark mb-1">Documents nécessaires</h4>
                                    <p class="text-sm text-gray-dark">Pièce d'identité, carte d'assurance maladie, ordonnance médicale</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Facturation et paiement -->
                <div x-data="{ open: false }" class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-6 text-left focus:outline-none">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-turquoise/10 flex items-center justify-center text-turquoise mr-4">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                            <h3 class="font-bold text-xl text-dark">Facturation et paiement</h3>
                        </div>
                        <i class="fas" :class="open ? 'fa-chevron-up text-turquoise' : 'fa-chevron-down text-gray-dark'"></i>
                    </button>
                    <div x-show="open" class="px-6 pb-6">
                        <p class="text-gray-dark mb-4">
                            Notre service de facturation s'occupe de l'établissement des factures et des différentes modalités de paiement, y compris la coordination avec les assurances.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                            <div class="flex items-start">
                                <div class="text-turquoise mt-1 mr-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark mb-1">Moyens de paiement</h4>
                                    <p class="text-sm text-gray-dark">Espèces, cartes bancaires, chèques, virement bancaire</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="text-turquoise mt-1 mr-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark mb-1">Assurances partenaires</h4>
                                    <p class="text-sm text-gray-dark">Ny Havana, ARO, OSTIE, AMIT et autres mutuelles</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Archives médicales -->
                <div x-data="{ open: false }" class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-6 text-left focus:outline-none">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-4">
                                <i class="fas fa-folder-open"></i>
                            </div>
                            <h3 class="font-bold text-xl text-dark">Archives médicales</h3>
                        </div>
                        <i class="fas" :class="open ? 'fa-chevron-up text-purple' : 'fa-chevron-down text-gray-dark'"></i>
                    </button>
                    <div x-show="open" class="px-6 pb-6">
                        <p class="text-gray-dark mb-4">
                            Ce service gère la conservation et l'accès aux dossiers médicaux des patients, garantissant la confidentialité et la disponibilité des informations médicales.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                            <div class="flex items-start">
                                <div class="text-purple mt-1 mr-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark mb-1">Demande de copies</h4>
                                    <p class="text-sm text-gray-dark">Formulaire à remplir et présentation d'une pièce d'identité requise</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="text-purple mt-1 mr-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark mb-1">Délai de conservation</h4>
                                    <p class="text-sm text-gray-dark">Les dossiers sont conservés pendant 20 ans conformément à la législation</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service social -->
                <div x-data="{ open: false }" class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-6 text-left focus:outline-none">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-turquoise/10 flex items-center justify-center text-turquoise mr-4">
                                <i class="fas fa-hands-helping"></i>
                            </div>
                            <h3 class="font-bold text-xl text-dark">Service social</h3>
                        </div>
                        <i class="fas" :class="open ? 'fa-chevron-up text-turquoise' : 'fa-chevron-down text-gray-dark'"></i>
                    </button>
                    <div x-show="open" class="px-6 pb-6">
                        <p class="text-gray-dark mb-4">
                            Notre service social accompagne les patients et leurs familles dans les démarches administratives et l'accès aux aides disponibles en fonction de leur situation.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                            <div class="flex items-start">
                                <div class="text-turquoise mt-1 mr-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark mb-1">Assistance aux patients</h4>
                                    <p class="text-sm text-gray-dark">Aide à l'accès aux soins pour les patients en difficulté financière</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="text-turquoise mt-1 mr-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-dark mb-1">Coordination</h4>
                                    <p class="text-sm text-gray-dark">Liaison avec les services sociaux extérieurs et les organisations d'aide</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
