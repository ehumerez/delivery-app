<?php

namespace sisDelivery\Http\Controllers;

use Illuminate\Http\Request;
use sisDelivery\app\Http\Requests\CategoriaClienteFormRequest;

use sisDelivery\CategoriaCliente;
//use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
//use sisVentas\Http\Requests\CategoriaFormRequest;
use DB;
class CategoriaClienteController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function index(Request $request) {
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$categorias=DB::table('categoria_cliente')->where('descripcion','LIKE','%'.$query.'%')
    		->orderBy('idcategoria_cliente','asc')
    		->paginate(7);
    		return view('delivery.categoria_cliente.index',["categorias"=>$categorias,"searchText"=>$query]);
    	}
    }

    public function create() {
    	return view('delivery.categoria_cliente.create');
    }

    public function store(Request $request) {
    	$categoria_cliente = new CategoriaCliente;
    	$categoria_cliente->descripcion = $request->get('descripcion');
    	$categoria_cliente->minimo = $request->get('minimo');
    	$categoria_cliente->save();
    	return Redirect::to('delivery/categoria_cliente');
    }

    public function show($id) {
    	return view('delivery.categoria_cliente.show',["categoria"=>CategoriaCliente::findOrFail($id)]);
    }

    public function edit($id) {
    	return view('delivery.categoria_cliente.edit',["categoria"=>CategoriaCliente::findOrFail($id)]);
    }

    public function update(Request $request,$id) {
    	$categoria_cliente= CategoriaCliente::findOrFail($id);
    	$categoria_cliente->descripcion = $request->get('descripcion');
    	$categoria_cliente->minimo = $request->get('minimo');
    	$categoria_cliente->update();
    	return Redirect::to('delivery/categoria_cliente');
    }

    public function destroy($id) {
    	//CategoriaCliente::where($id)->delete($id);
    	///revisar
        $categoria_cliente = CategoriaCliente::findOrFail($id);        
        $categoria_cliente->delete($id);
    	return Redirect::to('delivery/categoria_cliente');
    }
}
