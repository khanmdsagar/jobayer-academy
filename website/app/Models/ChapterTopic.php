<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChapterTopic extends Model
{
    protected $table    = 'chapter_topic';
    protected $fillable = ['course_id', 'chapter_id', 'topic_name', 'topic_video'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function courseChapter()
    {
        return $this->belongsTo(CourseChapter::class, 'chapter_id');
    }
}
