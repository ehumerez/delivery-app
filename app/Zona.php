<?php

namespace sisDelivery;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $table = 'zona';

    protected $primaryKey = 'idzona';

    public $timestamps=false;

    protected $fillable =[
    	'descripcion',
    	'costo_envio',
    	'tiempo_entrega'
    ];

    protected $guarded = [
    	
    ];
}
