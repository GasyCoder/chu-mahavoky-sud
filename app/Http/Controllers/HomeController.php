<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Service;
use App\Models\Setting;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function __invoke()
    {
        $settings = Setting::allSettings();

        $latestNews = Blog::published()
            ->featured()
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        // Récupération des vrais chefs de service (Responsables)
        $services = Service::whereNotNull('team_members')->get();
        $doctors = [];

        foreach ($services as $service) {
            $team = $service->team_members;
            
            if (is_array($team)) {
                foreach ($team as $member) {
                    // On cherche le responsable réel (Ancien code : isLead ou role 'Chef de service')
                    $isLead = (isset($member['isLead']) && $member['isLead'] === true) || 
                              (isset($member['role']) && stripos($member['role'], 'chef') !== false);
                    
                    if ($isLead) {
                        // Gestion de la photo réelle (Ancien code : storage/photos/...)
                        $photoPath = $member['photo'] ?? $member['avatar'] ?? null;
                        $imageUrl = asset('assets/herobg.jpg'); // Fallback

                        if ($photoPath) {
                            // On vérifie les dossiers storage/photos ou storage/team-photos
                            $imageUrl = asset('storage/' . $photoPath);
                        }

                        $doctors[] = [
                            'id' => $service->id,
                            'name' => $member['name'],
                            'specialty' => $member['role'] ?? $service->name,
                            'image_url' => $imageUrl,
                        ];
                    }
                }
            }
        }

        // On ne garde que les 4 premiers pour le design slim de l'accueil
        $doctors = array_slice($doctors, 0, 4);

        return Inertia::render('Home', [
            'settings' => $settings,
            'latestNews' => $latestNews,
            'totalServices' => Service::count(),
            'doctors' => $doctors,
        ]);
    }
}
