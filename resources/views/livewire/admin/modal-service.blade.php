@if($showEditModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen p-4 text-center sm:block sm:p-0">
            <!-- Arrière-plan semi-transparent -->
            <div class="fixed inset-0 transition-opacity bg-opacity-75 bg-dark" aria-hidden="true"></div>

            <!-- Contenu du Modal -->
            <div class="inline-block align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <!-- En-tête du Modal avec design amélioré -->
                <div class="flex items-center justify-between p-4 text-white rounded-t-lg bg-turquoise">
                    <h3 class="text-lg font-semibold">
                        <i class="mr-2 fas fa-edit"></i> Modifier: {{ $serviceData['name'] }}
                    </h3>
                    <button 
                        wire:click="closeModal" 
                        type="button" 
                        class="text-white hover:text-gray-200 focus:outline-none"
                    >
                        <span class="sr-only">Fermer</span>
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Corps du Modal avec onglets -->
                <div class="p-6">
                    <div x-data="{ activeTab: 'general' }">
                        <!-- Navigation par onglets -->
                        <div class="flex mb-6 border-b border-gray">
                            <button 
                                @click="activeTab = 'general'" 
                                :class="{ 'border-b-2 border-turquoise text-turquoise': activeTab === 'general', 'text-gray-500': activeTab !== 'general' }"
                                class="px-4 py-2 text-sm font-medium text-left transition focus:outline-none"
                            >
                                <i class="mr-1 fas fa-info-circle"></i> Information générale
                            </button>
                            <button 
                                @click="activeTab = 'team'" 
                                :class="{ 'border-b-2 border-turquoise text-turquoise': activeTab === 'team', 'text-gray-500': activeTab !== 'team' }"
                                class="px-4 py-2 text-sm font-medium text-left transition focus:outline-none"
                            >
                                <i class="mr-1 fas fa-users"></i> Équipe
                            </button>
                            <button 
                                @click="activeTab = 'contact'" 
                                :class="{ 'border-b-2 border-turquoise text-turquoise': activeTab === 'contact', 'text-gray-500': activeTab !== 'contact' }"
                                class="px-4 py-2 text-sm font-medium text-left transition focus:outline-none"
                            >
                                <i class="mr-1 fas fa-address-card"></i> Contact
                            </button>
                        </div>

                        <form wire:submit.prevent="updateService" class="space-y-6">
                            <!-- Onglet: Informations générales -->
                            <div x-show="activeTab === 'general'">
                                <div class="space-y-4">
                                    <!-- Catégorie -->
                                    <div>
                                        <label for="category_id" class="block text-sm font-medium text-left text-gray-700">Catégorie</label>
                                        <select wire:model="serviceData.category_id" id="category_id" class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('serviceData.category_id') border-pink @enderror">
                                            <option value="">Sélectionner une catégorie</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('serviceData.category_id') <span class="mt-1 text-sm text-left text-pink">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Nom du service -->
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-left text-gray-700">Nom du service</label>
                                        <input wire:model="serviceData.name" id="name" type="text" class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('serviceData.name') border-pink @enderror">
                                        @error('serviceData.name') <span class="mt-1 text-sm text-left text-pink">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <!-- Description courte -->
                                    <div>
                                        <label for="short_description" class="block text-sm font-medium text-left text-gray-700">
                                            Description courte <span class="text-xs text-gray-500">(max 500 caractères)</span>
                                        </label>
                                        <textarea wire:model="serviceData.short_description" id="short_description" rows="2" class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('serviceData.short_description') border-pink @enderror"></textarea>
                                        <div class="flex justify-end mt-1 text-xs text-gray-500">
                                            {{ strlen($serviceData['short_description']) }} / 500
                                        </div>
                                        @error('serviceData.short_description') <span class="mt-1 text-sm text-left text-pink">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Description complète -->
                                    <div>
                                        <label for="full_description" class="block text-sm font-medium text-left text-gray-700">Description complète</label>
                                        <textarea wire:model="serviceData.full_description" id="full_description" rows="4" class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('serviceData.full_description') border-pink @enderror"></textarea>
                                        @error('serviceData.full_description') <span class="mt-1 text-sm text-left text-pink">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                
                                <!-- Statut -->
                                <div class="mt-4">
                                    <div class="flex items-center">
                                        <input wire:model="serviceData.active" id="active" type="checkbox" class="rounded border-gray text-turquoise focus:ring-turquoise">
                                        <label for="active" class="ml-2 text-sm font-medium text-gray-700">Service actif</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Onglet: Équipe -->
                            <div x-show="activeTab === 'team'">
                                <div class="space-y-6">
                                    <!-- Nom de l'équipe -->
                                    <div>
                                        <label for="team_name" class="block text-sm font-medium text-left text-gray-700">Titre de l'équipe</label>
                                        <input wire:model="serviceData.team_name" id="team_name" type="text" class="block w-full p-2 mt-1 rounded-md border-gray focus:ring-turquoise focus:border-turquoise">
                                    </div>
                                    <!-- Responsable d'équipe -->
                                    <div class="p-4 border border-gray-200 rounded-lg">
                                        <p class="mb-4 font-medium text-left text-gray-700">Chef d'équipe</h4>
                                        
                                        <div class="space-y-4">
                                            <!-- Nom du responsable -->
                                            <div>
                                                <label for="team_leader_name" class="block text-sm font-medium text-left text-gray-700">Nom du responsable</label>
                                                <input wire:model="serviceData.team_leader.name" id="team_leader_name" type="text" class="block w-full p-2 mt-1 rounded-md border-gray focus:ring-turquoise focus:border-turquoise">
                                            </div>

                                            <!-- Poste du responsable -->
                                            <div>
                                                <label for="team_leader_position" class="block text-sm font-medium text-left text-gray-700">Poste/Fonction</label>
                                                <input wire:model="serviceData.team_leader.position" id="team_leader_position" type="text" class="block w-full p-2 mt-1 rounded-md border-gray focus:ring-turquoise focus:border-turquoise">
                                            </div>

                                            <!-- Photo du responsable -->
                                            <div>
                                                <label for="team_leader_photo" class="block text-sm font-medium text-left text-gray-700">Photo</label>
                                                <div class="flex items-center mt-1">
                                                    @if(!empty($serviceData['team_leader']['photo']) && !is_object($serviceData['team_leader']['photo']))
                                                        <div class="w-16 h-16 mr-3 overflow-hidden bg-gray-100 rounded-full">
                                                            <img src="{{ $serviceData['team_leader']['photo'] }}" alt="Photo du responsable" class="object-cover w-full h-full">
                                                        </div>
                                                    @elseif(!empty($teamLeaderPhotoTemp))
                                                        <div class="w-16 h-16 mr-3 overflow-hidden bg-gray-100 rounded-full">
                                                            <img src="{{ $teamLeaderPhotoTemp->temporaryUrl() }}" alt="Aperçu de la photo" class="object-cover w-full h-full">
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
                                                                wire:model="teamLeaderPhotoTemp" 
                                                                class="hidden"
                                                                accept="image/*"
                                                            >
                                                            
                                                            @if(!empty($serviceData['team_leader']['photo']) || !empty($teamLeaderPhotoTemp))
                                                                <button 
                                                                    type="button" 
                                                                    wire:click="removeTeamLeaderPhoto" 
                                                                    class="px-2 py-1 text-sm text-pink hover:text-pink-dark focus:outline-none"
                                                                >
                                                                    <i class="fas fa-trash-alt"></i> Supprimer
                                                                </button>
                                                            @endif
                                                        </div>
                                                        
                                                        <div class="flex items-center space-x-2">
                                                            <span class="text-sm text-gray-500">ou</span>
                                                            <input 
                                                                wire:model="serviceData.team_leader.photo" 
                                                                type="text" 
                                                                class="flex-1 p-2 text-sm rounded-md border-gray focus:ring-turquoise focus:border-turquoise" 
                                                                placeholder="URL de la photo"
                                                            >
                                                        </div>
                                                        
                                                        @error('teamLeaderPhotoTemp') 
                                                            <span class="block mt-1 text-sm text-left text-pink">{{ $message }}</span> 
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Email du responsable -->
                                            <div>
                                                <label for="team_leader_email" class="block text-sm font-medium text-left text-gray-700">Email</label>
                                                <input wire:model="serviceData.team_leader.email" id="team_leader_email" type="email" class="block w-full p-2 mt-1 rounded-md border-gray focus:ring-turquoise focus:border-turquoise">
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
                                                class="text-sm font-medium text-turquoise hover:text-turquoise-dark focus:outline-none"
                                            >
                                                <i class="mr-1 fas fa-plus-circle"></i> Ajouter un membre
                                            </button>
                                        </div>

                                        <div class="space-y-3">
                                            @foreach($serviceData['team_members'] as $index => $member)
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
                                                            <input wire:model="serviceData.team_members.{{ $index }}.name" type="text" class="block w-full p-2 mt-1 text-sm rounded-md border-gray focus:ring-turquoise focus:border-turquoise">
                                                        </div>
                                                        <div>
                                                            <label class="block text-xs font-medium text-left text-gray-700">Poste</label>
                                                            <input wire:model="serviceData.team_members.{{ $index }}.position" type="text" class="block w-full p-2 mt-1 text-sm rounded-md border-gray focus:ring-turquoise focus:border-turquoise">
                                                        </div>

                                                        <div>
                                                            <label class="block text-xs font-medium text-left text-gray-700">Photo</label>
                                                            <div class="flex items-center mt-1 space-x-2">
                                                                @if(!empty($serviceData['team_members'][$index]['photo']) && !is_object($serviceData['team_members'][$index]['photo']))
                                                                    <div class="w-12 h-12 overflow-hidden bg-gray-100 rounded-full">
                                                                        <img src="{{ $serviceData['team_members'][$index]['photo'] }}" alt="Photo" class="object-cover w-full h-full">
                                                                    </div>
                                                                @elseif(!empty($teamMemberPhotoTemp[$index]))
                                                                    <div class="w-12 h-12 overflow-hidden bg-gray-100 rounded-full">
                                                                        <img src="{{ $teamMemberPhotoTemp[$index]->temporaryUrl() }}" alt="Aperçu de la photo" class="object-cover w-full h-full">
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
                                                                            wire:model="teamMemberPhotoTemp.{{ $index }}" 
                                                                            class="hidden"
                                                                            accept="image/*"
                                                                        >
                                                                        
                                                                        @if(!empty($serviceData['team_members'][$index]['photo']) || !empty($teamMemberPhotoTemp[$index]))
                                                                            <button 
                                                                                type="button" 
                                                                                wire:click="removeTeamMemberPhoto({{ $index }})" 
                                                                                class="px-2 py-1 text-xs text-pink hover:text-pink-dark focus:outline-none"
                                                                            >
                                                                                <i class="fas fa-trash-alt"></i>
                                                                            </button>
                                                                        @endif
                                                                    </div>
                                                                    
                                                                    <div class="flex items-center space-x-2">
                                                                        <span class="text-xs text-gray-500">ou</span>
                                                                        <input 
                                                                            wire:model="serviceData.team_members.{{ $index }}.photo" 
                                                                            type="text" 
                                                                            class="flex-1 rounded-md border-gray p-1.5 focus:ring-turquoise focus:border-turquoise text-xs" 
                                                                            placeholder="URL de la photo"
                                                                        >
                                                                    </div>
                                                                    
                                                                    @error('teamMemberPhotoTemp.' . $index) 
                                                                        <span class="block mt-1 text-xs text-left text-pink">{{ $message }}</span> 
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach

                                            @if(empty($serviceData['team_members']))
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
                                                class="pl-10 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('serviceData.phone') border-pink @enderror"
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
                                                class="pl-10 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('serviceData.email') border-pink @enderror"
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
                                                class="pl-10 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('serviceData.location') border-pink @enderror"
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
                                                class="pl-10 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('serviceData.working_hours') border-pink @enderror"
                                                placeholder="Ex: Lun-Ven: 9h-18h, Sam: 10h-15h"
                                            >
                                        </div>
                                        @error('serviceData.working_hours') <span class="mt-1 text-sm text-left text-pink">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons de navigation et de soumission -->
                            <div class="flex justify-between pt-4 border-t border-gray-200">
                                <div class="flex space-x-2">
                                    <button 
                                        type="button" 
                                        @click="activeTab = (activeTab === 'general') ? 'team' : (activeTab === 'team' ? 'contact' : 'general')"
                                        class="px-4 py-2 text-gray-700 transition bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none"
                                    >
                                        <span x-text="activeTab === 'general' ? 'Suivant: Équipe' : (activeTab === 'team' ? 'Suivant: Contact' : 'Retour au début')"></span>
                                    </button>
                                </div>
                                
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
                                        class="px-4 py-2 text-white transition rounded-lg bg-turquoise hover:bg-turquoise-dark focus:outline-none"
                                    >
                                        <i class="mr-1 fas fa-save"></i> Enregistrer
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif