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
        Schema::table('users', function (Blueprint $table) {
            $table->string('father_name')->after('email_verified_at')->nullable();
            $table->string('caste')->after('father_name')->nullable();
            $table->string('joining_date')->after('caste')->nullable();
            $table->string('home_town')->after('joining_date')->nullable();
            $table->string('reserve_driver_joining_date')->after('home_town')->nullable();
            $table->string('main_reserve_driver_joining_date')->after('reserve_driver_joining_date')->nullable();
            $table->string('simt_joining_date')->after('main_reserve_driver_joining_date')->nullable();
            $table->string('current_distrtict_joining_date')->after('simt_joining_date')->nullable();
            $table->string('other_comment')->after('current_distrtict_joining_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('father_name');
        });
    }
};
