<?php
/**
 * Created by PhpStorm.
 * User: Juliano Sirtori
 * Date: 17/04/2017
 * Time: 15:03
 */

namespace App\CRUD;


use App\Consulta;
use App\Curriculo;

class ConsultaCRUD extends CRUD
{
    /**
     * @param array $array -> o array deve ser do tipo dicionario com as chaves iguais ao nome do banco
     * salva uma nova consulta
     */
    public function create(array $array)
    {
        $consulta = new Consulta();
        $consulta->fontConsu = $array['fontConsu'];
        $consulta->resConsu = $array['resConsu'];
        $consulta->id_curriculo = $array['id_curriculo'];
        $consulta->save();

        parent::mudaCampoCurriculo($array['id_curriculo'], "consulta", "etapa");
    }

    /**
     * @param $id_curriculo -> id da consulta que deseja pegar
     * @return mixed -> retorna uma Consulta com o id igual passado pelo paramentro
     */
    public function findByIdCurriculo($id_curriculo)
    {
        return Consulta::where("id_curriculo", "=", $id_curriculo)->get();
    }

    /**
     * @param $id_curriculo -> id do curriculo que deseja apagar
     */
    public function delete($id_curriculo)
    {
        Consulta::where("id_curriculo", "=", $id_curriculo)->delete();
    }
}