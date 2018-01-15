<?php
/**
 * Created by PhpStorm.
 * User: julianosirtori
 * Date: 08/10/17
 * Time: 12:50
 */

namespace App\CRUD;


use App\Vaga;

class VagaCRUD extends CRUD
{
    public function create(array $array)
    {
        $vaga = new Vaga();
        $vaga = parent::preencheObjeto($vaga, $array);
        $vaga->save();
    }

    public function update(array $array, $id)
    {
        $vaga = Vaga::find($id);
        $vaga = parent::preencheObjeto($vaga, $array);
        $vaga->save();
    }
}