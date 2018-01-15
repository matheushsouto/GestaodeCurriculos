<?php
/**
 * Created by PhpStorm.
 * User: Juliano Sirtori
 * Date: 28/03/2017
 * Time: 10:33
 */

namespace App\CRUD;


use App\Curriculo;
use App\Uteis\Filtros;
use App\Vaga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CurriculoCRUD extends CRUD
{

    /**
     * OBS: REFATORAR JUNTO COM O CONTROLLER CURRICULO
     */

    /**
     * @return mixed
     * retorna o total de curriculos salvos
     */
    public function getTotal(){
        return DB::table('curriculos')->count();
    }

    /**
     * @param array $array
     * @return mixed
     * cria um novo curriculo e retorna seu id
     */
    public function create(array $array)
    {
        $curriculo = new Curriculo();
        $array['status'] = 'Em Andamento';
        $array['etapa'] = 'Cadastro';
       return $this->preencheObjeto($curriculo,$array);
    }

    /**
     * @param $object
     * @param $array
     * @return mixed
     * sobreescre o metodo da classe pai, adicionando o id do usuario, que fez a modificação
     */
    public function preencheObjeto($object, $array)
    {
        $curriculo = parent::preencheObjeto( $object, $array );
        $curriculo->id_user = Auth::id();
        $curriculo->save();
        return $curriculo->id;
    }

    /**
     * @param array $array
     * @param $id_curriculo
     * @return mixed
     * faz um update no curriculo
     */
    public function update(array $array, $id_curriculo)
    {
        $curriculo = Curriculo::find($id_curriculo);
        return $this->preencheObjeto( $curriculo, $array );
    }


    /**
     * @param $cpf
     * @return null
     * retorna um id do cpf especificado
     */
    public function findCurriculoByCPF($cpf){
       $curriculo = Curriculo::where('cpf', $cpf)->first();
       if($curriculo == null){
           return null;
       }
       return $curriculo->id;
    }


    /**
     * @param $cpf
     * @param $rg
     * @return mixed -> retorna id igual ao cpf especificado
     */
    public function findByRg($cpf, $rg){
       return DB::table('curriculos')
            ->where("cpf", "=", $cpf)
            ->where("rg", "=", $rg)->first();
    }

    /**
     * @param $id
     * @return mixed -> Curriculo igual ao id especificado
     */
    public function findById($id)
    {
        return Curriculo::find($id)->toArray();
    }

    /**
     * @param $id -> id do Curriculo que deseja apagar
     */
    public function delete($id)
    {
       DB::table('curriculos')->where('id', '=', $id)->delete();
    }

    /**
     * @return integer -> retorna a aquantidade de curriculos pendentes no sistema
     */
    public function  getTotalPendentes(){

        return Curriculo::where('status', '=', 'Em Andamento')->count();
    }

    /**
     * @return integer -> retorna a quantidade de curriculos baixados
     */
    public function getTotalBaixados(){
        return Curriculo::whereIn('status',['Aprovado','Reprovado', 'Em Espera','Contratado'])->count();

    }

    public function getDataTables($tipo){
        return Curriculo::join( 'indicacoes', 'curriculos.id', '=', 'indicacoes.id_curriculo' )
            ->join( 'cargos', 'curriculos.cargo_id', '=', 'cargos.id' )
            ->select( ['curriculos.id','cpf',
                'nome', 'bairro', 'datNasc', 'escolaridade', 'cargos.descricao as cargo', 'status', 'nomInd', 'tipInd', 'curriculos.created_at'] )
            ->whereIn( 'curriculos.status',  Filtros::$tabela[$tipo]['status'] )
            ->whereIn( 'curriculos.etapa',  Filtros::$tabela[$tipo]['etapa'] )
            ->whereIn( 'indicacoes.tipInd', Filtros::$tabela[$tipo]['indicacao'] )
            ->orderBy( 'curriculos.created_at', 'desc' );
    }

    public function getDataTablesExperiencia($tipo){
        return Curriculo::join( 'indicacoes', 'curriculos.id', '=', 'indicacoes.id_curriculo' )
            ->join( 'cargos', 'curriculos.cargo_id', '=', 'cargos.id' )
            ->join( 'experiencias', 'curriculos.id', '=', 'experiencias.id_curriculo' )
            ->select( ['curriculos.id','cpf', 'nome', 'bairro', 'datNasc', 'escolaridade', 'cargos.descricao as cargo', 'status', 'tipInd',
                'curriculos.created_at', 'empresa', 'experiencias.funcao','entSai', 'motSai' ] )
            ->whereIn( 'curriculos.status',  Filtros::$tabela[$tipo]['status'] )
            ->whereIn( 'curriculos.etapa',  Filtros::$tabela[$tipo]['etapa'] )
            ->whereIn( 'indicacoes.tipInd', Filtros::$tabela[$tipo]['indicacao'] )
            ->orderBy( 'curriculos.created_at', 'desc' );
    }

    /**
     * @param $id
     * @param $valor
     * altera o campo status no curriculo igual ao id especificado
     */
    public function saveStatus($id, $valor){
       parent::mudaCampoCurriculo($id, $valor, 'status');
    }

    /**
     * @param $id
     * @param $valor
     * altera o campo vaga no curriculo igual ao id especificado
     */
    public function saveVaga($id, $valor){

        // busca a vaga
        $vaga = Vaga::find($valor);
        //busca o curriculo
        $curriculo = Curriculo::find($id);

        // verifica a ultima vaga que tinha sido atribuida para aquele usuario
        $old_vaga_id =  $curriculo->vaga_id;

        if($old_vaga_id == null){ // se não existe ele ja atribui menos um na quantia
            $vaga->quantidade = $vaga->quantidade -1;

        } else if($old_vaga_id != $valor){ // verefica se a ultima vaga é diferente da atribuida

            $old_vaga = Vaga::find($old_vaga_id);
            $old_vaga->quantidade = $old_vaga->quantidade + 1;
            if($old_vaga->quantidade > 0){
                $old_vaga->status = "aberto";
            }
            $vaga->quantidade = $vaga->quantidade -1;
            $old_vaga->save();
        }


        if($vaga->quantidade <= 0){
            $vaga->status = "fechado";
        }

        $vaga->save();


        // mudar o campos na tabela curriculo
        parent::mudaCampoCurriculo($id, $valor, 'vaga_id');
    }

}