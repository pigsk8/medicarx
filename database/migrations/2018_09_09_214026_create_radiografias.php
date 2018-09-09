<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRadiografias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radiografias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ruta_img');
            $table->integer('estudio_id')->unsigned();
            $table->integer('consulta_id')->unsigned();
            $table->foreign('estudio_id')->references('id')->on('estudios');
            $table->foreign('consulta_id')->references('id')->on('consultas');
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
        Schema::dropIfExists('radiografias');
    }
}
