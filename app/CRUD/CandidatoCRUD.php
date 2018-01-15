<?php
/**
 * Created by PhpStorm.
 * User: Juliano Sirtori
 * Date: 22/05/2017
 * Time: 16:32
 */

namespace App\CRUD;


class CandidatoCRUD
{
    public function getCandidato(Request $request, $idCurriculo)
    {
        $candidato = new Candidato();
        $candidato->curriculo = Curriculo::where( 'id', '=', $idCurriculo )->get();
        $candidato->conhecimentos = Conhecimento::where( 'id_curriculo', '=', $idCurriculo )->get();
        $candidato->experiencias = Experiencia::where( 'id_curriculo', '=', $idCurriculo )->get();
        $candidato->indicacoes = Indicacao::where( 'id_curriculo', '=', $idCurriculo )->orderBy( 'created_at', 'desc' )->get();
        return $candidato;
    }

}