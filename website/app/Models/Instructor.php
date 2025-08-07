<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $table = 'instructor';

    protected $fillable = [
        'instructor_name',
        'instructor_photo',
        'instructor_designation',
    ];

    public function course()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }
}
