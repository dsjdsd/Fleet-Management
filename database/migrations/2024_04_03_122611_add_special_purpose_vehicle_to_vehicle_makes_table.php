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
        Schema::table('vehicle_makes', function (Blueprint $table) {
            $table->string('special_purpose_vehicle')->after('vehicle_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicle_makes', function (Blueprint $table) {
            $table->dropColumn('special_purpose_vehicle');
        });
    }
};
