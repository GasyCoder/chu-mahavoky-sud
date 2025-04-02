<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Paramètres généraux
        Setting::set('site_name', 'CHU Mahavoky', 'general');
        Setting::set('site_description', 'Centre hospitalier universitaire', 'general');
        Setting::set('logo', 'logo.png', 'general');
        Setting::set('favicon', 'favicon.ico', 'general');

        // Paramètres de contact
        Setting::set('contact_phone', '+261 12 345 67', 'contact');
        Setting::set('contact_emergency', '+261 87 654 32', 'contact');
        Setting::set('contact_email', 'accueil@chu-mahavoky.mg', 'contact');
        Setting::set('contact_direction_email', 'direction@chu-mahavoky.mg', 'contact');
        Setting::set('contact_address', '123 Avenue de la Santé, Antananarivo', 'contact');

        // Horaires
        Setting::set('opening_hours', 'Lundi - Vendredi: 8h00 - 18h00', 'hours');
        Setting::set('weekend_hours', 'Samedi: 8h00 - 12h00, Dimanche: Fermé', 'hours');

        // Réseaux sociaux
        Setting::set('facebook_url', 'https://facebook.com/chu-mahavoky', 'social');
        Setting::set('twitter_url', 'https://twitter.com/chu-mahavoky', 'social');
        Setting::set('linkedin_url', 'https://linkedin.com/company/chu-mahavoky', 'social');
        Setting::set('youtube_url', '', 'social');

        // SEO
        Setting::set('meta_title', 'CHU Mahavoky | Centre Hospitalier Universitaire', 'seo');
        Setting::set('meta_description', 'Le Centre Hospitalier Universitaire de Mahavoky offre des services médicaux de qualité avec des équipements de pointe.', 'seo');
        Setting::set('meta_keywords', 'hôpital, médecine, santé, CHU, Mahavoky, soins, urgences', 'seo');

        // Mot du directeur
        Setting::set('director_name', 'Dr. Nouraly Habib', 'director');
        Setting::set('director_title', 'Directeur Général', 'director');
        Setting::set('director_message', "En tant que directeur du CHU Mahavoky Atsimo, je suis fier de diriger une équipe dévouée de professionnels de santé qui s'engagent à fournir des soins exceptionnels adaptés aux besoins de chaque patient. Notre mission est d'offrir une médecine d'excellence accessible à tous, combinant expertise médicale, technologies de pointe et approche humaine.", 'director');
        Setting::set('director_photo', 'director.jpg', 'director');
    }
}
