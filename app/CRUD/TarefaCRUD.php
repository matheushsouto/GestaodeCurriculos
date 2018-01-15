<?php
/**
 * Created by PhpStorm.
 * User: Juliano Sirtori
 * Date: 06/04/2017
 * Time: 14:53
 */

namespace App\CRUD;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TarefaCRUD
{
    /**
     * @param $limit
     * @return mixed
     * lista as ultiomas $limit tarefas
     */
    public function getAllLimit($limit){
        return DB::table('historico_tarefas')
            ->join('tarefas', 'historico_tarefas.id_tarefa', '=', 'tarefas.id')
            ->select('tarefa', 'created_at')
            ->where('id_user', '=', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }


}