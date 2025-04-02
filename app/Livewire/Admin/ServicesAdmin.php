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

class ServicesAdmin extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    // État d'affichage - Modal
    public $showEditModal = false;
    
    // L'ID du service en cours d'édition
    public $serviceId = null;
    
    // Variables pour la recherche et les filtres
    public $searchTerm = '';
    public $categoryFilter = '';
    public $statusFilter = null;
    
    // Propriétés pour le tri
    public $sortField = 'name'; // Tri par défaut sur le nom
    public $sortDirection = 'asc'; // Direction par défaut
    
    // Variables temporaires pour les photos uploadées
    public $teamLeaderPhotoTemp;
    public $teamMemberPhotoTemp = [];
    
    // Les données du formulaire
    public $serviceData = [
        'category_id' => '',
        'name' => '',
        'slug' => '',
        'icon' => '',
        'image' => '',
        'short_description' => '',
        'full_description' => '',
        'phone' => '',
        'email' => '',
        'location' => '',
        'working_hours' => '',
        'team_name' => '',
        'team_leader' => [
            'name' => '',
            'position' => '',
            'photo' => '',
            'email' => ''
        ],
        'team_members' => [],
        'order' => 0,
        'featured' => false,
        'active' => true
    ];
    
    // Les catégories pour le select
    public $categories = [];
    
    // Propriétés pour le rafraîchissement des données
    protected $queryString = ['searchTerm' => ['except' => ''], 'categoryFilter' => ['except' => ''], 'statusFilter' => ['except' => null], 'sortField' => ['except' => 'name'], 'sortDirection' => ['except' => 'asc']];
    
    // Écouteurs d'événements
    protected $listeners = ['refreshServices' => '$refresh'];
    
    // Règles de validation
    protected $rules = [
        'serviceData.category_id' => 'required|exists:service_categories,id',
        'serviceData.name' => 'required|string|max:255',
        'serviceData.slug' => 'required|string|max:255',
        'serviceData.icon' => 'nullable|string|max:255',
        'serviceData.image' => 'nullable|string|max:255',
        'serviceData.short_description' => 'required|string|max:500',
        'serviceData.full_description' => 'nullable|string',
        'serviceData.phone' => 'nullable|string|max:20',
        'serviceData.email' => 'nullable|email|max:255',
        'serviceData.location' => 'nullable|string|max:255',
        'serviceData.working_hours' => 'nullable|string|max:255',
        'serviceData.team_name' => 'nullable|string|max:255',
        'serviceData.team_leader' => 'nullable|array',
        'serviceData.team_members' => 'nullable|array',
        'serviceData.order' => 'nullable|integer|min:0',
        'serviceData.featured' => 'boolean',
        'serviceData.active' => 'boolean',
        
        // Règles pour les photos
        'teamLeaderPhotoTemp' => 'nullable|image|max:1024', // Max 1MB
        'teamMemberPhotoTemp.*' => 'nullable|image|max:1024' // Max 1MB pour chaque photo
    ];
    
    // Réinitialiser la pagination lors de la recherche
    public function updatedSearchTerm()
    {
        $this->resetPage();
    }
    
    // Réinitialiser la pagination lors des filtres
    public function updatedCategoryFilter()
    {
        $this->resetPage();
    }
    
    public function updatedStatusFilter()
    {
        $this->resetPage();
    }
    
    // Gérer le tri des colonnes
    public function sortBy($field)
    {
        // Si on clique sur le même champ, on inverse la direction du tri
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // Sinon, on trie sur le nouveau champ en ordre ascendant
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        
        // Réinitialiser la pagination
        $this->resetPage();
    }
    
    // Réinitialiser les filtres et le tri
    public function resetFilters()
    {
        $this->searchTerm = '';
        $this->categoryFilter = '';
        $this->statusFilter = null;
        $this->sortField = 'name';
        $this->sortDirection = 'asc';
        $this->resetPage();
    }
    
    // Réinitialiser la recherche
    public function resetSearch()
    {
        $this->searchTerm = '';
        $this->resetPage();
    }
    
    public function mount()
    {
        $this->categories = ServiceCategory::all();
        Log::info('ServicesAdmin component mounted with ' . count($this->categories) . ' categories');
    }
    
    public function updatedServiceDataName()
    {
        if (!empty($this->serviceData['name'])) {
            $this->serviceData['slug'] = Str::slug($this->serviceData['name']);
        }
    }
    
    // Créer un nouveau service
    public function createNewService()
    {
        $this->resetForm();
        $this->showEditModal = true;
    }
    
    // Méthode pour gérer l'upload de photo du responsable
    public function updatedTeamLeaderPhotoTemp()
    {
        $this->validate([
            'teamLeaderPhotoTemp' => 'image|max:1024', // Max 1MB
        ]);
    }
    
    // Méthode pour gérer l'upload de photo des membres
    public function updatedTeamMemberPhotoTemp()
    {
        $this->validate([
            'teamMemberPhotoTemp.*' => 'image|max:1024', // Max 1MB
        ]);
    }
    
    // Méthode pour supprimer la photo du responsable
    public function removeTeamLeaderPhoto()
    {
        $this->teamLeaderPhotoTemp = null;
        $this->serviceData['team_leader']['photo'] = '';
    }
    
    // Méthode pour supprimer la photo d'un membre
    public function removeTeamMemberPhoto($index)
    {
        if (isset($this->teamMemberPhotoTemp[$index])) {
            unset($this->teamMemberPhotoTemp[$index]);
        }
        
        if (isset($this->serviceData['team_members'][$index])) {
            $this->serviceData['team_members'][$index]['photo'] = '';
        }
    }
    
    public function openEditModal($id)
    {
        Log::info('Opening edit modal for service ID: ' . $id);
        
        try {
            $service = Service::findOrFail($id);
            Log::info('Service found: ' . $service->name);
            
            $this->serviceId = $service->id;
            
            // Réinitialiser les variables temporaires pour les photos
            $this->teamLeaderPhotoTemp = null;
            $this->teamMemberPhotoTemp = [];
            
            // Préparer les données par défaut pour éviter les erreurs
            $team = $service->team_members ?? [];
            $teamLeader = $team['leader'] ?? [
                'name' => '',
                'position' => '',
                'photo' => '',
                'email' => ''
            ];
            $teamMembers = $team['members'] ?? [];
            $teamName = $team['name'] ?? '';
            
            // Remplir les données du formulaire
            $this->serviceData = [
                'category_id' => $service->category_id,
                'name' => $service->name,
                'slug' => $service->slug,
                'icon' => $service->icon,
                'image' => $service->image,
                'short_description' => $service->short_description,
                'full_description' => $service->full_description,
                'phone' => $service->phone,
                'email' => $service->email,
                'location' => $service->location,
                'working_hours' => $service->working_hours,
                'team_name' => $teamName,
                'team_leader' => $teamLeader,
                'team_members' => $teamMembers,
                'order' => $service->order,
                'featured' => $service->featured,
                'active' => $service->active
            ];
            
            // Afficher le modal
            $this->showEditModal = true;
            
            Log::info('Edit modal opened for service: ' . $service->name);
        } catch (\Exception $e) {
            Log::error('Error opening edit modal: ' . $e->getMessage());
            session()->flash('error', 'Erreur lors du chargement du service. Veuillez réessayer.');
        }
    }
    
    public function closeModal()
    {
        $this->showEditModal = false;
        $this->resetForm();
    }
    
    public function addTeamMember()
    {
        $this->serviceData['team_members'][] = [
            'name' => '',
            'position' => '',
            'photo' => ''
        ];
    }
    
    public function removeTeamMember($index)
    {
        // S'assurer que l'index existe
        if (isset($this->serviceData['team_members'][$index])) {
            // Supprimer le membre à l'index spécifié
            unset($this->serviceData['team_members'][$index]);
            // Réindexer le tableau pour éviter les trous
            $this->serviceData['team_members'] = array_values($this->serviceData['team_members']);
        }
        
        // Supprimer également la photo temporaire si elle existe
        if (isset($this->teamMemberPhotoTemp[$index])) {
            unset($this->teamMemberPhotoTemp[$index]);
        }
    }
    
    public function updateService()
    {
        Log::info('Updating service ID: ' . $this->serviceId);
        
        // Validation spéciale pour le slug (unique sauf pour le service actuel)
        $this->rules['serviceData.slug'] = 'required|string|max:255|unique:services,slug,' . $this->serviceId;
        
        // Valider les données
        $this->validate();
        
        try {
            $service = $this->serviceId ? Service::findOrFail($this->serviceId) : new Service();
            
            // Traiter les photos uploadées
            // Photo du responsable
            if ($this->teamLeaderPhotoTemp) {
                // Stocker la photo et obtenir le chemin
                $photoPath = $this->teamLeaderPhotoTemp->store('team-photos', 'public');
                // Mettre à jour le chemin dans les données du service
                $this->serviceData['team_leader']['photo'] = Storage::url($photoPath);
            }
            
            // Photos des membres de l'équipe
            foreach ($this->teamMemberPhotoTemp as $index => $photo) {
                if ($photo && isset($this->serviceData['team_members'][$index])) {
                    $photoPath = $photo->store('team-photos', 'public');
                    $this->serviceData['team_members'][$index]['photo'] = Storage::url($photoPath);
                }
            }
            
            // Préparer les données de l'équipe
            $teamData = [
                'name' => $this->serviceData['team_name'],
                'leader' => $this->serviceData['team_leader'],
                'members' => $this->serviceData['team_members']
            ];
            
            // Mettre à jour ou créer le service
            $data = [
                'category_id' => $this->serviceData['category_id'],
                'name' => $this->serviceData['name'],
                'slug' => $this->serviceData['slug'],
                'icon' => $this->serviceData['icon'],
                'image' => $this->serviceData['image'],
                'short_description' => $this->serviceData['short_description'],
                'full_description' => $this->serviceData['full_description'],
                'phone' => $this->serviceData['phone'],
                'email' => $this->serviceData['email'],
                'location' => $this->serviceData['location'],
                'working_hours' => $this->serviceData['working_hours'],
                'team_members' => $teamData,
                'order' => $this->serviceData['order'],
                'featured' => $this->serviceData['featured'],
                'active' => $this->serviceData['active']
            ];
            
            if ($this->serviceId) {
                $service->update($data);
                $message = 'Service mis à jour avec succès!';
            } else {
                $service = Service::create($data);
                $message = 'Service créé avec succès!';
            }
            
            // Fermer le modal et réinitialiser le formulaire
            $this->closeModal();
            
            // Afficher un message de succès
            session()->flash('message', $message);
            
            Log::info($message . ': ' . $service->name);
        } catch (\Exception $e) {
            Log::error('Error updating service: ' . $e->getMessage());
            session()->flash('error', 'Erreur lors de la mise à jour du service. Veuillez réessayer.');
        }
    }
    
    public function deleteService($id)
    {
        try {
            $service = Service::findOrFail($id);
            $serviceName = $service->name;
            
            // Ici, vous pourriez également supprimer les photos associées au service
            // Mais cela dépend de votre logique métier et de votre politique de gestion des ressources
            
            $service->delete();
            
            session()->flash('message', "Le service '{$serviceName}' a été supprimé avec succès!");
            Log::info('Service deleted: ' . $serviceName);
        } catch (\Exception $e) {
            Log::error('Error deleting service: ' . $e->getMessage());
            session()->flash('error', 'Erreur lors de la suppression du service. Veuillez réessayer.');
        }
    }
    
    private function resetForm()
    {
        $this->serviceId = null;
        $this->teamLeaderPhotoTemp = null;
        $this->teamMemberPhotoTemp = [];
        $this->serviceData = [
            'category_id' => '',
            'name' => '',
            'slug' => '',
            'icon' => '',
            'image' => '',
            'short_description' => '',
            'full_description' => '',
            'phone' => '',
            'email' => '',
            'location' => '',
            'working_hours' => '',
            'team_name' => '',
            'team_leader' => [
                'name' => '',
                'position' => '',
                'photo' => '',
                'email' => ''
            ],
            'team_members' => [],
            'order' => 0,
            'featured' => false,
            'active' => true
        ];
    }
    
    public function render()
    {
        // Construire la requête avec les filtres
        $query = Service::query();
        
        // Appliquer la recherche
        if (!empty($this->searchTerm)) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('short_description', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('full_description', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('location', 'like', '%' . $this->searchTerm . '%');
            });
        }
        
        // Appliquer le filtre de catégorie
        if (!empty($this->categoryFilter)) {
            $query->where('category_id', $this->categoryFilter);
        }
        
        // Appliquer le filtre de statut
        if ($this->statusFilter !== null) {
            $query->where('active', $this->statusFilter);
        }
        
        // Cas spécial pour le tri par catégorie (car c'est une relation)
        if ($this->sortField === 'category_id') {
            $query->join('service_categories', 'services.category_id', '=', 'service_categories.id')
                  ->select('services.*')
                  ->orderBy('service_categories.name', $this->sortDirection);
        } else {
            // Tri standard
            $query->orderBy($this->sortField, $this->sortDirection);
        }
        
        // Joindre la catégorie et paginer les résultats
        $services = $query->with('category')->paginate(10);
        
        return view('livewire.admin.services-admin', [
            'services' => $services,
            'categories' => $this->categories
        ]);
    }
}