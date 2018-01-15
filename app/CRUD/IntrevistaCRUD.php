<?php
/**
 * Created by PhpStorm.
 * User: Juliano Sirtori
 * Date: 27/04/2017
 * Time: 09:39
 */

namespace App\CRUD;


use App\Curriculo;
use App\Entrevista;


class IntrevistaCRUD extends CRUD
{

    /**
     * @param array $array -> o array deve ser do tipo dicionario com as chaves iguais ao nome do banco
     * @return integer retorna o id da entrevista salva
     * salva uma nova entrevista
     */
    public function create(array $array)
    {
        $entrevista = new Entrevista();
        return $this->save($entrevista, $array);
    }


    public function update(array $array, $id_curriculo)
    {
        $entrevista = Entrevista::find($id_curriculo);
        return $this->save($entrevista, $array);
    }

    /**
     * @param $entrevista
     * @param $array
     * @return mixed
     * metodo auxiliador de outros metodos create e uopdate
     */
    private function save($entrevista, $array ){
        $entrevista = parent::preencheObjeto($entrevista, $array);
        $entrevista->save();
        parent::mudaCampoCurriculo($array['id_curriculo'], 'consulta', 'etapa');
        return $entrevista->id;
    }

}