<?php
/**
 * Created by PhpStorm.
 * User: Juliano Sirtori
 * Date: 19/05/2017
 * Time: 16:53
 */

namespace App\CRUD;


use App\Curriculo;

class CRUD
{

    /**
     * @param $object
     * @param $array
     * @return mixed
     * essa função é responsavel por popular um objeto com os dados passados por uma array
     */
    public function preencheObjeto($object, $array ){
        foreach (array_keys($array) as $key ){
            $object->$key = $array[$key];
        }
        return $object;
    }

    /**
     * @param $id
     * @param $valor
     * @param $campo
     * altera o valor de um campo do Curriculo
     */
    public function mudaCampoCurriculo($id, $valor, $campo){
        $curriculo = Curriculo::find($id);
        $curriculo->$campo = $valor;
        $curriculo->save();
    }

}