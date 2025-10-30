<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminCourseController extends Controller
{
    // get quiz for a course
    public function get_quiz($course_id)
    {
        return DB::table('exam_quiz')->where('course_id', $course_id)->orderBy('id', 'desc')->get();
    }

    // add a new quiz
    public function add_quiz(Request $request)
    {
        try {
            $question = $request->input('question');
            $option1 = $request->input('option1');
            $option2 = $request->input('option2');
            $option3 = $request->input('option3');
            $option4 = $request->input('option4');
            $correct = $request->input('correct');
            $duration = $request->input('duration');
            $course_id = $request->input('course_id');

            $is_quiz_exist = DB::table('exam_quiz')
                ->where('course_id', $course_id)
                ->where('question', $question)
                ->count();

            if ($is_quiz_exist) {
                return response()->json(['status' => 'error', 'message' => 'Quiz already exists']);
            } else {
                DB::table('exam_quiz')->insert([
                    'question' => $question,
                    'option1' => $option1,
                    'option2' => $option2,
                    'option3' => $option3,
                    'option4' => $option4,
                    'correct' => $correct,
                    'duration' => $duration,
                    'course_id' => $course_id,
                ]);
            }

            return response()->json(['status' => 'success', 'message' => 'Quiz added successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to add quiz', 'error' => $e->getMessage()], 500);
        }
    }

    // delete a quiz
    public function delete_quiz(Request $request)
    {
        // logic to delete a quiz
        $quiz_id = $request->input('quiz_id');
        $result = DB::table('exam_quiz')->where('id', $quiz_id)->delete();

        if ($result) {
            return response()->json(['status' => 'success', 'message' => 'Quiz deleted successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to delete quiz'], 500);
        }
    }

    // edit a quiz
    public function edit_quiz(Request $request)
    {
        // logic to edit a quiz
        $quiz_id = $request->input('quiz_id');
        $question2 = $request->input('question2');
        $option12 = $request->input('option12');
        $option22 = $request->input('option22');
        $option32 = $request->input('option32');
        $option42 = $request->input('option42');
        $correct2 = $request->input('correct2');
        $duration2 = $request->input('duration2');

        $result = DB::table('exam_quiz')
            ->where('id', $quiz_id)
            ->update([
                    'question' => $question2,
                    'option1' => $option12,
                    'option2' => $option22,
                    'option3' => $option32,
                    'option4' => $option42,
                    'correct' => $correct2,
                    'duration' => $duration2,
                ]);

        if ($result) {
            return response()->json(['status' => 'success', 'message' => 'Quiz updated successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update quiz'], 500);
        }
    }
}
