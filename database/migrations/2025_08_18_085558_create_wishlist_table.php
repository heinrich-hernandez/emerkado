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
        Schema::create('wishlists', function (Blueprint $table) {
            // Primary key for the wishlist table
            $table->id();
    
            // Foreign key referencing the users table (the user who owns the wishlist)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
    
            // Foreign key referencing the products table (the product in the wishlist)
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
    
            // Timestamps for tracking when the wishlist item was created and last updated
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlist');
    }
};
