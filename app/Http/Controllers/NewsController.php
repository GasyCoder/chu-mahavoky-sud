<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');

        // On récupère les actualités mises en avant
        $featuredNews = Blog::published()
            ->featured()
            ->take(3)
            ->get();

        // On construit la requête pour les actualités
        $newsQuery = Blog::published();

        // Filtrage par catégorie
        if ($category) {
            $newsQuery->where('category', $category);
        }

        // Filtrage par recherche
        if ($search) {
            $newsQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('excerpt', 'like', '%' . $search . '%')
                      ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        // On récupère les actualités paginées
        $news = $newsQuery->paginate(9)->withQueryString();

        // On récupère toutes les catégories distinctes existantes
        $categories = Blog::published()
            ->reorder()
            ->groupBy('category')
            ->pluck('category');

        return Inertia::render('News/Index', [
            'news' => $news,
            'featuredNews' => $featuredNews,
            'categories' => $categories,
            'filters' => $request->only(['search', 'category']),
        ]);
    }
}
