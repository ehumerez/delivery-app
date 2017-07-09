<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {	
        return view('auth/login');
});

//Route::get('layouts/master', 'MenuController@index');
// Laravel agrupa en una sola ruta resource y q liga a un controlador con las peticiones index, create, edit, show, store, update, destroy
Route::resource('productos/categoria','CategoriaProductoController');
Route::resource('productos/producto','ProductoController');

Route::resource('delivery/categoria_cliente','CategoriaClienteController');
Route::resource('delivery/cliente','ClienteController');
Route::resource('delivery/estado_pedido','EstadoPedidoController');
Route::resource('delivery/pedido','PedidoController');
Route::resource('delivery/zona','ZonaController');

Route::resource('usuarios/rol','RolController');
Route::resource('usuarios/empleado','EmpleadoController');
//Route::resource('delivery/ubicacion_cliente','UbicacionClienteController');
/////////////////////////////////////////////////////
Route::resource('productosc/producto','ProductoCController');

Route::resource('deliveryc/cliente','ClienteCController');
Route::resource('deliveryc/pedido','PedidoCController');
/////////////////////////////////////////////////////
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/{slug?}', 'HomeController@index');

Route::group(['middleware'=>['admin']],function() {
    Route::get('/layouts/master',function(){
        echo "Tienes acceso";
    })->middleware('admin');
});

Route::group(['middleware'=>['client']],function() {
    Route::get('admin',function(){
        echo "Tienes acceso";
    })->middleware('client');
});