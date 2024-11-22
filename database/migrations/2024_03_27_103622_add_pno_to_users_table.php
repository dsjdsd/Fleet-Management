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
            $table->integer('pno_number')->after('email_verified_at');
            $table->date('dob')->after('pno_number');
            $table->string('district')->after('dob');
            $table->string('photo')->after('district')->nullable();
            $table->string('contact_number')->after('photo');
            $table->tinyInteger('status')->default(1)->after('contact_number');
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
            $table->dropColumn('pno_number');
        });
    }
};
