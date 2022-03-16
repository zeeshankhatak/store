<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GamingHours extends Model
{
    protected $table = "gaming_hours";
    protected $fillable = ['hours'];
}
