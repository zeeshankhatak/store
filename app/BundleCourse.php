<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BundleCourse extends Model
{
    protected $table = 'bundle_courses';

    protected $fillable = ['user_id', 'course_id', 'title', 'detail', 'price', 'discount_price', 'type', 'slug', 'status', 'featured', 'preview_image'];

    protected $casts = [
    	'course_id' => 'array'
    ];

    public function courses()
    {
    	return $this->belongsTo('App\Course','course_id','id');
    }

    public function User()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }

    public function order()
    {
        return $this->hasMany('App\Order','bundle_id');
    }
}
