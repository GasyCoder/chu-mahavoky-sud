<?php

namespace App\Livewire;

use App\Models\Blog;
use Livewire\Component;

class HomePage extends Component
{
    /**
     * Récupération des dernières actualités publiées
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getLatestNews()
    {
        return Blog::published()
            ->take(3)
            ->orderBy('published_at', 'desc')
            ->get();
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