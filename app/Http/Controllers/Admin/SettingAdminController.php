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

            // Hero section
            'hero_background_url' => Setting::get('hero_background') ? asset('storage/' . Setting::get('hero_background')) : null,
            'hero_title' => Setting::get('hero_title', ''),
            'hero_subtitle' => Setting::get('hero_subtitle', ''),
            'presentation_video' => Setting::get('presentation_video', ''),

            // Services section
            'services_section_label' => Setting::get('services_section_label', 'Nos Spécialités'),
            'services_section_title' => Setting::get('services_section_title', 'Excellence en Soins de Santé'),
            'services_section_description' => Setting::get('services_section_description', ''),

            // Stats
            'stat_doctors' => Setting::get('stat_doctors', '47'),
            'stat_services' => Setting::get('stat_services', '12'),
            'stat_beds' => Setting::get('stat_beds', '150'),
            'stat_emergency' => Setting::get('stat_emergency', '24h/7j'),

            // Section visibility
            'show_stats_section' => filter_var(Setting::get('show_stats_section', true), FILTER_VALIDATE_BOOLEAN),
            'show_services_section' => filter_var(Setting::get('show_services_section', true), FILTER_VALIDATE_BOOLEAN),
            'show_about_section' => filter_var(Setting::get('show_about_section', true), FILTER_VALIDATE_BOOLEAN),
            'show_emergency_section' => filter_var(Setting::get('show_emergency_section', true), FILTER_VALIDATE_BOOLEAN),
            'show_experts_section' => filter_var(Setting::get('show_experts_section', false), FILTER_VALIDATE_BOOLEAN),
            'show_infrastructure_section' => filter_var(Setting::get('show_infrastructure_section', true), FILTER_VALIDATE_BOOLEAN),
            'show_news_section' => filter_var(Setting::get('show_news_section', true), FILTER_VALIDATE_BOOLEAN),
            'show_partners_section' => filter_var(Setting::get('show_partners_section', true), FILTER_VALIDATE_BOOLEAN),
        ];

        return Inertia::render('Admin/Settings', [
            'settings' => $settings
        ]);
    }

    public function updateHero(Request $request)
    {
        $validated = $request->validate([
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'presentation_video' => 'nullable|string|max:500',
            'hero_background' => 'nullable|image|max:5120',
            'stat_doctors' => 'nullable|string|max:20',
            'stat_services' => 'nullable|string|max:20',
            'stat_beds' => 'nullable|string|max:20',
            'stat_emergency' => 'nullable|string|max:20',
            'services_section_label' => 'nullable|string|max:100',
            'services_section_title' => 'nullable|string|max:255',
            'services_section_description' => 'nullable|string|max:500',
        ]);

        Setting::set('hero_title', $validated['hero_title'], 'hero');
        Setting::set('hero_subtitle', $validated['hero_subtitle'], 'hero');
        Setting::set('presentation_video', $validated['presentation_video'], 'hero');
        Setting::set('stat_doctors', $validated['stat_doctors'], 'hero');
        Setting::set('stat_services', $validated['stat_services'], 'hero');
        Setting::set('stat_beds', $validated['stat_beds'], 'hero');
        Setting::set('stat_emergency', $validated['stat_emergency'], 'hero');
        Setting::set('services_section_label', $validated['services_section_label'], 'hero');
        Setting::set('services_section_title', $validated['services_section_title'], 'hero');
        Setting::set('services_section_description', $validated['services_section_description'], 'hero');

        if ($request->hasFile('hero_background')) {
            $oldBg = Setting::get('hero_background');
            if ($oldBg && Storage::disk('public')->exists($oldBg)) {
                Storage::disk('public')->delete($oldBg);
            }
            Setting::set('hero_background', $request->file('hero_background')->store('settings', 'public'), 'hero');
        }

        return redirect()->back()->with('success', 'Section Hero mise à jour avec succès.');
    }

    public function updateSocial(Request $request)
    {
        $validated = $request->validate([
            'facebook_url' => 'nullable|string|max:500',
            'twitter_url' => 'nullable|string|max:500',
            'linkedin_url' => 'nullable|string|max:500',
            'youtube_url' => 'nullable|string|max:500',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value, 'social');
        }

        return redirect()->back()->with('success', 'Réseaux sociaux mis à jour avec succès.');
    }

    public function updateDisplay(Request $request)
    {
        $validated = $request->validate([
            'show_stats_section' => 'required|boolean',
            'show_services_section' => 'required|boolean',
            'show_about_section' => 'required|boolean',
            'show_emergency_section' => 'required|boolean',
            'show_experts_section' => 'required|boolean',
            'show_infrastructure_section' => 'required|boolean',
            'show_news_section' => 'required|boolean',
            'show_partners_section' => 'required|boolean',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value, 'display');
        }

        return redirect()->back()->with('success', 'Paramètres d\'affichage mis à jour avec succès.');
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
