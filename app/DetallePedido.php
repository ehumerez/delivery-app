<?php

namespace sisDelivery;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $table = 'detalle';

    protected $primaryKey = 'iddetalle';

    public $timestamps=false;

    protected $fillable =[ 
        'idpedido',
        'idproducto',   	
    	'cantidad',
        'sub_total',
        'tiempo_parcial'   	 
    ];

    protected $guarded = [
    	
    ];
}
