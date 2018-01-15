<?php
/**
 * Created by PhpStorm.
 * User: julianosirtori
 * Date: 08/10/17
 * Time: 12:49
 */

namespace App\CRUD;


use App\Cargo;

class CargoCRUD extends CRUD
{
    public function create(array $array)
    {
        $cargo = new Cargo();
        $cargo = parent::preencheObjeto($cargo, $array);
        $cargo->save();
    }

    public function update(array $array, $id)
    {
        $cargo = Cargo::find($id);
        $cargo = parent::preencheObjeto($cargo, $array);
        $cargo->save();
    }
}