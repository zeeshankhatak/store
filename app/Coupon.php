<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;
	protected $table = 'fps_coupans';

    protected $fillable = [
      'coupan_type','coupan_code','gamer_id','amount_type','amount','status'
    ];

    public function cate (){
     	return $this->belongsTo("App\Categories","category_id");
    }

    public function product (){
     	return $this->belongsTo("App\Course","course_id");
    }
}
