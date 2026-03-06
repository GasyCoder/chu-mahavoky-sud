<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo', 'link', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getLogoUrlAttribute()
    {
        return asset('storage/' . $this->logo);
    }
}
