<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Catégories de services médicaux
        $medicalCategories = [
            [
                'name' => 'Urgence',
                'icon' => 'fas fa-ambulance',
                'description' => 'Services d\'urgence disponibles 24h/24 et 7j/7',
                'is_medical' => true,
                'order' => 1,
                'active' => true
            ],
            [
                'name' => 'Imagerie',
                'icon' => 'fas fa-x-ray',
                'description' => 'Services d\'imagerie médicale pour le diagnostic',
                'is_medical' => true,
                'order' => 2,
                'active' => true
            ],
            [
                'name' => 'Laboratoire',
                'icon' => 'fas fa-flask',
                'description' => 'Analyses biologiques et examens de laboratoire',
                'is_medical' => true,
                'order' => 3,
                'active' => true
            ],
            [
                'name' => 'Chirurgie',
                'icon' => 'fas fa-procedures',
                'description' => 'Services chirurgicaux généraux et spécialisés',
                'is_medical' => true,
                'order' => 4,
                'active' => true
            ],
            [
                'name' => 'Stomatologie',
                'icon' => 'fas fa-tooth',
                'description' => 'Soins dentaires et chirurgie maxillo-faciale',
                'is_medical' => true,
                'order' => 5,
                'active' => true
            ],
            [
                'name' => 'Médecine Interne',
                'icon' => 'fas fa-stethoscope',
                'description' => 'Diagnostic et traitement des maladies internes',
                'is_medical' => true,
                'order' => 6,
                'active' => true
            ],
            [
                'name' => 'Maladie Infectieuses',
                'icon' => 'fas fa-virus',
                'description' => 'Diagnostic et traitement des maladies infectieuses',
                'is_medical' => true,
                'order' => 7,
                'active' => true
            ],
            [
                'name' => 'Hépato Gastro Enterologie',
                'icon' => 'fas fa-diagnoses',
                'description' => 'Soins pour les maladies du foie, de l\'estomac et de l\'intestin',
                'is_medical' => true,
                'order' => 8,
                'active' => true
            ],
            [
                'name' => 'Dermatologie',
                'icon' => 'fas fa-allergies',
                'description' => 'Diagnostic et traitement des affections de la peau',
                'is_medical' => true,
                'order' => 9,
                'active' => true
            ],
            [
                'name' => 'Cardiologie',
                'icon' => 'fas fa-heartbeat',
                'description' => 'Services spécialisés dans le diagnostic et le traitement des maladies cardiaques',
                'is_medical' => true,
                'order' => 10,
                'active' => true
            ],
            [
                'name' => 'Pharmacie',
                'icon' => 'fas fa-pills',
                'description' => 'Dispense et gestion des médicaments',
                'is_medical' => true,
                'order' => 11,
                'active' => true
            ],
            [
                'name' => 'Centre de Réception, Régulation des Appels',
                'icon' => 'fas fa-phone-volume',
                'description' => 'Gestion des appels d\'urgence et coordination des soins',
                'is_medical' => true,
                'order' => 12,
                'active' => true
            ],
            [
                'name' => 'Allergologie',
                'icon' => 'fas fa-lungs',
                'description' => 'Diagnostic et traitement des allergies',
                'is_medical' => true,
                'order' => 13,
                'active' => true
            ],
            [
                'name' => 'Endoscopie',
                'icon' => 'fas fa-microscope',
                'description' => 'Procédures endoscopiques pour le diagnostic et le traitement',
                'is_medical' => true,
                'order' => 14,
                'active' => true
            ],
            [
                'name' => 'Gériatrie',
                'icon' => 'fas fa-user-md',
                'description' => 'Soins médicaux spécialisés pour les personnes âgées',
                'is_medical' => true,
                'order' => 15,
                'active' => true
            ]
        ];

        // Catégories de services administratifs
        $administrativeCategories = [
            [
                'name' => 'Service Personnel',
                'icon' => 'fas fa-users',
                'description' => 'Gestion du personnel hospitalier',
                'is_medical' => false,
                'order' => 1,
                'active' => true
            ],
            [
                'name' => 'Finance',
                'icon' => 'fas fa-money-bill-wave',
                'description' => 'Gestion financière et comptabilité de l\'hôpital',
                'is_medical' => false,
                'order' => 2,
                'active' => true
            ],
            [
                'name' => 'Affaires Juridiques',
                'icon' => 'fas fa-balance-scale',
                'description' => 'Gestion des aspects juridiques et réglementaires',
                'is_medical' => false,
                'order' => 3,
                'active' => true
            ],
            [
                'name' => 'Statistiques',
                'icon' => 'fas fa-chart-bar',
                'description' => 'Collecte et analyse des données hospitalières',
                'is_medical' => false,
                'order' => 4,
                'active' => true
            ],
            [
                'name' => 'Hygiène et Soins',
                'icon' => 'fas fa-broom',
                'description' => 'Maintien de l\'hygiène et des normes sanitaires',
                'is_medical' => false,
                'order' => 5,
                'active' => true
            ],
            [
                'name' => 'Direction',
                'icon' => 'fas fa-user-tie',
                'description' => 'Administration et direction de l\'hôpital',
                'is_medical' => false,
                'order' => 6,
                'active' => true
            ]
        ];

        // Au lieu de truncate, supprimer les catégories existantes une par une
        // pour respecter les contraintes de clé étrangère
        ServiceCategory::where('id', '>', 0)->delete();

        // Insérer toutes les catégories
        foreach (array_merge($medicalCategories, $administrativeCategories) as $category) {
            // Ajouter automatiquement le slug
            if (!isset($category['slug'])) {
                $category['slug'] = Str::slug($category['name']);
            }

            ServiceCategory::create($category);
        }
    }
}
