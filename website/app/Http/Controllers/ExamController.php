<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    //quiz data for exam
    function get_exam_quiz($course_id)
    {
        return DB::table('exam_quiz')->where('course_id', $course_id)->inRandomOrder()->get();
    }
}
