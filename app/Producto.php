<?php

namespace sisDelivery;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';

    protected $primaryKey = 'idproducto';

    public $timestamps=false;

    protected $fillable =[
    	'idcategoria_producto',        
    	'nombre',
    	'precio',
    	'tiempo_prep',
        'imagen',
    	'estado',
    	'info' 	
    ];

    protected $guarded = [
    	
    ];
}
