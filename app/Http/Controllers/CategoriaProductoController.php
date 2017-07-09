<?php

namespace sisDelivery\Http\Controllers;

use Illuminate\Http\Request;
use sisDelivery\app\Http\Requests\CategoriaProductoFormRequest;

use sisDelivery\CategoriaProducto;
//use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
//use sisVentas\Http\Requests\CategoriaFormRequest;
use DB;
class CategoriaProductoController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function index(Request $request) {
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$categorias=DB::table('categoria_producto')->where('descripcion','LIKE','%'.$query.'%')
    		->orderBy('idcategoria_producto','asc')
    		->paginate(7);
    		return view('productos.categoria.index',["categorias"=>$categorias,"searchText"=>$query]);
    	}
    }

    public function create() {
    	return view('productos.categoria.create');
    }

    public function store(Request $request) {
    	$categoria_producto = new CategoriaProducto;
    	$categoria_producto->descripcion = $request->get('descripcion');
    	$categoria_producto->save();
    	return Redirect::to('productos/categoria');
    }

    public function show($id) {
    	return view('productos.categoria.show',["categoria"=>CategoriaProducto::findOrFail($id)]);
    }

    public function edit($id) {
    	return view('productos.categoria.edit',["categoria"=>CategoriaProducto::findOrFail($id)]);
    }

    public function update(Request $request,$id) {
    	$categoria_producto= CategoriaProducto::findOrFail($id);
    	$categoria_producto->descripcion = $request->get('descripcion');
    	$categoria_producto->update();
    	return Redirect::to('productos/categoria');
    }

    public function destroy($id) {
    	//CategoriaProducto::where($id)->delete($id);

        $categoria_producto = CategoriaProducto::findOrFail($id);        
        $categoria_producto->delete($id);
    	return Redirect::to('productos/categoria');
    }
}
