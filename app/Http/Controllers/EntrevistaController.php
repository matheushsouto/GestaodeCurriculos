<?php

namespace App\Http\Controllers;

use App\CRUD\CurriculoCRUD;
use App\CRUD\IntrevistaCRUD;
use App\Curriculo;
use App\Entrevista;
use Illuminate\Http\Request;

class EntrevistaController extends Controller
{


    /**
     * EntrevistaController constructor.
     */
    public $entrevistaCrud;

    public function __construct()
    {
        $this->entrevistaCrud = new IntrevistaCRUD();
        $this->curriculoCrud = new CurriculoCRUD();
    }

    public function cadastro(Request $request)
    {
        if ($request->isMethod( 'post' )) {

            $validator = $this->validaFormulario( $request, 'create' );
            if ($validator->fails()) {
                // voltar para trás e enviar os erros, regras ($rules), que não foram respeitadas
                return redirect()->back()->withInput()->withErrors( $validator );
            }
            $array = $request->curriculo;
            $array['etapa'] = 'entrevista';
            $this->curriculoCrud->update( $array, $request->id );
            $this->entrevistaCrud->create( $request->entrevista );
            return redirect()->route('curriculo_show', ['id'=>$request->id]);
        }
        $curriculo = Curriculo::find( $request->id )->toArray();
        $entrevista = Entrevista::where('id_curriculo', '=', $request->id)->get()->toArray();
        return view( 'entrevista.form', ['curriculo' => $curriculo, 'entrevista' => $entrevista] );
        
    }

    protected function validaFormulario(Request $request, $acao)
    {
        //refatorar depois
        $inputs = $request->except( '_token' );
        $rules = array(
            'curriculo.nome' => 'required',
            'curriculo.anos' => 'required',
            'curriculo.foneRec' => 'required',
            'curriculo.fone' => 'required',
            'curriculo.cpf' => 'required',
            'curriculo.rg' => 'required',
            'curriculo.nomePai' => 'required',
            'curriculo.profPai' => 'required',
            'curriculo.nomeMae' => 'required',
            'curriculo.profMae' => 'required'
        );
        $validator = \Illuminate\Support\Facades\Validator::make( $inputs, $rules );
        return $validator;
    }

    //refatorar depois
    public function editar(Request $request){
        if ($request->isMethod( 'post' )) {

            $validator = $this->validaFormulario( $request, 'create' );
            if ($validator->fails()) {
                // voltar para trás e enviar os erros, regras ($rules), que não foram respeitadas
                return redirect()->back()->withInput()->withErrors( $validator );
            }
            $this->curriculoCrud->update( $request->curriculo, $request->id );

            $this->entrevistaCrud->update( $request->entrevista, $request->dados['id']);
            return redirect()->route('curriculo_show', ['id'=>$request->id]);
        }
        return redirect()->route('curriculo_show', ['id'=>$request->id]);
    }

}
