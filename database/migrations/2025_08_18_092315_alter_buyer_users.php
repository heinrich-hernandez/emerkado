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
            // This variable would track offenses made by created accounts
            $table->string('offenses')->default('0,0,0,0,0,0')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buyer', function (Blueprint $table) {
            $table->dropColumn('offenses');
        });
    }
};
