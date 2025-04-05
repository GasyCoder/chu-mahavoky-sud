<?php

namespace App\Livewire\Pages;

use App\Models\Service;
use App\Models\ServiceCategory;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class ServicesIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $activeTab = 'technical'; // 'technical' ou 'administrative'
    public $selectedCategoryId = null;
    public $searchQuery = '';

    // Ajouter searchQuery aux paramètres d'URL
    protected $queryString = [
        'activeTab' => ['except' => 'technical'],
        'selectedCategoryId' => ['except' => null],
        'searchQuery' => ['except' => '']
    ];

    public function mount()
    {
        // Par défaut, on montre les services techniques
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
        // Données pour les services techniques
        $technicalCategories = ServiceCategory::where('type', 'technical')
            ->orderBy('id')
            ->get();

        $technicalServicesQuery = Service::query()
            ->with('category')
            ->whereHas('category', function ($query) {
                $query->where('type', 'technical');
            })
            ->where('active', true);

        // Appliquer le filtre de catégorie si sélectionné
        if ($this->activeTab === 'technical' && $this->selectedCategoryId) {
            $technicalServicesQuery->where('category_id', $this->selectedCategoryId);
        }

        // Appliquer la recherche si une requête est présente
        if ($this->activeTab === 'technical' && !empty($this->searchQuery)) {
            $search = '%' . $this->searchQuery . '%';
            $technicalServicesQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', $search)
                    ->orWhere('short_description', 'like', $search)
                    ->orWhere('full_description', 'like', $search)
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', $search);
                    });
            });
        }

        $technicalServices = $this->activeTab === 'technical'
            ? $technicalServicesQuery->orderBy('featured', 'desc')->orderBy('order')->paginate(9)
            : new LengthAwarePaginator([], 0, 9); // Retourne un paginateur vide

        // Données pour les services administratifs
        $adminCategories = ServiceCategory::where('type', 'administrative')
            ->orderBy('id')
            ->get();

        $adminServicesQuery = Service::query()
            ->with('category')
            ->whereHas('category', function ($query) {
                $query->where('type', 'administrative');
            })
            ->where('active', true);

        // Appliquer le filtre de catégorie si sélectionné
        if ($this->activeTab === 'administrative' && $this->selectedCategoryId) {
            $adminServicesQuery->where('category_id', $this->selectedCategoryId);
        }

        // Appliquer la recherche si une requête est présente
        if ($this->activeTab === 'administrative' && !empty($this->searchQuery)) {
            $search = '%' . $this->searchQuery . '%';
            $adminServicesQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', $search)
                    ->orWhere('short_description', 'like', $search)
                    ->orWhere('full_description', 'like', $search)
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', $search);
                    });
            });
        }

        $adminServices = $this->activeTab === 'administrative'
            ? $adminServicesQuery->orderBy('featured', 'desc')->orderBy('order')->paginate(9)
            : new LengthAwarePaginator([], 0, 9); // Retourne un paginateur vide

        // Compter le nombre total de résultats pour afficher dans l'interface
        $totalResults = $this->activeTab === 'technical'
            ? $technicalServices->total()
            : $adminServices->total();

        return view('livewire.pages.services-index', [
            'technicalCategories' => $technicalCategories,
            'technicalServices' => $technicalServices,
            'adminCategories' => $adminCategories,
            'adminServices' => $adminServices,
            'totalResults' => $totalResults
        ])->layout('layouts.front');
    }
}
