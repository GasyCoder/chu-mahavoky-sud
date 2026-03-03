<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServicesController extends Controller
{
    public function index(Request $request)
    {
        // On récupère les paramètres de filtrage
        $activeTab = $request->input('activeTab', 'technical');
        $selectedCategoryId = $request->input('selectedCategoryId');
        $searchQuery = $request->input('searchQuery');

        // On construit la requête pour les services
        $servicesQuery = Service::query()
            ->with('category')
            ->whereHas('category', function ($query) use ($activeTab) {
                $query->where('type', $activeTab);
            });

        // Filtrage par catégorie
        if ($selectedCategoryId) {
            $servicesQuery->where('category_id', $selectedCategoryId);
        }

        // Filtrage par recherche
        if ($searchQuery) {
            $servicesQuery->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%')
                      ->orWhere('short_description', 'like', '%' . $searchQuery . '%');
            });
        }

        // On récupère les services paginés (9 par page pour notre grille de 3)
        $services = $servicesQuery->orderBy('name')->paginate(9)->withQueryString();

        // On récupère toutes les catégories pour les filtres
        $technicalCategories = ServiceCategory::where('type', 'technical')
            ->orderBy('name')
            ->get();

        $adminCategories = ServiceCategory::where('type', 'administrative')
            ->orderBy('name')
            ->get();

        return Inertia::render('Services/Index', [
            'services' => $services,
            'technicalCategories' => $technicalCategories,
            'adminCategories' => $adminCategories,
            'filters' => $request->only(['searchQuery', 'selectedCategoryId', 'activeTab']),
        ]);
    }
}
