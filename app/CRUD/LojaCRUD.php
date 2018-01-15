<?php
/**
 * Created by PhpStorm.
 * User: julianosirtori
 * Date: 08/10/17
 * Time: 12:49
 */

namespace App\CRUD;


use App\Loja;

class LojaCRUD extends CRUD
{
    public function create(array $array)
    {
        $loja = new Loja();
        $loja = parent::preencheObjeto($loja, $array);
        $loja->save();
    }

    public function update(array $array, $id)
    {
        $loja = Loja::find($id);
        $loja = parent::preencheObjeto($loja, $array);
        $loja->save();
    }


}