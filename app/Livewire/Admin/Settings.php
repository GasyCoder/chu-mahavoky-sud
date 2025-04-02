<?php

namespace App\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Settings extends Component
{
    use WithFileUploads;

    // Paramètres généraux
    public $site_name;
    public $site_description;
    public $logo;
    public $temp_logo;
    public $favicon;
    public $temp_favicon;

    // Paramètres de contact
    public $contact_phone;
    public $contact_emergency;
    public $contact_email;
    public $contact_direction_email;
    public $contact_address;

    // Horaires
    public $opening_hours;
    public $weekend_hours;

    // Réseaux sociaux
    public $facebook_url;
    public $twitter_url;
    public $linkedin_url;
    public $youtube_url;

    // SEO
    public $meta_title;
    public $meta_description;
    public $meta_keywords;

    // Mot du directeur
    public $director_name;
    public $director_title;
    public $director_message;
    public $director_photo;
    public $temp_director_photo;

    // UI
    public $activeTab = 'general';

    public function mount()
    {
        // Charger tous les paramètres
        $this->loadSettings();
    }

    protected function loadSettings()
    {
        // Paramètres généraux
        $this->site_name = Setting::get('site_name', 'CHU Mahavoky');
        $this->site_description = Setting::get('site_description', 'Centre hospitalier universitaire');
        $this->logo = Setting::get('logo');
        $this->favicon = Setting::get('favicon');

        // Paramètres de contact
        $this->contact_phone = Setting::get('contact_phone');
        $this->contact_emergency = Setting::get('contact_emergency');
        $this->contact_email = Setting::get('contact_email');
        $this->contact_direction_email = Setting::get('contact_direction_email');
        $this->contact_address = Setting::get('contact_address');

        // Horaires
        $this->opening_hours = Setting::get('opening_hours');
        $this->weekend_hours = Setting::get('weekend_hours');

        // Réseaux sociaux
        $this->facebook_url = Setting::get('facebook_url');
        $this->twitter_url = Setting::get('twitter_url');
        $this->linkedin_url = Setting::get('linkedin_url');
        $this->youtube_url = Setting::get('youtube_url');

        // SEO
        $this->meta_title = Setting::get('meta_title');
        $this->meta_description = Setting::get('meta_description');
        $this->meta_keywords = Setting::get('meta_keywords');

        // Mot du directeur
        $this->director_name = Setting::get('director_name');
        $this->director_title = Setting::get('director_title');
        $this->director_message = Setting::get('director_message');
        $this->director_photo = Setting::get('director_photo');
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function saveGeneralSettings()
    {
        $this->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'temp_logo' => 'nullable|image|max:1024',
            'temp_favicon' => 'nullable|image|max:1024',
        ]);

        // Enregistrer les paramètres textuels
        Setting::set('site_name', $this->site_name, 'general');
        Setting::set('site_description', $this->site_description, 'general');

        // Gérer le téléchargement du logo
        if ($this->temp_logo) {
            // Supprimer l'ancien logo si nécessaire
            if ($this->logo && Storage::disk('public')->exists($this->logo)) {
                Storage::disk('public')->delete($this->logo);
            }

            // Enregistrer le nouveau logo
            $logoPath = $this->temp_logo->store('settings', 'public');
            Setting::set('logo', $logoPath, 'general');
            $this->logo = $logoPath;
            $this->temp_logo = null;
        }

        // Gérer le téléchargement du favicon
        if ($this->temp_favicon) {
            // Supprimer l'ancien favicon si nécessaire
            if ($this->favicon && Storage::disk('public')->exists($this->favicon)) {
                Storage::disk('public')->delete($this->favicon);
            }

            // Enregistrer le nouveau favicon
            $faviconPath = $this->temp_favicon->store('settings', 'public');
            Setting::set('favicon', $faviconPath, 'general');
            $this->favicon = $faviconPath;
            $this->temp_favicon = null;
        }

        session()->flash('message', 'Paramètres généraux mis à jour avec succès.');
    }

    public function saveContactSettings()
    {
        $this->validate([
            'contact_phone' => 'nullable|string|max:20',
            'contact_emergency' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'contact_direction_email' => 'nullable|email|max:255',
            'contact_address' => 'nullable|string|max:500',
        ]);

        Setting::set('contact_phone', $this->contact_phone, 'contact');
        Setting::set('contact_emergency', $this->contact_emergency, 'contact');
        Setting::set('contact_email', $this->contact_email, 'contact');
        Setting::set('contact_direction_email', $this->contact_direction_email, 'contact');
        Setting::set('contact_address', $this->contact_address, 'contact');

        session()->flash('message', 'Paramètres de contact mis à jour avec succès.');
    }

    public function saveHoursSettings()
    {
        $this->validate([
            'opening_hours' => 'nullable|string|max:255',
            'weekend_hours' => 'nullable|string|max:255',
        ]);

        Setting::set('opening_hours', $this->opening_hours, 'hours');
        Setting::set('weekend_hours', $this->weekend_hours, 'hours');

        session()->flash('message', 'Horaires mis à jour avec succès.');
    }

    public function saveSocialSettings()
    {
        $this->validate([
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
        ]);

        Setting::set('facebook_url', $this->facebook_url, 'social');
        Setting::set('twitter_url', $this->twitter_url, 'social');
        Setting::set('linkedin_url', $this->linkedin_url, 'social');
        Setting::set('youtube_url', $this->youtube_url, 'social');

        session()->flash('message', 'Paramètres des réseaux sociaux mis à jour avec succès.');
    }

    public function saveSeoSettings()
    {
        $this->validate([
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        Setting::set('meta_title', $this->meta_title, 'seo');
        Setting::set('meta_description', $this->meta_description, 'seo');
        Setting::set('meta_keywords', $this->meta_keywords, 'seo');

        session()->flash('message', 'Paramètres SEO mis à jour avec succès.');
    }

    public function saveDirectorSettings()
    {
        $this->validate([
            'director_name' => 'nullable|string|max:100',
            'director_title' => 'nullable|string|max:100',
            'director_message' => 'nullable|string|max:2000',
            'temp_director_photo' => 'nullable|image|max:1024',
        ]);

        Setting::set('director_name', $this->director_name, 'director');
        Setting::set('director_title', $this->director_title, 'director');
        Setting::set('director_message', $this->director_message, 'director');

        // Gérer le téléchargement de la photo du directeur
        if ($this->temp_director_photo) {
            // Supprimer l'ancienne photo si nécessaire
            if ($this->director_photo && Storage::disk('public')->exists($this->director_photo)) {
                Storage::disk('public')->delete($this->director_photo);
            }

            // Enregistrer la nouvelle photo
            $photoPath = $this->temp_director_photo->store('settings', 'public');
            Setting::set('director_photo', $photoPath, 'director');
            $this->director_photo = $photoPath;
            $this->temp_director_photo = null;
        }

        session()->flash('message', 'Mot du directeur mis à jour avec succès.');
    }

    // Nettoyer le cache des paramètres
    public function clearSettingsCache()
    {
        Setting::clearCache();
        session()->flash('message', 'Cache des paramètres nettoyé avec succès.');
    }

    public function render()
    {
        return view('livewire.admin.settings');
    }
}
