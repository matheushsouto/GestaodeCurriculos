<?php
/**
 * Created by PhpStorm.
 * User: Juliano Sirtori
 * Date: 06/04/2017
 * Time: 15:00
 */

namespace App\CRUD;


use App\HistorioTarefas;
use Illuminate\Support\Facades\Auth;

class HistoriTarefaCRUD
{
    /**
     * @param array $array
     * salva uma nova historiaTarefa
     */
    public function create(array $array)
    {
        $historioTarefa = new HistorioTarefas();
        $historioTarefa->id_user = Auth::id();
        $historioTarefa->id_tarefa = $array['id_tarefa'];
        $historioTarefa->save();
    }

}