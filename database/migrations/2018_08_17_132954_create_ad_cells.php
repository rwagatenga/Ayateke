<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdCells extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_cells', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sectorId')->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('sectorId')->references('id')  ->on('ad_sectors')
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
        Schema::dropIfExists('ad_cells');
    }
}
