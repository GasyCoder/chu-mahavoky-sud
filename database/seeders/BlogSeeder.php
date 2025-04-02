<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Article 1 - Événement (comme dans votre design)
        Blog::create([
            'title' => 'Journée mondiale de la santé',
            'slug' => 'journee-mondiale-de-la-sante',
            'content' => '<p>Notre établissement organise une journée portes ouvertes avec consultations gratuites et ateliers de sensibilisation pour tous les publics.</p>
            <p>Au programme de cette journée:</p>
            <ul>
                <li>Consultations gratuites de 9h à 17h</li>
                <li>Ateliers de prévention et d\'information</li>
                <li>Conférences sur les thématiques de santé actuelles</li>
                <li>Démonstrations d\'équipements médicaux</li>
            </ul>
            <p>Cette journée s\'inscrit dans le cadre de la Journée Mondiale de la Santé, célébrée chaque année le 7 avril. C\'est l\'occasion pour notre établissement de rappeler l\'importance de la prévention et de l\'accès aux soins pour tous.</p>',
            'excerpt' => 'Notre établissement organise une journée portes ouvertes avec consultations gratuites et ateliers de sensibilisation.',
            'image' => 'blogs/actualite1.jpg',
            'published_at' => now()->subDays(2),
            'category' => Blog::CATEGORY_EVENT,
            'is_featured' => true,
            'status' => Blog::STATUS_PUBLISHED,
        ]);

        // Article 2 - Service (comme dans votre design)
        Blog::create([
            'title' => 'Ouverture du service de neurologie',
            'slug' => 'ouverture-service-neurologie',
            'content' => '<p>Notre équipe s\'agrandit avec l\'arrivée d\'un service complet dédié aux pathologies neurologiques avec des spécialistes reconnus.</p>
            <p>Ce nouveau service propose:</p>
            <ul>
                <li>Consultations spécialisées en neurologie</li>
                <li>Examens neurologiques complets</li>
                <li>Suivi des patients atteints de maladies neurologiques chroniques</li>
                <li>Collaboration étroite avec notre service d\'imagerie médicale</li>
            </ul>
            <p>L\'équipe est dirigée par le Dr. Martin, neurologue renommé avec plus de 15 ans d\'expérience dans le domaine.</p>',
            'excerpt' => 'Notre équipe s\'agrandit avec l\'arrivée d\'un service complet dédié aux pathologies neurologiques.',
            'image' => 'blogs/service1.jpg',
            'published_at' => now()->subDays(5),
            'category' => Blog::CATEGORY_SERVICE,
            'is_featured' => true,
            'status' => Blog::STATUS_PUBLISHED,
        ]);

        // Article 3 - Équipement (comme dans votre design)
        Blog::create([
            'title' => 'Nouvel équipement d\'imagerie médicale',
            'slug' => 'nouvel-equipement-imagerie-medicale',
            'content' => '<p>Le CHU renforce ses capacités diagnostiques avec l\'acquisition d\'un scanner de dernière génération permettant des examens plus précis.</p>
            <p>Ce nouvel équipement offre:</p>
            <ul>
                <li>Images haute définition pour un diagnostic plus précis</li>
                <li>Temps d\'examen réduit de 30%</li>
                <li>Réduction significative de l\'exposition aux rayonnements</li>
                <li>Meilleur confort pour les patients</li>
            </ul>
            <p>Cet investissement s\'inscrit dans notre démarche continue d\'amélioration de la qualité des soins et des services proposés à nos patients.</p>',
            'excerpt' => 'Le CHU renforce ses capacités diagnostiques avec l\'acquisition d\'un scanner de dernière génération.',
            'image' => 'blogs/equipement1.jpg',
            'published_at' => now()->subDays(10),
            'category' => Blog::CATEGORY_EQUIPMENT,
            'is_featured' => true,
            'status' => Blog::STATUS_PUBLISHED,
        ]);

        // Article 4 - Actualité générale
        Blog::create([
            'title' => 'Des résultats prometteurs pour notre programme de recherche',
            'slug' => 'resultats-prometteurs-programme-recherche',
            'content' => '<p>Notre département de recherche a récemment publié des résultats encourageants concernant un nouveau traitement expérimental.</p>
            <p>Après trois années d\'études cliniques, les premiers résultats montrent une amélioration significative chez 75% des patients participants. Cette avancée pourrait changer considérablement la prise en charge de certaines pathologies chroniques.</p>
            <p>Ces résultats ont été présentés lors du dernier congrès international de médecine et feront l\'objet d\'une publication dans une revue scientifique de référence le mois prochain.</p>',
            'excerpt' => 'Notre département de recherche a récemment publié des résultats encourageants concernant un nouveau traitement expérimental.',
            'image' => 'blogs/recherche1.jpg',
            'published_at' => now()->subDays(15),
            'category' => Blog::CATEGORY_NEWS,
            'is_featured' => false,
            'status' => Blog::STATUS_PUBLISHED,
        ]);

        // Article 5 - Article en brouillon
        Blog::create([
            'title' => 'Formation continue : de nouveaux partenariats académiques',
            'slug' => 'formation-continue-nouveaux-partenariats',
            'content' => '<p>Notre établissement développe de nouveaux partenariats avec des universités prestigieuses pour renforcer notre programme de formation continue.</p>
            <p>Ces collaborations permettront à notre personnel médical et paramédical de bénéficier de formations de haut niveau, directement en lien avec les dernières avancées dans leurs domaines respectifs.</p>
            <p>Un programme détaillé sera communiqué prochainement à l\'ensemble du personnel.</p>',
            'excerpt' => 'Notre établissement développe de nouveaux partenariats avec des universités prestigieuses pour renforcer notre programme de formation continue.',
            'image' => 'blogs/formation1.jpg',
            'published_at' => null,
            'category' => Blog::CATEGORY_NEWS,
            'is_featured' => false,
            'status' => Blog::STATUS_DRAFT,
        ]);

        // Article 6 - Événement à venir
        Blog::create([
            'title' => 'Conférence sur les avancées en cardiologie',
            'slug' => 'conference-avancees-cardiologie',
            'content' => '<p>Notre service de cardiologie organise une conférence sur les dernières avancées dans le traitement des maladies cardiovasculaires.</p>
            <p>Plusieurs experts internationaux seront présents pour partager leurs connaissances et échanger avec nos équipes. Cette conférence sera également ouverte au public, sur inscription préalable.</p>
            <p>Rendez-vous le 15 avril 2025 dans notre amphithéâtre pour cette journée exceptionnelle qui promet d\'être riche en enseignements.</p>',
            'excerpt' => 'Notre service de cardiologie organise une conférence sur les dernières avancées dans le traitement des maladies cardiovasculaires.',
            'image' => 'blogs/conference1.jpg',
            'published_at' => now()->subDay(),
            'category' => Blog::CATEGORY_EVENT,
            'is_featured' => false,
            'status' => Blog::STATUS_PUBLISHED,
        ]);

        // Article 7 - Nouveau service
        Blog::create([
            'title' => 'Lancement de notre service de téléconsultation',
            'slug' => 'lancement-service-teleconsultation',
            'content' => '<p>Afin de faciliter l\'accès aux soins pour tous, notre établissement lance un service de téléconsultation sécurisé.</p>
            <p>Ce service permet aux patients de consulter certains de nos spécialistes à distance, sans avoir à se déplacer. Il est particulièrement adapté pour :</p>
            <ul>
                <li>Le suivi de maladies chroniques</li>
                <li>Le renouvellement d\'ordonnances</li>
                <li>Les consultations préliminaires</li>
                <li>L\'orientation vers les services appropriés</li>
            </ul>
            <p>Pour bénéficier de ce service, il suffit de prendre rendez-vous via notre plateforme en ligne ou par téléphone.</p>',
            'excerpt' => 'Afin de faciliter l\'accès aux soins pour tous, notre établissement lance un service de téléconsultation sécurisé.',
            'image' => 'blogs/teleconsultation1.jpg',
            'published_at' => now()->subDays(7),
            'category' => Blog::CATEGORY_SERVICE,
            'is_featured' => false,
            'status' => Blog::STATUS_PUBLISHED,
        ]);
    }
}
