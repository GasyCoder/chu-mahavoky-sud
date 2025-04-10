<div class="py-6">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- En-tête -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-dark">Paramètres du site</h2>

            <!-- Bouton pour vider le cache -->
            <button
                wire:click="clearSettingsCache"
                class="px-4 py-2 text-white transition-colors rounded-lg bg-gray-dark hover:bg-black"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Vider le cache
            </button>
        </div>

        <!-- Message de confirmation -->
        @if (session()->has('message'))
            <div class="p-3 mb-6 text-white rounded-lg bg-turquoise">
                {{ session('message') }}
            </div>
        @endif

        <!-- Onglets -->
        <div class="bg-white rounded-t-lg shadow-sm">
            <div class="border-b border-gray">
                <nav class="flex py-1 overflow-x-auto">
                    <button
                        wire:click="setActiveTab('general')"
                        class="px-4 py-2 font-medium text-sm transition-colors whitespace-nowrap {{ $activeTab === 'general' ? 'text-purple border-b-2 border-purple' : 'text-gray-dark hover:text-purple' }}"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Général
                    </button>
                    <button
                        wire:click="setActiveTab('contact')"
                        class="px-4 py-2 font-medium text-sm transition-colors whitespace-nowrap {{ $activeTab === 'contact' ? 'text-purple border-b-2 border-purple' : 'text-gray-dark hover:text-purple' }}"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        Contact
                    </button>
                    <button
                        wire:click="setActiveTab('hours')"
                        class="px-4 py-2 font-medium text-sm transition-colors whitespace-nowrap {{ $activeTab === 'hours' ? 'text-purple border-b-2 border-purple' : 'text-gray-dark hover:text-purple' }}"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Horaires
                    </button>
                    <button
                        wire:click="setActiveTab('social')"
                        class="px-4 py-2 font-medium text-sm transition-colors whitespace-nowrap {{ $activeTab === 'social' ? 'text-purple border-b-2 border-purple' : 'text-gray-dark hover:text-purple' }}"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                        Réseaux sociaux
                    </button>
                    <button
                        wire:click="setActiveTab('seo')"
                        class="px-4 py-2 font-medium text-sm transition-colors whitespace-nowrap {{ $activeTab === 'seo' ? 'text-purple border-b-2 border-purple' : 'text-gray-dark hover:text-purple' }}"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        SEO
                    </button>
                    <button wire:click="setActiveTab('header')"
                        class="px-4 py-2 font-medium text-sm transition-colors whitespace-nowrap {{ $activeTab === 'header' ? 'text-purple border-b-2 border-purple' : 'text-gray-dark hover:text-purple' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                        En-tête
                    </button>
                    <!-- Ajouter ce bouton après l'onglet "Général" et avant "Contact" dans la barre de navigation -->
                    <button
                    wire:click="setActiveTab('director')"
                    class="px-4 py-2 font-medium text-sm transition-colors whitespace-nowrap {{ $activeTab === 'director' ? 'text-purple border-b-2 border-purple' : 'text-gray-dark hover:text-purple' }}"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Mot du directeur
                    </button>
                </nav>
            </div>
        </div>

        <!-- Contenu des onglets -->
        <div class="p-6 bg-white rounded-b-lg shadow-sm">
            <!-- Onglet Général -->
            <div class="space-y-6" style="display: {{ $activeTab === 'general' ? 'block' : 'none' }}">
                <form wire:submit.prevent="saveGeneralSettings" enctype="multipart/form-data">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <!-- Nom du site -->
                            <div class="mb-4">
                                <label for="site_name" class="block mb-1 text-sm font-medium text-dark">Nom du site</label>
                                <input wire:model="site_name" type="text" id="site_name" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                                <p class="mt-1 text-xs text-gray-dark">Nom principal de l'établissement (ex: CHU Mahavoky Atsimo)</p>
                                @error('site_name') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>

                            <!-- Description du site -->
                            <div class="mb-4">
                                <label for="site_description" class="block mb-1 text-sm font-medium text-dark">Description du site</label>
                                <textarea wire:model="site_description" id="site_description" rows="2" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50"></textarea>
                                <p class="mt-1 text-xs text-gray-dark">Courte description (ex: Centre Hospitalier Universitaire)</p>
                                @error('site_description') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>

                            <!-- Slogan du site -->
                            <div class="mb-4">
                                <label for="site_slogan" class="block mb-1 text-sm font-medium text-dark">Slogan du site</label>
                                <textarea wire:model="site_slogan" id="site_slogan" rows="2" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50"></textarea>
                                <p class="mt-1 text-xs text-gray-dark">Phrase d'accroche affichée sur la page d'accueil (ex: Offrir des soins de qualité et une prise en charge optimale)</p>
                                @error('site_slogan') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <!-- Logo -->
                            <div class="mb-4">
                                <label for="temp_logo" class="block mb-1 text-sm font-medium text-dark">Logo du site</label>

                                @if($logo)
                                    <div class="flex items-center mb-2">
                                        <img src="{{ asset('storage/' . $logo) }}" alt="Logo" class="object-contain h-16">
                                        <button type="button" wire:click="$set('logo', null)" class="ml-2 text-pink hover:text-pink-dark">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                @endif

                                <input wire:model="temp_logo" type="file" id="temp_logo" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                                <div class="mt-1 text-xs text-gray-dark">
                                    <p><span class="font-semibold">Recommandations :</span></p>
                                    <ul class="ml-2 list-disc list-inside">
                                        <li>Dimensions optimales : 300×100 pixels pour un logo horizontal</li>
                                        <li>Format recommandé : PNG avec fond transparent</li>
                                        <li>Taille maximale : 1 Mo</li>
                                    </ul>
                                </div>
                                @error('temp_logo') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>

                            <!-- Favicon -->
                            <div class="mb-4">
                                <label for="temp_favicon" class="block mb-1 text-sm font-medium text-dark">Favicon</label>

                                @if($favicon)
                                    <div class="flex items-center mb-2">
                                        <img src="{{ asset('storage/' . $favicon) }}" alt="Favicon" class="object-contain w-8 h-8">
                                        <button type="button" wire:click="$set('favicon', null)" class="ml-2 text-pink hover:text-pink-dark">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                @endif

                                <input wire:model="temp_favicon" type="file" id="temp_favicon" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                                <div class="mt-1 text-xs text-gray-dark">
                                    <p><span class="font-semibold">Recommandations :</span></p>
                                    <ul class="ml-2 list-disc list-inside">
                                        <li>Dimensions idéales : 32×32 ou 64×64 pixels (carré)</li>
                                        <li>Formats acceptés : ICO, PNG</li>
                                        <li>Taille maximale : 100 Ko</li>
                                    </ul>
                                </div>
                                @error('temp_favicon') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit" class="px-4 py-2 text-white transition-colors rounded-lg bg-purple hover:bg-purple-dark">
                            Enregistrer les paramètres généraux
                        </button>
                    </div>
                </form>
            </div>

            <!-- Onglet Contact -->
            <div class="space-y-6" style="display: {{ $activeTab === 'contact' ? 'block' : 'none' }}">
                <form wire:submit.prevent="saveContactSettings">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <!-- Téléphone standard -->
                            <div class="mb-4">
                                <label for="contact_phone" class="block mb-1 text-sm font-medium text-dark">Téléphone d'accueil</label>
                                <input wire:model="contact_phone" type="text" id="contact_phone" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                                @error('contact_phone') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>

                            <!-- Téléphone urgence -->
                            <div class="mb-4">
                                <label for="contact_emergency" class="block mb-1 text-sm font-medium text-dark">Téléphone d'urgence</label>
                                <input wire:model="contact_emergency" type="text" id="contact_emergency" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                                @error('contact_emergency') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>

                            <!-- Email standard -->
                            <div class="mb-4">
                                <label for="contact_email" class="block mb-1 text-sm font-medium text-dark">Email d'accueil</label>
                                <input wire:model="contact_email" type="email" id="contact_email" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                                @error('contact_email') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <!-- Email direction -->
                            <div class="mb-4">
                                <label for="contact_direction_email" class="block mb-1 text-sm font-medium text-dark">Email de direction</label>
                                <input wire:model="contact_direction_email" type="email" id="contact_direction_email" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                                @error('contact_direction_email') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>

                            <!-- Adresse -->
                            <div class="mb-4">
                                <label for="contact_address" class="block mb-1 text-sm font-medium text-dark">Adresse</label>
                                <textarea wire:model="contact_address" id="contact_address" rows="3" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50"></textarea>
                                @error('contact_address') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit" class="px-4 py-2 text-white transition-colors rounded-lg bg-purple hover:bg-purple-dark">
                            Enregistrer les coordonnées
                        </button>
                    </div>
                </form>
            </div>

            <!-- Onglet Horaires -->
            <div class="space-y-6" style="display: {{ $activeTab === 'hours' ? 'block' : 'none' }}">
                <form wire:submit.prevent="saveHoursSettings">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <!-- Horaires en semaine -->
                            <div class="mb-4">
                                <label for="opening_hours" class="block mb-1 text-sm font-medium text-dark">Horaires en semaine</label>
                                <input wire:model="opening_hours" type="text" id="opening_hours" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                                <p class="mt-1 text-xs text-gray-dark">Exemple: Lundi - Vendredi: 8h00 - 18h00</p>
                                @error('opening_hours') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <!-- Horaires weekend -->
                            <div class="mb-4">
                                <label for="weekend_hours" class="block mb-1 text-sm font-medium text-dark">Horaires weekend</label>
                                <input wire:model="weekend_hours" type="text" id="weekend_hours" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                                <p class="mt-1 text-xs text-gray-dark">Exemple: Samedi: 8h00 - 12h00, Dimanche: Fermé</p>
                                @error('weekend_hours') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit" class="px-4 py-2 text-white transition-colors rounded-lg bg-purple hover:bg-purple-dark">
                            Enregistrer les horaires
                        </button>
                    </div>
                </form>
            </div>

            <!-- Onglet Réseaux sociaux -->
            <div class="space-y-6" style="display: {{ $activeTab === 'social' ? 'block' : 'none' }}">
                <form wire:submit.prevent="saveSocialSettings">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <!-- Facebook -->
                            <div class="mb-4">
                                <label for="facebook_url" class="block mb-1 text-sm font-medium text-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-1 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                                    </svg>
                                    Facebook
                                </label>
                                <input wire:model="facebook_url" type="url" id="facebook_url" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                                @error('facebook_url') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>

                            <!-- Twitter -->
                            <div class="mb-4">
                                <label for="twitter_url" class="block mb-1 text-sm font-medium text-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-1 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/>
                                    </svg>
                                    Twitter
                                </label>
                                <input wire:model="twitter_url" type="url" id="twitter_url" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                                @error('twitter_url') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <!-- LinkedIn -->
                            <div class="mb-4">
                                <label for="linkedin_url" class="block mb-1 text-sm font-medium text-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-1 text-blue-700" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                    LinkedIn
                                </label>
                                <input wire:model="linkedin_url" type="url" id="linkedin_url" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                                @error('linkedin_url') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>

                            <!-- YouTube -->
                            <div class="mb-4">
                                <label for="youtube_url" class="block mb-1 text-sm font-medium text-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-1 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/>
                                    </svg>
                                    YouTube
                                </label>
                                <input wire:model="youtube_url" type="url" id="youtube_url" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                                @error('youtube_url') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit" class="px-4 py-2 text-white transition-colors rounded-lg bg-purple hover:bg-purple-dark">
                            Enregistrer les réseaux sociaux
                        </button>
                    </div>
                </form>
            </div>

            <!-- Onglet SEO -->
            <div class="space-y-6" style="display: {{ $activeTab === 'seo' ? 'block' : 'none' }}">
                <form wire:submit.prevent="saveSeoSettings">
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Meta titre -->
                        <div class="mb-4">
                            <label for="meta_title" class="block mb-1 text-sm font-medium text-dark">Meta titre</label>
                            <input wire:model="meta_title" type="text" id="meta_title" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                            <p class="mt-1 text-xs text-gray-dark">Recommandé: 50-60 caractères max. Actuel: {{ Str::length($meta_title ?? '') }}</p>
                            @error('meta_title') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Meta description -->
                        <div class="mb-4">
                            <label for="meta_description" class="block mb-1 text-sm font-medium text-dark">Meta description</label>
                            <textarea wire:model="meta_description" id="meta_description" rows="3" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50"></textarea>
                            <p class="mt-1 text-xs text-gray-dark">Recommandé: 150-160 caractères max. Actuel: {{ Str::length($meta_description ?? '') }}</p>
                            @error('meta_description') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Meta mots-clés -->
                        <div class="mb-4">
                            <label for="meta_keywords" class="block mb-1 text-sm font-medium text-dark">Meta mots-clés</label>
                            <input wire:model="meta_keywords" type="text" id="meta_keywords" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                            <p class="mt-1 text-xs text-gray-dark">Séparez les mots-clés par des virgules. Ex: hôpital, santé, médecine</p>
                            @error('meta_keywords') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit" class="px-4 py-2 text-white transition-colors rounded-lg bg-purple hover:bg-purple-dark">
                            Enregistrer les paramètres SEO
                        </button>
                    </div>
                </form>
            </div>

            <!-- Onglet Header -->
            <div class="space-y-6" style="display: {{ $activeTab === 'header' ? 'block' : 'none' }}">
                <form wire:submit.prevent="saveHeaderSettings" enctype="multipart/form-data">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <!-- Image d'arrière-plan -->
                            <div class="mb-4">
                                <label for="temp_hero_background" class="block mb-1 text-sm font-medium text-dark">Image d'arrière-plan de l'en-tête</label>

                                @if($hero_background)
                                    <div class="flex items-center mb-2">
                                        <img src="{{ asset('storage/' . $hero_background) }}" alt="Image d'arrière-plan" class="object-cover w-40 h-24 rounded">
                                    </div>
                                @endif

                                <input wire:model="temp_hero_background" type="file" id="temp_hero_background" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                                <div class="mt-1 text-xs text-gray-dark">
                                    <p><span class="font-semibold">Recommandations :</span></p>
                                    <ul class="ml-2 list-disc list-inside">
                                        <li>Dimensions idéales : 1920×1080 pixels</li>
                                        <li>Taille maximale : 2 Mo</li>
                                        <li>Formats acceptés : JPG, PNG, GIF</li>
                                    </ul>
                                </div>
                                @error('temp_hero_background') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>

                            <!-- URL du Ministère -->
                            <div class="mb-4">
                                <label for="ministry_url" class="block mb-1 text-sm font-medium text-dark">URL du Ministère</label>
                                <input wire:model="ministry_url" type="url" id="ministry_url" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50" placeholder="https://www.msanp.gov.mg/">
                                <p class="mt-1 text-xs text-gray-dark">Lien vers le site du ministère de la santé.</p>
                                @error('ministry_url') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <!-- Logo du Ministère -->
                            <div class="mb-4">
                                <label for="temp_ministry_logo" class="block mb-1 text-sm font-medium text-dark">Logo du Ministère</label>

                                @if($ministry_logo)
                                    <div class="flex items-center mb-2">
                                        <img src="{{ asset('storage/' . $ministry_logo) }}" alt="Logo du Ministère" class="object-contain h-20 rounded">
                                    </div>
                                @endif

                                <input wire:model="temp_ministry_logo" type="file" id="temp_ministry_logo" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                                <div class="mt-1 text-xs text-gray-dark">
                                    <p><span class="font-semibold">Recommandations :</span></p>
                                    <ul class="ml-2 list-disc list-inside">
                                        <li>Dimensions optimales : 200×200 à 500×500 pixels</li>
                                        <li>Taille maximale : 1 Mo</li>
                                        <li>Format recommandé : PNG avec fond transparent</li>
                                    </ul>
                                </div>
                                @error('temp_ministry_logo') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>

                            <!-- Vidéo de présentation -->
                            <div class="mb-4">
                                <label for="presentation_video" class="block mb-1 text-sm font-medium text-dark">URL de la vidéo de présentation</label>
                                <input wire:model="presentation_video" type="url" id="presentation_video" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50" placeholder="https://www.youtube.com/embed/XXXXXXXX">
                                <div class="mt-1 text-xs text-gray-dark">
                                    <p><span class="font-semibold">URL vidéo :</span></p>
                                    <ul class="ml-2 list-disc list-inside">
                                        <li>Pour YouTube : utilisez le lien d'intégration : https://www.youtube.com/XXXXXXXX</li>
                                        <li>Pour Vimeo : https://player.vimeo.com/video/XXXXXXXX</li>
                                    </ul>
                                </div>
                                @error('presentation_video') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Aperçu de l'en-tête -->
                    <div class="p-4 mt-6 rounded-lg bg-gray-light">
                        <h3 class="mb-3 text-lg font-semibold text-dark">Aperçu de l'en-tête</h3>
                        <div class="relative h-40 overflow-hidden bg-center bg-cover rounded-lg" style="background-image: url('{{ $hero_background ? asset('storage/' . $hero_background) : asset('assets/herobg.jpg') }}');">
                            <div class="absolute inset-0 bg-gradient-to-br from-purple/80 via-purple/70 to-turquoise/60"></div>
                            <div class="relative z-10 flex items-center h-full p-4 text-white">
                                <div>
                                    <h4 class="text-lg font-medium">{{ $site_description }}</h4>
                                    <h2 class="text-2xl font-bold">{{ $site_name }}</h2>
                                </div>
                            </div>
                            @if($ministry_logo)
                            <div class="absolute p-1 rounded right-3 bottom-3 bg-white/80">
                                <img src="{{ asset('storage/' . $ministry_logo) }}" alt="Logo Ministère" class="object-contain h-10">
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit" class="px-4 py-2 text-white transition-colors rounded-lg bg-purple hover:bg-purple-dark">
                            Enregistrer les paramètres d'en-tête
                        </button>
                    </div>
                </form>
            </div>
            <!-- Onglet Mot du directeur -->
            <div class="space-y-6" style="display: {{ $activeTab === 'director' ? 'block' : 'none' }}">
                <form wire:submit.prevent="saveDirectorSettings">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <!-- Nom du directeur -->
                            <div class="mb-4">
                                <label for="director_name" class="block mb-1 text-sm font-medium text-dark">Nom du directeur</label>
                                <input wire:model="director_name" type="text" id="director_name" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                                @error('director_name') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>

                            <!-- Titre du directeur -->
                            <div class="mb-4">
                                <label for="director_title" class="block mb-1 text-sm font-medium text-dark">Titre/Fonction</label>
                                <input wire:model="director_title" type="text" id="director_title" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                                @error('director_title') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>

                            <!-- Photo du directeur -->
                            <div class="mb-4">
                                <label for="temp_director_photo" class="block mb-1 text-sm font-medium text-dark">Photo du directeur</label>

                                @if($director_photo)
                                    <div class="flex items-center mb-2">
                                        <img src="{{ asset('storage/' . $director_photo) }}" alt="Photo du directeur" class="object-cover w-32 h-32 rounded-lg">
                                    </div>
                                @endif

                                <input wire:model="temp_director_photo" type="file" id="temp_director_photo" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50">
                                @error('temp_director_photo') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <!-- Message du directeur -->
                            <div class="mb-4">
                                <label for="director_message" class="block mb-1 text-sm font-medium text-dark">Message du directeur</label>
                                <textarea wire:model="director_message" id="director_message" rows="12" class="w-full rounded-lg border-gray focus:border-purple focus:ring focus:ring-purple-light focus:ring-opacity-50"></textarea>
                                <p class="mt-1 text-xs text-gray-dark">Ce message apparaîtra sur la page À propos et d'autres sections importantes du site.</p>
                                @error('director_message') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Aperçu du message -->
                    <div class="p-4 mt-6 rounded-lg bg-gray-light">
                        <h3 class="mb-3 text-lg font-semibold text-dark">Aperçu</h3>
                        <div class="flex flex-col items-start gap-6 md:flex-row">
                            @if($director_photo)
                                <div class="shrink-0">
                                    <img src="{{ asset('storage/' . $director_photo) }}" alt="{{ $director_name }}" class="object-cover w-32 h-32 rounded-lg shadow-md">
                                </div>
                            @endif
                            <div>
                                <h4 class="font-bold text-dark">{{ $director_name ?: 'Nom du directeur' }}</h4>
                                <p class="mb-3 text-sm text-purple">{{ $director_title ?: 'Titre/Fonction' }}</p>
                                <div class="italic text-gray-dark">
                                    {{ $director_message ?: 'Le message du directeur apparaîtra ici.' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit" class="px-4 py-2 text-white transition-colors rounded-lg bg-purple hover:bg-purple-dark">
                            Enregistrer le mot du directeur
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
