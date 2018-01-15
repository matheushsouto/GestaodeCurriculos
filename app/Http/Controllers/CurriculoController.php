<?php

namespace App\Http\Controllers;

use App\Avaliacao;
use App\Candidato;
use App\Cargo;
use App\Conhecimento;
use App\Consulta;
use App\CRUD\ConhecimentoCRUD;
use App\CRUD\CurriculoCRUD;
use App\CRUD\ExperienciaCRUD;
use App\CRUD\IndicacaoCRUD;
use App\CRUD\TarefaCRUD;
use App\Curriculo;
use App\Entrevista;
use App\Experiencia;
use App\Indicacao;
use App\Uteis\Filtros;
use App\Vaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

/**
 * Class CurriculoController
 * @package App\Http\Controllers
 * Querdido eu do futuro, me desculpe, eu não consigo nem começar a dizer o quão disapontado eu estou
 */
class CurriculoController extends Controller
{

    protected $experienciaCrud;
    protected $conhecimentoCrud;
    protected $indicacaoCrud;

    protected $curriculo;
    protected $conhecimentos;
    protected $experiencias;

    /**
     * CurriculoController constructor.
     */
    public function __construct()
    {
        $this->middleware( 'auth' );
        $this->curriculoCrud = new CurriculoCRUD();
        $this->indicacaoCrud = new IndicacaoCRUD();
        $this->tarefaCrud = new TarefaCRUD();
        $this->experienciaCrud = new ExperienciaCRUD();
        $this->conhecimentoCrud = new ConhecimentoCRUD();
        $this->indicacaoCrud = new IndicacaoCRUD();

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $cargos = Cargo::orderBy('descricao')->get();

        return view( 'curriculo.cadastro', ['cargos' => $cargos] );
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @param Request $request
     * metodo que é chamadod quando é acessado rota list_all
     */
    public function listAll(Request $request)
    {
        return view('curriculo.list', ['tipo' => $request->tipo]);
    }

    public function listAllExperiencia(Request $request)
    {
        return view('curriculo.list_experiencia', ['tipo' => $request->tipo]);
    }

    /**
     * @param Request $request
     * @return mixed
     * metodo que alimenta tabela via ajax
     */
    public function showCurriculos(Request $request)
    {
        $curriculos = $this->curriculoCrud->getDataTables($request->tipo);
        $dataTables = Datatables::of( $curriculos )
            ->filterColumn( 'id_curriculo', function ($query, $keyword) {
                $query->whereRaw( "CONCAT(curriculos.id,'-',curriculos.id) like ?", ["%{$keyword}%"] );})->make( true );
        return $dataTables;
    }

    public function showCurriculosExperiencia(Request $request)
    {
        $curriculos = $this->curriculoCrud->getDataTablesExperiencia($request->tipo);
        $dataTables = Datatables::of( $curriculos )
            ->filterColumn( 'id_curriculo', function ($query, $keyword) {
                $query->whereRaw( "CONCAT(curriculos.id,'-',curriculos.id) like ?", ["%{$keyword}%"] );})->make( true );
        return $dataTables;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * metodo é chamado quando na tela de show curriculo é adicionado uma nova vaga
     */
    public function addStatus(Request $request)
    {
        $this->curriculoCrud->saveStatus( $request->id, $request->status );
        $this->curriculoCrud->saveVaga( $request->id, $request->vaga_id );
        return redirect()->route( 'curriculo_show', ['id' => $request->id] );
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * metodo é chamado quando é submetido o formulario da tela cadastrar curricolo, essea abaixo cadatra um novo curriculo
     */
    public function form(Request $request)
    {

        $cargos = Cargo::orderBy('descricao')->get();

        if($this->validaFormulario( $request) != null){
            return $this->validaFormulario( $request);
        }
        $this->salvaCampos( 'create', 2, $request );
        return view( 'curriculo.cadastro', ['salvou' => true, 'cargos' => $cargos] );
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * metodo é chamado quando é submetido o formulario da tela cadastrar curricolo, modificando um curriculo
     * existente
     */
    public function update(Request $request)
    {
        if($this->validaFormulario( $request) != null){
            return $this->validaFormulario( $request);
        }
        $id = $this->salvaCampos( 'update', 5, $request );
        return redirect()->route( 'curriculo_show', ['id' => $id] );
    }


    /**
     * @param Request $request
     * @return mixed
     * metodo  chamado por uma rota via ajax, como parametro o cpf retornando um json que é
     * usado para preencher os campos da tela cadastro curriculo
     */
    public function gelAllByCpf(Request $request)
    {
        if (isset( $request->cpf )) {
            $idCurriculo = $this->curriculoCrud->findCurriculoByCPF( $request->cpf );
            if (isset( $idCurriculo )) {
                $candidato = $this->getCandidato( $request, $idCurriculo );
                return json_decode( json_encode( $candidato ), true );
            }
        }
        return null;
    }

    //metodo que epreenche o curriculo
    public function gelAllById(Request $request)
    {
        if (isset( $request->id )) {
            $candidato = $this->getCandidato( $request, $request->id );
            return json_decode( json_encode( $candidato ), true );
        }
        return null;

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * metodo é responsavel por apagar um curriculo, possui uma rota referenciando ele que é chamado quando o
     * usuario clica no botao apagar na tela show
     */

    public function delete(Request $request)
    {
        $this->curriculoCrud->delete( $request->id );
        $this->registraTarefa( 6 );
        return redirect()->route( 'curriculo_listall', ['tipo' => 'todos'] );
    }

    /**
     * @param Request $request
     * @return mixed
     * metodo é usado para verificar a existencia de um RG,  é usado quando, no cadastro, ja existe um cpf
     */
    public function verificaRG(Request $request)
    {
        $verifica = $this->curriculoCrud->findByRg( $request->cpf, $request->rg );
        if (isset( $verifica->nome )) {
            return $verifica->nome;
        }
    }


    /**
     * @param Request $request
     * @return mixed
     * metodo usado para gerar um pdf e exibir na tela
     */
    public function pdf(Request $request)
    {
        //refatorar
        list( $curriculo, $conhecimentos, $experiencias, $indicacao, $consulta, $entrevista ) = $this->montaCurriculoCompleto( $request );
        if ($request->documentos == "false") {
            $documentos = null;
        } else {
            $documentos = true;
        }
        if ($request->indicacao == "false") {
            $indicacao = null;
        }
        if ($request->consulta == "false") {
            $consulta = null;
        }
        if ($request->conhecimento == "false") {
            $conhecimentos = null;
        }
        if ($request->experiencia == "false") {
            $experiencias = null;
        }
        if ($request->entrevista == "false") {
            $experiencias = null;
        }

        $pdf = \PDF::loadView( 'curriculo.showPdf', ['curriculo' => $curriculo, 'conhecimentos' => $conhecimentos,
            'experiencias' => $experiencias, 'indicacao' => $indicacao, 'consultas' => $consulta, 'documentos' => $documentos,
            'entrevista' => $entrevista] );
        return $pdf->stream();
        /*
        return view('curriculo.showPdf', ['curriculo' => $curriculo, 'conhecimentos' => $conhecimentos,
            'experiencias' => $experiencias, 'indicacao' => $indicacao, 'consultas' => $consulta, 'documentos' => $documentos,
            'entrevista' => $entrevista]);
           */
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * metodo é chamada atraves de uma rota, gerando a tela que exibe todos
     * os dados do candidato cadastrados no sistema
     */
    public function show(Request $request)
    {

        $vagas = Vaga::orderBy('descricao')->get();

        list( $curriculo, $conhecimentos, $experiencias, $indicacao, $consulta, $entrevista, $avaliacao ) = $this->montaCurriculoCompleto( $request );
        return view( 'curriculo.show', ['curriculo' => $curriculo, 'conhecimentos' => $conhecimentos,
            'experiencias' => $experiencias, 'indicacao' => $indicacao, 'consultas' => $consulta,
            'entrevista' => $entrevista, 'avaliacao' => $avaliacao, 'vagas' => $vagas] );
    }


    /**
     * @param Request $request
     * @return mixed
     * metodo tem como objetivo validar as informalções enviadas via form, da tela cadastro curriculo
     */
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

    /**
     * @param Request $request
     * @return bool
     * metodo chamado nos metodo para salvar um curriculo
     */
    protected function salvaCurriculo(Request $request, $acao)
    {
        $crud = new CurriculoCRUD();
        if ($acao == 'create') {
            $id = $crud->create( $request->curriculo );
        } else {
            $id = $crud->update( $request->curriculo, $request->id );
        }
        return $id;

    }

    /**
     * @param Request $request
     * metodo é chamado para salvar as experiencias cadastraadas pelo usuario
     */
    protected function salvaExperiencias(Request $request, $id_curriculo)
    {
        //refatorar
        $this->experienciaCrud->delete( $id_curriculo ); // apaga se houver outras experiencias
        for ($i = 0; $i < 3; $i++) {
            $array = ["id_curriculo" => 0, "empresa" => " ", "funcao" => " ", "entSai" => " ", "motSai" => " ", "id_curriculo" => " "];
            foreach (array_keys( $array ) as $key) {
                if (strcmp( "id_curriculo", "$key" )) {
                    if (isset( $request->all()[$key][$i] )) {
                        $array[$key] = $request->all()[$key][$i];
                    }
                } else {
                    $array["id_curriculo"] = $id_curriculo;
                }
            }
            $aux = trim( $array["empresa"] );
            if (!empty( $aux )) {
                $this->experienciaCrud->create( $array );
            }
        }
    }

    /**
     * @param Request $request
     * @param $id_curriculo
     * salva indicação
     */
    protected function salvaIndicacao(Request $request, $id_curriculo)
    {
        //refatorar
        if (isset( $request->indicador )) {
            $indicador = $request->indicador;
        } else {
            $indicador = "Sem indicação";
        }
        $array = ["tipCur" => $request->tipCur, "indicador" => $indicador, "id_curriculo" => $id_curriculo];
        $this->indicacaoCrud->delete( $id_curriculo );
        $this->indicacaoCrud->create( $array );
    }


    /**
     * @param Request $request
     * @param $id_curriculo
     * salva os conhecimentos cadastrados
     */
    protected function salvaConhecimento(Request $request, $id_curriculo)
    {
        $this->conhecimentoCrud->deleteAllByIdCurriculo( $id_curriculo ); //apaga todos os conhecimentos e cadastra os novoas
        $array = ["acougue", "padaria", "informatica", "confeitaria"];
        foreach ($array as $conhecimento) {
            if (isset( $request->all()["$conhecimento"] )) {
                $this->conhecimentoCrud->create( ["conhecimento" => $conhecimento, "id_curriculo" => $id_curriculo] );
            }
        }
    }

    /**
     * @param Request $request
     * @return array
     * metodo responsavel por montar os dados necessarios para exibir o curriculo na tela show
     */
    private function montaCurriculoCompleto(Request $request)
    {
        //metodo todo precisa ser refatorado, talvez precisa colocar para uma nova classe
        $curriculo = Curriculo::where( 'id', '=', $request->id )->first();
        $datNasc = explode( "-", $curriculo['datNasc'] );
        $curriculo['datNasc'] = $datNasc[2] . "/" . $datNasc[1] . "/" . $datNasc[0];
        $datNasc = explode( "-", $curriculo['dat_ficha'] );
        $curriculo['dat_ficha'] = $datNasc[2] . "/" . $datNasc[1] . "/" . $datNasc[0];
        $conhecimentos = Conhecimento::where( 'id_curriculo', '=', $request->id )->get();
        $experiencias = Experiencia::where( 'id_curriculo', '=', $request->id )->get();
        $indicacao = Indicacao::where( 'id_curriculo', '=', $request->id )->orderBy( 'created_at', 'desc' )->first();
        $consulta = Consulta::where( 'id_curriculo', '=', $request->id )->get();
        $entrevista = Entrevista::where( 'id_curriculo', '=', $request->id )->first();
        $avaliacao = Avaliacao::where( 'id_curriculo', '=', $request->id )->first();
        return array($curriculo, $conhecimentos, $experiencias, $indicacao, $consulta, $entrevista, $avaliacao);
    }

    /**
     * @param $acao
     * @param $tarefa
     * @param Request $request
     * metodo ussado tanto para salvar no metodo form ou para modificar no metodo update dependte dos parametros
     * passados para ele
     */
    protected function salvaCampos($acao, $tarefa, Request $request)
    {

        $id_curriculo = $this->salvaCurriculo( $request, $acao );
        $this->salvaExperiencias( $request, $id_curriculo );
        $this->salvaIndicacao( $request, $id_curriculo );
        $this->salvaConhecimento( $request, $id_curriculo );
        $this->registraTarefa( $tarefa );

        return $id_curriculo;
    }

    /**
     * @param Request $request
     * @param $idCurriculo
     * @return Candidato
     * pega as informações do candidato, usado para gerar o json no metodo getAllByCPF
     */
    protected function getCandidato(Request $request, $idCurriculo)
    {
        $candidato = new Candidato();
        $candidato->curriculo = Curriculo::where( 'id', '=', $idCurriculo )->get();
        $candidato->conhecimentos = Conhecimento::where( 'id_curriculo', '=', $idCurriculo )->get();
        $candidato->experiencias = Experiencia::where( 'id_curriculo', '=', $idCurriculo )->get();
        $candidato->indicacoes = Indicacao::where( 'id_curriculo', '=', $idCurriculo )->orderBy( 'created_at', 'desc' )->get();
        return $candidato;
    }
}
