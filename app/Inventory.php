<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
	protected $table = "inventories";

	protected $fillable = [
		'product_id',
		'type_stock_min',
		'quantity',
		'Kg_L',
		'stock_min',
	];

	public function product(){
		return $this->belongsTo(Product::class,'product_id');
	}
}
