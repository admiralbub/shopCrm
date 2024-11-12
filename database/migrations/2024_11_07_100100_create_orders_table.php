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
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
			$table->string('first_name');
			$table->string('last_name');
            $table->string('middle_name')->nullable();
			$table->string('phone');
			$table->string('email');
			$table->longText('comment')->nullable();
	        $table->text('delivery');
            $table->text('pay_info');
            $table->integer('status')->default(1)->nullable();
	        $table->integer('total');
	        $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
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
