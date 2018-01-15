<?php
/**
 * Created by PhpStorm.
 * User: Juliano Sirtori
 * Date: 28/03/2017
 * Time: 13:48
 */

namespace App\CRUD;


use App\Conhecimento;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ConhecimentoCRUD
{

    /**
     * @param array $array -> o array deve ser do tipo dicionario com as chaves iguais ao nome do banco
     * @return bool
     * metodo salva um conhecimento
     */
    public function create(array $array)
    {
        $conhecimento = new Conhecimento();
        $conhecimento->id_curriculo = $array['id_curriculo'];
        $conhecimento->conhecimento = $array['conhecimento'];
        return $conhecimento->save();

    }

    /**
     * @param $id_curriculo
     * apaga todos os conhecimentos de um id especico
     */
    public function deleteAllByIdCurriculo($id_curriculo)
    {
        DB::table('conhecimentos')->where('id_curriculo', '=', $id_curriculo)->delete();
    }

}