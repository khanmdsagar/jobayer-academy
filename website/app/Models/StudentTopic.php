<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentTopic extends Model
{
    protected $table = 'student_topic';

    public function course_chapter()
    {
        return $this->belongsTo(CourseChapter::class);
    }
}
