<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculo extends Model
{
    public function avaliacao()
    {
        return $this->hasOne("App\Avaliacao", "id_curriculo");
    }
}
