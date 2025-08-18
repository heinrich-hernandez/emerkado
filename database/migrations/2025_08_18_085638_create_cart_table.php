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
        Schema::create('carts', function (Blueprint $table) {
            // Primary key for the cart table
            $table->id();
    
            // Foreign key referencing the users table (the user who owns the cart)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
    
            // Foreign key referencing the products table (the product in the cart)
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
    
            // Quantity of the product in the cart
            $table->integer('quantity');
    
            // Timestamps for tracking when the cart item was created and last updated
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
