<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes';

    public function curriculo()
    {
        return $this->belongsTo("App\Curriculo", "id_curriculo");
    }
}
