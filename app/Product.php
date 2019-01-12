<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
    	'name',
    	'peso_unit',
    	'price',
    	'quantity_for_box',
    	'medida',
    	'image',
    ];

    public function inventory(){
    	return $this->hasOne(Inventory::class);
    }
}
