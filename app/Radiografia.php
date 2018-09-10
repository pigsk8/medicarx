<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Radiografia extends Model
{
    protected $guarded = [];

    public function estudio(){
        return $this->belongsTo(Estudio::class);
    }

    public function consulta(){
        return $this->belongsTo(Consulta::class);
    }
}
