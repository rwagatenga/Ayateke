<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roloves', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_names');
            $table->string('tel');
            $table->string('water_meter');
            $table->string('index')->default('0');
            $table->string('m')->default('0');
            $table->string('amount')->default('0');
            $table->integer('user_id')->default('0');
            $table->string('category')->default('0');
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
        Schema::dropIfExists('roloves');
    }
}
