<?php

namespace App\Livewire;

use App\Models\Blog;
use Livewire\Component;

class HomePage extends Component
{
    /**
     * Récupération UNIQUEMENT des actualités mises en avant (is_featured)
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getLatestNews()
    {
        return Blog::published()
            ->featured() // Utilise le scope featured() défini dans votre modèle Blog
            ->orderByDesc('published_at')
            ->get(); // Sans limite pour récupérer tous les articles mis en avant
    }
    
    /**
     * Render du composant
     */
    public function render()
    {
        $latestNews = $this->getLatestNews();
        
        return view('livewire.home-page', [
            'latestNews' => $latestNews,
        ])->layout('layouts.front');
    }
}