<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class SettingAdminController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name' => Setting::get('site_name', 'CHU Mahavoky'),
            'site_description' => Setting::get('site_description', ''),
            'site_slogan' => Setting::get('site_slogan', ''),
            'logo_url' => Setting::get('logo') ? asset('storage/' . Setting::get('logo')) : null,
            'favicon_url' => Setting::get('favicon') ? asset('storage/' . Setting::get('favicon')) : null,
            
            'contact_phone' => Setting::get('contact_phone', ''),
            'contact_emergency' => Setting::get('contact_emergency', ''),
            'contact_email' => Setting::get('contact_email', ''),
            'contact_direction_email' => Setting::get('contact_direction_email', ''),
            'contact_address' => Setting::get('contact_address', ''),
            
            'opening_hours' => Setting::get('opening_hours', ''),
            'weekend_hours' => Setting::get('weekend_hours', ''),
            
            'facebook_url' => Setting::get('facebook_url', ''),
            'twitter_url' => Setting::get('twitter_url', ''),
            'linkedin_url' => Setting::get('linkedin_url', ''),
            'youtube_url' => Setting::get('youtube_url', ''),
            
            'director_name' => Setting::get('director_name', ''),
            'director_title' => Setting::get('director_title', ''),
            'director_message' => Setting::get('director_message', ''),
            'director_photo_url' => Setting::get('director_photo') ? asset('storage/' . Setting::get('director_photo')) : null,
        ];

        return Inertia::render('Admin/Settings', [
            'settings' => $settings
        ]);
    }

    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'site_slogan' => 'nullable|string|max:500',
            'logo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|max:1024',
        ]);

        Setting::set('site_name', $validated['site_name'], 'general');
        Setting::set('site_description', $validated['site_description'], 'general');
        Setting::set('site_slogan', $validated['site_slogan'], 'general');

        if ($request->hasFile('logo')) {
            $oldLogo = Setting::get('logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            Setting::set('logo', $request->file('logo')->store('settings', 'public'), 'general');
        }

        if ($request->hasFile('favicon')) {
            $oldFavicon = Setting::get('favicon');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }
            Setting::set('favicon', $request->file('favicon')->store('settings', 'public'), 'general');
        }

        return redirect()->back()->with('success', 'Paramètres généraux mis à jour avec succès.');
    }

    public function updateContact(Request $request)
    {
        $validated = $request->validate([
            'contact_phone' => 'nullable|string|max:50',
            'contact_emergency' => 'nullable|string|max:50',
            'contact_email' => 'nullable|email|max:255',
            'contact_direction_email' => 'nullable|email|max:255',
            'contact_address' => 'nullable|string|max:500',
            'opening_hours' => 'nullable|string|max:255',
            'weekend_hours' => 'nullable|string|max:255',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value, 'contact');
        }

        return redirect()->back()->with('success', 'Informations de contact mises à jour.');
    }

    public function updateDirector(Request $request)
    {
        $validated = $request->validate([
            'director_name' => 'nullable|string|max:100',
            'director_title' => 'nullable|string|max:100',
            'director_message' => 'nullable|string|max:2000',
            'director_photo' => 'nullable|image|max:2048',
        ]);

        Setting::set('director_name', $validated['director_name'], 'director');
        Setting::set('director_title', $validated['director_title'], 'director');
        Setting::set('director_message', $validated['director_message'], 'director');

        if ($request->hasFile('director_photo')) {
            $oldPhoto = Setting::get('director_photo');
            if ($oldPhoto && Storage::disk('public')->exists($oldPhoto)) {
                Storage::disk('public')->delete($oldPhoto);
            }
            Setting::set('director_photo', $request->file('director_photo')->store('settings', 'public'), 'director');
        }

        return redirect()->back()->with('success', 'Informations de la direction mises à jour.');
    }
}
