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
        Schema::create('brands', function (Blueprint $table) {
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
            $table->string('images');
            $table->string('slug');
            $table->text('description_ua')->nullable();
            $table->text('description_ru')->nullable();
            $table->boolean('status')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
