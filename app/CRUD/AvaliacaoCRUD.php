<?php
/**
 * Created by PhpStorm.
 * User: Juliano Sirtori
 * Date: 12/05/2017
 * Time: 14:38
 */

namespace App\CRUD;


use App\Avaliacao;
use App\Curriculo;

class AvaliacaoCRUD extends CRUD
{

    /**
     * @param array $array -> o array deve ser do tipo dicionario com as chaves iguais ao nome do banco
     * @return integer -> retorna o id da avaliação salva
     */
    public function create(array $array)
    {
        $avaliacao = new Avaliacao();
       $avaliacao = parent::preencheObjeto($avaliacao, $array);
        $avaliacao->save();
        parent::mudaCampoCurriculo($array['id_curriculo'] ,'avaliacao', 'etapa');
        return $avaliacao->id;
    }


    /**
     * @param array $array -> o array deve ser do tipo dicionario com as chaves iguais ao nome do banco
     * @param $id_avaliacao -> id da avaliação que deseja modificar
     * @return retorna o id da avaliação salva
     * metodo responsavel por fazer um update de uma avaliaçaõ com um id especifico
     */
    public function update(array $array, $id_avaliacao)
    {
        $avaliacao = Avaliacao::find($id_avaliacao);
        $avaliacao = parent::preencheObjeto($avaliacao, $array);
        $avaliacao->save();
        return $avaliacao->id;
    }


}