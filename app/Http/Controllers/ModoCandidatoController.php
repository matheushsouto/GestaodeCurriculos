<?php

namespace App\Http\Controllers;

use App\CRUD\ConhecimentoCRUD;
use App\CRUD\CurriculoCRUD;
use App\CRUD\ExperienciaCRUD;
use App\CRUD\IndicacaoCRUD;
use App\CRUD\TarefaCRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModoCandidatoController extends CurriculoController
{


    /**
     * ModoCandidatoController constructor.
     */
    //gamiara do cpf arrumar depois
    public function __construct()
    {
        $this->curriculoCrud = new CurriculoCRUD();
        $this->indicacaoCrud = new IndicacaoCRUD();
        $this->tarefaCrud = new TarefaCRUD();
        $this->experienciaCrud = new ExperienciaCRUD();
        $this->conhecimentoCrud = new ConhecimentoCRUD();
        $this->indicacaoCrud = new IndicacaoCRUD();
    }

    public function modoCandidato(Request $request)
    {
        Auth::logout();
        if ($request->salvou == "1"){
            return view( 'curriculo.modo_candidato', ['salvou' => true] );
        }
        return view( 'curriculo.modo_candidato' );
    }

    public function form(Request $request)
    {
        if($this->validaFormulario( $request) != null){
            return $this->validaFormulario( $request);
        }
        $this->salvaCampos( 'create', 2, $request );
        return view( 'curriculo.modo_candidato', ['salvou' => true] );
    }

    public function update(Request $request)
    {
        if($this->validaFormulario( $request) != null){
            return $this->validaFormulario( $request);
        }
        $this->salvaCampos( 'update', 5, $request );

        return redirect()->route('curriculo_cadastro_modocandidato',['salvou'=> true]);
    }

    public function registraTarefa($id_tarefa){

    }

    protected function validaFormulario(Request $request)
    {
        //refatorar depois
        $inputs = $request->except( '_token' );
        $rules = array(
            'curriculo.nome' => 'required',
            'curriculo.trabSupe' => 'required',
            'curriculo.dat_ficha' => 'required',
            'curriculo.fone' => 'required',
            'curriculo.datNasc' => 'required',
            'curriculo.rua' => 'required',
            'curriculo.bairro' => 'required',
            'curriculo.cidade' => 'required',
            'curriculo.escolaridade' => 'required'
        );
        $validator = \Illuminate\Support\Facades\Validator::make( $inputs, $rules );
        if ($validator->fails()) {
            // voltar para trás e enviar os erros, regras ($rules), que não foram respeitadas
            return redirect()->back()->withInput()->withErrors( $validator );
        }
        return null;
    }



}
