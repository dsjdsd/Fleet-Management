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
        Schema::create('daily_diaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id');
            $table->string('date');
            $table->string('vehicle_type');
            $table->string('special_purpose_vehicle')->nullable();
            $table->string('chasis_number');
            $table->string('engine_number');
            $table->string('cubic_capacity')->nullable();
            $table->string('num_cylinders');
            $table->string('vehicle_make');
            $table->string('ability_to_sit');
            $table->string('engine_oil_quantity');
            $table->string('gear_oil_quantity');
            $table->string('average_expenses');
            $table->string('purchase_date');
            $table->string('usage_start_date');
            $table->string('purchase_price');
            $table->timestamps();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_diaries');
    }
};
