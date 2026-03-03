<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Inertia\Inertia;

class ServiceDetailController extends Controller
{
    public function show($slug)
    {
        $service = Service::with('category')
            ->where('slug', $slug)
            ->where('active', true)
            ->firstOrFail();

        $relatedServices = Service::where('category_id', $service->category_id)
            ->where('id', '!=', $service->id)
            ->where('active', true)
            ->orderBy('order')
            ->limit(3)
            ->get()
            ->map(fn($s) => [
                'id' => $s->id,
                'name' => $s->name,
                'slug' => $s->slug,
                'short_description' => $s->short_description,
                'icon' => $s->icon,
            ]);

        return Inertia::render('Services/Show', [
            'service' => [
                'id' => $service->id,
                'name' => $service->name,
                'slug' => $service->slug,
                'icon' => $service->icon,
                'image' => $service->image,
                'image_url' => $service->image ? asset('storage/' . $service->image) : null,
                'images' => $service->images ?? [],
                'images_urls' => array_map(fn($img) => asset('storage/' . $img), $service->images ?? []),
                'short_description' => $service->short_description,
                'full_description' => $service->full_description,
                'phone' => $service->phone,
                'email' => $service->email,
                'location' => $service->location,
                'working_hours' => $service->working_hours,
                'team_members' => $service->formatted_team_members,
                'equipments' => $service->equipments,
                'category' => [
                    'name' => $service->category->name,
                    'icon' => $service->category->icon,
                ],
            ],
            'relatedServices' => $relatedServices,
        ]);
    }
}
