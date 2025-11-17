<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\Course;
use App\Models\CourseChapter;

class DashController extends Controller
{
    protected $student_id;

    public function __construct()
    {
        $this->student_id = Session::get('user_id');
    }


    //question answer
    function get_asked_question()
    {
        return DB::table('ask_question')
            ->where('ask_question.student_id', Session::get('user_id'))
            ->join('course', 'ask_question.course_id', '=', 'course.id')
            ->join('chapter_topic', 'ask_question.topic_id', '=', 'chapter_topic.id')
            ->select(
                'ask_question.id as question_id',
                'ask_question.*',
                'course.course_name',
                'chapter_topic.topic_name'
            )
            ->orderBy('ask_question.id', 'DESC')
            ->get();
    }

    function delete_asked_question(Request $request)
    {
        $question_id = strip_tags(trim($request->input('question_id')));

        $is_data = DB::table('ask_question')
            ->where('id', $question_id)
            ->where('student_id', $this->student_id)
            ->first();

        if ($is_data) {
            DB::table('ask_question')
                ->where('id', $question_id)
                ->where('student_id', $this->student_id)
                ->delete();

            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }



    function tutorial_view($course_id, $slug = null)
    {
        $student_id = Session::get('user_id');

        $course_content = Course::where('id', $course_id)->first();
        $course_name = $course_content->course_name;
        $course_tagline = $course_content->course_tagline;

        DB::table('enrolled_course')->where('course_id', $course_id)->where('student_id', $student_id)->update([
            'is_new' => 0
        ]);

        $is_topic_completion = DB::table('topic_completion')->where('course_id', $course_id)->where('student_id', $student_id)->count();
        $is_enrolled = DB::table('enrolled_course')->where('course_id', $course_id)->where('student_id', $student_id)->count();

        if (!$is_topic_completion && $is_enrolled) {
            $topic_ids = [];

            $get_topics = DB::table('chapter_topic')->where('course_id', $course_id)->get();

            foreach ($get_topics as $topic) {
                $topic_ids[] = $topic->id . "-0";
            }

            DB::table('topic_completion')->insert([
                'topic_ids' => json_encode($topic_ids),
                'course_id' => $course_id,
                'student_id' => $student_id
            ]);
        }

        return view('tutorialview', compact('course_id', 'slug', 'course_name', 'course_tagline'));
    }

    function get_video_data($topic_id)
    {
        return DB::table('chapter_topic')->where('id', $topic_id)->first();
    }

    // get course content
    function get_course_content(Request $request)
    {
        $student_id = Session::get('user_id');
        $course_id  = strip_tags(trim($request->input('course_id')));

        $course_content = CourseChapter::with('chapter_topic')
            ->where('course_id', $course_id)
            ->get();

        try {
            $get_topic_completion_ids = DB::table('topic_completion')
                ->where('course_id', $course_id)
                ->where('student_id', $student_id)
                ->get();
        } 
        catch (\Exception $e) {
            return $e->getMessage();
        }

        return response()->json(['course_content' => $course_content, 'topic_completion_ids' => $get_topic_completion_ids]);
    }

    // get course progress

    function get_course_progress(Request $request)
    {
        $course_id = $request->input('course_id');

        try {
            $Student_topics = DB::table('topic_completion')
                ->where('student_id', Session::get('user_id'))
                ->where('course_id', $course_id)
                ->get();

            if ($Student_topics->isEmpty()) {
                return response()->json(['course_progress' => 0]);
            }

            $completedCount = 0;

            $topic_ids = json_decode($Student_topics[0]->topic_ids, true);

            foreach ($topic_ids as $topic) {
                $parts = explode('-', $topic);
                $status = $parts[1];

                if ($status === '1') {
                    $completedCount++;
                }
            }

            $course_topic = DB::table('chapter_topic')->where('course_id', $course_id)->count();

            $course_progress = $course_topic > 0 ? ($completedCount / $course_topic) * 100 : 0;

            return response()
                ->json([
                    'course_progress' => $course_progress,
                    'course_topic' => $course_topic,
                    'course_topic_completed' => $completedCount
                ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    function mark_as_complete(Request $request)
    {
        $topic_id = $request->input('topic_id');
        $student_id = Session::get('user_id');
        $course_id = $request->input('course_id');

        $record = DB::table('topic_completion')
            ->where('course_id', $course_id)
            ->where('student_id', $student_id)
            ->get();

        if ($record) {
            $topic_ids = json_decode($record[0]->topic_ids, true);

            $updated_topic_ids = array_map(function ($item) use ($topic_id) {
                $parts = explode('-', $item);
                if ($parts[0] == $topic_id && $parts[1] == 0) {
                    return $parts[0] . '-1';
                }
                return $item;
            }, $topic_ids);

            try {
                $result = DB::table('topic_completion')
                    ->where('id', $record[0]->id)
                    ->update([
                        'topic_ids' => json_encode($updated_topic_ids)
                    ]);

                if ($result) {
                    return response()->json(['status' => 'success', 'message' => 'টপিকটি সফলভাবে সম্পন্ন হয়েছে']);
                } else {
                    return response()->json(['status' => 'success', 'message' => 'টপিকটি ইতমধ্যে সম্পন্ন হয়েছে']);
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }

    function topic_is_completed($course_id, $topic_id)
    {
        $Student_topics = DB::table('topic_completion')
            ->where('student_id', $this->student_id)
            ->where('course_id', $course_id)->get();

        $topic_ids = json_decode($Student_topics[0]->topic_ids, true);

        foreach ($topic_ids as $topic) {
            $parts = explode('-', $topic);
            $id = $parts[0];
            $status = $parts[1];

            if ($topic_id == $id) {
                if ($status == 1) {
                    return 1;
                } else {
                    return 0;
                }
            }
        }
    }

    //asked question
    function get_ask_question($topic_id)
    {
        return DB::table('ask_question')
            ->join('student', 'ask_question.student_id', '=', 'student.id')
            ->where('ask_question.topic_id', $topic_id)
            ->select('ask_question.*', 'student.*')
            ->orderBy('ask_question.id', 'DESC')
            ->get();
    }

    function submit_qsn(Request $request)
    {
        $question = strip_tags(trim($request->input('question')));
        $course_id = strip_tags(trim($request->input('course_id')));
        $topic_id = strip_tags(trim($request->input('topic_id')));

        $is_qsn = DB::table('ask_question')
            ->where('question', $question)
            ->where('topic_id', $topic_id)
            ->where('student_id', $this->student_id)
            ->first();

        if ($is_qsn) {
            return response()->json(['error' => 'আপনি ইতোমধ্যেই এই প্রশ্নটি করেছেন।']);
        } else {
            // Insert into ask_question table
            $result = DB::table('ask_question')->insert([
                'question' => $question,
                'answer' => '',
                'course_id' => $course_id,
                'topic_id' => $topic_id,
                'student_id' => $this->student_id,
            ]);

            if ($result) {
                return response()->json(['success' => 'প্রশ্নটি সফলভাবে জমা হয়েছে।']);
            } else {
                return response()->json(['error' => 'দুঃখিত, প্রশ্নটি জমা দেওয়া যায়নি। পরে আবার চেষ্টা করুন।']);
            }
        }
    }

    function get_resource($course_id)
    {
        return DB::table('resource')->where('course_id', $course_id)->get();
    }

    //update password
    function update_password(Request $request)
    {
        $student_password = strip_tags(trim($request->input('student_password')));

        $encrypted_password = Crypt::encrypt($student_password);

        $result = DB::table('student')->where('id', $this->student_id)->update([
            "student_password" => $encrypted_password,
        ]);

        if ($result) {
            return response()->json(['status' => 200, "message" => 'পাসওয়ার্ড আপডেট করা হয়েছে']);
        } else {
            return response()->json(['status' => 404, "message" => 'পাসওয়ার্ড আপডেট করা যায়নি']);
        }
    }

    //get student info
    function get_student_info()
    {
        return DB::table('student')->where('id', $this->student_id)->get();
    }

    //update student info
    function update_student_info(Request $request)
    {
        $student_id = $this->student_id;
        $student_name = strip_tags(trim($request->input('student_name')));
        $student_email = strip_tags(trim($request->input('student_email')));
        $student_address = strip_tags(trim($request->input('student_address')));
        $student_division = strip_tags(trim($request->input('student_division')));
        $student_district = strip_tags(trim($request->input('student_district')));
        $student_page_url = strip_tags(trim($request->input('student_page_url')));
        $student_birthday = strip_tags(trim($request->input('student_birthday')));
        $student_profession = strip_tags(trim($request->input('student_profession')));
        $student_profile_url = strip_tags(trim($request->input('student_profile_url')));

        $result = DB::table('student')->where('id', $student_id)->update([
            "student_name" => $student_name,
            "student_email" => $student_email,
            "student_address" => $student_address,
            "student_division" => $student_division,
            "student_page_url" => $student_page_url,
            "student_birthday" => $student_birthday,
            "student_profession" => $student_profession,
            "student_profile_url" => $student_profile_url,
            "student_district" => $student_district,
        ]);

        if ($result) {
            return response()->json(['status' => 200, "message" => 'তথ্য আপডেট করা হয়েছে']);
        } else {
            return response()->json(['status' => 404, "message" => 'তথ্য আপডেট করা যায়নি']);
        }
    }

    function submit_review(Request $request)
    {
        $course_id = strip_tags(trim($request->input('course_id')));
        $student_review = strip_tags(trim($request->input('student_review')));
        $student_rating = strip_tags(trim($request->input('student_rating')));

        $is_data = DB::table('course_review')->where('student_id', $this->student_id)->where('course_id', $course_id)->count();

        try {
            if (!$is_data) {
                DB::table('course_review')->where('student_id', $this->student_id)->where('course_id', $course_id)->insert([
                    "review" => $student_review,
                    "review_rating" => $student_rating,
                    "review_date" => Carbon::now(),
                    "student_id" => $this->student_id,
                    "course_id" => $course_id,
                ]);

                return response()->json(['message' => 'রিভিউ সফলভাবে জমা হয়েছে।', 'status' => 200]);
            } else {
                return response()->json(['message' => 'আপনি রিভিউ দিয়েছেন।', 'status' => 200]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'রিভিউ সংরক্ষণ করতে সমস্যা হয়েছে।', 'status' => 200]);
        }
    }

    //check review is given by student or not
    function is_reviewed(Request $request)
    {
        $course_id = strip_tags(trim($request->input('course_id')));
        return DB::table('course_review')
            ->where('student_id', $this->student_id)
            ->where('course_id', $course_id)
            ->count();
    }

    //check student is enrolled or not in a specific course
    function is_student_enrolled(Request $request)
    {
        $course_id = strip_tags(trim($request->input('course_id')));
        return DB::table('enrolled_course')
            ->where('student_id', $this->student_id)
            ->where('course_id', $course_id)
            ->count();
    }
}
