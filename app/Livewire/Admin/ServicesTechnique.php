<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use App\Models\ServiceCategory;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ServicesTechnique extends Component
{
    use WithPagination, WithFileUploads;

    // Propriétés de base
    public $serviceType = 'technical';
    public $pageTitle = 'Gestion des Services Techniques';
    
    // Propriétés pour la recherche et le filtrage
    public $searchTerm = '';
    public $categoryFilter = '';
    public $statusFilter = null;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    
    // Propriétés pour l'édition des services
    public $showEditModal = false;
    public $editingServiceId = null;
    
    // Données du service
    public $serviceData = [
        'name' => '',
        'category_id' => '',
        'icon' => '',
        'short_description' => '',
        'full_description' => '',
        'phone' => '',
        'email' => '',
        'location' => '',
        'working_hours' => '',
        'team_members' => [
            'leader' => [
                'name' => '',
                'position' => '',
                'photo' => '',
                'email' => ''
            ],
            'members' => []
        ],
        'order' => 0,
        'featured' => false,
        'active' => true
    ];
    
    // Gestion des images
    public $mainImage; // Image principale
    public $galleryImages = []; // Images multiples pour l'upload
    public $existingImages = []; // Images existantes en base de données
    
    // Gestion des photos d'équipe
    public $teamLeaderPhoto;
    public $teamMemberPhotos = [];
    
    // Liste des catégories disponibles
    public $categories = [];
    public $technicalCategoryIds = [];

    // Initialisation du composant
    public function mount()
    {
        $this->loadCategories();
        $this->categoryFilter = '';
    }

    // Chargement des catégories
    protected function loadCategories()
    {
        // Récupérer toutes les catégories
        $this->categories = ServiceCategory::all();

        // Filtrer les IDs des catégories techniques
        $this->technicalCategoryIds = $this->categories
            ->where('type', 'technical')
            ->pluck('id')
            ->toArray();

        if (count($this->technicalCategoryIds) === 0) {
            Log::warning('Aucune catégorie technique trouvée.');
        }

        // Définir une catégorie par défaut pour les nouveaux services
        $defaultCategory = $this->categories->where('type', 'technical')->first();
        if ($defaultCategory) {
            $this->serviceData['category_id'] = $defaultCategory->id;
        }
    }

    // Règles de validation
    protected function rules()
    {
        return [
            'serviceData.name' => 'required|string|max:255',
            'serviceData.category_id' => 'required|exists:service_categories,id',
            'serviceData.icon' => 'nullable|string|max:255',
            'serviceData.short_description' => 'required|string|max:500',
            'serviceData.full_description' => 'nullable|string',
            'serviceData.phone' => 'nullable|string|max:255',
            'serviceData.email' => 'nullable|email|max:255',
            'serviceData.location' => 'nullable|string|max:255',
            'serviceData.working_hours' => 'nullable|string|max:255',
            'mainImage' => 'nullable|image|max:2048',
            'galleryImages.*' => 'nullable|image|max:2048',
            'teamLeaderPhoto' => 'nullable|image|max:2048',
            'teamMemberPhotos.*' => 'nullable|image|max:2048'
        ];
    }

    // Rendu du composant
    public function render()
    {
        $services = $this->getFilteredServices();

        return view('livewire.admin.services-technique', [
            'services' => $services,
            'categories' => $this->categories,
            'technicalCategoryIds' => $this->technicalCategoryIds,
            'serviceType' => $this->serviceType
        ]);
    }

    // Récupérer les services filtrés
    public function getFilteredServices()
    {
        $query = Service::query()
            ->join('service_categories', 'services.category_id', '=', 'service_categories.id')
            ->where('service_categories.type', $this->serviceType)
            ->select('services.*');

        // Appliquer les filtres de recherche
        if (!empty($this->searchTerm)) {
            $query->where(function ($q) {
                $q->where('services.name', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('services.short_description', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('services.phone', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('services.email', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('services.location', 'like', '%' . $this->searchTerm . '%');
            });
        }

        // Filtrer par catégorie
        if (!empty($this->categoryFilter)) {
            $query->where('services.category_id', $this->categoryFilter);
        }

        // Filtrer par statut
        if ($this->statusFilter !== null) {
            $query->where('services.active', $this->statusFilter);
        }

        // Tri
        if ($this->sortField === 'category_id') {
            $query->orderBy('service_categories.name', $this->sortDirection);
        } else {
            $query->orderBy('services.' . $this->sortField, $this->sortDirection);
        }

        return $query->with('category')->paginate(10);
    }

    // Changement du tri
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    // Réinitialisation des filtres
    public function resetFilters()
    {
        $this->searchTerm = '';
        $this->categoryFilter = '';
        $this->statusFilter = null;
    }

    // Réinitialisation de la recherche
    public function resetSearch()
    {
        $this->searchTerm = '';
    }

    // Création d'un nouveau service
    public function createNewService()
    {
        $this->resetForm();
        $firstCategory = ServiceCategory::where('type', $this->serviceType)->first();
        if ($firstCategory) {
            $this->serviceData['category_id'] = $firstCategory->id;
        }
        $this->showEditModal = true;
        $this->dispatch('modal-opened');
    }

    // Édition d'un service existant
    public function editService($id)
    {
        $this->resetForm();
        $this->editingServiceId = $id;
        
        $service = Service::findOrFail($id);
        $category = ServiceCategory::findOrFail($service->category_id);
        
        // Vérifier le type de service
        if ($category->type !== $this->serviceType) {
            session()->flash('error', 'Ce service n\'est pas un service technique.');
            return;
        }

        // Charger les données du service
        $this->serviceData = [
            'name' => $service->name,
            'category_id' => $service->category_id,
            'icon' => $service->icon,
            'short_description' => $service->short_description,
            'full_description' => $service->full_description,
            'phone' => $service->phone,
            'email' => $service->email,
            'location' => $service->location,
            'working_hours' => $service->working_hours,
            'team_members' => $service->team_members ?? [
                'leader' => ['name' => '', 'position' => '', 'photo' => '', 'email' => ''],
                'members' => []
            ],
            'order' => $service->order,
            'featured' => $service->featured,
            'active' => $service->active
        ];

        // Charger l'image principale
        if ($service->image) {
            $this->serviceData['image'] = $service->image;
        }

        // Charger les images de la galerie
        $this->existingImages = $service->images ?? [];

        $this->showEditModal = true;
        $this->dispatch('modal-opened');

        $this->dispatch('descriptionUpdated', $this->serviceData['full_description']);
    }

    // Fermeture du modal
    public function closeModal()
    {
        $this->showEditModal = false;
        $this->dispatch('modal-closed');
    }

    // Réinitialisation du formulaire
    public function resetForm()
    {
        $this->serviceData = [
            'name' => '',
            'category_id' => '',
            'icon' => '',
            'short_description' => '',
            'full_description' => '',
            'phone' => '',
            'email' => '',
            'location' => '',
            'working_hours' => '',
            'team_members' => [
                'leader' => [
                    'name' => '',
                    'position' => '',
                    'photo' => '',
                    'email' => ''
                ],
                'members' => []
            ],
            'order' => 0,
            'featured' => false,
            'active' => true
        ];

        $this->mainImage = null;
        $this->galleryImages = [];
        $this->existingImages = [];
        $this->teamLeaderPhoto = null;
        $this->teamMemberPhotos = [];
        $this->editingServiceId = null;
        $this->resetErrorBag();

        // Définir la catégorie par défaut
        $defaultCategory = $this->categories->where('type', 'technical')->first();
        if ($defaultCategory) {
            $this->serviceData['category_id'] = $defaultCategory->id;
        }
    }

    // Sauvegarde du service
    public function saveService()
    {
        $this->validate();

        // Vérifier que la catégorie est bien une catégorie technique
        $category = ServiceCategory::findOrFail($this->serviceData['category_id']);
        if ($category->type !== $this->serviceType) {
            session()->flash('error', 'Veuillez choisir une catégorie technique.');
            return;
        }

        try {
            // Récupérer ou créer le service
            $service = $this->editingServiceId ? Service::findOrFail($this->editingServiceId) : new Service();
            
            // Générer le slug si nouveau service
            if (empty($service->slug)) {
                $service->slug = Str::slug($this->serviceData['name']);
            }

            // Traiter l'image principale
            if ($this->mainImage) {
                if ($service->image && Storage::exists($service->image)) {
                    Storage::delete($service->image);
                }
                $imagePath = $this->mainImage->store('services', 'public');
                $this->serviceData['image'] = $imagePath;
            }

            // Traiter les photos d'équipe
            $this->processTeamPhotos();
            
            // Traiter les images de la galerie
            $this->processGalleryImages($service);

            // Remplir et sauvegarder le service
            $service->fill($this->serviceData);
            $service->save();

            // Notification de succès
            session()->flash('success', $this->editingServiceId ? 'Service technique mis à jour.' : 'Service technique créé.');
            $this->showEditModal = false;
            
        } catch (\Exception $e) {
            Log::error('Erreur lors de la sauvegarde: ' . $e->getMessage(), [
                'exception' => $e,
                'service_data' => $this->serviceData
            ]);
            session()->flash('error', 'Erreur lors de l\'enregistrement: ' . $e->getMessage());
        }
    }

    // Traitement des photos d'équipe
    protected function processTeamPhotos()
    {
        // Photo du chef d'équipe
        if ($this->teamLeaderPhoto) {
            $path = $this->teamLeaderPhoto->store('team-photos', 'public');
            $this->serviceData['team_members']['leader']['photo'] = Storage::url($path);
        }

        // Photos des membres de l'équipe
        if (!empty($this->teamMemberPhotos)) {
            foreach ($this->teamMemberPhotos as $index => $photo) {
                if ($photo && isset($this->serviceData['team_members']['members'][$index])) {
                    $path = $photo->store('team-photos', 'public');
                    $this->serviceData['team_members']['members'][$index]['photo'] = Storage::url($path);
                }
            }
        }
    }

    // Traitement des images de galerie
    protected function processGalleryImages(&$service)
    {
        // Initialiser le tableau d'images
        $galleryImages = [];
        
        // Conserver les images existantes
        if (!empty($this->existingImages)) {
            $galleryImages = $this->existingImages;
        }
        
        // Ajouter les nouvelles images
        if (!empty($this->galleryImages)) {
            foreach ($this->galleryImages as $image) {
                $path = $image->store('services/gallery', 'public');
                $galleryImages[] = $path;
            }
        }
        
        // Mettre à jour les images du service si nous avons des images
        if (!empty($galleryImages)) {
            $service->images = $galleryImages;
        }
    }

    // Suppression d'une image de la galerie
    public function removeGalleryImage($index)
    {
        if (isset($this->existingImages[$index])) {
            $imagePath = $this->existingImages[$index];
            
            // Supprimer l'image du stockage
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            
            // Supprimer l'image du tableau
            unset($this->existingImages[$index]);
            $this->existingImages = array_values($this->existingImages);
            
            // Mettre à jour le service si on est en mode édition
            if ($this->editingServiceId) {
                $service = Service::find($this->editingServiceId);
                if ($service) {
                    $service->images = $this->existingImages;
                    $service->save();
                    session()->flash('success', 'Image supprimée avec succès.');
                }
            }
        }
    }

    public function removeUploadedGalleryImage($index)
    {
        if (isset($this->galleryImages[$index])) {
            // Supprimer l'élément spécifique du tableau
            unset($this->galleryImages[$index]);
            
            // Réindexer le tableau pour qu'il n'y ait pas de trous
            $this->galleryImages = array_values($this->galleryImages);
        }
    }

    // Suppression de l'image principale
    public function removeMainImage()
    {
        if (isset($this->serviceData['image']) && !empty($this->serviceData['image'])) {
            // Supprimer l'image du stockage
            if (Storage::disk('public')->exists($this->serviceData['image'])) {
                Storage::disk('public')->delete($this->serviceData['image']);
            }
            
            // Supprimer la référence à l'image
            $this->serviceData['image'] = null;
            
            // Mettre à jour le service si on est en mode édition
            if ($this->editingServiceId) {
                $service = Service::find($this->editingServiceId);
                if ($service) {
                    $service->image = null;
                    $service->save();
                    session()->flash('success', 'Image principale supprimée avec succès.');
                }
            }
        }
        
        // Réinitialiser l'image principale temporaire
        $this->mainImage = null;
    }

    // Utiliser une image de la galerie comme image principale
    public function setAsMainImage($index)
    {
        if (isset($this->existingImages[$index])) {
            $imagePath = $this->existingImages[$index];
            
            // Si une image principale existe déjà, l'ajouter à la galerie
            if (isset($this->serviceData['image']) && !empty($this->serviceData['image'])) {
                $this->existingImages[] = $this->serviceData['image'];
            }
            
            // Mettre à jour l'image principale
            $this->serviceData['image'] = $imagePath;
            
            // Supprimer l'image de la galerie
            unset($this->existingImages[$index]);
            $this->existingImages = array_values($this->existingImages);
            
            // Mettre à jour le service si on est en mode édition
            if ($this->editingServiceId) {
                $service = Service::find($this->editingServiceId);
                if ($service) {
                    $service->image = $this->serviceData['image'];
                    $service->images = $this->existingImages;
                    $service->save();
                    session()->flash('success', 'Image principale mise à jour avec succès.');
                }
            }
        }
    }

    // Confirmation de suppression d'un service
    public function confirmDeleteService($id)
    {
        $service = Service::findOrFail($id);
        $category = ServiceCategory::findOrFail($service->category_id);

        if ($category->type !== $this->serviceType) {
            session()->flash('error', 'Ce service n\'est pas un service technique.');
            return;
        }

        $this->dispatch('confirm-service-deletion', ['id' => $id]);
    }

    // Suppression d'un service
    public function deleteService($id)
    {
        $service = Service::findOrFail($id);
        $category = ServiceCategory::findOrFail($service->category_id);

        if ($category->type !== $this->serviceType) {
            session()->flash('error', 'Ce service n\'est pas un service technique.');
            return;
        }

        try {
            // Supprimer l'image principale
            if ($service->image && Storage::exists($service->image)) {
                Storage::delete($service->image);
            }
            
            // Supprimer les images de la galerie
            if (is_array($service->images) && !empty($service->images)) {
                foreach ($service->images as $imagePath) {
                    if (Storage::exists($imagePath)) {
                        Storage::delete($imagePath);
                    }
                }
            }
            
            // Supprimer le service
            $service->delete();
            
            session()->flash('success', 'Service technique supprimé avec succès.');
            
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression du service: ' . $e->getMessage());
            session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    // Ajout d'un membre à l'équipe
    public function addTeamMember()
    {
        if (!isset($this->serviceData['team_members']['members'])) {
            $this->serviceData['team_members']['members'] = [];
        }
        
        $this->serviceData['team_members']['members'][] = [
            'name' => '',
            'position' => '',
            'photo' => '',
            'email' => ''
        ];
    }

    // Suppression d'un membre de l'équipe
    public function removeTeamMember($index)
    {
        if (isset($this->serviceData['team_members']['members'][$index])) {
            unset($this->serviceData['team_members']['members'][$index]);
            $this->serviceData['team_members']['members'] = array_values($this->serviceData['team_members']['members']);
        }

        if (isset($this->teamMemberPhotos[$index])) {
            unset($this->teamMemberPhotos[$index]);
        }
    }

    // Suppression de la photo du chef d'équipe
    public function removeTeamLeaderPhoto()
    {
        $this->serviceData['team_members']['leader']['photo'] = '';
        $this->teamLeaderPhoto = null;
    }

    // Suppression de la photo d'un membre de l'équipe
    public function removeTeamMemberPhoto($index)
    {
        if (isset($this->serviceData['team_members']['members'][$index])) {
            $this->serviceData['team_members']['members'][$index]['photo'] = '';
        }

        if (isset($this->teamMemberPhotos[$index])) {
            unset($this->teamMemberPhotos[$index]);
        }
    }
}