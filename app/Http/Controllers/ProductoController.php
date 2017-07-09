<?php

namespace sisDelivery\Http\Controllers;

use Illuminate\Http\Request;

use sisDelivery\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisDelivery\Http\Request\ProductoFormRequest;
use sisDelivery\Producto;
use sisDelivery\ProductoCombo;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use DB;

class ProductoController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function index(Request $request) {
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$productos=DB::table('producto as p')
    		->join('categoria_producto as c','p.idcategoria_producto','=','c.idcategoria_producto')
    		->select('p.idproducto','p.nombre','c.descripcion as categoria','p.imagen','p.precio','p.tiempo_prep','info','estado')
    		->where('p.nombre','LIKE','%'.$query.'%')
            ->orwhere('c.descripcion','LIKE','%'.$query.'%')
    		->orderBy('c.descripcion','asc')
    		->paginate(3);
            /*if (Auth::user()->rol==8) {
                return view('productos.producto.index',["productos"=>$productos,"searchText"=>$query]);
            }else {
                return view('productosc.producto.index',["productos"=>$productos,"searchText"=>$query]);
            }*/
    		return view('productos.producto.index',["productos"=>$productos,"searchText"=>$query]);
    	}
    }

    public function create() {
    	$categorias = DB::table('categoria_producto')->get();
        $productos = DB::table('producto as prod')           
            ->where('prod.estado','=','Activo')
            ->get();

        /*if (Auth::user()->rol == 8) {
            return view('productos.producto.create',["categorias"=>$categorias,"productos"=>$productos]);
        } else {
            return view('\layouts\master');
        }*/
    	return view('productos.producto.create',["categorias"=>$categorias,"productos"=>$productos]);
    }

    // El parámetro de tipo Request debe ser cambiado por ProductoFormRequest para validar los datos ingresados
    public function store(Request $request) {
        try {
            
            DB::beginTransaction();
            $producto = new Producto;
            $producto->idcategoria_producto = $request->get('idcategoria_producto');
            $producto->nombre = $request->get('nombre');
            $producto->precio = $request->get('precio');
            $producto->tiempo_prep = $request->get('tiempo_prep');
            $producto->estado = 'Activo';
            $producto->info = $request->get('info');            
            if (Input::hasFile('imagen')) {
                $file=Input::file('imagen');
                $file->move(public_path().'/imagenes/productos/',$file->getClientOriginalName());
                $producto->imagen = $file->getClientOriginalName();
            }
            $producto->save();
            if ($producto->idcategoria_producto == 1) {
            
            $idproducto = $request->get('pidproducto');
            $cantidad = $request->get('pcantidad');
            //$precio = $request->get('idproducto');
            //$tiempo_prep = $request->get('idproducto');
            
                $cont = 0;
                while ($cont < count($idproducto)) {
                    $ProductoCombo = new ProductoCombo;
                    $ProductoCombo->idcombo = $producto->idproducto;
                    $ProductoCombo->idproducto = $idproducto[$cont];
                    $ProductoCombo->cantidad = $cantidad[$cont];
                    $ProductoCombo->save();
                    $cont=$cont+1;
                }    
            }            

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
        }
    	
    	return Redirect::to('productos/producto');
    }

    public function show($id) {
        $producto=DB::table('producto as p')
            ->join('categoria_producto as c','c.idcategoria_producto','=','p.idcategoria_producto')
            ->select('p.idproducto','p.nombre','c.descripcion','p.precio','p.tiempo_prep','p.info')
            ->where('p.idproducto','=',$id)
            ->first();//El método first sirve para hacer que cuando el primer producto q cumpla con el $id
            //sea el primer producto en visualizar

            $producto_combos=DB::table('producto_combo as pcc')
                ->join('producto as pp','pcc.idproducto','=','pp.idproducto')
                ->select('pcc.idproducto as idproductoc','pp.nombre as producto','pcc.cantidad','pp.precio as precioc','pp.tiempo_prep as tiempo_prepc')
                ->where('pcc.idcombo','=',$id)
                ->get();
            return view('productos.producto.show',["producto"=>$producto,"producto_combos"=>$producto_combos]);
    }

    public function edit($id) {
    	$producto = Producto::findOrFail($id);
    	$categorias = DB::table('categoria_producto')->get();
        $productos = DB::table('producto')->get();
        $producto_combos=DB::table('producto_combo as pcc')
                ->join('producto as pp','pcc.idproducto','=','pp.idproducto')
                ->select('pp.nombre as producto','pcc.cantidad','pp.precio as precioc','pp.tiempo_prep as tiempo_prepc')
                ->where('pcc.idcombo','=',$id)
                ->get();
    	return view('productos.producto.edit',["productos"=>$productos,"producto"=>$producto,'categorias'=>$categorias,"producto_combos"=>$producto_combos]);
    }

    // El parámetro de tipo Request debe ser cambiado por ProductoFormRequest para validar los datos ingresados
    public function update(Request $request,$id) {    	

        try {
            
            DB::beginTransaction();
            $producto= Producto::findOrFail($id);
            $producto->idcategoria_producto = $request->get('idcategoria_producto');
            $producto->nombre = $request->get('nombre');
            $producto->precio = $request->get('precio');
            $producto->tiempo_prep = $request->get('tiempo_prep');
            //$producto->estado = 'Activo';
            $producto->info = $request->get('info');            
            if (Input::hasFile('imagen')) {
                $file=Input::file('imagen');
                $file->move(public_path().'/imagenes/productos/',$file->getClientOriginalName());
                $producto->imagen = $file->getClientOriginalName();
            }
            $producto->update();

            if ($producto->idcategoria_producto == 1) {
                            
                $idproducto = $request->get('pidproducto');
                $cantidad = $request->get('pcantidad');
                //$precio = $request->get('idproducto');
                //$tiempo_prep = $request->get('idproducto');          

                $cont = 0;
                while ($cont < count($idproducto)) {
                    $ProductoCombo = new ProductoCombo;
                    $ProductoCombo->idcombo = $producto->idproducto;
                    $ProductoCombo->idproducto = $idproducto[$cont];                
                    $ProductoCombo->cantidad = $cantidad[$cont];
                    $ProductoCombo->update();
                    $cont=$cont+1;
                }
            }
            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
        }
        
        return Redirect::to('productos/producto');
    }

    public function destroy($id) {    	

        $producto = Producto::findOrFail($id);        
        $producto->estado = 'Inactivo';
        $producto->update();
    	return Redirect::to('productos/producto');
    }
}
