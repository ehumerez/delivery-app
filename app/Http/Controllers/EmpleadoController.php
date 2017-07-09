<?php

namespace sisDelivery\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use sisDelivery\Http\Requests;
use sisDelivery\Empleado;//Modelo Cliente
use sisDelivery\Rol;
use sisDelivery\Http\Requests\EmpleadoFormRequest;//Request
use DB;//Base de Datos
class EmpleadoController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    public function index(Request $request){
    	if ($request) {

    		$query=trim($request->get('searchText'));    		
    		$empleados=DB::table('empleado as e')
    		->join('rol as r','e.idrol','r.idrol')
    		->select('e.ci','e.nombre','e.apellido','r.descripcion','e.email','e.direccion','e.telefono','e.estado')            
    		->where('e.nombre','LIKE','%'.$query.'%')    		
    		//->where('e.estado','=','Activo')
            ->orwhere('e.ci','LIKE','%'.$query.'%')  		    	
            ->orderBy('e.ci','asc')
    		->paginate(7);
    		
    		return view('usuarios.empleado.index',["empleados"=>$empleados,"searchText"=>$query]);
    	
        }
    }
    public function create(){
        $roles = DB::table('rol')->get();
    	return view("usuarios.empleado.create",['roles'=>$roles]);
    }
    /*store: Para almacenar
        Esta funcion es llamada con el 'method'=>'POST'
    */
    public function store(Request $request){
    	$empleado = new Empleado;   	
        $empleado->ci=$request->get('ci');
        $empleado->idrol=$request->get('idrol');
    	$empleado->nombre=$request->get('nombre');
    	$empleado->apellido=$request->get('apellido');    	
    	$empleado->email=$request->get('email'); 
    	$empleado->direccion=$request->get('direccion'); 
    	$empleado->telefono=$request->get('telefono');    	     	   
    	$empleado->estado="Activo";    
    	$empleado->save();
    	return Redirect::to('usuarios/empleado');
    }
    public function show($id){
    	return view("usuarios.empleado.show",["empleado"=>empleado::findOrFail($id)]);
    }
    public function edit($id){
        $roles = DB::table('rol')->get();
    	return view("usuarios.empleado.edit",["empleado"=>Empleado::findOrFail($id),'roles'=>$roles]);
    }
    public function update(Request $request,$id){
    	$empleado = Empleado::findOrFail($id);
    	
    	$empleado->ci=$request->get('ci');
        $empleado->idrol=$request->get('idrol');
    	$empleado->nombre=$request->get('nombre');
    	$empleado->apellido=$request->get('apellido');    	
    	$empleado->email=$request->get('email'); 
    	$empleado->direccion=$request->get('direccion'); 
    	$empleado->telefono=$request->get('telefono');     
    	$empleado->update();
    	
    	return Redirect::to('usuarios/empleado');
    }
    public function destroy($id){
    	$empleado = Empleado::findOrFail($id);
    	$empleado->estado='Inactivo';    	
    	$empleado->update();
    	return Redirect::to('usuarios/empleado');
    }
}
