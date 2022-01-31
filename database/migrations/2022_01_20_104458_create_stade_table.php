<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stade', function (Blueprint $table) {
            $table->id();
            $table->string('nom_stade');
            $table->string('description');
            $table->BigInt('nombre_place');
            //$table->bigInteger('user_id')->unsigned()->index()->nullable();
            //$table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('stade');
    }
}
