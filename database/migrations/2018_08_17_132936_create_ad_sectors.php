<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdSectors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_sectors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('districtId')->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('districtId')->references('id')  ->on('ad_districts')
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
        Schema::dropIfExists('ad_sectors');
    }
}
