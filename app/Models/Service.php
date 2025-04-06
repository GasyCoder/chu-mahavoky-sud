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

    protected $casts = [
        'images' => 'array',
        'team_members' => 'array',
        'equipments' => 'array',
        'featured' => 'boolean',
        'active' => 'boolean',
    ];

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
