<?php

namespace App\Livewire\Pages;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class News extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $perPage = 9;

    // Réinitialiser la pagination quand on change les filtres
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    // Appliquer un filtre de catégorie
    public function filterByCategory($category)
    {
        $this->category = $category;
    }

    // Effacer tous les filtres
    public function clearFilters()
    {
        $this->search = '';
        $this->category = '';
        $this->resetPage();
    }

    public function render()
    {
        $query = Blog::published();

        if ($this->search) {
            $query->search($this->search);
        }

        if ($this->category) {
            $query->where('category', $this->category);
        }

        $news = $query->paginate($this->perPage);

        // Récupérer les actualités en vedette pour le slider du haut
        $featuredNews = Blog::published()->featured()->take(3)->get();

        // Récupérer les catégories pour les filtres - utiliser une requête brute pour éviter les problèmes
        $categories = DB::table('blogs')
            ->select('category')
            ->where('status', Blog::STATUS_PUBLISHED)
            ->where('published_at', '<=', now())
            ->groupBy('category')
            ->pluck('category');

        return view('livewire.pages.news', [
            'news' => $news,
            'featuredNews' => $featuredNews,
            'categories' => $categories
        ])->layout('layouts.front');
    }
}
