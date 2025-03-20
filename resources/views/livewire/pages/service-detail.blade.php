<div>
    <!-- Bannière avec hauteur ajustée et typographie optimisée -->
    <div class="relative">
        <!-- Image de fond ou gradient si pas d'image -->
        <div class="absolute inset-0 bg-gradient-to-r from-purple to-turquoise overflow-hidden">
            @if($service->image)
                <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" class="w-full h-full object-cover opacity-30 mix-blend-overlay">
            @endif
        </div>

        <!-- Contenu de la bannière avec taille de texte ajustée -->
        <div class="relative py-12 md:py-16 container mx-auto px-4" data-aos="fade-up">
            <div class="inline-flex items-center bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-white/90 text-xs mb-3">
                <i class="{{ $service->category->icon ?? 'fas fa-tag' }} mr-1.5"></i>
                <span>{{ $service->category->name }}</span>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ $service->name }}</h1>
            <div class="flex items-center text-white/80 inline-block px-3 py-1.5 rounded-lg backdrop-blur-sm text-sm">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">
                    <i class="fas fa-home mr-1"></i>Accueil
                </a>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <a href="{{ route('services') }}" class="hover:text-white transition-colors">Nos Services</a>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <span class="text-white">{{ $service->name }}</span>
            </div>
        </div>
    </div>

    <!-- Contenu principal avec espacement et tailles optimisés -->
    <div class="container mx-auto px-4 py-8 md:py-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Colonne principale - Informations du service -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Carte principale -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up">
                    <!-- Grande image du service si disponible, hauteur optimisée -->
                    @if($service->image)
                    <div class="h-64 md:h-72 relative group">
                        <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-4">
                            <div class="inline-flex items-center bg-{{ $service->category->is_medical ? 'purple' : 'turquoise' }}/90 text-white px-2.5 py-1 rounded-lg text-xs">
                                <i class="{{ $service->category->icon ?? 'fas fa-tag' }} mr-1.5"></i>
                                {{ $service->category->name }}
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="p-5 md:p-6">
                        <!-- Description complète avec taille de texte ajustée -->
                        <div class="prose max-w-none mb-6 text-gray-700">
                            <h5 class="font-semibold text-dark mb-3 relative">
                                À propos de ce service
                                <span class="block w-16 h-1 bg-purple mt-2"></span>
                            </h5>
                            <div class="text-base">
                                {!! $service->full_description !!}
                            </div>
                        </div>

                        <!-- Équipements si disponibles -->
                        @if(!empty($service->equipments) && is_array($service->equipments) && count($service->equipments) > 0)
                        <div class="mt-8">
                            <h5 class="text-dark mb-3 flex items-center">
                                <i class="fas fa-tools text-purple mr-2"></i>
                                Équipements & Technologies
                            </h5>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-3">
                                @foreach($service->equipments as $equipment)
                                <div class="bg-gray-50 px-3 py-2 rounded-lg flex items-center text-sm">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>{{ $equipment }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Section améliorée de l'équipe -->
<!-- Section améliorée de l'équipe -->
@php
    // Vérifier si nous avons un leader d'équipe et des membres
    $hasTeamLeader = isset($service->team_members['leader']) && !empty($service->team_members['leader']);
    $hasTeamMembers = isset($service->team_members['members']) && is_array($service->team_members['members']) && count($service->team_members['members']) > 0;
    $teamName = $service->team_members['name'] ?? null;
@endphp

@if($hasTeamLeader || $hasTeamMembers || !empty($formattedTeamMembers))
<div class="bg-white rounded-lg shadow-md overflow-hidden p-5 md:p-6" data-aos="fade-up" data-aos-delay="100">
    <h5 class="font-semibold text-dark mb-4 flex items-center">
        <i class="fas fa-user-md text-purple mr-2"></i>
        @if($teamName)
            {{ $teamName }}
        @else
            Notre équipe spécialisée
        @endif
    </h5>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Afficher le responsable d'équipe s'il existe -->
        @if($hasTeamLeader)
            @php
                $leader = $service->team_members['leader'];
                $leaderName = $leader['name'] ?? 'Responsable';
                $leaderPosition = $leader['position'] ?? 'Chef de service';
                $leaderPhoto = $leader['photo'] ?? null;
            @endphp
            <div class="team-member-card team-member-lead" data-member-index="leader">
                <div class="team-member-avatar bg-purple/10 relative rounded-full overflow-hidden mx-auto mt-4 mb-3" style="width: 100px; height: 100px;">
                    @if(!empty($leaderPhoto))
                        <img src="{{ asset($leaderPhoto) }}" alt="{{ $leaderName }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-user-md text-purple text-3xl"></i>
                        </div>
                    @endif
                    <span class="absolute bottom-0 right-0 bg-purple text-white text-xs px-1.5 py-0.5 rounded-full">
                        <i class="fas fa-star text-xs mr-1"></i>
                        Chef
                    </span>
                </div>
                <div class="p-3 text-center">
                    <h5 class="text-dark text-base font-medium">{{ $leaderName }}</h5>
                    <p class="text-gray-600 text-xs mt-0.5">{{ $leaderPosition }}</p>
                </div>
            </div>
        @endif

            <!-- Afficher les membres d'équipe s'ils existent -->
            @if($hasTeamMembers)
                @foreach($service->team_members['members'] as $index => $member)
                    @php
                        $memberName = $member['name'] ?? 'Membre';
                        $memberPosition = $member['position'] ?? 'Professionnel de santé';
                        $memberPhoto = $member['photo'] ?? null;
                        $colorIndex = $index % 3;
                        $avatarBgClass = $colorIndex === 0 ? 'bg-turquoise/10' : ($colorIndex === 1 ? 'bg-amber-400/10' : 'bg-gray-200');
                        $avatarIconClass = $colorIndex === 0 ? 'fa-user-nurse text-turquoise' : ($colorIndex === 1 ? 'fa-user text-amber-500' : 'fa-user-plus text-gray-500');
                    @endphp
                    <div class="team-member-card" data-member-index="{{ $index }}">
                        <div class="team-member-avatar {{ $avatarBgClass }} relative rounded-full overflow-hidden mx-auto mt-4 mb-3" style="width: 100px; height: 100px;">
                            @if(!empty($memberPhoto))
                                <img src="{{ asset($memberPhoto) }}" alt="{{ $memberName }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas {{ $avatarIconClass }} text-3xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-3 text-center">
                            <h5 class="text-dark text-base font-medium">{{ $memberName }}</h5>
                            <p class="text-gray-600 text-xs mt-0.5">{{ $memberPosition }}</p>
                        </div>
                    </div>
                @endforeach
            @endif

        <!-- Utiliser les données formatées si nous n'avons pas la structure attendue -->
            @if(!$hasTeamLeader && !$hasTeamMembers && !empty($formattedTeamMembers))
                @foreach($formattedTeamMembers as $index => $member)
                    <div class="team-member-card {{ $member['isLead'] ? 'team-member-lead' : '' }}" data-member-index="{{ $index }}">
                        @php
                            $colorIndex = $index % 3;
                            $avatarBgClass = $colorIndex === 0 ? 'bg-purple/10' : ($colorIndex === 1 ? 'bg-turquoise/10' : 'bg-amber-400/10');
                            $avatarIconClass = $colorIndex === 0 ? 'fa-user-md text-purple' : ($colorIndex === 1 ? 'fa-user-nurse text-turquoise' : 'fa-user text-amber-500');
                        @endphp
                        
                        <div class="team-member-avatar {{ $avatarBgClass }} relative rounded-full overflow-hidden mx-auto mt-4 mb-3" style="width: 100px; height: 100px;">
                            @if(!empty($member['avatar']))
                                <img src="{{ asset($member['avatar']) }}" alt="{{ $member['name'] }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas {{ $avatarIconClass }} text-3xl"></i>
                                </div>
                            @endif

                            @if($member['isLead'])
                            <span class="absolute bottom-0 right-0 bg-purple text-white text-xs px-1.5 py-0.5 rounded-full">
                                <i class="fas fa-star text-xs mr-1"></i>
                                Chef
                            </span>
                            @endif
                        </div>

                        <div class="p-3 text-center">
                            <h5 class="text-dark text-base font-medium">{{ $member['name'] }}</h5>
                            <p class="text-gray-600 text-xs mt-0.5">{{ $member['role'] }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    @endif
            </div>

            <!-- Colonne latérale - Informations pratiques -->
            <div class="space-y-6">
                <!-- Carte d'informations de contact -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-left">
                    <div class="bg-purple/10 p-4">
                        <h5 class="text-dark flex items-center font-medium">
                            <i class="fas fa-info-circle text-purple mr-2"></i>
                            Informations pratiques
                        </h5>
                    </div>

                    <div class="p-4 space-y-4">
                        @if($service->phone)
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-3 shrink-0">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <p class="font-medium text-dark text-sm">Téléphone</p>
                                <p class="text-gray-700 text-sm">{{ $service->phone }}</p>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $service->phone) }}" class="text-purple text-xs hover:underline inline-flex items-center mt-1">
                                    <i class="fas fa-phone-alt mr-1"></i> Appeler
                                </a>
                            </div>
                        </div>
                        @endif

                        @if($service->email)
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-3 shrink-0">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <p class="font-medium text-dark text-sm">Email</p>
                                <p class="text-gray-700 text-sm">{{ $service->email }}</p>
                                <a href="mailto:{{ $service->email }}" class="text-purple text-xs hover:underline inline-flex items-center mt-1">
                                    <i class="fas fa-envelope mr-1"></i> Envoyer un email
                                </a>
                            </div>
                        </div>
                        @endif

                        @if($service->working_hours)
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-3 shrink-0">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <p class="font-medium text-dark text-sm">Horaires</p>
                                <p class="text-gray-700 text-sm">{{ $service->working_hours }}</p>
                            </div>
                        </div>
                        @endif

                        @if($service->location)
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-3 shrink-0">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <p class="font-medium text-dark text-sm">Localisation</p>
                                <p class="text-gray-700 text-sm">{{ $service->location }}</p>
                                @if(!empty($service->location))
                                <a href="https://maps.google.com/?q={{ urlencode($service->location) }}" target="_blank" class="text-purple text-xs hover:underline inline-flex items-center mt-1">
                                    <i class="fas fa-map-marked-alt mr-1"></i> Voir sur la carte
                                </a>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Carte de prise de rendez-vous améliorée -->
                <div class="bg-gradient-to-br from-purple to-purple/80 text-white rounded-lg shadow-md overflow-hidden" data-aos="fade-left" data-aos-delay="100">
                    <div class="p-5">
                        <h3 class="font-bold text-lg mb-2 flex items-center">
                            <i class="fas fa-calendar-check mr-2"></i>
                            Prendre rendez-vous
                        </h3>
                        <p class="mb-4 text-white/90 text-sm">
                            Vous souhaitez prendre rendez-vous avec notre service {{ $service->name }} ?
                            Contactez-nous directement ou réservez en ligne.
                        </p>
                        <div class="space-y-2">
                            <a href="#" class="inline-flex items-center justify-center w-full bg-white text-purple font-medium px-4 py-2.5 rounded-lg hover:bg-gray-100 transition-colors text-sm">
                                <i class="fas fa-calendar-plus mr-2"></i>
                                Réserver un rendez-vous
                            </a>
                            @if($service->phone)
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $service->phone) }}" class="inline-flex items-center justify-center w-full bg-white/20 backdrop-blur-sm text-white border border-white/30 font-medium px-4 py-2.5 rounded-lg hover:bg-white/30 transition-colors text-sm">
                                <i class="fas fa-phone-alt mr-2"></i>
                                Appeler directement
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Services associés avec design amélioré -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-left" data-aos-delay="200">
                    <div class="bg-purple/10 p-4">
                        <h5 class="text-dark flex items-center font-medium">
                            <i class="fas fa-link text-purple mr-2"></i>
                            Services associés
                        </h5>
                    </div>

                    <div class="p-3">
                        <a href="{{ route('services') }}" class="block p-2 border border-gray-100 rounded-lg mb-2 hover:bg-gray-50 transition-colors">
                            <div class="flex items-center">
                                <div class="w-9 h-9 rounded-full bg-purple/10 flex items-center justify-center text-purple mr-3 shrink-0">
                                    <i class="fas fa-th-large text-xs"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-dark text-sm">Tous les services</p>
                                    <p class="text-gray-500 text-xs">Retourner à la liste</p>
                                </div>
                            </div>
                        </a>

                        <!-- Services associés de la même catégorie -->
                        @if(isset($relatedServices) && count($relatedServices) > 0)
                            @foreach($relatedServices as $relatedService)
                            <a href="{{ route('services.show', $relatedService->slug) }}" class="block p-2 border border-gray-100 rounded-lg mb-2 hover:bg-purple/5 transition-colors">
                                <div class="flex items-center">
                                    @php $isEven = $loop->index % 2 === 0; @endphp
                                    <div class="w-9 h-9 rounded-full {{ $isEven ? 'bg-turquoise/10 text-turquoise' : 'bg-purple/10 text-purple' }} flex items-center justify-center mr-3 shrink-0">
                                        <i class="{{ $relatedService->icon ?? 'fas fa-stethoscope' }} text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-dark text-sm">{{ $relatedService->name }}</p>
                                        <p class="text-gray-500 text-xs line-clamp-1">{{ Str::limit($relatedService->short_description, 40) }}</p>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        @else
                            <div class="text-center p-3 text-gray-500 text-sm">
                                <i class="fas fa-info-circle mr-1"></i>
                                Aucun service associé disponible
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

