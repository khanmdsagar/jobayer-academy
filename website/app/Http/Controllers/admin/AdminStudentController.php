<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EnrolledCourse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;

class AdminStudentController extends Controller
{
    function student_info($student_id)
    {
        $student_data = DB::table('student')->where('id', $student_id)->first();
        $enrolled_course = EnrolledCourse::with('course')->where('student_id', $student_id)->get();
        $site_course = DB::table('course')->get();

        $student_info = DB::table('student')->where('id', $student_id)->first();
        $division = $student_info->student_division;
        $district = $student_info->student_district;
        $profession = $student_info->student_profession;

        $day = null;
        $month = null;
        $year = null;

        if ($student_info->student_birthday != '') {
            $parts = explode('-', $student_info->student_birthday);
            $day = $parts[0];
            $month = $parts[1];
            $year = $parts[2];
        }

        return view('admin.admin_student_info', compact('student_data', 'enrolled_course', 'site_course', 'day', 'month', 'year', 'profession', 'division', 'district'));
    }

    function edit_student_info(Request $request)
    {
        $student_id           = strip_tags(trim($request->input('id')));
        $student_name         = strip_tags(trim($request->input('student_name')));
        $student_email        = strip_tags(trim($request->input('student_email')));
        $student_number       = strip_tags(trim($request->input('student_number')));
        $student_address      = strip_tags(trim($request->input('student_address')));
        $student_note         = strip_tags(trim($request->input('student_note')));
        $student_paid_amount  = strip_tags(trim($request->input('student_paid_amount')));
        $student_division     = strip_tags(trim($request->input('student_division')));
        $student_district     = strip_tags(trim($request->input('student_district')));
        $student_page_url     = strip_tags(trim($request->input('student_page_url')));
        $student_birthday     = strip_tags(trim($request->input('student_birthday')));
        $student_profession   = strip_tags(trim($request->input('student_profession')));
        $student_profile_url  = strip_tags(trim($request->input('student_profile_url')));
        $student_password     = strip_tags(trim($request->input('student_password')));
        $encrypted_password   = Crypt::encrypt($student_password);

        if ($student_password != '') {
            DB::table('student')->where('id', $student_id)->update([
                'student_name'          => $student_name,
                'student_email'         => $student_email,
                'student_number'        => $student_number,
                'student_address'       => $student_address,
                'student_division'      => $student_division,
                'student_district'      => $student_district,
                'student_page_url'      => $student_page_url,
                'student_profile_url'   => $student_profile_url,
                'student_profession'    => $student_profession,
                'student_birthday'      => $student_birthday,
                'student_note'          => $student_note,
                "student_paid_amount"   => $student_paid_amount,
                'student_password'      => $encrypted_password,
            ]);
        } 
        else {
            DB::table('student')->where('id', $student_id)->update([
                'student_name'          => $student_name,
                'student_email'         => $student_email,
                'student_number'        => $student_number,
                'student_address'       => $student_address,
                'student_division'      => $student_division,
                'student_district'      => $student_district,
                'student_page_url'      => $student_page_url,
                'student_profile_url'   => $student_profile_url,
                'student_profession'    => $student_profession,
                'student_birthday'      => $student_birthday,
                'student_note'          => $student_note,
                "student_paid_amount"   => $student_paid_amount,
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'Student info updated successfully!']);
    }
}
