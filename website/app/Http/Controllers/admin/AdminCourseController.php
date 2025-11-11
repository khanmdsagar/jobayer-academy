<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCourseController extends Controller
{
    //faq functions
    function get_faq($course_id)
    {
        return DB::table('question_answer')->where('course_id', $course_id)->orderBy('id', 'desc')->get();
    }

    function add_faq(Request $request)
    {
        $course_id    = $request->input('course_id');
        $faq_answer   = $request->input('faq_answer');
        $faq_question = $request->input('faq_question');

        $result = DB::table('question_answer')->insert([
            'question'  => $faq_question,
            'answer'    => $faq_answer,
            'course_id' => $course_id,
        ]);

        if ($result) {
            return response()->json(['status' => 'success']);
        } 
        else {
            return response()->json(['status' => 'error']);
        }
    }

    function delete_faq(Request $request){
        $faq_id = $request->input('faq_id');

        $result = DB::table('question_answer')->where('id', $faq_id)->delete();

        if ($result) {
            return response()->json(['status' => 'success']);
        }
        else {
            return response()->json(['status' => 'error']);
        }
    }


    //resource functions
    function get_resource($course_id)
    {
        return DB::table('resource')->where('course_id', $course_id)->orderBy('id', 'desc')->get();
    }

    function add_resource(Request $request)
    {
        $originalName = $request->file('resource_file')->getClientOriginalName();
        $path = $request->file('resource_file')->storeAs('file', $originalName, 'public');

        //$path = $request->file('resource_file')->store('file', 'public');
        return $path;
    }

    function add_resource_details(Request $request)
    {
        $resource_name = $request->input('resource_name');
        $resource_path = $request->input('resource_path');
        $resource_type = $request->input('resource_type');
        $course_id = $request->input('course_id');

        $result = DB::table('resource')->insert([
            'resource_name' => $resource_name,
            'resource_path' => $resource_path,
            'resource_type' => $resource_type,
            'course_id' => $course_id,
        ]);

        if (!$result) {
            return response()->json(['status' => 'error']);
        } else {
            return response()->json(['status' => 'success']);
        }
    }

    function delete_resource(Request $request)
    {
        $resource_id = $request->input('resource_id');
        $resource_type = $request->input('resource_type');
        $resource_path = $request->input('resource_path');

        if ($resource_type == 'file') {
            try {
                Storage::disk('public')->delete($resource_path);
                DB::table('resource')->where('id', $resource_id)->delete();
                return response()->json(['status' => 'success']);
            } catch (\Exception $e) {
                return response()->json(['status' => 'failed', 'error' => $e->getMessage()]);
            }
        } 
        else {
            try {
                DB::table('resource')->where('id', $resource_id)->delete();
                return response()->json(['status' => 'success']);
            } catch (\Exception $e) {
                return response()->json(['status' => 'failed']);
            }
        }
    }

    // quiz management functions
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
