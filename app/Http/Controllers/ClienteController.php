<?php

namespace sisDelivery\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use sisDelivery\Http\Requests;
use sisDelivery\Cliente;//Modelo Cliente
use sisDelivery\CategoriaCliente;
use sisDelivery\Http\Requests\ClienteFormRequest;//Request
use DB;//Base de Datos

class ClienteController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    public function index(Request $request){
    	if ($request) {

    		$query=trim($request->get('searchText'));    		
    		$clientes=DB::table('cliente as c')
    		->join('categoria_cliente as cc','c.idcategoria_cliente','cc.idcategoria_cliente')
    		->select('c.idcliente','c.ci','c.nombre','c.apellido','c.tel_fijo','c.celular','c.email','cc.descripcion','c.longitud','c.latitud','c.direccion','c.estado')            
    		->where('c.nombre','LIKE','%'.$query.'%')    		
    		//->where('c.estado','=','Activo')
            ->orwhere('c.ci','LIKE','%'.$query.'%')
    		->orwhere('c.celular','LIKE','%'.$query.'%')   		    	
            ->orderBy('c.idcliente','asc')
    		->paginate(7);
    		
    		return view('delivery.cliente.index',["clientes"=>$clientes,"searchText"=>$query]);
    	
        }
    }
    public function create(){
        $categoria_clientes = DB::table('categoria_cliente')->get();
    	return view("delivery.cliente.create",['categoria_clientes'=>$categoria_clientes]);
    }
    /*store: Para almacenar
        Esta funcion es llamada con el 'method'=>'POST'
    */
    public function store(Request $request){
    	$Cliente = new Cliente;    	
        $Cliente->idcategoria_cliente=$request->get('idcategoria_cliente');
    	$Cliente->nombre=$request->get('nombre');
    	$Cliente->apellido=$request->get('apellido');
    	$Cliente->ci =$request->get('ci');
    	$Cliente->tel_fijo=$request->get('tel_fijo');
    	$Cliente->celular=$request->get('celular');  	
    	$Cliente->email=$request->get('email');
        $Cliente->direccion=$request->get('direccion');
        $Cliente->longitud=$request->get('longitud');     
        $Cliente->latitud=$request->get('latitud');     
    	$Cliente->estado="Activo";    
    	$Cliente->save();
    	return Redirect::to('delivery/cliente');
    }
    public function show($id){
    	return view("delivery.cliente.show",["cliente"=>Cliente::findOrFail($id)]);
    }
    public function edit($id){
        $categoria_clientes = DB::table('categoria_cliente')->get();
    	return view("delivery.cliente.edit",["cliente"=>Cliente::findOrFail($id),'categoria_clientes'=>$categoria_clientes]);
    }
    public function update(Request $request,$id){
    	$Cliente = Cliente::findOrFail($id);
    	
    	$Cliente->nombre=$request->get('nombre');
    	$Cliente->apellido=$request->get('apellido');
    	$Cliente->ci=$request->get('ci');
    	$Cliente->telefonofijo=$request->get('telefonofijo');
    	$Cliente->celular=$request->get('celular');  	
    	$Cliente->email=$request->get('email');     
    	$Cliente->update();
    	
    	return Redirect::to('delivery/cliente');
    }
    public function destroy($id){
    	$Cliente = Cliente::findOrFail($id);
    	$Cliente->estado='Inactivo';    	
    	$Cliente->update();
    	return Redirect::to('delivery/cliente');
    }
}
