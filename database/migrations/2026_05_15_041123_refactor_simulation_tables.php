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
        // 1. Drop existing table to rebuild cleaner (assuming this is local dev/safe to wipe results)
        Schema::dropIfExists('simulation_results');

        // 2. Standard Simulation Tables
        Schema::create('simulation_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('topic_id')->constrained('simulation_topics')->cascadeOnDelete();
            $table->string('stance');
            $table->integer('total_score')->default(0);
            $table->text('feedback_summary')->nullable();
            $table->timestamps();
        });

        Schema::create('simulation_phase_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('simulation_result_id')->constrained()->cascadeOnDelete();
            $table->string('phase_name');
            $table->text('user_argument');
            $table->integer('score')->default(0);
            $table->text('feedback')->nullable();
            $table->string('relevance_status')->nullable();
            $table->timestamps();
        });

        // 3. Interactive Debate Tables
        Schema::create('interactive_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('topic_id')->constrained('simulation_topics')->cascadeOnDelete();
            $table->string('stance');
            $table->integer('current_phase')->default(1);
            $table->integer('total_score')->default(0);
            $table->string('mode')->default('normal'); // 'normal' or 'speed'
            $table->timestamps();
        });

        Schema::create('interactive_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('interactive_sessions')->cascadeOnDelete();
            $table->string('sender_type'); // 'user' or 'system'
            $table->text('message');
            $table->integer('phase');
            $table->integer('score')->nullable();
            $table->text('feedback')->nullable();
            $table->string('relevance_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interactive_messages');
        Schema::dropIfExists('interactive_sessions');
        Schema::dropIfExists('simulation_phase_results');
        Schema::dropIfExists('simulation_results');
    }
};
