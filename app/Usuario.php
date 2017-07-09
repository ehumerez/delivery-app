<?php

namespace sisDelivery;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';

    protected $primaryKey = 'idusuario';

    public $timestamps=false;

    protected $fillable =[
    	'usuario',
    	'contrasena',
    	'ci_empleado',
    	'idcliente'    	
    ];

    protected $guarded = [
    	
    ];
}
