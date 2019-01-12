<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    protected $table = "formulas";

    protected $fillable = [
		'product_id',
		'materia_prima'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'materia_prima');
    }

}
