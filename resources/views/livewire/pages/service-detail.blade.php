<div>
    <div>
        <!-- Bannière avec hauteur ajustée et typographie optimisée -->
        <div class="relative">
            <!-- Image principale ici de fond ou gradient si pas d'image -->
            <div class="absolute inset-0 overflow-hidden bg-gradient-to-r from-purple to-turquoise">
                @if($service->image)
                    <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}" class="object-cover w-full h-full opacity-30 mix-blend-overlay">
                @endif
            </div>
    
            <!-- Contenu de la bannière avec taille de texte ajustée -->
            <div class="container relative px-4 py-12 mx-auto md:py-16" data-aos="fade-up">
                <div class="inline-flex items-center px-3 py-1 mb-3 text-xs rounded-full bg-white/20 backdrop-blur-sm text-white/90">
                    <i class="{{ $service->category->icon ?? 'fas fa-tag' }} mr-1.5"></i>
                    <span>{{ $service->category->name }}</span>
                </div>
                <h1 class="mb-4 text-2xl font-bold text-white md:text-3xl">{{ $service->name }}</h1>
                <div class="flex items-center text-white/80 inline-block px-3 py-1.5 rounded-lg backdrop-blur-sm text-sm">
                    <a href="{{ route('home') }}" class="transition-colors hover:text-white">
                        <i class="mr-1 fas fa-home"></i>Accueil
                    </a>
                    <i class="mx-2 text-xs fas fa-chevron-right"></i>
                    <a href="{{ route('services') }}" class="transition-colors hover:text-white">Nos Services</a>
                    <i class="mx-2 text-xs fas fa-chevron-right"></i>
                    {{-- <span class="text-white">{{ $service->name }}</span> --}}
                </div>
            </div>
        </div>
    
        <!-- Contenu principal avec espacement et tailles optimisés -->
        <div class="container px-4 py-8 mx-auto md:py-10">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <!-- Colonne principale - Informations du service -->
                <div class="space-y-6 lg:col-span-2">
                    <!-- Carte principale -->
                    <div class="overflow-hidden bg-white rounded-lg shadow-md" data-aos="fade-up">
                        <!-- Image principale du service si disponible -->
                        @if($service->image)
                        <div class="relative h-64 md:h-72 group">
                            <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-4">
                                <div class="inline-flex items-center bg-{{ $service->category->type === 'technical' ? 'purple' : 'turquoise' }}/90 text-white px-2.5 py-1 rounded-lg text-xs">
                                    <i class="{{ $service->category->icon ?? 'fas fa-tag' }} mr-1.5"></i>
                                    {{ $service->category->name }}
                                </div>
                            </div>
                        </div>
                        @endif
    
                        <div class="p-5 md:p-6">
                            <!-- Description complète avec taille de texte ajustée -->
                            <div class="mb-6 prose text-gray-700 max-w-none">
                                <h5 class="relative mb-3 font-semibold text-dark">
                                    À propos de ce service
                                    <span class="block w-16 h-1 mt-2 bg-purple"></span>
                                </h5>
                                <div class="text-base content-rich">
                                    {!! $service->full_description !!}
                                </div>
                            </div>
    
                            <!-- Équipements si disponibles -->
                            @if(!empty($service->equipments) && is_array($service->equipments) && count($service->equipments) > 0)
                            <div class="mt-8">
                                <h5 class="flex items-center mb-3 text-dark">
                                    <i class="mr-2 fas fa-tools text-purple"></i>
                                    Équipements & Technologies
                                </h5>
                                <div class="grid grid-cols-1 gap-2 mt-3 md:grid-cols-2">
                                    @foreach($service->equipments as $equipment)
                                    <div class="flex items-center px-3 py-2 text-sm rounded-lg bg-gray-50">
                                        <i class="mr-2 text-green-500 fas fa-check-circle"></i>
                                        <span>{{ $equipment }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
    
                    <!-- Section galerie améliorée -->
                    @if(!empty($service->images) && count($service->images) > 0)
                    <div class="p-5 overflow-hidden bg-white rounded-lg shadow-md" data-aos="fade-up" data-aos-delay="50">
                        <h5 class="flex items-center mb-3 font-semibold text-dark">
                            <i class="mr-2 fas fa-images text-purple"></i>
                            Galerie de photos
                        </h5>
                        
                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-4">
                            @foreach($service->images as $index => $imagePath)
                            <div class="relative overflow-hidden rounded-lg cursor-pointer group gallery-item" onclick="openLightbox('{{ Storage::url($imagePath) }}', {{ $index }})">
                                <img src="{{ Storage::url($imagePath) }}" alt="{{ $service->name }} - Image {{ $index + 1 }}" class="object-cover w-full h-32 transition-transform duration-300 group-hover:scale-110">
                                <div class="absolute inset-0 flex items-center justify-center transition-opacity bg-black opacity-0 bg-opacity-40 group-hover:opacity-100">
                                    <div class="p-2 bg-white rounded-full">
                                        <i class="text-purple fas fa-search-plus"></i>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
    
                    <!-- Section améliorée de l'équipe -->
                    @php
                        // Vérifier si nous avons un leader d'équipe et des membres
                        $hasTeamLeader = isset($service->team_members['leader']) && !empty($service->team_members['leader']['name']);
                        $hasTeamMembers = isset($service->team_members['members']) && is_array($service->team_members['members']) && count($service->team_members['members']) > 0;
                        $teamName = $service->team_members['name'] ?? null;
                    @endphp
    
                    @if($hasTeamLeader || $hasTeamMembers || !empty($formattedTeamMembers))
                    <div class="p-5 overflow-hidden bg-white rounded-lg shadow-md md:p-6" data-aos="fade-up" data-aos-delay="100">
                        <h5 class="flex items-center mb-4 font-semibold text-dark">
                            <i class="mr-2 fas fa-user-md text-purple"></i>
                            @if($teamName)
                                {{ $teamName }}
                            @else
                                Notre équipe spécialisée
                            @endif
                        </h5>
    
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                            <!-- Afficher le responsable d'équipe s'il existe -->
                            @if($hasTeamLeader)
                                @php
                                    $leader = $service->team_members['leader'];
                                    $leaderName = $leader['name'] ?? 'Responsable';
                                    $leaderPosition = $leader['position'] ?? 'Chef de service';
                                    $leaderPhoto = $leader['photo'] ?? null;
                                @endphp
                                <div class="team-member-card team-member-lead" data-member-index="leader">
                                    <div class="relative mx-auto mt-4 mb-3 overflow-hidden rounded-full team-member-avatar bg-purple/10" style="width: 100px; height: 100px;">
                                        @if(!empty($leaderPhoto))
                                            <img src="{{ $leaderPhoto }}" alt="{{ $leaderName }}" class="object-cover w-full h-full">
                                        @else
                                            <div class="flex items-center justify-center w-full h-full">
                                                <i class="text-3xl fas fa-user-md text-purple"></i>
                                            </div>
                                        @endif
                                        <span class="absolute bottom-0 right-0 bg-purple text-white text-xs px-1.5 py-0.5 rounded-full">
                                            <i class="mr-1 text-xs fas fa-star"></i>
                                            Chef
                                        </span>
                                    </div>
                                    <div class="p-3 text-center">
                                        <h5 class="text-base font-medium text-dark">{{ $leaderName }}</h5>
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
                                                <img src="{{ $memberPhoto }}" alt="{{ $memberName }}" class="object-cover w-full h-full">
                                            @else
                                                <div class="flex items-center justify-center w-full h-full">
                                                    <i class="fas {{ $avatarIconClass }} text-3xl"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="p-3 text-center">
                                            <h5 class="text-base font-medium text-dark">{{ $memberName }}</h5>
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
                                                <img src="{{ $member['avatar'] }}" alt="{{ $member['name'] }}" class="object-cover w-full h-full">
                                            @else
                                                <div class="flex items-center justify-center w-full h-full">
                                                    <i class="fas {{ $avatarIconClass }} text-3xl"></i>
                                                </div>
                                            @endif
    
                                            @if($member['isLead'])
                                            <span class="absolute bottom-0 right-0 bg-purple text-white text-xs px-1.5 py-0.5 rounded-full">
                                                <i class="mr-1 text-xs fas fa-star"></i>
                                                Chef
                                            </span>
                                            @endif
                                        </div>
    
                                        <div class="p-3 text-center">
                                            <h5 class="text-base font-medium text-dark">{{ $member['name'] }}</h5>
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
                    <div class="overflow-hidden bg-white rounded-lg shadow-md" data-aos="fade-left">
                        <div class="p-4 bg-purple/10">
                            <h5 class="flex items-center font-medium text-dark">
                                <i class="mr-2 fas fa-info-circle text-purple"></i>
                                Informations pratiques
                            </h5>
                        </div>
    
                        <div class="p-4 space-y-4">
                            @if($service->phone)
                            <div class="flex items-start">
                                <div class="flex items-center justify-center w-10 h-10 mr-3 rounded-full bg-purple/10 text-purple shrink-0">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-dark">Téléphone</p>
                                    <p class="text-sm text-gray-700">{{ $service->phone }}</p>
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $service->phone) }}" class="inline-flex items-center mt-1 text-xs text-purple hover:underline">
                                        <i class="mr-1 fas fa-phone-alt"></i> Appeler
                                    </a>
                                </div>
                            </div>
                            @endif
    
                            @if($service->email)
                            <div class="flex items-start">
                                <div class="flex items-center justify-center w-10 h-10 mr-3 rounded-full bg-purple/10 text-purple shrink-0">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-dark">Email</p>
                                    <p class="text-sm text-gray-700">{{ $service->email }}</p>
                                    <a href="mailto:{{ $service->email }}" class="inline-flex items-center mt-1 text-xs text-purple hover:underline">
                                        <i class="mr-1 fas fa-envelope"></i> Envoyer un email
                                    </a>
                                </div>
                            </div>
                            @endif
    
                            @if($service->working_hours)
                            <div class="flex items-start">
                                <div class="flex items-center justify-center w-10 h-10 mr-3 rounded-full bg-purple/10 text-purple shrink-0">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-dark">Horaires</p>
                                    <p class="text-sm text-gray-700">{{ $service->working_hours }}</p>
                                </div>
                            </div>
                            @endif
    
                            @if($service->location)
                            <div class="flex items-start">
                                <div class="flex items-center justify-center w-10 h-10 mr-3 rounded-full bg-purple/10 text-purple shrink-0">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-dark">Localisation</p>
                                    <p class="text-sm text-gray-700">{{ $service->location }}</p>
                                    @if(!empty($service->location))
                                    <a href="https://maps.google.com/?q={{ urlencode($service->location) }}" target="_blank" class="inline-flex items-center mt-1 text-xs text-purple hover:underline">
                                        <i class="mr-1 fas fa-map-marked-alt"></i> Voir sur la carte
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
    
                    <!-- Carte de prise de rendez-vous améliorée -->
                    <div class="overflow-hidden text-white rounded-lg shadow-md bg-gradient-to-br from-purple to-purple/80" data-aos="fade-left" data-aos-delay="100">
                        <div class="p-5">
                            <h3 class="flex items-center mb-2 text-lg font-bold">
                                <i class="mr-2 fas fa-calendar-check"></i>
                                Prendre rendez-vous
                            </h3>
                            <p class="mb-4 text-sm text-white/90">
                                Vous souhaitez prendre rendez-vous avec notre service {{ $service->name }} ?
                                Contactez-nous directement ou réservez en ligne.
                            </p>
                            <div class="space-y-2">
                                <a href="#" class="inline-flex items-center justify-center w-full bg-white text-purple font-medium px-4 py-2.5 rounded-lg hover:bg-gray-100 transition-colors text-sm">
                                    <i class="mr-2 fas fa-calendar-plus"></i>
                                    Réserver un rendez-vous
                                </a>
                                @if($service->phone)
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $service->phone) }}" class="inline-flex items-center justify-center w-full bg-white/20 backdrop-blur-sm text-white border border-white/30 font-medium px-4 py-2.5 rounded-lg hover:bg-white/30 transition-colors text-sm">
                                    <i class="mr-2 fas fa-phone-alt"></i>
                                    Appeler directement
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
    
                    <!-- Services associés avec design amélioré -->
                    <div class="overflow-hidden bg-white rounded-lg shadow-md" data-aos="fade-left" data-aos-delay="200">
                        <div class="p-4 bg-purple/10">
                            <h5 class="flex items-center font-medium text-dark">
                                <i class="mr-2 fas fa-link text-purple"></i>
                                Services associés
                            </h5>
                        </div>
    
                        <div class="p-3">
                            <a href="{{ route('services') }}" class="block p-2 mb-2 transition-colors border border-gray-100 rounded-lg hover:bg-gray-50">
                                <div class="flex items-center">
                                    <div class="flex items-center justify-center mr-3 rounded-full w-9 h-9 bg-purple/10 text-purple shrink-0">
                                        <i class="text-xs fas fa-th-large"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-dark">Tous les services</p>
                                        <p class="text-xs text-gray-500">Retourner à la liste</p>
                                    </div>
                                </div>
                            </a>
    
                            <!-- Services associés de la même catégorie -->
                            @if(isset($relatedServices) && count($relatedServices) > 0)
                                @foreach($relatedServices as $relatedService)
                                <a href="{{ route('services.show', $relatedService->slug) }}" class="block p-2 mb-2 transition-colors border border-gray-100 rounded-lg hover:bg-purple/5">
                                    <div class="flex items-center">
                                        @php $isEven = $loop->index % 2 === 0; @endphp
                                        <div class="w-9 h-9 rounded-full {{ $isEven ? 'bg-turquoise/10 text-turquoise' : 'bg-purple/10 text-purple' }} flex items-center justify-center mr-3 shrink-0">
                                            <i class="{{ $relatedService->icon ?? 'fas fa-stethoscope' }} text-xs"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-dark">{{ $relatedService->name }}</p>
                                            <p class="text-xs text-gray-500 line-clamp-1">{{ Str::limit($relatedService->short_description, 40) }}</p>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            @else
                                <div class="p-3 text-sm text-center text-gray-500">
                                    <i class="mr-1 fas fa-info-circle"></i>
                                    Aucun service associé disponible
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Lightbox amélioré -->
    <div id="lightbox" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-90">
        <button onclick="closeLightbox()" class="absolute text-white top-4 right-4 hover:text-gray-300">
            <i class="text-2xl fas fa-times"></i>
        </button>
        
        <button id="prevButton" class="absolute text-white left-4 hover:text-gray-300">
            <i class="text-3xl fas fa-chevron-left"></i>
        </button>
        
        <button id="nextButton" class="absolute text-white right-4 hover:text-gray-300">
            <i class="text-3xl fas fa-chevron-right"></i>
        </button>
        
        <div class="w-full max-w-4xl p-2">
            <img id="lightboxImage" src="" alt="Image agrandie" class="max-w-full max-h-[80vh] mx-auto rounded shadow-xl">
            <div class="mt-4 text-center text-white">
                <span id="imageCount" class="px-3 py-1 rounded-full bg-purple"></span>
            </div>
        </div>
    </div>
    
    <script>
        // Variables pour la galerie
        let currentIndex = 0;
        const images = [
            @if(!empty($service->images))
                @foreach($service->images as $index => $imagePath)
                    "{{ Storage::url($imagePath) }}",
                @endforeach
            @endif
        ];
        
        // Fonction pour ouvrir le lightbox
        function openLightbox(imageSrc, index) {
            document.getElementById('lightboxImage').src = imageSrc;
            document.getElementById('lightbox').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            currentIndex = index;
            updateImageCounter();
        }
        
        // Fonction pour fermer le lightbox
        function closeLightbox() {
            document.getElementById('lightbox').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        // Mise à jour du compteur d'images
        function updateImageCounter() {
            const imageCount = document.getElementById('imageCount');
            if (imageCount) {
                imageCount.textContent = `${currentIndex + 1} / ${images.length}`;
            }
        }
        
        // Navigation entre les images
        const prevButton = document.getElementById('prevButton');
        if (prevButton) {
            prevButton.addEventListener('click', function(e) {
                e.stopPropagation();
                currentIndex = (currentIndex - 1 + images.length) % images.length;
                document.getElementById('lightboxImage').src = images[currentIndex];
                updateImageCounter();
            });
        }
        
        const nextButton = document.getElementById('nextButton');
        if (nextButton) {
            nextButton.addEventListener('click', function(e) {
                e.stopPropagation();
                currentIndex = (currentIndex + 1) % images.length;
                document.getElementById('lightboxImage').src = images[currentIndex];
                updateImageCounter();
            });
        }
        
        // Fermer le lightbox en cliquant en dehors de l'image
        const lightbox = document.getElementById('lightbox');
        if (lightbox) {
            lightbox.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeLightbox();
                }
            });
        }
        
        // Navigation avec les touches du clavier
        document.addEventListener('keydown', function(e) {
            const lightbox = document.getElementById('lightbox');
            if (!lightbox || lightbox.classList.contains('hidden')) return;
            
            if (e.key === 'Escape') {
                closeLightbox();
            } else if (e.key === 'ArrowLeft') {
                const prevButton = document.getElementById('prevButton');
                if (prevButton) prevButton.click();
            } else if (e.key === 'ArrowRight') {
                const nextButton = document.getElementById('nextButton');
                if (nextButton) nextButton.click();
            }
        });
    </script>
</div>
