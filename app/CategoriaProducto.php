<?php

namespace sisDelivery;

use Illuminate\Database\Eloquent\Model;

class CategoriaProducto extends Model
{
    protected $table = 'categoria_producto';

    protected $primaryKey = 'idcategoria_producto';

    public $timestamps=false;

    protected $fillable =[
    	'descripcion'
    ];

    protected $guarded = [
    	
    ];
}
