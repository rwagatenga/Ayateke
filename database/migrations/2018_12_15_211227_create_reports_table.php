<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('cId')->unsigned();
          $table->string('index');
          $table->string('m3');
          $table->integer('amount');
          $table->integer('paid');
          $table->integer('userId')->unsigned();
          $table->timestamps();
          $table->foreign('cId')->references('id')->on('clients')
                                                            ->onDelete('restrict')
                                                            ->onUpdate('cascade');
          $table->foreign('userId')->references('id')->on('users')
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
        Schema::dropIfExists('reports');
    }
}
