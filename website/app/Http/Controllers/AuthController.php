<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function registerStudent(Request $request)
    {
        $student_number = strip_tags(trim($request->input('student_number')));

        try{
            $result = DB::table('student')->insert([
                'student_number' => $student_number,
                'created_at'     => Carbon::now(),
            ]);

            if($result){
                $student_data = DB::table('student')->where('student_number', $student_number)->first();
                Session::put('user_id', $student_data->id);
            }

            return response()->json([
                'status'    => 'success',
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status'    => 'error',
                'message'   => $e->getMessage()
            ]);
        }
    }

    public function loginStudent(Request $request)
    {
        $student_number   = strip_tags(trim($request->input('student_number')));
		$student_password = strip_tags(trim($request->input('student_password')));

        try{
            $student_data = DB::table('student')->where('student_number', $student_number)->first();

            if ($student_data) {
                $decrypted_password = Crypt::decrypt($student_data->student_password);

                if ($student_password == $decrypted_password) {
                    Session::put('user_id', $student_data->id);

                    return response()->json([
                        'status' => 'success',
                    ]);
                }
                else{
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'পাসওয়ার্ড সঠিক নয়'
                    ]);
                }
            }
        }
        catch(\Exception $e){
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function resetPassword(Request $request)
    {
        $student_number  = strip_tags(trim($request->input('student_number')));
        $reset_password = strip_tags(trim($request->input('reset_password')));

        $student_data = DB::table('student')->where('student_number', $student_number)->first();

        if($student_data){
            $encrypted_password = Crypt::encrypt($reset_password);

            $result = DB::table('student')->where('student_number', $student_number)->update([
                'student_password' => $encrypted_password,
            ]);

            if($result){
                Session::put('user_id', $student_data->id);

                return response()->json([
                    'status'    => 'success',
                    'message'   => 'পাসওয়ার্ড রিসেট সফলভাবে হয়েছে',
                ]);
            }
            else{
                return response()->json([
                    'status'    => 'error',
                    'message'   => 'পাসওয়ার্ড রিসেট সফলভাবে হয়নি',
                ]);
            }
        }
    }

    public function checkStudent(Request $request)
    {
        $student_number = strip_tags(trim($request->input('student_number')));

        $student_data = DB::table('student')->where('student_number', $student_number)->first();

        if($student_data && $student_data->student_password == null){
            return response()->json([
                'status'    => 'no password',
            ]);
        }
        else if($student_data){
            return response()->json([
                'status'    => 'success',
            ]);
        }
        else{
            return response()->json([
                'status'    => 'failed',
            ]);
        }
    }

    public function sendVerificationCode(Request $request)
    {
        $student_number = strip_tags(trim($request->input('student_number')));

        $code = rand(1000, 9999);

	//8809617619977
        $response = Http::asForm()->post('https://bulksmsbd.net/api/smsapi', [
            'api_key'  => 'nWGO5VES88qBMugYOJtt',
            'type'     => 'text',
            'number'   => $student_number,
            'senderid' => '8809648903497', 
            'message'  => 'Jobayer Academy \nআপনার ভেরিফিকেশন কোড হলো: ' . $code,
        ]);

        $data = $response->json();

        return response()->json([
            'code'      => $code,
            'data'      => $data,
        ]);
    }

    public function getDeviceInfo(Request $request){
        return response()->json([
            'device_info' => $request->userAgent(),
            'ip_address'  => $request->ip(),
            'session_id'  => $request->session()->getId(),
        ]);
    }
}
