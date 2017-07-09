<?php

namespace sisDelivery\Http\Controllers;

use Illuminate\Http\Request;

use sisDelivery\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisDelivery\Http\Request\PedidoFormRequest;
use sisDelivery\Pedido;
use sisDelivery\DetallePedido;
use sisDelivery\Zona;
use sisDelivery\Cliente;
use sisDelivery\Empleado;
use sisDelivery\EstadoPedido;
use sisDelivery\Rol;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use DB;
class PedidoCController extends Controller
{
    public function __construct() {
    	$this->middleware('client');
    }

    public function index(Request $request) {
    	if ($request) {
    		$query = trim($request->get('searchText'));
            
            $pedidos=DB::table('pedido as p')
            ->join('cliente as c','c.idcliente','=','p.idcliente')
            //->join('empleado as e','e.ci','=','p.ci_empleado')
            ->join('estado_pedido as ep','ep.idestado','=','p.idestado')
            ->join('zona as z','z.idzona','=','p.idzona')
    		->select('p.idpedido','c.nombre','c.apellido','p.fecha_creacion','p.monto','p.tiempo_total','p.tiempo_entrega','z.descripcion as zona','ep.descripcion')
    		->where('c.nombre','LIKE','%'.$query.'%')
            ->orwhere('c.apellido','LIKE','%'.$query.'%')
    		->orderBy('p.fecha_creacion','desc')
    		->paginate(7);
    		return view('deliveryc.pedido.index',["pedidos"=>$pedidos,"searchText"=>$query]);
    	}
    }

    public function create() {
        $clientes = DB::table('cliente')->get();
        /*$empleados = DB::table('empleado as e')
        ->join('rol as r','r.idrol','=','e.idrol')
        ->get();*/
        $zonas = DB::table('zona')->get();        
        $productos = DB::table('producto as prod')           
            ->where('prod.estado','=','Activo')
            ->get();        
    	return view('deliveryc.pedido.create',["clientes"=>$clientes,"productos"=>$productos,"zonas"=>$zonas]);
    }

    // El parámetro de tipo Request debe ser cambiado por ProductoFormRequest para validar los datos ingresados
    public function store(Request $request) {
        try {
            
            DB::beginTransaction();
            $pedido = new Pedido;
            $my_time = Carbon::now('America/La_Paz');
            $pedido->fecha_creacion = $my_time->toDateTimeString();
            $pedido->monto = $request->get('monto');
            $pedido->tiempo_entrega = $request->get('tiempo_pedido');
            $pedido->tiempo_total = $request->get('tiempo_entrega');
            $pedido->observaciones = $request->get('observaciones');
            $pedido->ci_empleado = 0;
            //$pedido->idcliente = $request->get('didcliente');
            $pedido->idcliente = 7;
            $pedido->idzona = $request->get('didzona');            
            $pedido->idestado = 1;
            $pedido->condicion = 'Activo';
            $pedido->save();
            
            
            $idproducto = $request->get('pidproducto');
            $cantidad = $request->get('pcantidad');
            $pprecio = $request->get('pprecio');
            $ptiempo_prep = $request->get('ptiempo_prep');
            //$precio = $request->get('idproducto');
            //$tiempo_prep = $request->get('idproducto');
            
            $cont = 0;
            while ($cont < count($idproducto)) {
                $DetallePedido = new DetallePedido;
                $DetallePedido->idpedido=$pedido->idpedido;
                $DetallePedido->idproducto=$idproducto[$cont];
                $DetallePedido->cantidad=$cantidad[$cont];
                $DetallePedido->sub_total=$pprecio[$cont] * $cantidad[$cont];
                $DetallePedido->tiempo_parcial=$ptiempo_prep[$cont] * $cantidad[$cont];
                $DetallePedido->save();
                $cont=$cont+1;
            }    
                   
            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
        }
    	
    	return Redirect::to('deliveryc/pedido');
    }

    public function show($id) {
        $pedido = Pedido::findOrFail($id);
        $cliente = Cliente::findOrFail($pedido->idcliente);     
        $empleado = DB::table('empleado as e')
        ->join('rol as r','r.idrol','=','e.idrol')
        ->select('e.nombre','e.apellido','r.descripcion')
        ->where('e.ci','=',$pedido->ci_empleado)
        ->first();

        $zona = Zona::findOrFail($pedido->idzona);
        $estado_pedido = EstadoPedido::findOrFail($pedido->idestado);
        $detalle = DB::table('detalle as d')
        ->join('producto as p','d.idproducto','=','p.idproducto')
        ->select('p.nombre','d.cantidad','p.precio','p.tiempo_prep','d.sub_total','d.tiempo_parcial')
        ->where('idpedido','=',$pedido->idpedido)
        ->get();
        return view('deliveryc.pedido.show',["pedido"=>$pedido,"cliente"=>$cliente,"empleado"=>$empleado,"zona"=>$zona,"estado_pedido"=>$estado_pedido,"detalle"=>$detalle]);
    }

    public function edit($id) {
        $pedido = Pedido::findOrFail($id);
        $cliente = Cliente::findOrFail($pedido->idcliente);
        $zona = Zona::findOrFail($pedido->idzona);
        $estado_pedidos = DB::table('estado_pedido')->get();
    	return view('deliveryc.pedido.edit',["pedido"=>$pedido,"estado_pedidos"=>$estado_pedidos,"cliente"=>$cliente,"zona"=>$zona]);
    }

    public function update(Request $request, $id) {
        $pedido = Pedido::findOrFail($id);
        $pedido->idestado = $request->get('idestado');
        $pedido->update();
        return Redirect::to('deliveryc/pedido');
    }

    /*public function destroy($id) {    	

        $pedido = Pedido::findOrFail($id);        
        $pedido->condicion = 'Inactivo';
        $pedido->update();
    	return Redirect::to('delivery/pedido');
    }*/
}
