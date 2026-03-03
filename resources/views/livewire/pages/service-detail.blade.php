<div>
    <div>
        <!-- Banner -->
        <div class="relative">
            <div class="absolute inset-0 overflow-hidden bg-primary">
                @if($service->image)
                    <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}" class="object-cover w-full h-full opacity-20">
                @endif
            </div>

            <div class="container relative px-4 py-12 mx-auto md:py-16" data-aos="fade-up">
                <div class="inline-flex items-center px-3 py-1 mb-3 text-xs rounded-full bg-white/20 backdrop-blur-sm text-white/90">
                    <i class="{{ $service->category->icon ?? 'fas fa-tag' }} mr-1.5"></i>
                    <span>{{ $service->category->name }}</span>
                </div>
                <h1 class="mb-4 text-2xl font-bold text-white md:text-3xl">{{ $service->name }}</h1>
                <div class="flex items-center text-white/70 inline-block px-3 py-1.5 rounded-xl backdrop-blur-sm text-sm">
                    <a href="{{ route('home') }}" class="transition-colors hover:text-white">
                        <i class="mr-1 far fa-home"></i>Accueil
                    </a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('services') }}" class="transition-colors hover:text-white">Nos Services</a>
                    <span class="mx-2">/</span>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="container px-4 py-10 mx-auto md:py-12">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <!-- Colonne principale -->
                <div class="space-y-8 lg:col-span-2">
                    <!-- Carte principale -->
                    <div class="overflow-hidden bg-white rounded-2xl shadow-sm" data-aos="fade-up">
                        @if($service->image)
                        <div class="relative h-64 md:h-72 group overflow-hidden rounded-t-2xl">
                            <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-4">
                                <div class="inline-flex items-center bg-primary/90 text-white px-2.5 py-1 rounded-lg text-xs">
                                    <i class="{{ $service->category->icon ?? 'fas fa-tag' }} mr-1.5"></i>
                                    {{ $service->category->name }}
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="p-6 md:p-8">
                            <!-- Description -->
                            <div class="mb-8 pb-8 border-b border-gray/50 prose text-gray-dark max-w-none">
                                <h5 class="relative mb-3 font-semibold text-dark">
                                    A propos de ce service
                                    <span class="block w-10 h-1 mt-2 bg-primary rounded-full"></span>
                                </h5>
                                <div class="text-base content-rich">
                                    {!! $service->full_description !!}
                                </div>
                            </div>

                            <!-- Equipements -->
                            @if(!empty($service->equipments) && is_array($service->equipments) && count($service->equipments) > 0)
                            <div class="mb-8 pb-8 border-b border-gray/50">
                                <h5 class="flex items-center mb-3 text-dark font-semibold">
                                    <i class="mr-2 far fa-tools text-primary"></i>
                                    Equipements & Technologies
                                </h5>
                                <div class="grid grid-cols-1 gap-2 mt-3 md:grid-cols-2">
                                    @foreach($service->equipments as $equipment)
                                    <div class="flex items-center px-3 py-2 text-sm rounded-xl bg-gray-light">
                                        <i class="mr-2 text-green-500 fas fa-check-circle"></i>
                                        <span>{{ $equipment }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Galerie -->
                    @if(!empty($service->images) && count($service->images) > 0)
                    <div class="p-6 overflow-hidden bg-white rounded-2xl shadow-sm" data-aos="fade-up" data-aos-delay="50">
                        <h5 class="flex items-center mb-4 font-semibold text-dark">
                            <i class="mr-2 far fa-images text-primary"></i>
                            Galerie de photos
                        </h5>

                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-4">
                            @foreach($service->images as $index => $imagePath)
                            <div class="relative overflow-hidden rounded-xl cursor-pointer group gallery-item" onclick="openLightbox('{{ Storage::url($imagePath) }}', {{ $index }})">
                                <img src="{{ Storage::url($imagePath) }}" alt="{{ $service->name }} - Image {{ $index + 1 }}" class="object-cover w-full h-32 transition-transform duration-300 group-hover:scale-110">
                                <div class="absolute inset-0 flex items-center justify-center transition-opacity bg-black/40 opacity-0 group-hover:opacity-100">
                                    <div class="p-2 bg-white rounded-full">
                                        <i class="text-primary fas fa-search-plus"></i>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Equipe -->
                    @php
                        $hasTeamLeader = isset($service->team_members['leader']) && !empty($service->team_members['leader']['name']);
                        $hasTeamMembers = isset($service->team_members['members']) && is_array($service->team_members['members']) && count($service->team_members['members']) > 0;
                        $teamName = $service->team_members['name'] ?? null;
                    @endphp

                    @if($hasTeamLeader || $hasTeamMembers || !empty($formattedTeamMembers))
                    <div class="p-6 overflow-hidden bg-white rounded-2xl shadow-sm" data-aos="fade-up" data-aos-delay="100">
                        <h5 class="flex items-center mb-4 font-semibold text-dark">
                            <i class="mr-2 far fa-user-md text-primary"></i>
                            @if($teamName)
                                {{ $teamName }}
                            @else
                                Notre equipe specialisee
                            @endif
                        </h5>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                            @if($hasTeamLeader)
                                @php
                                    $leader = $service->team_members['leader'];
                                    $leaderName = $leader['name'] ?? 'Responsable';
                                    $leaderPosition = $leader['position'] ?? 'Chef de service';
                                    $leaderPhoto = $leader['photo'] ?? null;
                                @endphp
                                <div class="team-member-card team-member-lead" data-member-index="leader">
                                    <div class="relative mx-auto mt-4 mb-3 overflow-hidden rounded-full team-member-avatar bg-primary/10" style="width: 100px; height: 100px;">
                                        @if(!empty($leaderPhoto))
                                            <img src="{{ $leaderPhoto }}" alt="{{ $leaderName }}" class="object-cover w-full h-full">
                                        @else
                                            <div class="flex items-center justify-center w-full h-full">
                                                <i class="text-3xl fas fa-user-md text-primary"></i>
                                            </div>
                                        @endif
                                        <span class="absolute bottom-0 right-0 bg-primary text-white text-xs px-1.5 py-0.5 rounded-full">
                                            <i class="mr-1 text-xs fas fa-star"></i>
                                            Chef
                                        </span>
                                    </div>
                                    <div class="p-3 text-center">
                                        <h5 class="text-base font-medium text-dark">{{ $leaderName }}</h5>
                                        <p class="text-gray-dark text-xs mt-0.5">{{ $leaderPosition }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($hasTeamMembers)
                                @foreach($service->team_members['members'] as $index => $member)
                                    @php
                                        $memberName = $member['name'] ?? 'Membre';
                                        $memberPosition = $member['position'] ?? 'Professionnel de sante';
                                        $memberPhoto = $member['photo'] ?? null;
                                    @endphp
                                    <div class="team-member-card" data-member-index="{{ $index }}">
                                        <div class="team-member-avatar bg-primary/10 relative rounded-full overflow-hidden mx-auto mt-4 mb-3" style="width: 100px; height: 100px;">
                                            @if(!empty($memberPhoto))
                                                <img src="{{ $memberPhoto }}" alt="{{ $memberName }}" class="object-cover w-full h-full">
                                            @else
                                                <div class="flex items-center justify-center w-full h-full">
                                                    <i class="fas fa-user-nurse text-primary text-3xl"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="p-3 text-center">
                                            <h5 class="text-base font-medium text-dark">{{ $memberName }}</h5>
                                            <p class="text-gray-dark text-xs mt-0.5">{{ $memberPosition }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            @if(!$hasTeamLeader && !$hasTeamMembers && !empty($formattedTeamMembers))
                                @foreach($formattedTeamMembers as $index => $member)
                                    <div class="team-member-card {{ $member['isLead'] ? 'team-member-lead' : '' }}" data-member-index="{{ $index }}">
                                        <div class="team-member-avatar bg-primary/10 relative rounded-full overflow-hidden mx-auto mt-4 mb-3" style="width: 100px; height: 100px;">
                                            @if(!empty($member['avatar']))
                                                <img src="{{ $member['avatar'] }}" alt="{{ $member['name'] }}" class="object-cover w-full h-full">
                                            @else
                                                <div class="flex items-center justify-center w-full h-full">
                                                    <i class="fas fa-user-nurse text-primary text-3xl"></i>
                                                </div>
                                            @endif

                                            @if($member['isLead'])
                                            <span class="absolute bottom-0 right-0 bg-primary text-white text-xs px-1.5 py-0.5 rounded-full">
                                                <i class="mr-1 text-xs fas fa-star"></i>
                                                Chef
                                            </span>
                                            @endif
                                        </div>

                                        <div class="p-3 text-center">
                                            <h5 class="text-base font-medium text-dark">{{ $member['name'] }}</h5>
                                            <p class="text-gray-dark text-xs mt-0.5">{{ $member['role'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Informations pratiques -->
                    <div class="overflow-hidden bg-white rounded-2xl shadow-sm" data-aos="fade-left">
                        <div class="p-4 bg-primary/5">
                            <h5 class="flex items-center font-medium text-dark">
                                <i class="mr-2 far fa-info-circle text-primary"></i>
                                Informations pratiques
                            </h5>
                        </div>

                        <div class="p-4 space-y-4">
                            @if($service->phone)
                            <div class="flex items-start">
                                <div class="flex items-center justify-center w-10 h-10 mr-3 rounded-xl bg-primary/10 text-primary shrink-0">
                                    <i class="far fa-phone-alt"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-dark">Telephone</p>
                                    <p class="text-sm text-gray-dark">{{ $service->phone }}</p>
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $service->phone) }}" class="inline-flex items-center mt-1 text-xs text-primary hover:underline">
                                        <i class="mr-1 far fa-phone-alt"></i> Appeler
                                    </a>
                                </div>
                            </div>
                            @endif

                            @if($service->email)
                            <div class="flex items-start">
                                <div class="flex items-center justify-center w-10 h-10 mr-3 rounded-xl bg-primary/10 text-primary shrink-0">
                                    <i class="far fa-envelope"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-dark">Email</p>
                                    <p class="text-sm text-gray-dark">{{ $service->email }}</p>
                                    <a href="mailto:{{ $service->email }}" class="inline-flex items-center mt-1 text-xs text-primary hover:underline">
                                        <i class="mr-1 far fa-envelope"></i> Envoyer un email
                                    </a>
                                </div>
                            </div>
                            @endif

                            @if($service->working_hours)
                            <div class="flex items-start">
                                <div class="flex items-center justify-center w-10 h-10 mr-3 rounded-xl bg-primary/10 text-primary shrink-0">
                                    <i class="far fa-clock"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-dark">Horaires</p>
                                    <p class="text-sm text-gray-dark">{{ $service->working_hours }}</p>
                                </div>
                            </div>
                            @endif

                            @if($service->location)
                            <div class="flex items-start">
                                <div class="flex items-center justify-center w-10 h-10 mr-3 rounded-xl bg-primary/10 text-primary shrink-0">
                                    <i class="far fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-dark">Localisation</p>
                                    <p class="text-sm text-gray-dark">{{ $service->location }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Carte RDV -->
                    <div class="overflow-hidden text-white rounded-2xl shadow-sm bg-primary" data-aos="fade-left" data-aos-delay="100">
                        <div class="p-6">
                            <h3 class="flex items-center mb-2 text-lg font-bold">
                                <i class="mr-2 far fa-calendar-check"></i>
                                Prendre rendez-vous
                            </h3>
                            <p class="mb-4 text-sm text-white/90">
                                Vous souhaitez prendre rendez-vous avec notre service {{ $service->name }} ?
                                Contactez-nous directement ou reservez en ligne.
                            </p>
                            <div class="space-y-2">
                                <a href="#" class="inline-flex items-center justify-center w-full bg-white text-primary font-medium px-4 py-2.5 rounded-xl hover:bg-gray-light transition-colors text-sm">
                                    <i class="mr-2 far fa-calendar-plus"></i>
                                    Reserver un rendez-vous
                                </a>
                                @if($service->phone)
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $service->phone) }}" class="inline-flex items-center justify-center w-full bg-white/20 backdrop-blur-sm text-white border border-white/30 font-medium px-4 py-2.5 rounded-xl hover:bg-white/30 transition-colors text-sm">
                                    <i class="mr-2 far fa-phone-alt"></i>
                                    Appeler directement
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Services associes -->
                    <div class="overflow-hidden bg-white rounded-2xl shadow-sm" data-aos="fade-left" data-aos-delay="200">
                        <div class="p-4 bg-primary/5">
                            <h5 class="flex items-center font-medium text-dark">
                                <i class="mr-2 far fa-link text-primary"></i>
                                Services associes
                            </h5>
                        </div>

                        <div class="p-3">
                            <a href="{{ route('services') }}" class="block p-2 mb-2 transition-colors rounded-xl hover:bg-gray-light">
                                <div class="flex items-center">
                                    <div class="flex items-center justify-center mr-3 rounded-xl w-9 h-9 bg-primary/10 text-primary shrink-0">
                                        <i class="text-xs far fa-th-large"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-dark">Tous les services</p>
                                        <p class="text-xs text-gray-dark">Retourner a la liste</p>
                                    </div>
                                </div>
                            </a>

                            @if(isset($relatedServices) && count($relatedServices) > 0)
                                @foreach($relatedServices as $relatedService)
                                <a href="{{ route('services.show', $relatedService->slug) }}" class="block p-2 mb-2 transition-colors rounded-xl hover:bg-primary/5">
                                    <div class="flex items-center">
                                        <div class="w-9 h-9 rounded-xl bg-primary/10 text-primary flex items-center justify-center mr-3 shrink-0">
                                            <i class="{{ $relatedService->icon ?? 'fas fa-stethoscope' }} text-xs"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-dark">{{ $relatedService->name }}</p>
                                            <p class="text-xs text-gray-dark line-clamp-1">{{ Str::limit($relatedService->short_description, 40) }}</p>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            @else
                                <div class="p-3 text-sm text-center text-gray-dark">
                                    <i class="mr-1 far fa-info-circle"></i>
                                    Aucun service associe disponible
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lightbox -->
    <div id="lightbox" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black/90 backdrop-blur-sm">
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
            <img id="lightboxImage" src="" alt="Image agrandie" class="max-w-full max-h-[80vh] mx-auto rounded-2xl shadow-xl">
            <div class="mt-4 text-center text-white">
                <span id="imageCount" class="px-3 py-1 rounded-full bg-primary text-sm"></span>
            </div>
        </div>
    </div>

    <script>
        let currentIndex = 0;
        const images = [
            @if(!empty($service->images))
                @foreach($service->images as $index => $imagePath)
                    "{{ Storage::url($imagePath) }}",
                @endforeach
            @endif
        ];

        function openLightbox(imageSrc, index) {
            document.getElementById('lightboxImage').src = imageSrc;
            document.getElementById('lightbox').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            currentIndex = index;
            updateImageCounter();
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function updateImageCounter() {
            const imageCount = document.getElementById('imageCount');
            if (imageCount) {
                imageCount.textContent = `${currentIndex + 1} / ${images.length}`;
            }
        }

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

        const lightbox = document.getElementById('lightbox');
        if (lightbox) {
            lightbox.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeLightbox();
                }
            });
        }

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
