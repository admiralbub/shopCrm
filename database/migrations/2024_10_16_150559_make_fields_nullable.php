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
        Schema::table('products', function (Blueprint $table) {
            $table->string('h1_ua')->nullable()->change();
            $table->string('h1_ru')->nullable()->change();
            $table->string('meta_title_ua')->nullable()->change();
            $table->string('meta_title_ru')->nullable()->change();
            $table->string('meta_description_ru')->nullable()->change();
            $table->string('meta_description_ua')->nullable()->change();
        });
        Schema::table('brands', function (Blueprint $table) {
            $table->string('h1_ua')->nullable()->change();
            $table->string('h1_ru')->nullable()->change();
            $table->string('meta_title_ua')->nullable()->change();
            $table->string('meta_title_ru')->nullable()->change();
            $table->string('meta_description_ru')->nullable()->change();
            $table->string('meta_description_ua')->nullable()->change();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->string('h1_ua')->nullable()->change();
            $table->string('h1_ru')->nullable()->change();
            $table->string('meta_title_ua')->nullable()->change();
            $table->string('meta_title_ru')->nullable()->change();
            $table->string('meta_description_ru')->nullable()->change();
            $table->string('meta_description_ua')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
