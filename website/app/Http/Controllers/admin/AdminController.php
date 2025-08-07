<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\EnrolledCourse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    function add_category(Request $request){
        $category_name = strip_tags(trim($request->input('category_name')));

        $result = DB::table('course_category')->insert([
            'category_name'  => $category_name,
            'category_slug'  => Str::slug($category_name),
            'category_image' => '',
            'created_at'     => Carbon::now(),
        ]);

        if($result){
            return response()->json(['status' => 200, "message" => 'ক্যাটাগরি যুক্ত করা হয়েছে']);
        }
        else{
            return response()->json(['status' => 404, "message" => 'ক্যাটাগরি যুক্ত করা যায়নি']);
        }
    }

    function get_category_data(){
        return DB::table('course_category')->get();
    }

    function delete_category(Request $request){
        $category_id = strip_tags(trim($request->input('category_id')));
        $result = DB::table('course_category')->where('id', $category_id)->delete();
    }

    function edit_category(Request $request){
        $category_id   = strip_tags(trim($request->input('category_id')));
        $category_name = strip_tags(trim($request->input('category_name')));
        $category_slug = Str::slug($category_name);

        $result = DB::table('course_category')->where('id', $category_id)->update([
            'category_name'  => $category_name,
            'category_slug'  => $category_slug,
            'category_image' => '',
            'updated_at'     => Carbon::now(),
        ]);

        if($result){
            return response()->json(['status' => 200, "message" => 'ক্যাটাগরি সম্পাদন করা হয়েছে']);
        }
        else{
            return response()->json(['status' => 404, "message" => 'ক্যাটাগরি সম্পাদন করা যায়নি']);
        }
    }

    function get_student_data() {
        $student_data = DB::table('student')->orderBy('id', 'desc')->get();
        return response()->json($student_data);
    }

    function search_student_data($search_data){
        $search_data2 = strip_tags(trim($search_data));

        if(is_numeric($search_data2)){
            $student_data = DB::table('student')->where('student_number', 'like', '%'.$search_data2.'%')->get();
            return response()->json($student_data);
        }
        else{
            $student_data = DB::table('student')->where('student_name', 'like', '%'.$search_data2.'%')->get();
            return response()->json($student_data);
        }
    }

    function student_info($student_id){
        $student_data = DB::table('student')->where('id', $student_id)->first();
        $enrolled_course = EnrolledCourse::with('course')->where('student_id', $student_id)->get();
        $site_course = DB::table('course')->get();
        return view('admin.admin_student_info', compact('student_data', 'enrolled_course', 'site_course'));
    }

    //filter student
    function filter_student($course_value){
        if($course_value == 'enrolled'){
            return DB::table('student')->where('student_enrolled_course', '!=', 0)->get();
        }
        else if($course_value == 'unenrolled'){
            return DB::table('student')->where('student_enrolled_course', 0)->get();
        }
        else{
            return EnrolledCourse::with('student')->where('course_id', $course_value)->get();
        }
    }

    function download_course_student_data($course_id){
        $data = EnrolledCourse::with('student')->where('course_id', $course_id)->get();

        $filename = 'course_students_'.$data[0]->course->course_slug.'_'.date('Y-m-d') . '.csv';

        $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=\"$filename\""];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, [
                'ID',
                'Name',
                'Email',
                'Number',
                'Address',
                'Division',
                'District',
                'Profession',
                'Note',
                'Birthday',
                'Page',
                'Profile',
                'Enrolled Course',
                'Enrollment Date'
            ]);
                 
            foreach ($data as $enrollment) {
                fputcsv($file, [
                    $enrollment->student->id,
                    $enrollment->student->student_name,
                    $enrollment->student->student_email,
                    $enrollment->student->student_number,
                    $enrollment->student->student_address,
                    $enrollment->student->student_division,
                    $enrollment->student->student_district,
                    $enrollment->student->student_profession,
                    $enrollment->student->student_note,
                    $enrollment->student->student_birthday,
                    $enrollment->student->student_page_url,
                    $enrollment->student->student_profile_url,
                    $enrollment->student->student_enrolled_course,
                    $enrollment->student->created_at
                ]);
            }
            
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    function download_unenrolled_student_data(){
        $data = DB::table('student')->where('student_enrolled_course', 0)->get();

        $filename = 'unenrollments_' . date('Y-m-d') . '.csv';

        $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=\"$filename\""];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, [
                'ID',
                'Name',
                'Email',
                'Number',
                'Address',
                'Division',
                'District',
                'Profession',
                'Note',
                'Birthday',
                'Page',
                'Profile',
                'Enrolled Course',
                'Enrollment Date'
            ]);
                 
            foreach ($data as $enrollment) {
                fputcsv($file, [
                    $enrollment->id,
                    $enrollment->student_name,
                    $enrollment->student_email,
                    $enrollment->student_number,
                    $enrollment->student_address,
                    $enrollment->student_division,
                    $enrollment->student_district,
                    $enrollment->student_profession,
                    $enrollment->student_note,
                    $enrollment->student_birthday,
                    $enrollment->student_page_url,
                    $enrollment->student_profile_url,
                    $enrollment->student_enrolled_course,
                    $enrollment->created_at
                ]);
            }
            
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    function download_enrolled_student_data(){
        // Get the data with relationships
        $data = EnrolledCourse::with(['student','course'])->get();

        // Define CSV filename
        $filename = 'enrollments_' . date('Y-m-d') . '.csv';

        // Set CSV headers
        $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=\"$filename\""];

        // Create CSV content
        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, [
                'ID',
                'Name',
                'Email',
                'Number',
                'Division',
                'District',
                'Profession',
                'Course Name',
                'Note',
                'Birthday',
                'Page',
                'Profile',
                'Enrolled Course',
                'Enrollment Date'
            ]);
            
            // Add data rows
            foreach ($data as $enrollment) {
                fputcsv($file, [
                    $enrollment->student_id,
                    $enrollment->student->student_name,
                    $enrollment->student->student_email,
                    $enrollment->student->student_number,
                    $enrollment->student->student_division,
                    $enrollment->student->student_district,
                    $enrollment->student->student_profession,
                    $enrollment->course->course_slug,
                    $enrollment->student_note,
                    $enrollment->student_birthday,
                    $enrollment->student_page_url,
                    $enrollment->student_profile_url,
                    $enrollment->student_enrolled_course,
                    $enrollment->enrolled_date
                ]);
            }
            
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    function download_student_data(){
        $data = DB::table('student')->get();

        $filename = 'students_' . date('Y-m-d') . '.csv';

        $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=\"$filename\""];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, [
                'ID',
                'Name',
                'Email',
                'Number',
                'Address',
                'Division',
                'District',
                'Profession',
                'Note',
                'Birthday',
                'Page',
                'Profile',
                'Enrolled Course',
                'Enrollment Date'
            ]);
            
            foreach ($data as $enrollment) {
                fputcsv($file, [
                    $enrollment->id,
                    $enrollment->student_name,
                    $enrollment->student_email,
                    $enrollment->student_number,
                    $enrollment->student_address,
                    $enrollment->student_division,
                    $enrollment->student_district,
                    $enrollment->student_profession,
                    $enrollment->student_note,
                    $enrollment->student_birthday,
                    $enrollment->student_page_url,
                    $enrollment->student_profile_url,
                    $enrollment->student_enrolled_course,
                    $enrollment->created_at
                ]);
            }
            
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    function enroll_student(Request $request){
        $student_id = strip_tags(trim($request->input('student_id')));
        $course_id  = strip_tags(trim($request->input('course_id')));
        $enrolled_course = DB::table('enrolled_course')->where('student_id', $student_id)->where('course_id', $course_id)->count();
        
        if($enrolled_course > 0){
            return response()->json(['status' => 404, "message" => 'কোর্স ইতিমধ্যে ভর্তি করা আছে']);
        }
        else{
            try{
                $result = DB::table('enrolled_course')->insert([
                    'student_id' => $student_id,
                    'course_id' => $course_id,
                    'is_new' => 1,
                    'enrolled_date' => Carbon::now(),
                ]);

                $student_data = DB::table('student')->where('id', $student_id)->first();
                $enrolled_course = DB::table('enrolled_course')->where('student_id', $student_id)->count();
                DB::table('student')->where('id', $student_id)->update(['student_enrolled_course' => $enrolled_course]);
        
                if($result){
                    return response()->json(['status' => 200, "message" => 'কোর্স ভর্তি করা হয়েছে']);
                }
                else{
                    return response()->json(['status' => 404, "message" => 'কোর্স ভর্তি করা যায়নি']);
                }
            }
            catch(\Exception $e){   
                return response()->json(['status' => 404, "message" => $e->getMessage()]);
            }
        }
    }

    function unenroll_student(Request $request){
        $enrolled_course_id = strip_tags(trim($request->input('enrolled_course_id')));
        $result = DB::table('enrolled_course')->where('id', $enrolled_course_id)->delete();
        if($result){
            return response()->json(['status' => 200, "message" => 'কোর্স বাতিল করা হয়েছে']);
        }
        else{
            return response()->json(['status' => 404, "message" => 'কোর্স বাতিল করা যায়নি']);
        }
    }

    function delete_student_info(Request $request){
        $student_id = strip_tags(trim($request->input('student_id')));
        $result = DB::table('student')->where('id', $student_id)->delete();

        if($result){
            return response()->json(['status' => 200, "message" => 'শিক্ষার্থী তথ্য মুছে ফেলা হয়েছে']);
        }
        else{
            return response()->json(['status' => 404, "message" => 'শিক্ষার্থী তথ্য মুছে ফেলা যায়নি']);
        }
    }

    function add_student_info(Request $request){
        $student_name         = strip_tags(trim($request->input('student_name')));
        $student_email        = strip_tags(trim($request->input('student_email')));
        $student_number       = strip_tags(trim($request->input('student_number')));
        $student_address      = strip_tags(trim($request->input('student_address')));
        $student_note         = strip_tags(trim($request->input('student_note')));
        $student_division     = strip_tags(trim($request->input('student_division')));
        $student_district     = strip_tags(trim($request->input('student_district')));
        $student_page_url     = strip_tags(trim($request->input('student_page_url')));
        $student_birthday     = strip_tags(trim($request->input('student_birthday')));
        $student_profession   = strip_tags(trim($request->input('student_profession')));
        $student_profile_url  = strip_tags(trim($request->input('student_profile_url')));

        try{
            $result = DB::table('student')->insert([
                "student_name"    => $student_name,
                "student_email"   => $student_email,
                "student_number"  => $student_number,
                "student_address"     => $student_address,
                "student_division"    => $student_division,
                "student_page_url"    => $student_page_url,
                "student_birthday"    => $student_birthday,
                "student_profession"  => $student_profession,
                "student_profile_url" => $student_profile_url,
                "student_district"    => $student_district,
                "student_note"        => $student_note,
                "created_at"  => Carbon::now(),
            ]);

            if($result){
                return response()->json(['status' => 200, "message" => 'তথ্য যোগ করা হয়েছে']);
            }
            else{
                return response()->json(['status' => 404, "message" => 'তথ্য যোগ করা যায়নি']);
            }
        }
        catch(\Exception $e){
            return response()->json(['status' => 404, "message" => $e->getMessage()]);
        }

    }

    function get_course_data(){
        return DB::table('course')->where('course_status', 1)->get();
    }
}
