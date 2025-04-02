<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer toutes les catégories
        $categories = ServiceCategory::all();

        // Supprimer les services existants sans utiliser truncate
        Service::where('id', '>', 0)->delete();

        // Pour chaque catégorie, créer des services
        foreach ($categories as $category) {
            // Créer 1 à 3 services par catégorie selon qu'elle est médicale ou administrative
            $numberOfServices = $category->is_medical ? rand(2, 3) : 1;

            for ($i = 1; $i <= $numberOfServices; $i++) {
                $this->createServiceForCategory($category, $i);
            }
        }
    }

    /**
     * Créer un service pour une catégorie donnée
     */
    private function createServiceForCategory($category, $order)
    {
        $isMainService = ($order === 1);
        $serviceName = $isMainService ? 'Service de ' . $category->name : $this->getSecondaryServiceName($category->name, $order);

        // Generate base slug
        $baseSlug = Str::slug($serviceName);
        $slug = $baseSlug;
        $counter = 1;

        // Ensure slug is unique by appending counter if needed
        while (Service::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $service = [
            'category_id' => $category->id,
            'name' => $serviceName,
            'slug' => $slug, // Use the unique slug
            'icon' => $this->getServiceIcon($category->name, $order),
            'short_description' => $this->getShortDescription($category->name, $order),
            'full_description' => $this->getFullDescription($category->name, $order),
            'phone' => '+261 34 ' . rand(10, 99) . ' ' . rand(100, 999) . ' ' . rand(100, 999),
            'email' => Str::slug($serviceName, '.') . '@chu-mahavoky.org',
            'location' => $this->getLocation($category->name, $order),
            'working_hours' => $this->getWorkingHours($category->is_medical, $isMainService),
            'team_members' => $this->getTeamMembers($category->name, $isMainService),
            'equipments' => $this->getEquipments($category->name, $order),
            'order' => $order,
            'featured' => $isMainService,
            'active' => true
        ];

        Service::create($service);
    }

    /**
     * Obtenir un nom pour un service secondaire
     */
    private function getSecondaryServiceName($categoryName, $order)
    {
        $secondaryNames = [
            'Urgence' => ['SAMU', 'Traumatologie d\'urgence'],
            'Imagerie' => ['Radiologie', 'Échographie', 'IRM'],
            'Laboratoire' => ['Analyses biologiques', 'Anatomopathologie'],
            'Chirurgie' => ['Chirurgie générale', 'Chirurgie orthopédique', 'Chirurgie digestive'],
            'Cardiologie' => ['Cardiologie interventionnelle', 'Soins intensifs cardiaques'],
            'Médecine Interne' => ['Consultations spécialisées', 'Hôpital de jour'],
            'Stomatologie' => ['Chirurgie dentaire', 'Prothèses dentaires'],
            'Maladie Infectieuses' => ['Consultations spécialisées', 'Unité d\'isolement'],
            'Hépato Gastro Enterologie' => ['Consultations spécialisées', 'Endoscopie digestive'],
            'Dermatologie' => ['Consultations dermatologiques', 'Photothérapie'],
            'Pharmacie' => ['Dispensation aux patients', 'Pharmacie clinique'],
            'Centre de Réception, Régulation des Appels' => ['Régulation médicale', 'Coordination des urgences'],
            'Allergologie' => ['Consultations allergologiques', 'Tests allergologiques'],
            'Endoscopie' => ['Endoscopie digestive', 'Endoscopie bronchique'],
            'Gériatrie' => ['Consultations gériatriques', 'Soins palliatifs']
        ];

        // Si des noms secondaires sont définis pour cette catégorie, les utiliser
        if (isset($secondaryNames[$categoryName]) && isset($secondaryNames[$categoryName][$order-2])) {
            return $secondaryNames[$categoryName][$order-2];
        }

        // Sinon, utiliser un nom générique
        return $categoryName . ' spécialisée ' . $order;
    }

    /**
     * Obtenir une icône pour un service
     */
    private function getServiceIcon($categoryName, $order)
    {
        $icons = [
            'Urgence' => ['fas fa-ambulance', 'fas fa-truck-medical', 'fas fa-first-aid'],
            'Imagerie' => ['fas fa-x-ray', 'fas fa-wave-square', 'fas fa-radiation'],
            'Laboratoire' => ['fas fa-flask', 'fas fa-microscope', 'fas fa-vial'],
            'Chirurgie' => ['fas fa-procedures', 'fas fa-cut', 'fas fa-user-md'],
            'Cardiologie' => ['fas fa-heartbeat', 'fas fa-heart', 'fas fa-stethoscope'],
            'Médecine Interne' => ['fas fa-stethoscope', 'fas fa-user-md', 'fas fa-clipboard-list'],
            'Stomatologie' => ['fas fa-tooth', 'fas fa-teeth', 'fas fa-teeth-open'],
            'Maladie Infectieuses' => ['fas fa-virus', 'fas fa-viruses', 'fas fa-shield-virus'],
            'Hépato Gastro Enterologie' => ['fas fa-diagnoses', 'fas fa-stethoscope', 'fas fa-tablets'],
            'Dermatologie' => ['fas fa-allergies', 'fas fa-hand-sparkles', 'fas fa-shower'],
            'Pharmacie' => ['fas fa-pills', 'fas fa-prescription-bottle-alt', 'fas fa-capsules'],
            'Centre de Réception, Régulation des Appels' => ['fas fa-phone-volume', 'fas fa-headset', 'fas fa-comments'],
            'Allergologie' => ['fas fa-lungs', 'fas fa-allergies', 'fas fa-wind'],
            'Endoscopie' => ['fas fa-microscope', 'fas fa-search', 'fas fa-camera'],
            'Gériatrie' => ['fas fa-user-md', 'fas fa-wheelchair', 'fas fa-walking']
        ];

        if (isset($icons[$categoryName]) && isset($icons[$categoryName][$order-1])) {
            return $icons[$categoryName][$order-1];
        }

        // Icône par défaut si la catégorie n'a pas d'icônes spécifiques définies
        return 'fas fa-hospital';
    }

    /**
     * Obtenir une description courte pour un service
     */
    private function getShortDescription($categoryName, $order)
    {
        $isMainService = ($order === 1);

        if ($isMainService) {
            return 'Service principal de ' . $categoryName . ' offrant des soins spécialisés et complets.';
        } else {
            return 'Service spécialisé en ' . $categoryName . ' proposant des soins adaptés et personnalisés.';
        }
    }

    /**
     * Obtenir une description complète pour un service
     */
    private function getFullDescription($categoryName, $order)
    {
        $isMainService = ($order === 1);

        if ($isMainService) {
            return '<p>Le service de ' . $categoryName . ' du CHU Mahavoky Atsimo offre des soins complets et spécialisés adaptés aux besoins de chaque patient. Notre équipe de professionnels hautement qualifiés utilise des équipements modernes pour garantir des diagnostics précis et des traitements efficaces.</p><p>Nous mettons l\'accent sur une approche personnalisée et humaine pour chaque patient, en combinant expertise médicale et accompagnement bienveillant tout au long du parcours de soins.</p>';
        } else {
            return '<p>Ce service spécialisé en ' . $categoryName . ' propose des soins ciblés pour des pathologies spécifiques. Notre équipe d\'experts utilise des techniques avancées et des équipements de pointe pour offrir les meilleurs soins possibles.</p><p>Grâce à notre approche multidisciplinaire, nous assurons une prise en charge globale qui répond aux besoins complexes de nos patients.</p>';
        }
    }

    /**
     * Obtenir une localisation pour un service
     */
    private function getLocation($categoryName, $order)
    {
        $buildings = ['A', 'B', 'C', 'D', 'E', 'F'];
        $floors = ['Rez-de-chaussée', '1er étage', '2ème étage', '3ème étage'];
        $wings = ['', ', Aile Nord', ', Aile Sud', ', Aile Est', ', Aile Ouest'];

        $building = $buildings[array_rand($buildings)];
        $floor = $floors[array_rand($floors)];
        $wing = ($order > 1) ? $wings[array_rand($wings)] : '';

        return 'Bâtiment ' . $building . ', ' . $floor . $wing;
    }

    /**
     * Obtenir des horaires pour un service
     */
    private function getWorkingHours($isMedical, $isMainService)
    {
        if ($isMedical) {
            if ($isMainService) {
                return 'Lundi au vendredi: 8h à 16h';
            } else {
                $options = [
                    '24h/24, 7j/7',
                    'Lundi au vendredi: 8h à 17h, Samedi: 8h à 12h',
                    'Lundi au vendredi: 7h30 à 15h30'
                ];
                return $options[array_rand($options)];
            }
        } else {
            return 'Lundi au vendredi: 8h à 16h';
        }
    }

    /**
     * Obtenir une équipe pour un service
     */
    private function getTeamMembers($categoryName, $isMainService)
    {
        $maleFirstNames = ['Jean', 'Pierre', 'Michel', 'André', 'Paul', 'Thomas', 'Robert', 'Richard', 'Joseph', 'Daniel'];
        $femaleFirstNames = ['Marie', 'Claire', 'Anne', 'Sophie', 'Sylvie', 'Julie', 'Catherine', 'Christine', 'Isabelle', 'Nathalie'];
        $lastNames = ['Rakoto', 'Ranaivo', 'Razafy', 'Randrianaivo', 'Rasolofo', 'Andria', 'Ravelo', 'Rabemananjara', 'Razafindrakoto', 'Rakotonirina'];

        $team = [];

        // Chef de service
        $gender = rand(0, 1); // 0 pour homme, 1 pour femme
        $firstName = $gender ? $femaleFirstNames[array_rand($femaleFirstNames)] : $maleFirstNames[array_rand($maleFirstNames)];
        $lastName = $lastNames[array_rand($lastNames)];
        $title = $gender ? 'Dre.' : 'Dr.';

        $team[] = [
            'name' => $title . ' ' . $lastName . ' ' . $firstName,
            'role' => 'Chef de service',
            'avatar' => null,
            'isLead' => true
        ];

        // 1 à 3 membres supplémentaires
        $teamSize = $isMainService ? rand(2, 3) : rand(1, 2);

        for ($i = 0; $i < $teamSize; $i++) {
            $gender = rand(0, 1);
            $firstName = $gender ? $femaleFirstNames[array_rand($femaleFirstNames)] : $maleFirstNames[array_rand($maleFirstNames)];
            $lastName = $lastNames[array_rand($lastNames)];

            // Déterminer le rôle en fonction de la catégorie
            $role = $this->getRole($categoryName, $gender);
            $prefix = $this->getRolePrefix($role, $gender);

            $team[] = [
                'name' => $prefix . ' ' . $lastName . ' ' . $firstName,
                'role' => $role,
                'avatar' => null,
                'isLead' => false
            ];
        }

        return $team;
    }

    /**
     * Obtenir un rôle en fonction de la catégorie
     */
    private function getRole($categoryName, $gender)
    {
        $medicalRoles = [
            'Médecin spécialiste',
            'Médecin assistant',
            $gender ? 'Infirmière spécialisée' : 'Infirmier spécialisé',
            'Technicien spécialisé'
        ];

        $administrativeRoles = [
            'Responsable administratif',
            'Assistant administratif',
            'Coordinateur',
            'Gestionnaire'
        ];

        $specificRoles = [
            'Cardiologie' => ['Cardiologue', 'Technicien en cardiologie'],
            'Chirurgie' => ['Chirurgien', 'Anesthésiste'],
            'Imagerie' => ['Radiologue', 'Manipulateur radio'],
            'Laboratoire' => ['Biologiste', 'Technicien de laboratoire'],
            'Urgence' => ['Urgentiste', 'Traumatologue'],
            'Pharmacie' => ['Pharmacien', 'Préparateur en pharmacie']
        ];

        // Si des rôles spécifiques sont définis pour cette catégorie, les utiliser
        if (isset($specificRoles[$categoryName])) {
            return $specificRoles[$categoryName][array_rand($specificRoles[$categoryName])];
        }

        // Sinon, utiliser un rôle générique selon que c'est médical ou administratif
        if (in_array($categoryName, ['Service Personnel', 'Finance', 'Affaires Juridiques', 'Statistiques', 'Hygiène et Soins', 'Direction'])) {
            return $administrativeRoles[array_rand($administrativeRoles)];
        } else {
            return $medicalRoles[array_rand($medicalRoles)];
        }
    }

    /**
     * Obtenir un préfixe pour un rôle (Dr., M., Mme.)
     */
    private function getRolePrefix($role, $gender)
    {
        $medicalProfessionals = [
            'Médecin', 'Cardiologue', 'Chirurgien', 'Radiologue', 'Biologiste',
            'Urgentiste', 'Traumatologue', 'Pharmacien', 'Anesthésiste'
        ];

        // Vérifier si le rôle commence par l'un des termes médicaux
        foreach ($medicalProfessionals as $profession) {
            if (strpos($role, $profession) === 0) {
                return $gender ? 'Dre.' : 'Dr.';
            }
        }

        // Sinon, utiliser M. ou Mme.
        return $gender ? 'Mme.' : 'M.';
    }

    /**
     * Obtenir des équipements pour un service
     */
    private function getEquipments($categoryName, $order)
    {
        $specificEquipments = [
            'Urgence' => ['Défibrillateurs', 'Moniteurs cardiaques', 'Matériel de réanimation', 'Ventilateurs', 'Équipement de triage'],
            'Imagerie' => ['Radiographie numérique', 'Échographe', 'Scanner', 'IRM', 'PACS'],
            'Laboratoire' => ['Analyseurs automatiques', 'Microscopes', 'Centrifugeuses', 'Équipement de microbiologie', 'PCR'],
            'Chirurgie' => ['Tables d\'opération', 'Lampes scialytiques', 'Équipement de laparoscopie', 'Instruments chirurgicaux'],
            'Cardiologie' => ['ECG', 'Échocardiographe', 'Moniteur Holter', 'Équipement d\'épreuve d\'effort'],
            'Pharmacie' => ['Armoires sécurisées', 'Logiciel de gestion pharmaceutique', 'Équipement de préparation'],
            'Endoscopie' => ['Endoscopes', 'Colonoscopes', 'Tours d\'endoscopie', 'Matériel de désinfection']
        ];

        // Si des équipements spécifiques sont définis pour cette catégorie, les utiliser
        if (isset($specificEquipments[$categoryName])) {
            // Prendre 2 à 4 équipements au hasard
            $count = min(rand(2, 4), count($specificEquipments[$categoryName]));
            $keys = array_rand($specificEquipments[$categoryName], $count);

            if (!is_array($keys)) {
                $keys = [$keys];
            }

            $equipments = [];
            foreach ($keys as $key) {
                $equipments[] = $specificEquipments[$categoryName][$key];
            }

            return $equipments;
        }

        // Sinon, utiliser des équipements génériques
        return ['Équipement spécialisé', 'Matériel médical moderne', 'Systèmes informatiques dédiés'];
    }
}
