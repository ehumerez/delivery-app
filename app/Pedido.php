<?php

namespace sisDelivery;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedido';

    protected $primaryKey = 'idpedido';

    public $timestamps=false;

    protected $fillable =[
    	'fecha_creacion',
        'tiempo_entrega',
    	'tiempo_total',
        'monto',		 	
    	'observaciones',
        'ci_empleado',
    	'idcliente',
    	'idzona',
        'idestado',
    	'condicion'    	 
    ];

    protected $guarded = [
    	
    ];
}
