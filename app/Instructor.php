<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
	protected $table = 'fps_coach_gaming_details';

    // protected $fillable = [ 'user_id', 'fname', 'lname', 'email', 'language', 'dob', 'mobile', 'gender', 'detail', 'file', 'image', 'status', 'gamer_tag', 'discord_tag', 'want_to_coach', 'rank', 'organization', 'death_ratio', 'win_ratio', 'links' ];

    protected $fillable = [ 'coach_id', 'game_id', 'coach_rank_id', 'is_organization_assigned', 'k_d_ratio', 'win_rate', 'gamer_tag', 'discord_tag', 'total_kills', 'total_death', 'good_coach_desc', 'rate', 'play_on', 'social_links'];


    public function courses()
    {
        return $this->hasMany('App\Course','user_id');

    }

    public function user()
    {
        return $this->belongsTo('App\User','coach_id','id');
    }
}
