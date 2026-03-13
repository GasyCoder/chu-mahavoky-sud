<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('icon', 50)->default('fa-cog');
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        DB::table('equipments')->insert([
            ['name' => 'Laboratoire Moderne', 'description' => 'Équipements de pointe pour des analyses précises et rapides', 'icon' => 'fa-microscope', 'image' => null, 'order' => 1, 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Blocs Opératoires', 'description' => 'Salles d\'opération stériles avec technologies avancées', 'icon' => 'fa-procedures', 'image' => null, 'order' => 2, 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Imagerie Médicale', 'description' => 'Scanner, IRM et radiologie numérique de dernière génération', 'icon' => 'fa-x-ray', 'image' => null, 'order' => 3, 'status' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('equipments');
    }
};
