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

        if ($this->activeTab === 'medical' && $this->selectedCategoryId) {
            $medicalServicesQuery->where('category_id', $this->selectedCategoryId);
        }

        $medicalServices = $this->activeTab === 'medical'
            ? $medicalServicesQuery->orderBy('order')->paginate(9)
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

        if ($this->activeTab === 'admin' && $this->selectedCategoryId) {
            $adminServicesQuery->where('category_id', $this->selectedCategoryId);
        }

        $adminServices = $this->activeTab === 'admin'
            ? $adminServicesQuery->orderBy('order')->paginate(9)
            : new LengthAwarePaginator([], 0, 9); // Retourne un paginateur vide

        return view('livewire.pages.services', [
            'medicalCategories' => $medicalCategories,
            'medicalServices' => $medicalServices,
            'adminCategories' => $adminCategories,
            'adminServices' => $adminServices,
        ])->layout('layouts.front');
    }
}