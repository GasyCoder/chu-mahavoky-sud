<?php

namespace App\Livewire\Pages;

use App\Models\Blog;
use Livewire\Component;

class NewsDetail extends Component
{
    public $slug;
    public $blog;

    // Hook de montage du composant
    public function mount($news)
    {
        $this->slug = $news;
        $this->loadBlog();
    }

    // Charger l'article demandé
    protected function loadBlog()
    {
        $this->blog = Blog::where('slug', $this->slug)
            ->where('status', Blog::STATUS_PUBLISHED)
            ->where('published_at', '<=', now())
            ->firstOrFail();
    }

    public function render()
    {
        // Récupérer des articles liés de la même catégorie
        $relatedNews = Blog::published()
            ->where('id', '!=', $this->blog->id)
            ->where('category', $this->blog->category)
            ->take(3)
            ->get();

        // Récupérer les articles récents (hors l'article actuel)
        $recentNews = Blog::published()
            ->where('id', '!=', $this->blog->id)
            ->take(4)
            ->get();

        return view('livewire.pages.news-detail', [
            'blog' => $this->blog,
            'relatedNews' => $relatedNews,
            'recentNews' => $recentNews
        ])->layout('layouts.front');
    }
}
