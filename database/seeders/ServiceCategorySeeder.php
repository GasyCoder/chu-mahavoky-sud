<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    public function run()
    {
        // Créer la catégorie technique
        ServiceCategory::firstOrCreate(
            ['type' => 'technical'],
            ['name' => 'Service Technique']
        );

        // Créer la catégorie administrative
        ServiceCategory::firstOrCreate(
            ['type' => 'administrative'],
            ['name' => 'Service Administratif']
        );
    }
}
