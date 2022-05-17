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
        Schema::create('equipments', function (Blueprint $table) {
            $table->string('Code')->notnull()->unique()->primary();
            $table->string('name', 100);
            $table->string('IP', 100);
            $table->string('service_use',1000);
            $table->string('login_name');
            $table->string('password');
            $table->unsignedBigInteger('equipment_type_id');
            $table->integer('status_active');
            $table->integer('status_connect');
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
        Schema::dropIfExists('equipment');
    }
};
