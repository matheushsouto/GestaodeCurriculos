<?php

namespace App\Http\Controllers;

use App\CRUD\ConsultaCRUD;
use App\CRUD\CurriculoCRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultaController extends Controller
{

    private $consultaCrud;

    /**
     * ConsultaController constructor.
     */
    public function __construct()
    {
        $this->middleware( 'auth' );
        $this->curriculoCrud = new CurriculoCRUD();
        $this->consultaCrud = new ConsultaCRUD();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * metodo principal que direciona as ações e retorna as views com os valores da consultas
     */
    public function cadastro(Request $request)
    {
        $curriculo = $this->curriculoCrud->findById( $request->id );
        $consultas = $this->consultaCrud->findByIdCurriculo( $request->id );
        if ($request->method() == "GET") {
            return view( 'consulta.form', ['curriculo' => $curriculo, 'consultas' => $consultas] );
        }
        $this->consultaCrud->delete( $request->id );
        $this->salvaConsultas( $request );
        return redirect()->route( 'curriculo_show', ['id' => $request->id] );

    }

    /**
     * @param Request $request
     */
    private function salvaConsultas(Request $request)
    {
        for ($i = 0; $i < $request->contador + 1; $i++) {
            $this->salvaConsulta( $request, $i );
        }
    }

    /**
     * @param Request $request
     * @param $i
     */
    private function salvaConsulta(Request $request, $i)
    {
        $array = ["id_curriculo" => 0, "fontConsu" => "", "resConsu" => " "];
        $array = $this->populaArrayConsulta( $request, $i, $array );
        $aux = trim( $array["fontConsu"] );
        if (!empty( $aux )) {
            $this->consultaCrud->create( $array );
        }
    }

    /**
     * @param Request $request
     * @param $i
     * @param $array
     * @return mixed
     */
    private function populaArrayConsulta(Request $request, $i, $array)
    {
        foreach (array_keys( $array ) as $key) {
            if (strcmp( "id_curriculo", "$key" )) {
                if ($this->existeObjeto( $request, $i, $key )) {
                    $array[$key] = $request->all()[$key][$i];
                }
            } else {
                $array["id_curriculo"] = $request->id;
            }
        }
        return $array;
    }

    /**
     * @param Request $request
     * @param $i
     * @param $key
     * @return bool
     */
    private function existeObjeto(Request $request, $i, $key)
    {
        return isset( $request->all()[$key][$i] );
    }

}
