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
        Schema::table('givenumbers', function (Blueprint $table) {
            $table->foreign('service_id')->references('Code')->on('services');
            $table->foreign('equipment_id')->references('Code')->on('equipments');
        });
        Schema::table('accounts', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles');
        });
        Schema::table('equipments', function (Blueprint $table) {
            $table->foreign('equipment_type_id')->references('id')->on('equipment_types');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('givenumbers', function (Blueprint $table) {
            //
        });
        Schema::table('accounts', function (Blueprint $table) {
        });
    }
};
