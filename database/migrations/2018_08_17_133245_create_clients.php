<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clientTypeId')->unsigned();
            $table->integer('organisationId')->unsigned()->nullable();
            $table->integer('villageId')->unsigned()->nullable();
            $table->integer('lineId')->unsigned()->nullable();
            $table->string('code')->unique();

            $table->string('firsname');
            $table->string('surname')->nullable();
            $table->string('idCard')->nullable();
            $table->string('phoneNumber1')->nullable();
            $table->string('phoneNumber2')->nullable();
            $table->string('counterNumber')->nullable();
            $table->string('firstConnection')->nullable();
            $table->string('comment')->nullable();
            $table->timestamps();

            $table->foreign('clientTypeId')->references('id')  ->on('client_types')
                                                            ->onDelete('restrict')
                                                            ->onUpdate('cascade');

            $table->foreign('organisationId')->references('id')  ->on('organisations')
                                                            ->onDelete('restrict')
                                                            ->onUpdate('cascade');

            $table->foreign('villageId')->references('id')  ->on('ad_villages')
                                                            ->onDelete('restrict')
                                                            ->onUpdate('cascade');

            $table->foreign('lineId')->references('id')  ->on('line')
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
        Schema::dropIfExists('clients');
    }
}
