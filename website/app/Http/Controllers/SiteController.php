<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use App\Models\Course;
use App\Models\EnrolledCourse;
use App\Models\CourseChapter;
use App\Models\CourseReview;
use Torann\GeoIP\Facades\GeoIP;

class SiteController extends Controller
{
    // home page
    function index(Request $request){
        $course = DB::table('course')->where('course_status', 1)->get();

        $userAgent = $request->header('User-Agent');
        $device    = preg_match('/mobile/i', $userAgent) ? 'Mobile' : 'Desktop';

        DB::table('visitor')->insert([
            'ip_address'  => $request->ip(),
            'user_device' => $device,
            'location'    => 'Unknown',
            'visited_at'  => Carbon::now()->toDateString()
        ]);

        return view('home', compact('course'));
    }

    // get courses
    function getCourses(){
        return DB::table('course')->where('course_status', 1)->get();
    }

    // course detail page
    function course_detail($course_slug){
        $course = Course::with('instructor')->where('course_slug', $course_slug)->firstOrFail();
        $course_id = $course->id;

        $is_qsn_ans = DB::table('question_answer')->where('course_id', $course_id)->count();
        $is_course_curriculum = DB::table('course_chapter')->where('course_id', $course_id)->count();
        $is_course_review = DB::table('course_review')->where('course_id', $course_id)->count();
        $is_student_enrolled = 0;

        $video_number = DB::table('chapter_topic')->where('course_id', $course_id)->count();
        $student_number = DB::table('enrolled_course')->where('course_id', $course_id)->count();

        if(Session::get('user_id')){
            $is_student_enrolled = DB::table('enrolled_course')
                ->where('student_id', Session::get('user_id'))
                ->where('course_id', $course_id)->count();
        }

        return view('course_detail', compact('student_number','video_number','is_student_enrolled','is_course_review','is_course_curriculum','is_qsn_ans','course', 'course_id', 'course_slug'));
    }

    // checkout page
    function checkout($course_id, $course_slug){
        $course = Course::with('combo_purchase')->where('id', $course_id)->first();
        $course_name = $course->course_name;
        $course_thumbnail = $course->course_thumbnail;

        return view('checkout', compact('course', 'course_name', 'course_thumbnail'));
    }

    // enroll course
    function enrollCourse(Request $request){
        $course_id = strip_tags(trim($request->input('course_id')));
        $combo_ids = $request->input('combo_ids');

        $student_id = Session::get('user_id');

        $is_enrolled = DB::table('enrolled_course')
                    ->where('student_id', $student_id)
                    ->where('course_id', $course_id)->first();

        if($is_enrolled){
            return response()->json(['status' => 'error', 'message' => 'আপনি ইতমধ্যে এই কোর্সে ভর্তি আছেন']);
        }
        else{
            try{
                DB::table('enrolled_course')->insert([
                    'student_id'      => $student_id,
                    'course_id'       => $course_id,
                    'enrolled_date'   => now()->format('Y-m-d'),
                ]);

                $student_data = DB::table('student')->where('id', $student_id)->first();
                $enrolled_course = DB::table('enrolled_course')->where('student_id', $student_id)->count();
                DB::table('student')->where('id', $student_id)->update(['student_enrolled_course' => $enrolled_course]);

                if($combo_ids){
                    foreach($combo_ids as $combo_id){
                        DB::table('combo_order')->insert([
                            'student_id'      => $student_id,
                            'combo_id'        => $combo_id,
                            'order_date'      => now()->format('Y-m-d'),
                        ]);
                    }
                }
            }
            catch(\Exception $e){
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }

            return response()->json(['status' => 'success', 'message' => 'কোর্স ভর্তি সফল হয়েছে']);
        }
    }

    // get enrolled course
    function getEnrolledCourse(){
        return EnrolledCourse::with('course')->where('student_id', Session::get('user_id'))->get();
    }

    function get_course_curriculum($course_id){
        return CourseChapter::with('chapter_topic')->where('course_id', $course_id)->get();
    }

    function check_login(){
        if (Session::has('user_id')) {
            return 'loggedIn';
        }
        else{
            return "notLoggedIn";
        }
    }

    function check_login_isenrolled($course_id){
        if (Session::has('user_id')) {
            $is_student_enrolled = DB::table('enrolled_course')
                ->where('student_id', Session::get('user_id'))
                ->where('course_id', $course_id)->count();

            if($is_student_enrolled){
                return 'Enrolled';
            }
            else{
                return 'notEnrolled';
            }
        }
        else{
            return "notLoggedIn";
        }
    }

    function get_review($course_id = null){
        if($course_id != null){
            return $course_review = CourseReview::with('student')->where('course_id', $course_id)->get();
        }
        else{
            return $course_review = CourseReview::with('student')->with('course')->inRandomOrder()->limit(5)->get();
        }
    }

    function get_site_gallery(){
        return $site_gallery = DB::table('site_gallery')->get();
    }

    function get_blog(){
        return $blog = DB::table('blog')->get();
    }

    function update_payment_amount(Request $request){
        $payment_amount = $request->input('payment_amount');
        $course_id = $request->input('course_id');
        $combo_ids = $request->input('combo_ids');

        session()->forget('payment_amount');
        session()->forget('course_id');
        session()->forget('combo_ids');

        Session::put('payment_amount', $payment_amount);
        Session::put('course_id', $course_id);
        Session::put('combo_ids', $combo_ids);

        return Session::get('payment_amount');
    }

    function check_coupon(Request $request){
        $coupon = strip_tags(trim($request->input('coupon_code')));

        $is_coupon = DB::table('coupon')->where('coupon_code', $coupon)->count();

        if($is_coupon){
            $coupon_detail  = DB::table('coupon')->where('coupon_code', $coupon)->get();

            if($coupon_detail[0]->coupon_is_valid == 1){
                $coupon_end_at = $coupon_detail[0]->coupon_end_at;

                if (Carbon::now()->lte(Carbon::parse($coupon_end_at))) {
                    return $coupon_detail[0];
                } else {
                    return "কুপনের মেয়াদ শেষ হয়েছে";
                }
            }else{
                return "কুপনটি বৈধ নয়";
            }
        }
        else{
            return "কুপনটি পাওয়া যায়নি";
        }
    }

    function get_question_answer($course_id){
        return DB::table('question_answer')->where('course_id', $course_id)->get();
    }
}
