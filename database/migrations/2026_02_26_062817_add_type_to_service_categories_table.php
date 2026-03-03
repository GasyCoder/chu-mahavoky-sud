<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_categories', function (Blueprint $table) {
            $table->enum('type', ['technical', 'administrative'])->default('technical')->after('name');
        });

        // Migrer les données existantes : is_medical=1 → technical, is_medical=0 → administrative
        DB::table('service_categories')->where('is_medical', 1)->update(['type' => 'technical']);
        DB::table('service_categories')->where('is_medical', 0)->update(['type' => 'administrative']);
    }

    public function down(): void
    {
        Schema::table('service_categories', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
