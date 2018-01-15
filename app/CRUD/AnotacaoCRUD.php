<?php
/**
 * Created by PhpStorm.
 * User: Juliano Sirtori
 * Date: 04/04/2017
 * Time: 16:58
 */

namespace App\CRUD;


use App\Anotacao;
use Illuminate\Support\Facades\Auth;

class AnotacaoCRUD extends CRUD
{

    /**
     * @param array $array -> o array deve ser do tipo dicionario com as chaves iguais ao nome do banco
     * salva uma nova anotação
     */
    public function create(array $array)
    {
        $anotacao = new Anotacao();
        $anotacao->id_user = Auth::id();
        $anotacao->titulo = $array['titulo'];
        $anotacao->anotacao = $array['anotacao'];
        $anotacao->save();
    }


    /**
     * @return mixed -> retorna todas as anotações de um usuario
     */
    public function listByIdUser(){
       return Anotacao::where('id_user', '=', Auth::id())
            ->select('id', 'titulo','created_at')
            ->orderBy('created_at', 'desc')->get();
    }

    /**
     * @param $id -> id do usuario
     * @return mixed -> retorna a anotação com o id igual ao especificado
     * pega somente uma anotação com um id especifico
     */
    public function findById($id)
    {
      return  Anotacao::where('id', '=', $id)->get();
    }

    /**
     * @param $id
     * apaga uma anotação
     */
    public function delete($id)
    {
        Anotacao::find($id)->delete();
    }
}