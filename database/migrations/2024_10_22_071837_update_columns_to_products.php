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

            $table->dropForeign(['brand_id']);
            $table->dropForeign(['stock_id']);

            
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->change();
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
