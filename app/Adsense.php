<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adsense extends Model
{
    protected $fillable = [
		'code',
		'status',
		'ishome',
		'iscart',
		'isdetail',
		'iswishlist',
		'isviewall',

	];
}
