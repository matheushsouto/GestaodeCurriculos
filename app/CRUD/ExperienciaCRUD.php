<?php
/**
 * Created by PhpStorm.
 * User: Juliano Sirtori
 * Date: 28/03/2017
 * Time: 10:34
 */

namespace App\CRUD;


use App\Experiencia;
use Illuminate\Support\Facades\DB;

class ExperienciaCRUD
{


    /**
     * @param array $array
     * salva uma nova experiencia
     */
    public function create(array $array)
    {
        $experiencia = new Experiencia();
        $experiencia->id_curriculo = $array['id_curriculo'];
        $experiencia->empresa = $array['empresa'];
        $experiencia->funcao = $array['funcao'];
        $experiencia->entSai = $array['entSai'];
        $experiencia->motSai = $array['motSai'];
        $experiencia->save();
    }


    /**
     * @param $id_curriculo
     * apaga uma experiencia
     */
    public function delete($id_curriculo)
    {
      DB::table('experiencias')->where('id_curriculo', '=', $id_curriculo)->delete();
    }


}