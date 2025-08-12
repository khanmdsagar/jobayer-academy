<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $table    = 'course_category';
    protected $fillable = ['category_name', 'category_slug'];

    public function course()
    {
        return $this->hasMany(Course::class, 'category_id', 'id');
    }
}
