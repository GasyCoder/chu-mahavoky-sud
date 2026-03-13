<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipments = [
            [
                'name' => 'Laboratoire Moderne',
                'description' => 'Équipements de pointe pour des analyses précises et rapides',
                'icon' => 'fa-microscope',
                'order' => 1,
                'status' => true,
            ],
            [
                'name' => 'Blocs Opératoires',
                'description' => 'Salles d\'opération stériles avec technologies avancées',
                'icon' => 'fa-procedures',
                'order' => 2,
                'status' => true,
            ],
            [
                'name' => 'Imagerie Médicale',
                'description' => 'Scanner, IRM et radiologie numérique de dernière génération',
                'icon' => 'fa-x-ray',
                'order' => 3,
                'status' => true,
            ],
        ];

        foreach ($equipments as $equipment) {
            Equipment::updateOrCreate(['name' => $equipment['name']], $equipment);
        }
    }
}
