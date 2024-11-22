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
        Schema::create('vehicles_inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('modal_id');
            $table->unsignedBigInteger('deployed_districts');
            $table->string("vehicle_type");
            $table->string("vehicle_numbers");
            $table->string("color_name");
            $table->timestamps();
            $table->foreign('modal_id')->references('id')->on('vehicle_makes')->onDelete('cascade');
            $table->foreign('deployed_districts')->references('id')->on('districts')->onDelete('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles_inventories');
    }
};
