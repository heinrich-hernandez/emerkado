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
        Schema::table('coop', function (Blueprint $table) {
            // 1. Drop the existing 'review_status' column (which is currently boolean)
            $table->dropColumn('name');
        });

        Schema::table('coop', function (Blueprint $table) {
            $table->string('name'); // You can set a default string value here
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coop', function (Blueprint $table) {
            // 1. Drop the string column if rolling back
            $table->dropColumn('name');
        });

        Schema::table('coop', function (Blueprint $table) {
            // 2. Add it back as boolean (reverting to original state)
            $table->string('name');
        });
    }
};
