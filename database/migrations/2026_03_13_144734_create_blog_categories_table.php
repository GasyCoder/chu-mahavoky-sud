<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('color', 30)->default('blue');
            $table->string('icon', 50)->nullable();
            $table->integer('order')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        DB::table('blog_categories')->insert([
            ['name' => 'Actualité', 'slug' => 'actualite', 'color' => 'blue', 'icon' => 'fa-newspaper', 'order' => 1, 'active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Événement', 'slug' => 'evenement', 'color' => 'purple', 'icon' => 'fa-calendar', 'order' => 2, 'active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Service', 'slug' => 'service', 'color' => 'emerald', 'icon' => 'fa-stethoscope', 'order' => 3, 'active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Équipement', 'slug' => 'equipement', 'color' => 'amber', 'icon' => 'fa-cog', 'order' => 4, 'active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_categories');
    }
};
