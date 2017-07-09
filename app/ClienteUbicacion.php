<?php

namespace sisDelivery;

use Illuminate\Database\Eloquent\Model;

class ClienteUbicacion extends Model
{
    protected $table = 'cliente_ubicacion';

    protected $primaryKey = 'idcliente_ubicacion';

    public $timestamps=false;

    protected $fillable =[
    	'idcliente',
    	'idubicacion',    	
    ];

    protected $guarded = [
    	
    ];
}
