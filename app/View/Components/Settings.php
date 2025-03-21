<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Helpers\SettingHelper;

class Settings extends Component
{
    public $settings;

    public function __construct()
    {
        $this->settings = [
            'site_name' => SettingHelper::get('site_name', 'CHU Mahavoky'),
            'site_description' => SettingHelper::get('site_description', ''),
            'logo' => SettingHelper::getImage('logo'),
            'favicon' => SettingHelper::getImage('favicon'),
            'contact' => [
                'phone' => SettingHelper::get('contact_phone', ''),
                'emergency' => SettingHelper::get('contact_emergency', ''),
                'email' => SettingHelper::get('contact_email', ''),
                'direction_email' => SettingHelper::get('contact_direction_email', ''),
                'address' => SettingHelper::get('contact_address', ''),
            ],
            'social' => [
                'facebook' => SettingHelper::get('facebook_url', ''),
                'twitter' => SettingHelper::get('twitter_url', ''),
                'linkedin' => SettingHelper::get('linkedin_url', ''),
                'youtube' => SettingHelper::get('youtube_url', ''),
            ],
            'hours' => [
                'weekdays' => SettingHelper::get('opening_hours', ''),
                'weekend' => SettingHelper::get('weekend_hours', ''),
            ],
        ];
    }

    public function render()
    {
        return function (array $data) {
            return $data;
        };
    }
}
