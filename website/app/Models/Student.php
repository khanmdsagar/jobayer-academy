<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';

    protected $fillable = ['student_name', 'student_address', 'student_email', 'student_phone', 'student_password', 'created_at'];

    public function course_review()
    {
        return $this->hasMany(CourseReview::class, 'student_id');
    }

    public function enrolled_course()
    {
        return $this->hasMany(EnrolledCourse::class, 'student_id');
    }

    protected $casts = [
        'created_at' => 'date:Y-m-d',
    ];
}
