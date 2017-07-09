<?php

namespace sisDelivery\Http\Controllers;

use Illuminate\Http\Request;

use sisDelivery\app\Http\Requests\EstadoPedidoFormRequest;

use sisDelivery\EstadoPedido;
//use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
//use sisVentas\Http\Requests\CategoriaFormRequest;
use DB;
class EstadoPedidoController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function index(Request $request) {
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$estados=DB::table('estado_pedido')->where('descripcion','LIKE','%'.$query.'%')
    		->orderBy('idestado','asc')
    		->paginate(7);
    		return view('delivery.estado_pedido.index',["estados"=>$estados,"searchText"=>$query]);
    	}
    }

    public function create() {
    	return view('delivery.estado_pedido.create');
    }

    public function store(Request $request) {
    	$estados = new EstadoPedido;
    	$estados->descripcion = $request->get('descripcion');
    	$estados->save();
    	return Redirect::to('delivery/estado_pedido');
    }

    public function show($id) {
    	return view('delivery.estado_pedido.show',["estado_pedido"=>EstadoPedido::findOrFail($id)]);
    }

    public function edit($id) {
    	return view('delivery.estado_pedido.edit',["estado_pedido"=>EstadoPedido::findOrFail($id)]);
    }

    public function update(Request $request,$id) {
    	$estados= EstadoPedido::findOrFail($id);
    	$estados->descripcion = $request->get('descripcion');
    	$estados->update();
    	return Redirect::to('delivery/estado_pedido');
    }

    public function destroy($id) {
    	//EstadoPedido::where($id)->delete($id);
        $estados = EstadoPedido::findOrFail($id);        
        $estados->delete($id);
    	return Redirect::to('delivery/estado_pedido');
    }
}
