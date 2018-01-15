<?php
/**
 * Created by PhpStorm.
 * User: Juliano Sirtori
 * Date: 28/03/2017
 * Time: 13:49
 */

namespace App\CRUD;


use App\Indicacao;
use Illuminate\Support\Facades\DB;

class IndicacaoCRUD
{


    /**
     * @return mixed
     * retorna o total de indicações pendentes
     */
    public function getCountIndicacoesPendentes(){
      return  DB::table('indicacoes')
            ->join('curriculos', 'indicacoes.id_curriculo', '=', 'curriculos.id')
            ->where('curriculos.status','=', 'Em Andamento')
            ->where('tipInd', '=', 'Indicação')->count();

    }

    /**
     * @param array $array
     * salva uma nova indicação
     */
    public function create(array $array)
    {
       $indicacao = new Indicacao();
       $indicacao->id_curriculo = $array["id_curriculo"];
       $indicacao->tipInd = $array["tipCur"];
       $indicacao->nomInd = $array["indicador"];
       $indicacao->save();
    }

    /**
     * @param array $array
     * @param $id_curriculo
     * muda a indicação de um curriculo especifico
     */
    public function update(array $array, $id_curriculo)
    {
        $indicacao = Indicacao::find($id_curriculo);
        $indicacao->id_curriculo = $array["id_curriculo"];
        $indicacao->tipInd = $array["tipCur"];
        $indicacao->nomInd = $array["indicador"];
        $indicacao->save();
    }


    /**
     * @param $id
     * apaga um todas as indicaçãoes de um curriculo especifico
     */
    public function delete($id)
    {
        DB::table('indicacoes')->where('id_curriculo','=',$id)->delete();
    }
}