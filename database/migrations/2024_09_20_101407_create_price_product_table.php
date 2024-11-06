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
        Schema::create('price_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('price_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();
            $table->foreign('price_id')->references('id')->on('prices')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_product');
    }
};