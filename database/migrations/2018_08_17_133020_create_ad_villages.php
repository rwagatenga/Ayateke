<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdVillages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_villages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cellId')->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('cellId')->references('id') ->on('ad_cells')
                                                        ->onDelete('restrict')
                                                        ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_villages');
    }
}
