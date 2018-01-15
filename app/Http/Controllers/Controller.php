<?php

namespace App\Http\Controllers;

use App\CRUD\HistoriTarefaCRUD;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $curriculoCrud;
    protected $indicacaoCrud;
    protected $tarefaCrud;

    //refatorar depois
    public function registraTarefa($id_tarefa){
        $array = ['id_tarefa'=>$id_tarefa];
        $crudHistoricoTarefa = new HistoriTarefaCRUD();
        $crudHistoricoTarefa->create($array);
    }
}
