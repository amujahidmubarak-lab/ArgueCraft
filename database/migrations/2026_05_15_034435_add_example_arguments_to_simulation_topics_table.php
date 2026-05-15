<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('simulation_topics', function (Blueprint $table) {
            $table->json('example_arguments')->nullable()->after('opponent_arguments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('simulation_topics', function (Blueprint $table) {
            $table->dropColumn('example_arguments');
        });
    }
};
