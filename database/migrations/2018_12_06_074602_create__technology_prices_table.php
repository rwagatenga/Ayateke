<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechnologyPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Technology_Prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('technologyId')->unsigned();
            $table->string('amount');
            $table->string('date');
            $table->integer('Status');
            $table->timestamps();

            $table->foreign('technologyId')->references('id')  ->on('Technology_names')
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
        Schema::dropIfExists('Technology_Prices');
    }
}
