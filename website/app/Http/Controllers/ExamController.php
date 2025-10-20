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

    //mark exam started
    function mark_exam_started($course_id)
    {
        $student_id = Session::get('user_id');

        DB::table('enrolled_course')
            ->where('student_id', $student_id)
            ->where('course_id', $course_id)
            ->update(['is_attended_exam' => 1]);
    }

    //check exam participation
    function check_exam_participation($course_id)
    {
        $student_id = Session::get('user_id');
        $enrollment = DB::table('enrolled_course')
            ->where('student_id', $student_id)
            ->where('course_id', $course_id)
            ->first();
        if ($enrollment && $enrollment->is_attended_exam) {
            return response()->json(['has_participated' => true]);
        } else {
            return response()->json(['has_participated' => false]);
        }
    }

    //submit exam result
    function submit_exam_result(Request $request, $course_id)
    {
        $student_id = Session::get('user_id');
        $score = $request->input('score');  
        
        DB::table('enrolled_course')
            ->where('student_id', $student_id)
            ->where('course_id', $course_id)
            ->update(['exam_mark' => $score]);
    }
}
