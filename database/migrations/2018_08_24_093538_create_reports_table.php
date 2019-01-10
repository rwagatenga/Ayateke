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
            $table->string('full_names');
            $table->string('tel');
            $table->string('water_meter');
            $table->string('index')->default('0');
            $table->string('m', 50)->default('0');
            $table->string('amount', 200)->default('0');
            $table->string('paid', 50)->default('0');
            $table->string('debt', 50)->default('0');
            $table->integer('user_id')->default('0');
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
        Schema::dropIfExists('reports');
    }
}
