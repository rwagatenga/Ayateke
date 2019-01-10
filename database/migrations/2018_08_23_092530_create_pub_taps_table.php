<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePubTapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pub_taps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_names');
            $table->string('no_of_tap');
            $table->string('nid', 16);
            $table->string('tel', 16);
            $table->string('sector');
            $table->string('cell');
            $table->string('village');
            $table->string('water_meter');
            $table->string('category');
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
        Schema::dropIfExists('pub_taps');
    }
}
