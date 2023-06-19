<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Foreign id to connect restaurant-orders relationship
            $table->foreignId('restaurant_id')
            ->constrained()
            ->cascadeOnDelete();

            $table->string('name', 50);
            $table->string('email', 50)->nullable();
            $table->string('address', 50);
            $table->string('phone_number', 15);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
