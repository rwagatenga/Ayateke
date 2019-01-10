<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBlanchesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blanche_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blancheId')->unsigned();
            $table->integer('userId')->unsigned();

            
            $table->timestamps();

            $table->foreign('blancheId')->references('id') ->on('blanches')
                                                        ->onDelete('restrict')
                                                        ->onUpdate('cascade');
            $table->foreign('userId')->references('id') ->on('users')
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
        Schema::dropIfExists('blanche_users');
    }
}
