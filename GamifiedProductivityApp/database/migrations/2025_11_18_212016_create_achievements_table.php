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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->char('achievement_name', 50);
            $table->char('description', 100);
            $table->unsignedSmallInteger('levels_needed')->default(0);
            $table->unsignedSmallInteger('xp_needed')->default(0);
            $table->unsignedSmallInteger('days_needed')->default(0);
            $table->unsignedSmallInteger('tasks_needed')->default(0);
            $table->string('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
