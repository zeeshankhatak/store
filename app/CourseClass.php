<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CourseClass extends Model
{
    //use HasTranslations;
    
    public $translatable = ['title'];

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
      $attributes = parent::toArray();
      
      foreach ($this->getTranslatableAttributes() as $name) {
          $attributes[$name] = $this->getTranslation($name, app()->getLocale());
      }
      
      return $attributes;
    } 

    protected $table = 'course_classes'; 

    protected $fillable = [
        'course_id', 'coursechapter_id', 'title', 'duration', 'featured', 'status','url',
        'size','image','video','pdf','zip', 'preview_video', 'date_time'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function courses()
    {
        return $this->belongsTo('App\Course','course_id','id');
    }   

	  public function coursechapters()
    {
    	return $this->belongsTo('App\CourseChapter','coursechapter_id','id');
    }
     
    public function viewprocess()
    {
     return $this->hasMany('App\ViewProcess','courseclass_id');
    }

    public function subtitle()
    {
      return $this->hasMany('App\Subtitle','c_id');
    }
}
