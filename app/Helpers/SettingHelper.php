<?php

namespace App\Helpers;

use App\Models\Setting;

class SettingHelper
{
    /**
     * Récupère un paramètre depuis la base de données
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        return Setting::get($key, $default);
    }

    /**
     * Récupère tous les paramètres d'un groupe
     *
     * @param string $group
     * @return array
     */
    public static function getGroup($group)
    {
        return Setting::getArray($group);
    }

    /**
     * Vérifie si un paramètre existe
     *
     * @param string $key
     * @return bool
     */
    public static function has($key)
    {
        return Setting::where('key', $key)->exists();
    }

    /**
     * Récupère le chemin complet d'une image stockée dans les paramètres
     *
     * @param string $key
     * @param string $default
     * @return string
     */
    public static function getImage($key, $default = null)
    {
        $path = self::get($key, $default);

        if (empty($path)) {
            return $default;
        }

        return asset('storage/' . $path);
    }

    /**
     * Récupère les informations de contact
     *
     * @return array
     */
    public static function getContactInfo()
    {
        return [
            'phone' => self::get('contact_phone'),
            'emergency' => self::get('contact_emergency'),
            'email' => self::get('contact_email'),
            'direction_email' => self::get('contact_direction_email'),
            'address' => self::get('contact_address'),
        ];
    }

    /**
     * Récupère les horaires d'ouverture
     *
     * @return array
     */
    public static function getOpeningHours()
    {
        return [
            'weekdays' => self::get('opening_hours'),
            'weekend' => self::get('weekend_hours'),
        ];
    }

    /**
     * Récupère les liens des réseaux sociaux
     *
     * @return array
     */
    public static function getSocialLinks()
    {
        return [
            'facebook' => self::get('facebook_url'),
            'twitter' => self::get('twitter_url'),
            'linkedin' => self::get('linkedin_url'),
            'youtube' => self::get('youtube_url'),
        ];
    }

    /**
     * Récupère les informations sur le mot du directeur
     *
     * @return array
     */
    public static function getDirectorInfo()
    {
        return [
            'name' => self::get('director_name'),
            'title' => self::get('director_title'),
            'message' => self::get('director_message'),
            'photo' => self::getImage('director_photo'),
        ];
    }

    /**
     * Récupère les méta-données SEO
     *
     * @return array
     */
    public static function getSeoMeta()
    {
        return [
            'title' => self::get('meta_title', self::get('site_name')),
            'description' => self::get('meta_description', self::get('site_description')),
            'keywords' => self::get('meta_keywords'),
        ];
    }

    /**
     * Génère les balises meta HTML pour SEO
     *
     * @param string $customTitle
     * @return string
     */
    public static function generateMetaTags($customTitle = null)
    {
        $seo = self::getSeoMeta();
        $title = $customTitle ? $customTitle . ' | ' . $seo['title'] : $seo['title'];

        $html = '<title>' . e($title) . '</title>' . PHP_EOL;
        $html .= '<meta name="description" content="' . e($seo['description']) . '">' . PHP_EOL;

        if (!empty($seo['keywords'])) {
            $html .= '<meta name="keywords" content="' . e($seo['keywords']) . '">' . PHP_EOL;
        }

        return $html;
    }
}
