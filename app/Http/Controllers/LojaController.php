<?php
/**
 * Created by PhpStorm.
 * User: julianosirtori
 * Date: 08/10/17
 * Time: 12:58
 */

namespace App\Http\Controllers;


use App\CRUD\LojaCRUD;
use App\Loja;
use Illuminate\Http\Request;

class LojaController extends Controller
{

    public function index(Request $request)
    {
        $lojas = Loja::all();
        $loja = new Loja();

        if($request->id != null){
            if($request->isMethod("post")){
                $crud = new LojaCRUD();
                $crud->update($request->loja, $request->id);
                return redirect()->route( 'loja');
            }

            $loja = Loja::find($request->id);
        }

        return view( 'loja.index', ['lojas' => $lojas, 'lojaUp' => $loja]);
    }

    public function cadastro(Request $request){
        $crud = new LojaCRUD();
        $crud->create($request->loja);

        return redirect()->route( 'loja');

    }

    public function apagar(Request $request){
        $loja = Loja::find($request->id);
        $loja->delete();

    }
}