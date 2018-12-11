<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $guarded = [];

    public function user_paciente(){
        return $this->belongsTo(User::class, 'user_paciente_id');
    }

    public function user_medico(){
        return $this->belongsTo(User::class, 'user_medico_id');
    }

    public function estado_consulta(){
        return $this->belongsTo(EstadoConsulta::class);
    }

    public function radiografias(){
        return $this->hasMany(Radiografia::class, 'consulta_id');
    }

}
