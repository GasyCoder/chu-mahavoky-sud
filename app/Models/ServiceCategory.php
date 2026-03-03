<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'slug',
        'icon',
        'description',
        'is_medical',
        'order',
        'active',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'category_id');
    }

    // Méthode pour vérifier si la catégorie est technique
    public function isTechnical()
    {
        return $this->type === 'technical';
    }

    // Méthode pour vérifier si la catégorie est administrative
    public function isAdministrative()
    {
        return $this->type === 'administrative';
    }
}
