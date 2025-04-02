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

class MedicalServicesAdmin extends ServicesAdmin
{
    // Propriété publique pour stocker les IDs des catégories médicales
    public $medicalCategoryIds = [];
    
    // Type de service pour les validations et les filtres
    public $serviceType = 'medical';
    
    // Filtrage pour afficher uniquement les services médicaux
    public function mount()
    {
        // Obtenir uniquement les catégories médicales pour le formulaire
        $this->categories = ServiceCategory::where('is_medical', true)->get();
        
        // Si vide, on récupère toutes les catégories (cas de fallback)
        if ($this->categories->isEmpty()) {
            $this->categories = ServiceCategory::all();
        }
        
        // Par défaut, pas de filtre spécifique de catégorie
        $this->categoryFilter = '';
        
        // Enregistrer les IDs des catégories médicales pour le marquage visuel
        $this->medicalCategoryIds = $this->categories->pluck('id')->toArray();
        
        Log::info('MedicalServicesAdmin component mounted with ' . count($this->categories) . ' medical categories');
    }
    
    public function render()
    {
        // Construire la requête avec les filtres
        $query = Service::query();
        
        // Joindre la table des catégories et filtrer par catégories médicales
        $query->join('service_categories', 'services.category_id', '=', 'service_categories.id')
              ->where('service_categories.is_medical', true)
              ->select('services.*');
        
        // Appliquer la recherche
        if (!empty($this->searchTerm)) {
            $query->where(function($q) {
                $q->where('services.name', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('services.short_description', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('services.full_description', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('services.phone', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('services.email', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('services.location', 'like', '%' . $this->searchTerm . '%');
            });
        }
        
        // Appliquer le filtre de catégorie spécifique (si sélectionné)
        if (!empty($this->categoryFilter)) {
            $query->where('services.category_id', $this->categoryFilter);
        }
        
        // Appliquer le filtre de statut
        if ($this->statusFilter !== null) {
            $query->where('services.active', $this->statusFilter);
        }
        
        // Tri
        if ($this->sortField === 'category_id') {
            $query->orderBy('service_categories.name', $this->sortDirection);
        } else {
            // Ajout du préfixe de table pour éviter les ambiguïtés
            $query->orderBy('services.' . $this->sortField, $this->sortDirection);
        }
        
        // Paginer les résultats
        $services = $query->with('category')->paginate(10);
        
        // Déterminer quel template utiliser - si medical-services-admin existe, l'utiliser, sinon utiliser services-admin
        $view = view()->exists('livewire.admin.medical-services-admin') 
            ? 'livewire.admin.medical-services-admin' 
            : 'livewire.admin.services-admin';
            
        return view($view, [
            'services' => $services,
            'categories' => $this->categories,
            'pageTitle' => 'Gestion des Services Médicaux',
            'serviceType' => $this->serviceType
        ]);
    }
    
    // Surcharger la méthode createNewService pour n'utiliser que des catégories médicales
    public function createNewService()
    {
        $this->resetForm();
        
        // Sélectionner par défaut la première catégorie médicale si elle existe
        $firstMedicalCategory = ServiceCategory::where('is_medical', true)->first();
        if ($firstMedicalCategory) {
            $this->serviceData['category_id'] = $firstMedicalCategory->id;
        }
        
        $this->showEditModal = true;
    }
    
    // Surcharger updateService pour s'assurer que le service utilise une catégorie médicale
    public function updateService()
    {
        // Validation standard
        $this->validate();
        
        try {
            // Vérifier que la catégorie sélectionnée est bien médicale
            $category = ServiceCategory::findOrFail($this->serviceData['category_id']);
            if (!$category->is_medical) {
                session()->flash('error', 'Veuillez choisir une catégorie médicale.');
                return;
            }
            
            // Appeler la méthode parent pour l'enregistrement
            parent::updateService();
            
        } catch (\Exception $e) {
            Log::error('Error in MedicalServicesAdmin updateService: ' . $e->getMessage());
            session()->flash('error', 'Erreur lors de la mise à jour du service médical: ' . $e->getMessage());
        }
    }
}