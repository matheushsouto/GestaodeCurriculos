<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    public function cargo()
    {
        return $this->belongsTo('App\Cargo');
    }

    public function loja()
    {
        return $this->belongsTo('App\Loja');
    }
}
