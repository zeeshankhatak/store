<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    public function state(){
    	return $this->belongsTo('App\State','state_id','state_id');
    }

    public function country(){
    	return $this->belongsTo('App\Country','country_id','country_id');
    }
}
