<?php

namespace App\Http\Controllers;

use App\Anotacao;
use App\CRUD\AnotacaoCRUD;
use App\CRUD\CRUDCandidato;
use App\CRUD\CurriculoCRUD;
use App\CRUD\IndicacaoCRUD;
use App\CRUD\TarefaCRUD;
use App\Vaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    protected $anotacaoCrud;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->curriculoCrud = new CurriculoCRUD();
        $this->indicacaoCrud = new IndicacaoCRUD();
        $this->tarefaCrud = new TarefaCRUD();
        $this->anotacaoCrud = new AnotacaoCRUD();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vagas = Vaga::limit(10)->get();

        $totalCurriculo = $this->curriculoCrud->getTotal();
        $totalPendentesCurriculo = $this->curriculoCrud->getTotalPendentes();
        $totalIndicacoesPendentes = $this->indicacaoCrud->getCountIndicacoesPendentes();
        //Ajuste do total de baixados -- Modificador por: Matheus Souto
        $totalCurriculoBaixado = $this->curriculoCrud->getTotalBaixados();
        return view('home', ['totCurriculo' => $totalCurriculo,'totalPendentesCurriculo' => $totalPendentesCurriculo,
            'totalIndicacoesPendentes' => $totalIndicacoesPendentes, 'totalCurriculoBaixado' => $totalCurriculoBaixado,
            'vagas' => $vagas]);
    }

    public function addNotation(Request $request)
    {
        $array = $this->montaArrayAnotacao($request);
        $this->anotacaoCrud->create($array);
        $this->registraTarefa(3);
    }

    public function listNotation(Request $request)
    {
        $anotacoes =  $this->anotacaoCrud->listByIdUser();
        return json_decode(json_encode($anotacoes, true));
    }


    public function delNotation(Request $request){
       $this->anotacaoCrud->delete($request->id);
        $this->registraTarefa(4);

    }

    public function openNotation(Request $request){
        $anotacao = $this->anotacaoCrud->findById($request->id);
        return json_decode(json_encode($anotacao, true));
    }

    /**
     * @param Request $request
     * @return array
     */
    private function montaArrayAnotacao(Request $request)
    {
        $array = ["titulo" => "", "anotacao" => ""];
        $array["titulo"] = $request->titulo;
        $array["anotacao"] = $request->texto;
        return $array;
    }
    public function erro(){
        return view ('auth/erro');
    }
}
