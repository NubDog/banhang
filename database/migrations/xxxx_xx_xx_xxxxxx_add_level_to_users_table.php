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
            // Add level column if it doesn't exist
            if (!Schema::hasColumn('users', 'level')) {
                $table->integer('level')->default(3)->after('remember_token');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the column if it exists
            if (Schema::hasColumn('users', 'level')) {
                $table->dropColumn('level');
            }
        });
    }
};