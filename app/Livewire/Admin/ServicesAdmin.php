<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use App\Models\ServiceCategory;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ServicesAdmin extends Component
{
    use WithPagination, WithFileUploads;

    // Propriétés de base
    public $serviceType = 'administrative';
    public $pageTitle = 'Gestion des Services Administratifs';

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

    // Initialisation du composant
    public function mount()
    {
        $this->categories = ServiceCategory::where('type', $this->serviceType)->get();
    }

    // Rendu du composant
    public function render()
    {
        $services = $this->getFilteredServices();

        return view('livewire.admin.services-admin', [
            'services' => $services,
            'categories' => $this->categories,
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
            session()->flash('error', 'Ce service ne correspond pas au type sélectionné.');
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
            // On ne fait que stocker le chemin, pas besoin de l'objet ici
            $this->serviceData['image'] = $service->image;
        }

        // Charger les images de la galerie
        $this->existingImages = $service->images ?? [];

        $this->showEditModal = true;
        $this->dispatch('modal-opened');
    }

    // Fermeture du modal
    public function closeModal()
    {
        $this->showEditModal = false;
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
    }

    // Sauvegarde du service
    public function saveService()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            // Récupérer ou créer le service
            if ($this->editingServiceId) {
                $service = Service::findOrFail($this->editingServiceId);
            } else {
                $service = new Service();
                $service->slug = Str::slug($this->serviceData['name']);
            }

            // Traiter les données de base
            $service->fill($this->serviceData);

            // Traiter l'image principale
            if ($this->mainImage) {
                // Supprimer l'ancienne image si elle existe
                if ($service->image && Storage::disk('public')->exists($service->image)) {
                    Storage::disk('public')->delete($service->image);
                }

                // Stocker la nouvelle image
                $service->image = $this->mainImage->store('services', 'public');
            }

            // Traiter les photos d'équipe
            $this->processTeamPhotos($service);

            // Traiter les images de la galerie
            $this->processGalleryImages($service);

            // Sauvegarder le service
            $service->save();

            DB::commit();

            // Notification de succès
            session()->flash('success', 'Service sauvegardé avec succès!');
            $this->showEditModal = false;
            $this->resetForm();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la sauvegarde du service: ' . $e->getMessage(), [
                'exception' => $e,
                'service_data' => $this->serviceData
            ]);
            session()->flash('error', 'Erreur lors de la sauvegarde: ' . $e->getMessage());
        }
    }

    // Traitement des photos d'équipe
    protected function processTeamPhotos(&$service)
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

        // Mettre à jour les données du service
        $service->team_members = $this->serviceData['team_members'];
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
            // Supprimer la photo du membre si elle existe
            $photoPath = $this->serviceData['team_members']['members'][$index]['photo'] ?? null;
            if ($photoPath && !Str::startsWith($photoPath, 'http')) {
                $path = str_replace('/storage/', '', $photoPath);
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }

            // Supprimer le membre
            unset($this->serviceData['team_members']['members'][$index]);
            $this->serviceData['team_members']['members'] = array_values($this->serviceData['team_members']['members']);
        }

        // Supprimer la photo temporaire si elle existe
        if (isset($this->teamMemberPhotos[$index])) {
            unset($this->teamMemberPhotos[$index]);
        }
    }

    // Suppression de la photo du chef d'équipe
    public function removeTeamLeaderPhoto()
    {
        // Supprimer la photo du stockage si elle existe
        $photoPath = $this->serviceData['team_members']['leader']['photo'] ?? null;
        if ($photoPath && !Str::startsWith($photoPath, 'http')) {
            $path = str_replace('/storage/', '', $photoPath);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        // Réinitialiser la photo
        $this->serviceData['team_members']['leader']['photo'] = '';
        $this->teamLeaderPhoto = null;
    }

    // Confirmation de suppression d'un service
    public function confirmDeleteService($id)
    {
        $service = Service::findOrFail($id);
        $category = ServiceCategory::findOrFail($service->category_id);

        if ($category->type !== $this->serviceType) {
            session()->flash('error', 'Ce service ne correspond pas au type sélectionné.');
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
            session()->flash('error', 'Ce service ne correspond pas au type sélectionné.');
            return;
        }

        try {
            DB::beginTransaction();

            // Suppression de l'image principale
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }

            // Suppression des images de la galerie
            if (is_array($service->images) && !empty($service->images)) {
                foreach ($service->images as $imagePath) {
                    if (Storage::disk('public')->exists($imagePath)) {
                        Storage::disk('public')->delete($imagePath);
                    }
                }
            }

            // Suppression du service
            $service->delete();

            DB::commit();

            session()->flash('success', 'Service supprimé avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la suppression du service: ' . $e->getMessage());
            session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }
}
