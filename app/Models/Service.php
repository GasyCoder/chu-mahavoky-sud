<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'icon',
        'image',
        'images',
        'short_description',
        'full_description',
        'phone',
        'email',
        'location',
        'working_hours',
        'team_members',
        'equipments',
        'order',
        'featured',
        'active'
    ];

    protected $appends = ['image_url', 'formatted_team_members'];

    // URL de l'image principale
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('assets/herobg.jpg');
    }

    // Formater les membres de l'équipe avec les URLs complètes
    public function getFormattedTeamMembersAttribute()
    {
        $team = $this->team_members;
        
        if (!$team) return null;

        // Formater le leader
        if (isset($team['leader']) && isset($team['leader']['photo'])) {
            // On vérifie si c'est déjà une URL ou juste un nom de fichier
            if (!filter_var($team['leader']['photo'], FILTER_VALIDATE_URL)) {
                $team['leader']['photo_url'] = asset('storage/' . $team['leader']['photo']);
            } else {
                $team['leader']['photo_url'] = $team['leader']['photo'];
            }
        }

        // Formater les membres
        if (isset($team['members']) && is_array($team['members'])) {
            foreach ($team['members'] as $key => $member) {
                if (isset($member['photo'])) {
                    if (!filter_var($member['photo'], FILTER_VALIDATE_URL)) {
                        $team['members'][$key]['photo_url'] = asset('storage/' . $member['photo']);
                    } else {
                        $team['members'][$key]['photo_url'] = $member['photo'];
                    }
                }
            }
        }

        return $team;
    }

    // S'assurer que les images sont toujours un tableau, même si null
    public function getImagesAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

        /**
     * Obtenir la description complète purifiée et prête à être affichée
     *
     * @return HtmlString
     */
    public function getPurifiedDescriptionAttribute()
    {
        // Si vous avez installé HTMLPurifier
        if (function_exists('clean')) {
            return new HtmlString(clean($this->full_description));
        }
        
        // Sinon, retourner le HTML brut (moins sûr)
        return new HtmlString($this->full_description);
    }
}
