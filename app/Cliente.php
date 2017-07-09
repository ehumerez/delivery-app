<?php

namespace sisDelivery;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';

    protected $primaryKey = 'idcliente';

    public $timestamps=false;

    protected $fillable =[
    	'idcategoria_cliente',
    	'ci',
    	'nombre',
    	'apellido',
    	'tel_fijo',
    	'celular',
    	'email',
        'latitud',
        'longitud',
        'direccion',
        'estado'
    ];

    protected $guarded = [
    	
    ];
}
