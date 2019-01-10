<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
<<<<<<< HEAD
            $table->string('email');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->integer('roleId')->unsigned();

            $table->foreign('roleId')->references('id') ->on('role')
                                                        ->onDelete('restrict')
                                                        ->onUpdate('cascade');
=======
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
>>>>>>> aa659fe1537f4faa13cb03b5d947c812ed3c169e
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
