<?php

namespace App\Http\Controllers;

use App\Avaliacao;
use App\Conhecimento;
use App\Consulta;
use App\CRUD\AvaliacaoCRUD;
use App\Curriculo;
use App\Entrevista;
use App\Experiencia;
use App\Indicacao;
use App\Mail\CurriculoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AvaliacaoController extends Controller
{
    protected $avaliacaoCRUD;

    /**
     * AvaliacaoController constructor.
     */
    public function __construct()
    {
        $this->middleware( 'auth' );
        $this->avaliacaoCRUD = new AvaliacaoCRUD();

    }

    public function cadastro(Request $request)
    {

        if ($request->isMethod( 'post' )) {

            $this->avaliacaoCRUD->create( $request->avaliacoes );
            return redirect()->route( 'curriculo_show', ['id' => $request->avaliacoes['id_curriculo']] );
        } else {
            $curriculo = Curriculo::where( 'id', '=', $request->id )->first();
            $avaliacao = Avaliacao::where( 'id_curriculo', '=', $request->id )->get()->toArray();
            return view( 'resultado.form', ['curriculo' => $curriculo, 'avaliacao' => $avaliacao] );
        }
    }

    public function editar(Request $request)
    {
        $this->avaliacaoCRUD->update( $request->avaliacoes, $request->id );
        return redirect()->route( 'curriculo_show', ['id' => $request->avaliacoes['id_curriculo']] );
    }


    public function email(Request $request)
    {
        /*TODO QUASE TODO O  CODIGO ABAIXO FOI COPIADO DO CURRICULOCONTROLER, QUANDO FINALIZAR DEVERA SER FEITA
        TODA REFATORAZAO*/

        //metodo todo precisa ser refatorado, talvez precisa colocar para uma nova classe
        $curriculo = Curriculo::where( 'id', '=', $request->email['id'] )->first();
        //  $datNasc = explode( "-", $curriculo['datNasc'] );
        //  $curriculo['datNasc'] = $datNasc[2] . "/" . $datNasc[1] . "/" . $datNasc[0];
        //  $datNasc = explode( "-", $curriculo['dat_ficha'] );
        //  $curriculo['dat_ficha'] = $datNasc[2] . "/" . $datNasc[1] . "/" . $datNasc[0];
        $conhecimentos = Conhecimento::where( 'id_curriculo', '=', $request->email['id'] )->get();
        $experiencias = Experiencia::where( 'id_curriculo', '=', $request->email['id'] )->get();
        $indicacao = Indicacao::where( 'id_curriculo', '=', $request->email['id'] )->orderBy( 'created_at', 'desc' )->first();
        $consulta = Consulta::where( 'id_curriculo', '=', $request->email['id'] )->get();
        $entrevista = Entrevista::where( 'id_curriculo', '=', $request->id )->first();
        $documentos = true;
        /*
        dd($curriculo);
        dd($conhecimentos);
        dd($indicacao);
        dd($consulta);
        */
        $pdf = \PDF::loadView( 'curriculo.showPdf', ['curriculo' => $curriculo, 'conhecimentos' => $conhecimentos,
            'experiencias' => $experiencias, 'indicacao' => $indicacao, 'consultas' => $consulta, 'documentos' => $documentos,
            'entrevista' => $entrevista] );
        Mail::to( $request->email['email'] )->send( new CurriculoMail($request->email['assunto'], $request->email['mensagem'],
            $pdf->output(), Auth::user()->name));
        return json_encode( Auth::user()->name );
    }
}
