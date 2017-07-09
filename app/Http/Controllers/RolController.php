<?php

namespace sisDelivery\Http\Controllers;

use Illuminate\Http\Request;
use sisDelivery\app\Http\Requests\RolFormRequest;

use sisDelivery\Rol;
//use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
//use sisVentas\Http\Requests\CategoriaFormRequest;
use DB;

class RolController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function index(Request $request) {
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$roles=DB::table('rol')->where('descripcion','LIKE','%'.$query.'%')
    		->orderBy('idrol','asc')
    		->paginate(7);
    		return view('usuarios.rol.index',["roles"=>$roles,"searchText"=>$query]);
    	}
    }

    public function create() {
    	return view('usuarios.rol.create');
    }

    public function store(Request $request) {
    	$rol = new Rol;
    	$rol->descripcion = $request->get('descripcion');
    	$rol->save();
    	return Redirect::to('usuarios/rol');
    }

    public function show($id) {
    	return view('usuarios.rol.show',["rol"=>Rol::findOrFail($id)]);
    }

    public function edit($id) {
    	return view('usuarios.rol.edit',["rol"=>Rol::findOrFail($id)]);
    }

    public function update(Request $request,$id) {
    	$rol= Rol::findOrFail($id);
    	$rol->descripcion = $request->get('descripcion');
    	$rol->update();
    	return Redirect::to('usuarios/rol');
    }

    public function destroy($id) {
    	//Rol::where($id)->delete($id);

        $rol = Rol::findOrFail($id);        
        $rol->delete($id);
    	return Redirect::to('usuarios/rol');
    }
}
