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
        Schema::create('products', function (Blueprint $table) {
            // Primary key for the products table
            $table->id();
    
            // Foreign key referencing the users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
    
            // Name of the product
            $table->string('name');
    
            // Description of the product
            $table->text('description');
    
            // Price of the product, with a total of 10 digits and 2 decimal places
            $table->decimal('price', 10, 2);
    
            // Foreign key referencing the categories table
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
    
            // Timestamps for tracking when the product was created and last updated
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
