<?php

use App\Helpers\SettingHelper;

if (!function_exists('settings')) {
    /**
     * Obtenir les paramètres du site
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    function settings($key = null, $default = null)
    {
        $settings = [
            'site_name' => SettingHelper::get('site_name', 'CHU Mahavoky'),
            'site_description' => SettingHelper::get('site_description', 'Centre hospitalier universitaire'),
            'logo' => SettingHelper::getImage('logo'),
            'favicon' => SettingHelper::getImage('favicon'),
            'contact' => SettingHelper::getContactInfo(),
            'social' => SettingHelper::getSocialLinks(),
            'hours' => SettingHelper::getOpeningHours(),
        ];

        if (is_null($key)) {
            return $settings;
        }

        return $settings[$key] ?? $default;
    }
}
