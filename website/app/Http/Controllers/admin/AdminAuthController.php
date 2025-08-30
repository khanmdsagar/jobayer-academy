<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    function admin_login(Request $request){
        $admin_username = strip_tags(trim($request->admin_username));
        $admin_password = strip_tags(trim($request->admin_password));

        $is_admin = DB::table('admin')->where('admin_username', $admin_username)->count();

        if($is_admin == 1){
            $admin_data = DB::table('admin')->where('admin_username', $admin_username)->first();
            $decrypted_password = Crypt::decrypt($admin_data->admin_password);

            if($admin_password == $decrypted_password){
                Session::put('admin_id', $admin_data->id);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Login Successful'
                ]);
            }
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Username or Password'
            ]);
        }
    }

    function admin_register(Request $request){
        $admin_username = strip_tags(trim($request->admin_username));
        $admin_password = strip_tags(trim($request->admin_password));
        $admin_role     = strip_tags(trim($request->admin_role));

        $encrypted_password = Crypt::encrypt($admin_password);

        $result = DB::table('admin')->insert([
            'admin_username' => $admin_username,
            'admin_password' => $encrypted_password,
            'admin_role' => $admin_role
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Registration successful'
        ]);
    }
}
