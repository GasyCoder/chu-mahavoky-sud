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
