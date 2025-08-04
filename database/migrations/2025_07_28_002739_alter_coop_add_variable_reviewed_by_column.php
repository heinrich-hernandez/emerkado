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
            // 2. Add the 'review_status' column back as a nullable string
            $table->string('reviewed_by')->nullable(); // You can set a default string value here
            // Or if you don't want a default, just: $table->string('review_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coop', function (Blueprint $table) {
            // 2. Add the 'review_status' column back as a nullable string
            $table->string('reviewed_by')->nullable(); // You can set a default string value here
            // Or if you don't want a default, just: $table->string('review_status')->nullable();
        });
    }
};
