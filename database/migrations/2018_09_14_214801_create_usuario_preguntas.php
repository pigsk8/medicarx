<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioPreguntas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregunta_usuario', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('pregunta_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('pregunta_id')->references('id')->on('preguntas');
            $table->primary(['user_id', 'pregunta_id']);
            $table->string('respuesta');
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
        Schema::dropIfExists('pregunta_usuario');
    }
}
