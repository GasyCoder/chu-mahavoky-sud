<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'icon',
        'image',
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
        'team_members' => 'array',
        'equipments' => 'array',
        'featured' => 'boolean',
        'active' => 'boolean',
    ];

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
}
