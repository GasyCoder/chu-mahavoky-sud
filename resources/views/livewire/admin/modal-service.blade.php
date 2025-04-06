@if($showEditModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen p-4 text-center sm:block sm:p-0">
            <!-- Arrière-plan semi-transparent -->
            <div class="fixed inset-0 transition-opacity bg-opacity-75 bg-dark" aria-hidden="true"></div>

            <!-- Contenu du Modal -->
            <div class="inline-block align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <!-- En-tête du Modal avec design adapté au type de service -->
                <div class="flex items-center justify-between p-4 text-white rounded-t-lg {{ $serviceType === 'technical' ? 'bg-purple' : 'bg-turquoise' }}">
                    <h3 class="text-lg font-semibold">
                        @if($editingServiceId)
                            <i class="mr-2 fas fa-edit"></i> Modifier: {{ $serviceData['name'] ?? 'Service' }}
                        @else
                            <i class="mr-2 fas fa-plus"></i> Ajouter un service {{ $serviceType === 'technical' ? 'technique' : 'administratif' }}
                        @endif
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
                                :class="{ 'border-b-2 {{ $serviceType === 'technical' ? 'border-purple text-purple' : 'border-turquoise text-turquoise' }}': activeTab === 'general', 'text-gray-500': activeTab !== 'general' }"
                                class="px-4 py-2 text-sm font-medium text-left transition focus:outline-none"
                            >
                                <i class="mr-1 fas fa-info-circle"></i> Information générale
                            </button>
                            <button
                                @click="activeTab = 'team'"
                                :class="{ 'border-b-2 {{ $serviceType === 'technical' ? 'border-purple text-purple' : 'border-turquoise text-turquoise' }}': activeTab === 'team', 'text-gray-500': activeTab !== 'team' }"
                                class="px-4 py-2 text-sm font-medium text-left transition focus:outline-none"
                            >
                                <i class="mr-1 fas fa-users"></i> Équipe
                            </button>
                            <button
                                @click="activeTab = 'contact'"
                                :class="{ 'border-b-2 {{ $serviceType === 'technical' ? 'border-purple text-purple' : 'border-turquoise text-turquoise' }}': activeTab === 'contact', 'text-gray-500': activeTab !== 'contact' }"
                                class="px-4 py-2 text-sm font-medium text-left transition focus:outline-none"
                            >
                                <i class="mr-1 fas fa-address-card"></i> Contact
                            </button>
                        </div>
                        
                        @include('livewire.admin.form')
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@push('scripts')
<script src="https://cdn.tiny.cloud/1/ggl24otsg6ii4amtaziztgfu6y1fv23npxoqemawhqdwvmnd/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('livewire:initialized', function (event) {
        initTinyMCE();
        
        // Événement modal ouvert
        Livewire.on('modal-opened', () => {
            setTimeout(() => {
                initTinyMCE();
            }, 100);
            
            // Votre code existant pour réinitialiser l'onglet actif
            if (typeof Alpine !== 'undefined') {
                const alpineComponent = document.querySelector('[x-data]')?.__x;
                if (alpineComponent) {
                    alpineComponent.$data.activeTab = 'general';
                }
            }
        });
        
        // Mettre à jour l'éditeur quand les données changent
        Livewire.on('descriptionUpdated', (content) => {
            if (tinymce.get('full_description')) {
                tinymce.get('full_description').setContent(content);
            }
        });
        
        // Votre code existant pour les actions après sauvegarde
        Livewire.on('serviceSaved', () => {
            // Notifications ou autres actions à effectuer après sauvegarde
        });
    });
    
    function initTinyMCE() {
        if (document.getElementById('full_description')) {
            // Supprimer l'instance existante si elle existe
            if (tinymce.get('full_description')) {
                tinymce.get('full_description').remove();
            }
            
            tinymce.init({
                selector: 'textarea#full_description',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                language: 'fr_FR', // Pour avoir l'interface en français
                height: 450,
                menubar: true,
                setup: function (editor) {
                    editor.on('change', function (e) {
                        @this.set('serviceData.full_description', editor.getContent());
                    });
                    
                    editor.on('init', function (e) {
                        // S'assurer que le contenu initial est chargé
                        if (@this.serviceData.full_description) {
                            editor.setContent(@this.serviceData.full_description);
                        }
                    });
                }
            });
        }
    }
</script>
@endpush