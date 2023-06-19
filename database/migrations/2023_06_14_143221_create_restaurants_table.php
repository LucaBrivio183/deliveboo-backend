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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();

            // Foreign id to connect user-restaurant relationship
            $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();

            $table->string('name', 40);
            $table->string('slug', 50);
            $table->string('vat_number', 50)->unique();
            $table->string('address', 80);
            $table->string('postal_code', 5)->nullable();
            $table->string('city', 20);
            $table->string('business_times')->nullable();
            $table->string('phone_number', 15)->unique();
            $table->decimal('delivery_cost', 4, 2)->unsigned()->default(0);
            $table->decimal('min_purchase', 4, 2)->unsigned()->default(0);
            $table->string('image')->nullable();

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
        Schema::dropIfExists('restaurants');
    }
};
