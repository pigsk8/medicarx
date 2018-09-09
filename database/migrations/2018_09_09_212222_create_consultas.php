<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_medico_id')->unsigned();
            $table->integer('user_paciente_id')->unsigned();
            $table->string('diagnostico',250);
            $table->date('fecha_solicitud');
            $table->date('fecha_entrega');
            $table->integer('estado_consulta_id')->unsigned();
            
            $table->foreign('user_medico_id')->references('id')->on('users');
            $table->foreign('user_paciente_id')->references('id')->on('users');
            $table->foreign('estado_consulta_id')->references('id')->on('estado_consultas');


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
        Schema::dropIfExists('consultas');
    }
}
