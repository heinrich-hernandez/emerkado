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
        Schema::table('buyer', function (Blueprint $table) {
            // 1. Drop the existing 'review_status' column (which is currently boolean)
            $table->dropColumn('review_status');
        });

        Schema::table('buyer', function (Blueprint $table) {
            // 2. Add the 'review_status' column back as a nullable string
            $table->string('review_status')->nullable(); // You can set a default string value here
            // Or if you don't want a default, just: $table->string('review_status')->nullable();
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buyer', function (Blueprint $table) {
            // 1. Drop the string column if rolling back
            $table->dropColumn('review_status');
        });

        Schema::table('buyer', function (Blueprint $table) {
            // 2. Add it back as boolean (reverting to original state)
            $table->boolean('review_status')->default(0);
        });
    }
};
