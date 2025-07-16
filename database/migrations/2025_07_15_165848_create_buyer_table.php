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
        Schema::create('buyer', function (Blueprint $table) {
            $table->id();
            $table->string('authorized_representative')->nullable(); // Can be optional
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->unique(); // Email should be unique
            $table->string('profile_picture')->nullable(); // Made nullable to avoid 'no default value' errors
            $table->string('valid_id_picture')->nullable(); // Made nullable to avoid 'no default value' errors
            $table->string('username')->unique(); // Username should be unique
            $table->string('password'); // Hashed password
            $table->string('user_role'); // e.g., 'Buyer'
            $table->boolean('status')->default(0); // e.g., 0 for inactive/pending, 1 for active
            $table->rememberToken();
            $table->date('date'); // Assuming this is a specific date field (e.g., registration date)
            $table->boolean('review_status')->default(0); // e.g., 0 for pending review, 1 for reviewed
            $table->string('reviewed_by')->nullable(); // User ID or name of the reviewer, can be null if not reviewed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buyer');
    }
};
