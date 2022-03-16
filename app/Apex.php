<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apex extends Model
{
    protected $table="apexes";
    protected $fillable=[
        'coaching_experience',
        'hours',
        'gaming_experience',
        'gaming_experienceee',
        'coach_A',
        'coach_B',
    ];
}
