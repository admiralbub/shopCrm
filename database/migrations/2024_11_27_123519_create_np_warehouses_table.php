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
        Schema::create('np_warehouses', function (Blueprint $table) {
            $table->id();
            $table->string("Description");
            $table->string("DescriptionRu")->nullable();
            $table->string("Ref")->nullable();
            $table->string("CityRef")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('np_warehouses');
    }
};
