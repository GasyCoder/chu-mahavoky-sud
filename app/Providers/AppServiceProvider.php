<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Helpers\SettingHelper;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Partager les paramètres communs avec toutes les vues
        View::composer('*', function ($view) {
            $seoMeta = SettingHelper::getSeoMeta();
            $view->with('settings', [
                'site_name' => SettingHelper::get('site_name', 'CHU Mahavoky'),
                'site_description' => SettingHelper::get('site_description'),
                'logo' => SettingHelper::getImage('logo'),
                'favicon' => SettingHelper::getImage('favicon'),
                'contact' => SettingHelper::getContactInfo(),
                'social' => SettingHelper::getSocialLinks(),
                'hours' => SettingHelper::getOpeningHours(),
                'director' => SettingHelper::getDirectorInfo(),
                'seo' => [
                    'title' => $seoMeta['title'],
                    'description' => $seoMeta['description'],
                    'keywords' => $seoMeta['keywords'],
                ],
            ]);
        });

        // Partager spécifiquement les balises meta avec les layouts
        View::composer(['layouts.front', 'layouts.admin'], function ($view) {
            $view->with('metaTags', SettingHelper::generateMetaTags());
        });
    }
}
