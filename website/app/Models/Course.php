<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model 
{
    protected $table = 'course';
    
    protected $fillable = [
        'course_name', 
        'course_fee',
        'course_discount',
        'course_slug',
        'course_duration',
        'course_level',
        'course_image',
        'course_description',
        'course_status',
        'course_created_at'
    ];

    public function combo_purchase()
    {
        return $this->hasMany(ComboPurchase::class);
    }

    public function enrolled_course(){
        return $this->hasMany(EnrolledCourse::class);
    }

    public function course_chapter(){
        return $this->hasMany(CourseChapter::class);
    }

    public function instructor(){
        return $this->belongsTo(Instructor::class);
    }

    public function course_review()
    {
        return $this->hasMany(CourseReview::class, 'course_id');
    }
}
