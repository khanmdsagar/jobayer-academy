<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseChapter extends Model
{
    protected $table = 'course_chapter';
    protected $fillable = ['chapter_name', 'course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function chapter_topic()
    {
        return $this->hasMany(ChapterTopic::class, 'chapter_id');
    }

    public function student_topic()
    {
        return $this->hasMany(StudentTopic::class, 'chapter_id');
    }
}
