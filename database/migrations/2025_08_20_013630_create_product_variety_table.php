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
        Schema::create('product_variety', function (Blueprint $table) {
            $table->id(); // primary key
            $table->string('name'); // name of the product variety
            $table->string('variety_code')->unique(); // unique code for the product variety
            $table->unsignedBigInteger('product_id'); // foreign key to products table
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade'); // foreign key constraint
            $table->decimal('price', 10, 2); // price of the product
            $table->integer('stock_quantity')->default(0); // stock quantity of the product
            $table->boolean('is_active')->default(true); // status of the product variety
            $table->string('image_path')->nullable(); // path to the product image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variety');
    }
};
