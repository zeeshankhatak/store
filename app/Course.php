<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Course extends Model
{
    //use HasTranslations;
    
    public $translatable = ['title', 'short_detail', 'detail', 'requirement'];

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

    protected $table = 'courses';  

    protected $fillable = [
        'category_id','childcategory_id','subcategory_id', 'language_id', 'user_id', 'title','short_detail', 'detail',  'price', 'discount_price','day','video', 'video_url', 'featured','requirement','url','slug','status','preview_image', 'type', 'preview_type', 'duration'
    ];

    public function chapter()
    {
    	return $this->hasMany('App\CourseChapter','course_id');
    }

    public function whatlearns()
    {
        return $this->hasMany('App\WhatLearn','course_id');
    }

    public function include()
    {
        return $this->hasMany('App\CourseInclude','course_id');
    }

    public function related()
    {
        return $this->hasMany('App\RelatedCourse','course_id');
    }

    public function question()
    {
        return $this->hasMany('App\Question','course_id');
    }

    public function answer()
    {
        return $this->hasMany('App\Answer','course_id');
    }

    public function announsment()
    {
        return $this->hasMany('App\Announcement','course_id');
    }

    public function courseclass()
    {
        return $this->hasMany('App\CourseClass','course_id');
    }

    public function favourite()
    {
        return $this->hasMany('App\Favourite','course_id');
    }

    public function wishlist()
    {
        return $this->hasMany('App\Wishlist','course_id');
    }

    public function review()
    {
        return $this->hasMany('App\ReviewRating','course_id');
    }

    public function reportreview()
    {
        return $this->hasMany('App\ReportReview','course_id');
    }

    public function instructor()
    {
        return $this->hasMany('App\Question','instructor_id');
    }

    public function order()
    {
        return $this->hasMany('App\Order','course_id');
    }

    public function pending()
    {
        return $this->hasMany('App\PendingPayout','course_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Categories','category_id','id');
    }

    public function language()
    {
        return $this->belongsTo('App\CourseLanguage','language_id','id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public static function scopeSearch($query, $searchTerm)
    {
        return $query->where('title', 'like', '%' .$searchTerm. '%');
    }
}
