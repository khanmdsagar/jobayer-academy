<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AskedQuestionController extends Controller
{
    function get_asked_question()
    {
        return DB::table('ask_question')
            ->join('course', 'ask_question.course_id', '=', 'course.id')
            ->join('chapter_topic', 'ask_question.topic_id', '=', 'chapter_topic.id')
            ->join('student', 'ask_question.student_id', '=', 'student.id')
            ->select(
                'ask_question.id as question_id',
                'ask_question.*',
                'course.course_name',
                'chapter_topic.topic_name',
                'student.student_name',
                'student.student_number'
            )
            ->orderBy('ask_question.id', 'DESC')
            ->get();
    }

    function delete_asked_question(Request $request)
    {
        $question_id = strip_tags(trim($request->input('question_id')));

        $is_data = DB::table('ask_question')
            ->where('id', $question_id)
            ->first();

        if ($is_data) {
            DB::table('ask_question')
                ->where('id', $question_id)
                ->delete();

            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }

    function reply_asked_question(Request $request)
    {
        $question_id = strip_tags(trim($request->input('question_id')));
        $reply = strip_tags(trim($request->input('reply')));

        $is_data = DB::table('ask_question')
            ->where('id', $question_id)
            ->first();

        if ($is_data) {
            DB::table('ask_question')
                ->where('id', $question_id)
                ->update(['answer' => $reply]);

            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }
}
