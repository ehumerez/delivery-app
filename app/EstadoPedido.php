<?php

namespace sisDelivery;

use Illuminate\Database\Eloquent\Model;

class EstadoPedido extends Model
{
    protected $table = 'estado_pedido';

    protected $primaryKey = 'idestado';

    public $timestamps=false;

    protected $fillable =[
    	'descripcion'
    ];

    protected $guarded = [
    	
    ];
}
