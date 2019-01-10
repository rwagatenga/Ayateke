<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('line', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blancheId')->unsigned();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('line_type');
            $table->string('line_price');
            $table->string('public_price');
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('blancheId')->references('id')  ->on('blanches')
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
        Schema::dropIfExists('lines');
    }
}
