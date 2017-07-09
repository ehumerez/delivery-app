<?php

namespace sisDelivery;

use Illuminate\Database\Eloquent\Model;

class UbicacionCliente extends Model
{
    protected $table = 'ubicacion';

    protected $primaryKey = 'idubicacion';

    public $timestamps=false;

    protected $fillable =[
    	'descripcion',
    	'latitud',
    	'longitud',
    	'ubicacion_actual'
    ];

    protected $guarded = [
    	
    ];
}
