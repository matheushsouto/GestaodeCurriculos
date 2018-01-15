<?php
/**
 * Created by PhpStorm.
 * User: julianosirtori
 * Date: 08/10/17
 * Time: 12:58
 */

namespace App\Http\Controllers;


use App\Cargo;
use App\CRUD\CargoCRUD;
use Illuminate\Http\Request;

class CargoController extends Controller
{

    public function index(Request $request)
    {

        $cargos = Cargo::orderBy('descricao')->get();
        $cargo = new Cargo();

        if($request->id != null){
            if($request->isMethod("post")){
                $crud = new CargoCRUD();
                $crud->update($request->cargo, $request->id);
                return redirect()->route( 'cargo');
            }

            $cargo = Cargo::find($request->id);
        }

        return view( 'cargo.index', ['cargos' => $cargos, 'cargoUp' => $cargo]);
    }




    public function cadastro(Request $request){
        $crud = new CargoCRUD();
        $crud->create($request->cargo);

        return redirect()->route( 'cargo');

    }

    public function apagar(Request $request){
        $cargo = Cargo::find($request->id);
        $cargo->delete();

    }

}