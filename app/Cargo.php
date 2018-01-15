<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    public function vagas()
    {
        return $this->hasMany('App\Vagas');
    }
}
