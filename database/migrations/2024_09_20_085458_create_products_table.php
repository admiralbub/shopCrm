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
            $table->id();
            $table->string('name_ua');
            $table->string('name_ru');
            $table->string('h1_ua');
            $table->string('h1_ru');
            $table->string('meta_title_ua');
            $table->string('meta_title_ru');
            $table->text('meta_description_ua');
            $table->text('meta_description_ru');
            $table->string('meta_keywords_ua')->nullable();
            $table->string('meta_keywords_ru')->nullable();
            $table->string('image');
            $table->text('description_ua')->nullable();
            $table->text('description_ru')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->unsignedBigInteger('stock_id')->nullable();
            $table->foreign('stock_id')->references('id')->on('stocks');
            $table->decimal('price', 9, 3);
            $table->string('slug')->unique();
            $table->Integer('old_price')->nullable();
            $table->Integer('price_stock')->default(0)->nullable();
            $table->boolean('is_publish')->default(0)->nullable();
            $table->boolean('is_new')->default(0)->nullable();
            $table->boolean('is_top')->default(0)->nullable();
            $table->boolean('is_recommender')->default(0)->nullable();
            $table->boolean('is_sale')->default(0)->nullable();
            $table->text('wholesale')->nullable();
            $table->Integer('status')->default(0)->nullable();
            $table->Integer('unit')->nullable();
            $table->boolean('hide_from_categories')->default(0)->nullable();
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
