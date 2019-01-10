<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersTapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pers_taps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_names');
            $table->string('nid');
            $table->string('tel');
            $table->string('sector');
            $table->string('cell');
            $table->string('village');
            $table->string('water_meter');
            $table->string('category');
            $table->integer('when');
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
        Schema::dropIfExists('pers_taps');
    }
}
