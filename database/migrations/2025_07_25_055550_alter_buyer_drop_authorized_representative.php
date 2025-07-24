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
            $table->dropColumn('authorized_representative');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buyer', function (Blueprint $table) {
            // 1. Drop the existing 'review_status' column (which is currently boolean)
            $table->dropColumn('authorized_representative');
        });
    }
};
