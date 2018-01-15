<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    public function vagas()
    {
        return $this->hasMany('App\Vaga');
    }
}
