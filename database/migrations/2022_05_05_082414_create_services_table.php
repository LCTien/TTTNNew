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
        Schema::create('services', function (Blueprint $table) {
            $table->string('Code')->notnull()->unique()->primary();
            $table->string('name', 100);
            $table->string('description', 10000);
            $table->string('auto_incre');
            $table->string('prefix')->nullable();
            $table->string('surfix')->nullable();
            $table->boolean('reset_everyday')->nullable()->default(false);
            $table->integer('status_active');
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
        Schema::dropIfExists('services');
    }
};
