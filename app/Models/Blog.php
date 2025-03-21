<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'image',
        'published_at',
        'category',
        'is_featured',
        'status'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    // Les statuts possibles pour un article
    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';

    // Les catégories possibles pour un article
    const CATEGORY_EVENT = 'Événement';
    const CATEGORY_SERVICE = 'Service';
    const CATEGORY_EQUIPMENT = 'Équipement';
    const CATEGORY_NEWS = 'Actualité';

    // Boot method pour initialiser certaines fonctionnalités
    protected static function boot()
    {
        parent::boot();

        // Génération automatique d'un slug à partir du titre
        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }

            // Si l'extrait est vide, on prend les premiers 150 caractères du contenu
            if (empty($blog->excerpt)) {
                $blog->excerpt = Str::limit(strip_tags($blog->content), 150);
            }

            // Si published_at n'est pas défini et que le statut est publié, on met la date actuelle
            if (empty($blog->published_at) && $blog->status === self::STATUS_PUBLISHED) {
                $blog->published_at = now();
            }
        });
    }

    // Scope pour les articles publiés
    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED)
                     ->where('published_at', '<=', now())
                     ->orderBy('published_at', 'desc');
    }

    // Scope pour les articles mis en avant
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope pour rechercher des articles
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($query) use ($term) {
            $query->where('title', 'like', "%{$term}%")
                  ->orWhere('content', 'like', "%{$term}%")
                  ->orWhere('excerpt', 'like', "%{$term}%")
                  ->orWhere('category', 'like', "%{$term}%");
        });
    }

    // Scope pour filtrer par catégorie
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Retourne la liste de toutes les catégories possibles
    public static function categories()
    {
        return [
            self::CATEGORY_EVENT,
            self::CATEGORY_SERVICE,
            self::CATEGORY_EQUIPMENT,
            self::CATEGORY_NEWS,
        ];
    }

    // Retourne la liste de tous les statuts possibles
    public static function statuses()
    {
        return [
            self::STATUS_DRAFT => 'Brouillon',
            self::STATUS_PUBLISHED => 'Publié',
        ];
    }

    // Retourne l'URL formatée de l'image
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        return asset('assets/news/default.jpg');
    }

    // Retourne la date de publication formatée
    public function getFormattedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('d F Y') : null;
    }

    // Retourne une couleur CSS en fonction de la catégorie
    public function getCategoryColorAttribute()
    {
        return match($this->category) {
            self::CATEGORY_EVENT => 'purple',
            self::CATEGORY_SERVICE => 'turquoise',
            self::CATEGORY_EQUIPMENT => 'from-purple to-turquoise',
            default => 'primary'
        };
    }

    // Retourne une icône en fonction de la catégorie
    public function getCategoryIconAttribute()
    {
        return match($this->category) {
            self::CATEGORY_EVENT => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />',
            self::CATEGORY_SERVICE => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />',
            self::CATEGORY_EQUIPMENT => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />',
            default => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />'
        };
    }
}
