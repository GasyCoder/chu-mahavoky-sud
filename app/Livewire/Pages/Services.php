<?php

namespace App\Livewire\Pages;

use App\Models\Service;
use App\Models\ServiceCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Services extends Component
{
    use WithPagination;

    public $activeTab = 'medical'; // 'medical' ou 'admin'
    public $selectedCategoryId = null;

    protected $queryString = [
        'activeTab' => ['except' => 'medical'],
        'selectedCategoryId' => ['except' => null]
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

    public function render()
    {
        // Récupération des catégories selon le type (médical ou administratif)
        $isMedical = $this->activeTab === 'medical';

        $categories = ServiceCategory::where('is_medical', $isMedical)
            ->where('active', true)
            ->orderBy('order')
            ->get();

        // Construction de la requête pour les services
        $servicesQuery = Service::query()
            ->with('category')
            ->whereHas('category', function($query) use ($isMedical) {
                $query->where('is_medical', $isMedical);
            })
            ->where('active', true);

        // Filtrage par catégorie si une est sélectionnée
        if ($this->selectedCategoryId) {
            $servicesQuery->where('category_id', $this->selectedCategoryId);
        }

        // Récupération des services avec pagination
        $services = $servicesQuery->orderBy('order')->paginate(9);

        return view('livewire.pages.services', [
            'categories' => $categories,
            'services' => $services
        ])->layout('layouts.front');
    }
}
