<?php
/**
 * Created by PhpStorm.
 * User: Juliano Sirtori
 * Date: 22/05/2017
 * Time: 10:12
 */

namespace App\Uteis;


/**
 * Class FiltroTabela
 * @package App\Uteis
 * classe responsavel por armazenar os filtros para as tabelas
 */
class Filtros
{

    /*
     *  refatorar depois
     *  const STATUS = ["Em Andamento", "Aprovado", "Reprovado", "Em Espera"];
     *   const ETAPA = ["cadastro", "consulta", "entrevista", "avaliacao", "concluido"];
     */

    public static $tabela = [
        "todos" => [
            "status" => ["Em Andamento", "Aprovado", "Reprovado", "Em Espera","Contratado"],
            "etapa" => ["cadastro", "consulta", "entrevista", "avaliacao", "concluido"],
            "indicacao" => ["Normal","Indicação"],
        ],
        "pendentes" => [
            "status" => ["Em Andamento"],
            "etapa" => ["cadastro", "consulta", "entrevista", "avaliacao"],
            "indicacao" => ["Normal", "Indicação"],
        ],
        "baixados" => [
            "status" => ["Aprovado", "Reprovado", "Em Espera","Contratado"],
            "etapa" => ["cadastro", "consulta", "entrevista", "avaliacao", "concluido"],
            "indicacao" => ["Normal", "Indicação"],
        ],
        "indicados" => [
            "status" => ["Em Andamento", "Aprovado", "Reprovado", "Em Espera"],
            "etapa" => ["cadastro", "consulta", "entrevista", "avaliacao", "concluido"],
            "indicacao" => ["Indicação"],
        ],
        "consulta" => [
            "status" => ["Em Andamento"],
            "etapa" => ["cadastro"],
            "indicacao" => ["Indicação", "Normal"],
        ],
        "entrevista" => [
            "status" => ["Em Andamento"],
            "etapa" => ["consulta"],
            "indicacao" => ["Indicação", "Normal"]
        ],
        "avaliacao" => [
            "status" => ["Em Andamento"],
            "etapa" => ["entrevista"],
            "indicacao" => ["Indicação", "Normal"]
        ],

    ];


}