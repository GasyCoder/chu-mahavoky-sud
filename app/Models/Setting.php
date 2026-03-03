<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'group'];

    /**
     * Récupérer une valeur de paramètre par sa clé
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        // Tenter de récupérer du cache d'abord
        if (Cache::has('setting_' . $key)) {
            return Cache::get('setting_' . $key);
        }

        // Sinon, chercher en base de données
        $setting = self::where('key', $key)->first();

        // Si trouvé, mettre en cache et retourner la valeur
        if ($setting) {
            Cache::put('setting_' . $key, $setting->value, now()->addDay());
            return $setting->value;
        }

        // Retourner la valeur par défaut si non trouvé
        return $default;
    }

    /**
     * Mettre à jour ou créer un paramètre
     *
     * @param string $key
     * @param mixed $value
     * @param string $group
     * @return Setting
     */
    public static function set($key, $value, $group = 'general')
    {
        // Mettre à jour ou créer le paramètre
        $setting = self::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );

        // Mettre à jour le cache
        Cache::put('setting_' . $key, $value, now()->addDay());

        return $setting;
    }

    /**
     * Récupérer tous les paramètres d'un groupe spécifique
     *
     * @param string $group
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getGroup($group)
    {
        return self::where('group', $group)->get();
    }

    /**
     * Récupérer tous les paramètres comme un tableau associatif
     *
     * @param string|null $group
     * @return array
     */
    public static function getArray($group = null)
    {
        $query = self::query();

        if ($group) {
            $query->where('group', $group);
        }

        return $query->pluck('value', 'key')->toArray();
    }

    /**
     * Récupérer toutes les configurations structurées pour le frontend
     *
     * @return array
     */
    public static function allSettings()
    {
        $logo = self::get('logo');
        if ($logo && file_exists(storage_path('app/public/' . $logo))) {
            $logoUrl = asset('storage/' . $logo);
        } else {
            $logoUrl = asset('assets/logo.png');
        }

        $favicon = self::get('favicon');
        if ($favicon && file_exists(storage_path('app/public/' . $favicon))) {
            $faviconUrl = asset('storage/' . $favicon);
        } else {
            $faviconUrl = asset('assets/logo.png');
        }

        return [
            ...self::getArray('general'),
            'logo' => $logoUrl,
            'favicon' => $faviconUrl,
            ...self::getArray('header'),
            'contact' => [
                'phone' => self::get('contact_phone'),
                'emergency' => self::get('contact_emergency'),
                'email' => self::get('contact_email'),
                'direction_email' => self::get('contact_direction_email'),
                'address' => self::get('contact_address'),
            ],
            'hours' => [
                'weekdays' => self::get('opening_hours'),
                'weekend' => self::get('weekend_hours'),
            ],
            'social' => [
                'facebook' => self::get('facebook_url'),
                'twitter' => self::get('twitter_url'),
                'linkedin' => self::get('linkedin_url'),
                'youtube' => self::get('youtube_url'),
            ],
            'director' => [
                'name' => self::get('director_name'),
                'title' => self::get('director_title'),
                'message' => self::get('director_message'),
                'photo' => (function() {
                    $photo = self::get('director_photo');
                    if ($photo && file_exists(storage_path('app/public/' . $photo))) {
                        return asset('storage/' . $photo);
                    }
                    return asset('assets/about/directeur.png');
                })(),
            ],
            'seo' => [
                'title' => self::get('meta_title', self::get('site_name')),
                'description' => self::get('meta_description', self::get('site_description')),
                'keywords' => self::get('meta_keywords'),
            ],
        ];
    }

    /**
     * Vider le cache des paramètres
     */
    public static function clearCache()
    {
        $settings = self::all();

        foreach ($settings as $setting) {
            Cache::forget('setting_' . $setting->key);
        }
    }
}
