<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoConsulta extends Model
{
    protected $guarded = [];

    public function consultas(){
        return $this->hasMany(Consulta::class);
    }
}
