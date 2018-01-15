<?php
/**
 * Created by PhpStorm.
 * User: julianosirtori
 * Date: 08/10/17
 * Time: 12:59
 */

namespace App\Http\Controllers;

use App\Cargo;
use App\CRUD\VagaCRUD;
use App\Curriculo;
use App\Loja;
use App\Vaga;
use Illuminate\Http\Request;

class VagaController extends Controller
{

    public function index(Request $request)
    {

        $lojas = Loja::orderBy('nome')->get();;
        $cargos = Cargo::orderBy('descricao')->get();
        $vagas = Vaga::orderBy('status')->orderBy('descricao')->get();;

        $vaga = new Vaga();

        if ($request->id != null) {
            if ($request->isMethod("post")) {
                $crud = new VagaCRUD();
                $crud->update($request->vaga, $request->id);
                return redirect()->route('vaga');
            }

            $vaga = Vaga::find($request->id);
        }

        return view('vaga.index', [
            'vaga' => $vaga,
            'vagas' => $vagas,
            'cargos' => $cargos,
            'lojas' => $lojas]);
    }


    public function cadastro(Request $request)
    {
        $crud = new VagaCRUD();
        $crud->create($request->vaga);

        return redirect()->route('vaga');

    }

    public function apagar(Request $request)
    {


        $vaga = Vaga::find($request->id);

        $vaga->delete();

    }
}