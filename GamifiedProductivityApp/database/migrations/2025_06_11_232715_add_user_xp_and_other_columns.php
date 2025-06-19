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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedTinyInteger('level')->default(1)->after('email');
            $table->unsignedSmallInteger('xp')->default(0)->after('level');
            $table->unsignedSmallInteger('tasks_completed')->default(0)->after('xp');
            $table->unsignedSmallInteger('day_streak')->default(0)->after('tasks_completed');
            $table->Datetime('last_login')->nullable()->after('day_streak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('level');
            $table->dropColumn('xp');
            $table->dropColumn('tasks_completed');
            $table->dropColumn('day_streak');
            $table->dropColumn('last_login');
        });
    }
};
