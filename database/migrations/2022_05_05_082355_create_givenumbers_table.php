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
        Schema::create('givenumbers', function (Blueprint $table) {
            $table->id();
            $table->string('serial')->notnull();
            $table->string('name');
            $table->string('phonenumber');
            $table->string('email');
            $table->string('service_id');
            $table->string('equipment_id');
            $table->dateTime('limit_time');
            $table->integer('status');
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
        Schema::dropIfExists('givenumbers');
    }
};
