<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = "clients";

    protected $fillable = [
		'code_rif',
		'name_bussines',
		'name',
		'address',
		'phone',
		'email',
		'tax'
    ];
}
