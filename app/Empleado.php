<?php

namespace sisDelivery;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleado';

    protected $primaryKey = 'ci';

    public $timestamps=false;

    protected $fillable =[ 
    	'idrol',  
    	'nombre',
    	'apellido',    	
    	'email',
        'direccion',
        'telefono',
        'estado'
    ];

    protected $guarded = [
    	
    ];
}
