<?php

namespace App\Livewire\Pages;

use App\Models\Service;
use App\Models\ServiceCategory;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class Services extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'tailwind';

    public $activeTab = 'medical'; // 'medical' ou 'admin'
    public $selectedCategoryId = null;
    public $searchQuery = '';
    
    // Ajouter searchQuery aux paramètres d'URL
    protected $queryString = [
        'activeTab' => ['except' => 'medical'],
        'selectedCategoryId' => ['except' => null],
        'searchQuery' => ['except' => '']
    ];

    public function mount()
    {
        // Par défaut, on montre les services médicaux
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->selectedCategoryId = null;
        $this->resetPage();
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategoryId = $categoryId;
        $this->resetPage();
    }
    
    // Réinitialiser la page lorsque la recherche change
    public function updatedSearchQuery()
    {
        $this->resetPage();
    }
    
    // Réinitialiser la recherche
    public function resetSearch()
    {
        $this->searchQuery = '';
        $this->resetPage();
    }
    
    // Méthode pour effacer le filtre de catégorie
    public function clearCategoryFilter()
    {
        $this->selectedCategoryId = null;
        $this->resetPage();
    }

    public function render()
    {
        // Données pour les services médicaux
        $medicalCategories = ServiceCategory::where('is_medical', true)
            ->where('active', true)
            ->orderBy('order')
            ->get();

        $medicalServicesQuery = Service::query()
            ->with('category')
            ->whereHas('category', function($query) {
                $query->where('is_medical', true);
            })
            ->where('active', true);

        // Appliquer le filtre de catégorie si sélectionné
        if ($this->activeTab === 'medical' && $this->selectedCategoryId) {
            $medicalServicesQuery->where('category_id', $this->selectedCategoryId);
        }
        
        // Appliquer la recherche si une requête est présente
        if ($this->activeTab === 'medical' && !empty($this->searchQuery)) {
            $search = '%' . $this->searchQuery . '%';
            $medicalServicesQuery->where(function($query) use ($search) {
                $query->where('name', 'like', $search)
                      ->orWhere('short_description', 'like', $search)
                      ->orWhere('full_description', 'like', $search)
                      ->orWhereHas('category', function($q) use ($search) {
                          $q->where('name', 'like', $search);
                      });
            });
        }

        $medicalServices = $this->activeTab === 'medical'
            ? $medicalServicesQuery->orderBy('featured', 'desc')->orderBy('order')->paginate(9)
            : new LengthAwarePaginator([], 0, 9); // Retourne un paginateur vide

        // Données pour les services administratifs
        $adminCategories = ServiceCategory::where('is_medical', false)
            ->where('active', true)
            ->orderBy('order')
            ->get();

        $adminServicesQuery = Service::query()
            ->with('category')
            ->whereHas('category', function($query) {
                $query->where('is_medical', false);
            })
            ->where('active', true);

        // Appliquer le filtre de catégorie si sélectionné
        if ($this->activeTab === 'admin' && $this->selectedCategoryId) {
            $adminServicesQuery->where('category_id', $this->selectedCategoryId);
        }
        
        // Appliquer la recherche si une requête est présente
        if ($this->activeTab === 'admin' && !empty($this->searchQuery)) {
            $search = '%' . $this->searchQuery . '%';
            $adminServicesQuery->where(function($query) use ($search) {
                $query->where('name', 'like', $search)
                      ->orWhere('short_description', 'like', $search)
                      ->orWhere('full_description', 'like', $search)
                      ->orWhereHas('category', function($q) use ($search) {
                          $q->where('name', 'like', $search);
                      });
            });
        }

        $adminServices = $this->activeTab === 'admin'
            ? $adminServicesQuery->orderBy('featured', 'desc')->orderBy('order')->paginate(9)
            : new LengthAwarePaginator([], 0, 9); // Retourne un paginateur vide
            
        // Compter le nombre total de résultats pour afficher dans l'interface
        $totalResults = $this->activeTab === 'medical' 
            ? $medicalServices->total() 
            : $adminServices->total();

        return view('livewire.pages.services', [
            'medicalCategories' => $medicalCategories,
            'medicalServices' => $medicalServices,
            'adminCategories' => $adminCategories,
            'adminServices' => $adminServices,
            'totalResults' => $totalResults
        ])->layout('layouts.front');
    }
}