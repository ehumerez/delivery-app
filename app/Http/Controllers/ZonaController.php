<?php

namespace sisDelivery\Http\Controllers;

use Illuminate\Http\Request;

use sisDelivery\app\Http\Requests\ZonaFormRequest;

use sisDelivery\Zona;
//use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
//use sisVentas\Http\Requests\CategoriaFormRequest;
use DB;
class ZonaController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function index(Request $request) {
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$zonas=DB::table('zona')->where('descripcion','LIKE','%'.$query.'%')
    		->orderBy('idzona','asc')
    		->paginate(7);
    		return view('delivery.zona.index',["zonas"=>$zonas,"searchText"=>$query]);
    	}
    }

    public function create() {
    	return view('delivery.zona.create');
    }

    public function store(Request $request) {
    	$zona = new Zona;
    	$zona->descripcion = $request->get('descripcion');
    	$zona->costo_envio = $request->get('costo_envio');
    	$zona->tiempo_entrega = $request->get('tiempo_entrega');
    	$zona->save();
    	return Redirect::to('delivery/zona');
    }

    public function show($id) {
    	return view('delivery.zona.show',["zona"=>Zona::findOrFail($id)]);
    }

    public function edit($id) {
    	return view('delivery.zona.edit',["zona"=>Zona::findOrFail($id)]);
    }

    public function update(Request $request,$id) {
    	$zona= Zona::findOrFail($id);
    	$zona->descripcion = $request->get('descripcion');
    	$zona->costo_envio = $request->get('costo_envio');
    	$zona->tiempo_entrega = $request->get('tiempo_entrega');
    	$zona->update();
    	return Redirect::to('delivery/zona');
    }

    public function destroy($id) {
    	//Zona::where($id)->delete($id);

        $zona = Zona::findOrFail($id);        
        $zona->delete($id);
    	return Redirect::to('delivery/zona');
    }
}
