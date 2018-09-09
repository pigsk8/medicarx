<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudio extends Model
{
    protected $guarded = [];

    public function radiografias(){
        return $this->hasMany(Radiografia::class);
    }
}
