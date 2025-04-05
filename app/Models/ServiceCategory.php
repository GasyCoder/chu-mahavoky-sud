<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
    ];

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
