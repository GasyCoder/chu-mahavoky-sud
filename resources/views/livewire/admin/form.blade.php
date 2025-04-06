<form wire:submit.prevent="saveService" class="space-y-6">
    <!-- Onglet: Informations générales -->
    <div x-show="activeTab === 'general'">
        <div class="space-y-4">
            <!-- Section de sélection de catégorie -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-left text-gray-700">Catégorie <span class="text-pink">*</span></label>
                <div class="p-3 mt-1 border rounded-md border-gray">
                    @php
                        $category = App\Models\ServiceCategory::where('type', $serviceType)->first();
                    @endphp

                    @if($category)
                        <div class="flex items-center">
                            <input
                                type="radio"
                                id="category_{{ $category->id }}"
                                wire:model="serviceData.category_id"
                                value="{{ $category->id }}"
                                class="w-4 h-4 text-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} focus:ring-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} border-gray"
                                checked
                            >
                            <label for="category_{{ $category->id }}" class="flex items-center ml-2 cursor-pointer">
                                <i class="mr-2 {{ $serviceType === 'technical' ? 'fas fa-tools text-purple' : 'fas fa-file-alt text-turquoise' }}"></i>
                                <span class="text-sm font-medium">{{ $category->name }}</span>
                            </label>
                        </div>
                    @else
                        <div class="p-2 text-sm text-center text-gray-500">
                            Catégorie {{ $serviceType === 'technical' ? 'technique' : 'administrative' }} non disponible.
                        </div>
                    @endif
                </div>
                @error('serviceData.category_id') <span class="mt-1 text-sm text-left text-pink">{{ $message }}</span> @enderror
            </div>
            <!-- Nom du service -->
            <div>
                <label for="name" class="block text-sm font-medium text-left text-gray-700">Nom du service <span class="text-pink">*</span></label>
                <input
                    wire:model="serviceData.name"
                    id="name"
                    type="text"
                    class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} focus:border-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} @error('serviceData.name') border-pink @enderror"
                >
                @error('serviceData.name') <span class="mt-1 text-sm text-left text-pink">{{ $message }}</span> @enderror
            </div>

            <!-- Description courte -->
            <div>
                <label for="short_description" class="block text-sm font-medium text-left text-gray-700">
                    Description courte <span class="text-pink">*</span> <span class="text-xs text-gray-500">(max 500 caractères)</span>
                </label>
                <textarea
                    wire:model="serviceData.short_description"
                    id="short_description"
                    rows="2"
                    class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} focus:border-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} @error('serviceData.short_description') border-pink @enderror"
                ></textarea>
                <div class="flex justify-end mt-1 text-xs text-gray-500">
                    {{ isset($serviceData['short_description']) ? strlen($serviceData['short_description']) : 0 }} / 500
                </div>
                @error('serviceData.short_description') <span class="mt-1 text-sm text-left text-pink">{{ $message }}</span> @enderror
            </div>

            <!-- Description complète -->
            <div>
                <label for="full_description" class="block text-sm font-medium text-left text-gray-700">Description complète</label>
                <div wire:ignore>
                    <textarea
                        id="full_description"
                        wire:model.defer="serviceData.full_description"
                        class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} focus:border-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} @error('serviceData.full_description') border-pink @enderror"
                    ></textarea>
                </div>
                @error('serviceData.full_description') <span class="text-sm text-pink">{{ $message }}</span> @enderror
            </div>


            <!-- Section des images -->
            <div class="mt-4">
                <!-- Image principale -->
                <div>
                    <label for="mainImage" class="block text-sm font-medium text-left text-gray-700">Image principale</label>
                    <div class="flex items-center mt-1 space-x-3">
                        @if(!empty($serviceData['image']) && !is_object($serviceData['image']))
                            <div class="relative w-32 h-32 overflow-hidden bg-gray-100 rounded group">
                                <img src="{{ Storage::url($serviceData['image']) }}" alt="Image du service" class="object-cover w-full h-full">
                                <button type="button" wire:click="removeMainImage" class="absolute top-0 right-0 p-1 text-white transition-opacity bg-red-600 rounded-full opacity-0 group-hover:opacity-100">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        @elseif(!empty($mainImage))
                            <div class="relative w-32 h-32 overflow-hidden bg-gray-100 rounded group">
                                <img src="{{ $mainImage->temporaryUrl() }}" alt="Aperçu de l'image" class="object-cover w-full h-full">
                                <button type="button" wire:click="$set('mainImage', null)" class="absolute top-0 right-0 p-1 text-white transition-opacity bg-red-600 rounded-full opacity-0 group-hover:opacity-100">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        @endif

                        <div class="flex flex-col flex-1 space-y-2">
                            <input
                                type="file"
                                id="mainImage"
                                wire:model="mainImage"
                                class="w-full p-2 text-sm border border-gray-300 rounded-md focus:ring-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} focus:border-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }}"
                                accept="image/*"
                            >
                            @error('mainImage') <span class="text-sm text-pink-600">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Images multiples -->
                <div class="mt-6">
                    <label for="galleryImages" class="block text-sm font-medium text-left text-gray-700">Images additionnelles</label>

                    <!-- Affichage des images existantes -->
                    @if(!empty($existingImages))
                        <div class="grid grid-cols-2 gap-4 mt-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
                            @foreach($existingImages as $index => $imagePath)
                                <div class="relative group">
                                    <img src="{{ Storage::url($imagePath) }}" alt="Image {{ $index + 1 }}" class="object-cover w-full h-32 rounded">
                                    <div class="absolute inset-0 flex-col items-center justify-center hidden transition-opacity bg-black bg-opacity-50 group-hover:flex">
                                        <button type="button" wire:click="setAsMainImage({{ $index }})" class="p-1 mb-1 text-white bg-blue-600 rounded-full hover:bg-blue-700">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.707 7.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L12 9.586V5a1 1 0 10-2 0v4.586l-2.293-2.293z" />
                                                <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm0-2a6 6 0 100-12 6 6 0 000 12z" />
                                            </svg>
                                        </button>
                                        <button type="button" wire:click="removeGalleryImage({{ $index }})" class="p-1 text-white bg-red-600 rounded-full hover:bg-red-700">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Aperçu des nouvelles images -->
                    @if(!empty($galleryImages))
                        <div class="grid grid-cols-2 gap-4 mt-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
                            @foreach($galleryImages as $index => $tempImage)
                                @if($tempImage)
                                    <div class="relative group">
                                        <img src="{{ $tempImage->temporaryUrl() }}" alt="Nouvelle image {{ $index + 1 }}" class="object-cover w-full h-32 rounded">
                                        <div class="absolute inset-0 flex items-center justify-center hidden transition-opacity bg-black bg-opacity-50 group-hover:flex">
                                            <button type="button" wire:click="removeUploadedGalleryImage({{ $index }})" class="p-1 text-white bg-red-600 rounded-full hover:bg-red-700">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-2">
                        <input
                            type="file"
                            id="galleryImages"
                            wire:model="galleryImages"
                            class="w-full p-2 text-sm border border-gray-300 rounded-md focus:ring-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} focus:border-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }}"
                            accept="image/*"
                            multiple
                        >
                        @error('galleryImages.*') <span class="text-sm text-pink-600">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

        </div>

        <!-- Options et statut -->
        <div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-2">
            <div class="flex items-center">
                <input
                    wire:model="serviceData.active"
                    id="active"
                    type="checkbox"
                    class="rounded border-gray text-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} focus:ring-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }}"
                >
                <label for="active" class="ml-2 text-sm font-medium text-gray-700">Service actif</label>
            </div>

            <div class="flex items-center">
                <input
                    wire:model="serviceData.featured"
                    id="featured"
                    type="checkbox"
                    class="rounded border-gray text-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} focus:ring-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }}"
                >
                <label for="featured" class="ml-2 text-sm font-medium text-gray-700">Mettre en avant</label>
            </div>

            <!-- Ordre d'affichage -->
            <div>
                <label for="order" class="block text-sm font-medium text-left text-gray-700">Ordre d'affichage</label>
                <input
                    wire:model="serviceData.order"
                    id="order"
                    type="number"
                    min="0"
                    class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} focus:border-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }}"
                >
            </div>
        </div>
    </div>

    <!-- Onglet: Équipe -->
    <div x-show="activeTab === 'team'">
        <div class="space-y-6">
            <!-- Chef d'équipe -->
            <div class="p-4 border border-gray-200 rounded-lg">
                <p class="mb-4 font-medium text-left text-gray-700">Chef d'équipe</p>

                <div class="space-y-4">
                    <!-- Nom du responsable -->
                    <div>
                        <label for="team_leader_name" class="block text-sm font-medium text-left text-gray-700">Nom du responsable</label>
                        <input
                            wire:model="serviceData.team_members.leader.name"
                            id="team_leader_name"
                            type="text"
                            class="block w-full p-2 mt-1 rounded-md border-gray focus:ring-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} focus:border-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }}"
                        >
                    </div>

                    <!-- Poste du responsable -->
                    <div>
                        <label for="team_leader_position" class="block text-sm font-medium text-left text-gray-700">Poste/Fonction</label>
                        <input
                            wire:model="serviceData.team_members.leader.position"
                            id="team_leader_position"
                            type="text"
                            class="block w-full p-2 mt-1 rounded-md border-gray focus:ring-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} focus:border-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }}"
                        >
                    </div>

                    <!-- Photo du responsable -->
                    <div>
                        <label for="team_leader_photo" class="block text-sm font-medium text-left text-gray-700">Photo</label>
                        <div class="flex items-center mt-1">
                            @if(isset($serviceData['team_members']['leader']['photo']) && !empty($serviceData['team_members']['leader']['photo']) && !is_object($serviceData['team_members']['leader']['photo']))
                                <div class="w-16 h-16 mr-3 overflow-hidden bg-gray-100 rounded-full">
                                    <img src="{{ $serviceData['team_members']['leader']['photo'] }}" alt="Photo du responsable" class="object-cover w-full h-full">
                                </div>
                            @elseif(isset($teamLeaderPhoto) && !empty($teamLeaderPhoto))
                                <div class="w-16 h-16 mr-3 overflow-hidden bg-gray-100 rounded-full">
                                    <img src="{{ $teamLeaderPhoto->temporaryUrl() }}" alt="Aperçu de la photo" class="object-cover w-full h-full">
                                </div>
                            @endif

                            <div class="flex flex-col flex-1 space-y-2">
                                <div class="flex items-center space-x-2">
                                    <label for="team_leader_photo_upload" class="px-3 py-1.5 bg-gray-200 text-gray-700 rounded cursor-pointer hover:bg-gray-300 transition text-sm">
                                        <i class="mr-1 fas fa-upload"></i> Télécharger une photo
                                    </label>
                                    <input
                                        type="file"
                                        id="team_leader_photo_upload"
                                        wire:model="teamLeaderPhoto"
                                        class="hidden"
                                        accept="image/*"
                                    >

                                    @if((isset($serviceData['team_members']['leader']['photo']) && !empty($serviceData['team_members']['leader']['photo'])) || (isset($teamLeaderPhoto) && !empty($teamLeaderPhoto)))
                                        <button
                                            type="button"
                                            wire:click="removeTeamLeaderPhoto"
                                            class="px-2 py-1 text-sm text-pink hover:text-pink-dark focus:outline-none"
                                        >
                                            <i class="fas fa-trash-alt"></i> Supprimer
                                        </button>
                                    @endif
                                </div>

                                @error('teamLeaderPhoto')
                                    <span class="block mt-1 text-sm text-left text-pink">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Email du responsable -->
                    <div>
                        <label for="team_leader_email" class="block text-sm font-medium text-left text-gray-700">Email</label>
                        <input
                            wire:model="serviceData.team_members.leader.email"
                            id="team_leader_email"
                            type="email"
                            class="block w-full p-2 mt-1 rounded-md border-gray focus:ring-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} focus:border-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }}"
                        >
                    </div>
                </div>
            </div>

            <!-- Membres de l'équipe (liste) -->
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-sm font-medium text-left text-gray-700">Membres de l'équipe</label>
                    <button
                        type="button"
                        wire:click="addTeamMember"
                        class="text-sm font-medium text-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} hover:text-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }}-dark focus:outline-none"
                    >
                        <i class="mr-1 fas fa-plus-circle"></i> Ajouter un membre
                    </button>
                </div>

                <div class="space-y-3">
                    @if(isset($serviceData['team_members']['members']) && is_array($serviceData['team_members']['members']) && count($serviceData['team_members']['members']) > 0)
                        @foreach($serviceData['team_members']['members'] as $index => $member)
                            <div class="p-3 border border-gray-200 rounded-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <h5 class="text-sm font-medium text-left">Membre #{{ $index + 1 }}</h5>
                                    <button
                                        type="button"
                                        wire:click="removeTeamMember({{ $index }})"
                                        class="text-pink hover:text-pink-dark focus:outline-none"
                                    >
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>

                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-xs font-medium text-left text-gray-700">Nom</label>
                                        <input
                                            wire:model="serviceData.team_members.members.{{ $index }}.name"
                                            type="text"
                                            class="block w-full p-2 mt-1 text-sm rounded-md border-gray focus:ring-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} focus:border-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }}"
                                        >
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-left text-gray-700">Poste</label>
                                        <input
                                            wire:model="serviceData.team_members.members.{{ $index }}.position"
                                            type="text"
                                            class="block w-full p-2 mt-1 text-sm rounded-md border-gray focus:ring-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} focus:border-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }}"
                                        >
                                    </div>

                                    <div>
                                        <label class="block text-xs font-medium text-left text-gray-700">Photo</label>
                                        <div class="flex items-center mt-1 space-x-2">
                                            @if(isset($serviceData['team_members']['members'][$index]['photo']) && !empty($serviceData['team_members']['members'][$index]['photo']) && !is_object($serviceData['team_members']['members'][$index]['photo']))
                                                <div class="w-12 h-12 overflow-hidden bg-gray-100 rounded-full">
                                                    <img src="{{ $serviceData['team_members']['members'][$index]['photo'] }}" alt="Photo" class="object-cover w-full h-full">
                                                </div>
                                            @elseif(isset($teamMemberPhotos[$index]) && $teamMemberPhotos[$index])
                                                <div class="w-12 h-12 overflow-hidden bg-gray-100 rounded-full">
                                                    <img src="{{ $teamMemberPhotos[$index]->temporaryUrl() }}" alt="Aperçu de la photo" class="object-cover w-full h-full">
                                                </div>
                                            @endif
                                    
                                            <div class="flex flex-col flex-1 space-y-2">
                                                <div class="flex items-center space-x-2">
                                                    <label for="team_member_photo_upload_{{ $index }}" class="px-2 py-1 text-xs text-gray-700 transition bg-gray-200 rounded cursor-pointer hover:bg-gray-300">
                                                        <i class="mr-1 fas fa-upload"></i> Télécharger
                                                    </label>
                                                    <input
                                                        type="file"
                                                        id="team_member_photo_upload_{{ $index }}"
                                                        wire:model="teamMemberPhotos.{{ $index }}"
                                                        class="hidden"
                                                        accept="image/*"
                                                    >
                                    
                                                    @if((isset($serviceData['team_members']['members'][$index]['photo']) && !empty($serviceData['team_members']['members'][$index]['photo'])) || (isset($teamMemberPhotos[$index]) && $teamMemberPhotos[$index]))
                                                        <button
                                                            type="button"
                                                            wire:click="removeTeamMemberPhoto({{ $index }})"
                                                            class="px-2 py-1 text-xs text-pink hover:text-pink-dark focus:outline-none"
                                                        >
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                    
                                                @error('teamMemberPhotos.' . $index)
                                                    <span class="block mt-1 text-xs text-left text-pink">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="p-4 text-center text-gray-500 rounded-lg bg-gray-50">
                            Aucun membre d'équipe ajouté. Cliquez sur "Ajouter un membre" pour commencer.
                        </div>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    <!-- Onglet: Contact -->
    <div x-show="activeTab === 'contact'">
        <div class="space-y-4">
            <!-- Téléphone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-left text-gray-700">Téléphone</label>
                <div class="relative mt-1 rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="text-gray-400 fas fa-phone-alt"></i>
                    </div>
                    <input
                        wire:model="serviceData.phone"
                        id="phone"
                        type="text"
                        class="pl-10 block w-full rounded-md border-gray p-2 focus:ring-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} focus:border-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} @error('serviceData.phone') border-pink @enderror"
                    >
                </div>
                @error('serviceData.phone') <span class="mt-1 text-sm text-left text-pink">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-left text-gray-700">Email</label>
                <div class="relative mt-1 rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="text-gray-400 fas fa-envelope"></i>
                    </div>
                    <input
                        wire:model="serviceData.email"
                        id="email"
                        type="email"
                        class="pl-10 block w-full rounded-md border-gray p-2 focus:ring-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} focus:border-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} @error('serviceData.email') border-pink @enderror"
                    >
                </div>
                @error('serviceData.email') <span class="mt-1 text-sm text-left text-pink">{{ $message }}</span> @enderror
            </div>

            <!-- Localisation -->
            <div>
                <label for="location" class="block text-sm font-medium text-left text-gray-700">Adresse</label>
                <div class="relative mt-1 rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="text-gray-400 fas fa-map-marker-alt"></i>
                    </div>
                    <input
                        wire:model="serviceData.location"
                        id="location"
                        type="text"
                        class="pl-10 block w-full rounded-md border-gray p-2 focus:ring-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} focus:border-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} @error('serviceData.location') border-pink @enderror"
                    >
                </div>
                @error('serviceData.location') <span class="mt-1 text-sm text-left text-pink">{{ $message }}</span> @enderror
            </div>

            <!-- Horaires -->
            <div>
                <label for="working_hours" class="block text-sm font-medium text-left text-gray-700">Horaires</label>
                <div class="relative mt-1 rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="text-gray-400 fas fa-clock"></i>
                    </div>
                    <input
                        wire:model="serviceData.working_hours"
                        id="working_hours"
                        type="text"
                        class="pl-10 block w-full rounded-md border-gray p-2 focus:ring-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} focus:border-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} @error('serviceData.working_hours') border-pink @enderror"
                    >
                </div>
                @error('serviceData.working_hours') <span class="mt-1 text-sm text-left text-pink">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- Boutons de soumission -->
    <div class="flex justify-end pt-4 border-t border-gray-200">
        <div class="flex space-x-2">
            <button
                type="button"
                wire:click="closeModal"
                class="px-4 py-2 text-white transition bg-gray-600 rounded-lg hover:bg-gray-700 focus:outline-none"
            >
                Annuler
            </button>
            <button
                type="submit"
                class="px-4 py-2 text-white transition rounded-lg bg-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }} hover:bg-{{ $serviceType === 'technical' ? 'purple' : 'turquoise' }}-dark focus:outline-none"
            >
                <i class="mr-1 fas fa-save"></i> Enregistrer
            </button>
        </div>
    </div>
</form>