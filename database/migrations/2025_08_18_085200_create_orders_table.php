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
        Schema::create('orders', function (Blueprint $table) {
            // Primary key for the orders table
            $table->id();
    
            // Foreign key referencing the users table (the user who placed the order)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
    
            // Foreign key referencing the products table (the product being ordered)
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
    
            // Quantity of the product being ordered
            $table->integer('quantity');
    
            // Total price for the order (calculated based on quantity and product price)
            $table->decimal('total_price', 10, 2);

            // Status of the order, defaulting to 'pending'
            $table->string('status')->default('pending');
    
            // Timestamps for tracking when the order was created and last updated
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
