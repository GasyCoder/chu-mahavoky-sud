@if($showEditModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen p-4 text-center sm:block sm:p-0">
            <!-- Arrière-plan semi-transparent -->
            <div class="fixed inset-0 bg-dark bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- Contenu du Modal -->
            <div class="inline-block align-bottom bg-white rounded-lg shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <!-- En-tête du Modal avec design amélioré -->
                <div class="flex justify-between items-center p-4 bg-turquoise text-white rounded-t-lg">
                    <h3 class="text-lg font-semibold">
                        <i class="fas fa-edit mr-2"></i> Modifier: {{ $serviceData['name'] }}
                    </h3>
                    <button 
                        wire:click="closeModal" 
                        type="button" 
                        class="text-white hover:text-gray-200 focus:outline-none"
                    >
                        <span class="sr-only">Fermer</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Corps du Modal avec onglets -->
                <div class="p-6">
                    <div x-data="{ activeTab: 'general' }">
                        <!-- Navigation par onglets -->
                        <div class="flex border-b border-gray mb-6">
                            <button 
                                @click="activeTab = 'general'" 
                                :class="{ 'border-b-2 border-turquoise text-turquoise': activeTab === 'general', 'text-gray-500': activeTab !== 'general' }"
                                class="px-4 py-2 font-medium text-sm focus:outline-none transition text-left"
                            >
                                <i class="fas fa-info-circle mr-1"></i> Information générale
                            </button>
                            <button 
                                @click="activeTab = 'team'" 
                                :class="{ 'border-b-2 border-turquoise text-turquoise': activeTab === 'team', 'text-gray-500': activeTab !== 'team' }"
                                class="px-4 py-2 font-medium text-sm focus:outline-none transition text-left"
                            >
                                <i class="fas fa-users mr-1"></i> Équipe
                            </button>
                            <button 
                                @click="activeTab = 'contact'" 
                                :class="{ 'border-b-2 border-turquoise text-turquoise': activeTab === 'contact', 'text-gray-500': activeTab !== 'contact' }"
                                class="px-4 py-2 font-medium text-sm focus:outline-none transition text-left"
                            >
                                <i class="fas fa-address-card mr-1"></i> Contact
                            </button>
                        </div>

                        <form wire:submit.prevent="updateService" class="space-y-6">
                            <!-- Onglet: Informations générales -->
                            <div x-show="activeTab === 'general'">
                                <div class="space-y-4">
                                    <!-- Catégorie -->
                                    <div>
                                        <label for="category_id" class="block text-sm font-medium text-gray-700 text-left">Catégorie</label>
                                        <select wire:model="serviceData.category_id" id="category_id" class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('serviceData.category_id') border-pink @enderror">
                                            <option value="">Sélectionner une catégorie</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('serviceData.category_id') <span class="mt-1 text-sm text-pink text-left">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Nom du service -->
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 text-left">Nom du service</label>
                                        <input wire:model="serviceData.name" id="name" type="text" class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('serviceData.name') border-pink @enderror">
                                        @error('serviceData.name') <span class="mt-1 text-sm text-pink text-left">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <!-- Description courte -->
                                    <div>
                                        <label for="short_description" class="block text-sm font-medium text-gray-700 text-left">
                                            Description courte <span class="text-xs text-gray-500">(max 500 caractères)</span>
                                        </label>
                                        <textarea wire:model="serviceData.short_description" id="short_description" rows="2" class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('serviceData.short_description') border-pink @enderror"></textarea>
                                        <div class="mt-1 text-xs text-gray-500 flex justify-end">
                                            {{ strlen($serviceData['short_description']) }} / 500
                                        </div>
                                        @error('serviceData.short_description') <span class="mt-1 text-sm text-pink text-left">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Description complète -->
                                    <div>
                                        <label for="full_description" class="block text-sm font-medium text-gray-700 text-left">Description complète</label>
                                        <textarea wire:model="serviceData.full_description" id="full_description" rows="4" class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('serviceData.full_description') border-pink @enderror"></textarea>
                                        @error('serviceData.full_description') <span class="mt-1 text-sm text-pink text-left">{{ $message }}</span> @enderror
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
                                        <label for="team_name" class="block text-sm font-medium text-gray-700 text-left">Titre de l'équipe</label>
                                        <input wire:model="serviceData.team_name" id="team_name" type="text" class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise">
                                    </div>
                                    <!-- Responsable d'équipe -->
                                    <div class="p-4 border border-gray-200 rounded-lg">
                                        <p class="font-medium text-gray-700 mb-4 text-left">Chef d'équipe</h4>
                                        
                                        <div class="space-y-4">
                                            <!-- Nom du responsable -->
                                            <div>
                                                <label for="team_leader_name" class="block text-sm font-medium text-gray-700 text-left">Nom du responsable</label>
                                                <input wire:model="serviceData.team_leader.name" id="team_leader_name" type="text" class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise">
                                            </div>

                                            <!-- Poste du responsable -->
                                            <div>
                                                <label for="team_leader_position" class="block text-sm font-medium text-gray-700 text-left">Poste/Fonction</label>
                                                <input wire:model="serviceData.team_leader.position" id="team_leader_position" type="text" class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise">
                                            </div>

                                            <!-- Photo du responsable -->
                                            <div>
                                                <label for="team_leader_photo" class="block text-sm font-medium text-gray-700 text-left">Photo</label>
                                                <div class="mt-1 flex items-center">
                                                    @if(!empty($serviceData['team_leader']['photo']) && !is_object($serviceData['team_leader']['photo']))
                                                        <div class="mr-3 h-16 w-16 bg-gray-100 rounded-full overflow-hidden">
                                                            <img src="{{ $serviceData['team_leader']['photo'] }}" alt="Photo du responsable" class="h-full w-full object-cover">
                                                        </div>
                                                    @elseif(!empty($teamLeaderPhotoTemp))
                                                        <div class="mr-3 h-16 w-16 bg-gray-100 rounded-full overflow-hidden">
                                                            <img src="{{ $teamLeaderPhotoTemp->temporaryUrl() }}" alt="Aperçu de la photo" class="h-full w-full object-cover">
                                                        </div>
                                                    @endif
                                                    
                                                    <div class="flex flex-col space-y-2 flex-1">
                                                        <div class="flex items-center space-x-2">
                                                            <label for="team_leader_photo_upload" class="px-3 py-1.5 bg-gray-200 text-gray-700 rounded cursor-pointer hover:bg-gray-300 transition text-sm">
                                                                <i class="fas fa-upload mr-1"></i> Télécharger une photo
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
                                                                    class="px-2 py-1 text-pink hover:text-pink-dark focus:outline-none text-sm"
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
                                                                class="flex-1 rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise text-sm" 
                                                                placeholder="URL de la photo"
                                                            >
                                                        </div>
                                                        
                                                        @error('teamLeaderPhotoTemp') 
                                                            <span class="mt-1 text-sm text-pink text-left block">{{ $message }}</span> 
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Email du responsable -->
                                            <div>
                                                <label for="team_leader_email" class="block text-sm font-medium text-gray-700 text-left">Email</label>
                                                <input wire:model="serviceData.team_leader.email" id="team_leader_email" type="email" class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Membres de l'équipe (liste) -->
                                    <div>
                                        <div class="flex justify-between items-center mb-2">
                                            <label class="block text-sm font-medium text-gray-700 text-left">Membres de l'équipe</label>
                                            <button 
                                                type="button" 
                                                wire:click="addTeamMember" 
                                                class="text-sm text-turquoise hover:text-turquoise-dark font-medium focus:outline-none"
                                            >
                                                <i class="fas fa-plus-circle mr-1"></i> Ajouter un membre
                                            </button>
                                        </div>

                                        <div class="space-y-3">
                                            @foreach($serviceData['team_members'] as $index => $member)
                                                <div class="p-3 border border-gray-200 rounded-lg">
                                                    <div class="flex justify-between items-center mb-2">
                                                        <h5 class="font-medium text-sm text-left">Membre #{{ $index + 1 }}</h5>
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
                                                            <label class="block text-xs font-medium text-gray-700 text-left">Nom</label>
                                                            <input wire:model="serviceData.team_members.{{ $index }}.name" type="text" class="mt-1 block w-full rounded-md border-gray p-2 text-sm focus:ring-turquoise focus:border-turquoise">
                                                        </div>
                                                        <div>
                                                            <label class="block text-xs font-medium text-gray-700 text-left">Poste</label>
                                                            <input wire:model="serviceData.team_members.{{ $index }}.position" type="text" class="mt-1 block w-full rounded-md border-gray p-2 text-sm focus:ring-turquoise focus:border-turquoise">
                                                        </div>

                                                        <div>
                                                            <label class="block text-xs font-medium text-gray-700 text-left">Photo</label>
                                                            <div class="mt-1 flex items-center space-x-2">
                                                                @if(!empty($serviceData['team_members'][$index]['photo']) && !is_object($serviceData['team_members'][$index]['photo']))
                                                                    <div class="h-12 w-12 bg-gray-100 rounded-full overflow-hidden">
                                                                        <img src="{{ $serviceData['team_members'][$index]['photo'] }}" alt="Photo" class="h-full w-full object-cover">
                                                                    </div>
                                                                @elseif(!empty($teamMemberPhotoTemp[$index]))
                                                                    <div class="h-12 w-12 bg-gray-100 rounded-full overflow-hidden">
                                                                        <img src="{{ $teamMemberPhotoTemp[$index]->temporaryUrl() }}" alt="Aperçu de la photo" class="h-full w-full object-cover">
                                                                    </div>
                                                                @endif
                                                                
                                                                <div class="flex flex-col space-y-2 flex-1">
                                                                    <div class="flex items-center space-x-2">
                                                                        <label for="team_member_photo_upload_{{ $index }}" class="px-2 py-1 bg-gray-200 text-gray-700 rounded cursor-pointer hover:bg-gray-300 transition text-xs">
                                                                            <i class="fas fa-upload mr-1"></i> Télécharger
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
                                                                                class="px-2 py-1 text-pink hover:text-pink-dark focus:outline-none text-xs"
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
                                                                        <span class="mt-1 text-xs text-pink text-left block">{{ $message }}</span> 
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach

                                            @if(empty($serviceData['team_members']))
                                                <div class="p-4 bg-gray-50 rounded-lg text-center text-gray-500">
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
                                        <label for="phone" class="block text-sm font-medium text-gray-700 text-left">Téléphone</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-phone-alt text-gray-400"></i>
                                            </div>
                                            <input 
                                                wire:model="serviceData.phone" 
                                                id="phone" 
                                                type="text" 
                                                class="pl-10 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('serviceData.phone') border-pink @enderror"
                                            >
                                        </div>
                                        @error('serviceData.phone') <span class="mt-1 text-sm text-pink text-left">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 text-left">Email</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-envelope text-gray-400"></i>
                                            </div>
                                            <input 
                                                wire:model="serviceData.email" 
                                                id="email" 
                                                type="email" 
                                                class="pl-10 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('serviceData.email') border-pink @enderror"
                                            >
                                        </div>
                                        @error('serviceData.email') <span class="mt-1 text-sm text-pink text-left">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Localisation -->
                                    <div>
                                        <label for="location" class="block text-sm font-medium text-gray-700 text-left">Adresse</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                                            </div>
                                            <input 
                                                wire:model="serviceData.location" 
                                                id="location" 
                                                type="text" 
                                                class="pl-10 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('serviceData.location') border-pink @enderror"
                                            >
                                        </div>
                                        @error('serviceData.location') <span class="mt-1 text-sm text-pink text-left">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Horaires -->
                                    <div>
                                        <label for="working_hours" class="block text-sm font-medium text-gray-700 text-left">Horaires</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-clock text-gray-400"></i>
                                            </div>
                                            <input 
                                                wire:model="serviceData.working_hours" 
                                                id="working_hours" 
                                                type="text" 
                                                class="pl-10 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('serviceData.working_hours') border-pink @enderror"
                                                placeholder="Ex: Lun-Ven: 9h-18h, Sam: 10h-15h"
                                            >
                                        </div>
                                        @error('serviceData.working_hours') <span class="mt-1 text-sm text-pink text-left">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons de navigation et de soumission -->
                            <div class="flex justify-between pt-4 border-t border-gray-200">
                                <div class="flex space-x-2">
                                    <button 
                                        type="button" 
                                        @click="activeTab = (activeTab === 'general') ? 'team' : (activeTab === 'team' ? 'contact' : 'general')"
                                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition focus:outline-none"
                                    >
                                        <span x-text="activeTab === 'general' ? 'Suivant: Équipe' : (activeTab === 'team' ? 'Suivant: Contact' : 'Retour au début')"></span>
                                    </button>
                                </div>
                                
                                <div class="flex space-x-2">
                                    <button 
                                        type="button" 
                                        wire:click="closeModal" 
                                        class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition focus:outline-none"
                                    >
                                        Annuler
                                    </button>
                                    <button 
                                        type="submit" 
                                        class="px-4 py-2 bg-turquoise text-white rounded-lg hover:bg-turquoise-dark transition focus:outline-none"
                                    >
                                        <i class="fas fa-save mr-1"></i> Enregistrer
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