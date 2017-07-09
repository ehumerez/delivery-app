<?php

namespace sisDelivery;

use Illuminate\Database\Eloquent\Model;

class ProductoCombo extends Model
{
    protected $table = 'producto_combo';

    protected $primaryKey = 'idproducto_combo';

    public $timestamps=false;

    protected $fillable =[
    	'idcombo',
    	'idproducto',    	
    	'cantidad'
    ];

    protected $guarded = [
    	
    ];
}
