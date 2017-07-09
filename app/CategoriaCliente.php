<?php

namespace sisDelivery;

use Illuminate\Database\Eloquent\Model;

class CategoriaCliente extends Model
{
    protected $table = 'categoria_cliente';

    protected $primaryKey = 'idcategoria_cliente';

    public $timestamps=false;

    protected $fillable =[
    	'descripcion',
    	'minimo'
    ];

    protected $guarded = [
    	
    ];
}
