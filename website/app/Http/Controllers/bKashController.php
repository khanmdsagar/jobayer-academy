<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class bKashController extends Controller
{
    private $base_url;
    private $site_url;

    public function __construct()
    {
        //$this->base_url = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta';
        $this->base_url = 'https://tokenized.pay.bka.sh/v1.2.0-beta';
        $this->site_url = 'https://jobayeracademy.com';
        //$this->site_url = 'http://127.0.0.1:8000';
    }

    public function authHeaders(){
        return array(
            'Content-Type:application/json',
            'Authorization:' .Session::get('bkash_token'),
            'X-APP-Key:'.env('BKASH_CHECKOUT_URL_APP_KEY')
        );
    }

    public function curlWithBody($url,$header,$method,$body_data_json){
        $curl = curl_init($this->base_url.$url);
        curl_setopt($curl,CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_POSTFIELDS, $body_data_json);
        curl_setopt($curl,CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function grant()
    {
        $header = array(
                'Content-Type:application/json',
                'username:'.env('BKASH_CHECKOUT_URL_USER_NAME'),
                'password:'.env('BKASH_CHECKOUT_URL_PASSWORD')
                );
        $header_data_json=json_encode($header);

        $body_data = array('app_key'=> env('BKASH_CHECKOUT_URL_APP_KEY'), 'app_secret'=>env('BKASH_CHECKOUT_URL_APP_SECRET'));
        $body_data_json=json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/token/grant',$header,'POST',$body_data_json);

        $token = json_decode($response)->id_token;

        return $token;
    }

    public function create(Request $request)
    {
        Session::forget('bkash_token');
        $token = $this->grant();
        Session::put('bkash_token', $token);

        $header =$this->authHeaders();

        $body_data = array(
            'mode' => '0011',
            'payerReference' => ' ',
            'callbackURL' => $this->site_url.'/bkash/checkout-url/callback',
            'amount' => Session::get('payment_amount'),
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => "Inv".Str::random(10) // you can pass here you OrderID
        );
        $body_data_json=json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/create',$header,'POST',$body_data_json);

        Session::forget('paymentID');
        Session::put('paymentID', json_decode($response)->paymentID);

        return redirect((json_decode($response)->bkashURL));
    }

    public function execute($paymentID)
    {

        $header =$this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID
        );
        $body_data_json=json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/execute',$header,'POST',$body_data_json);

        $res_array = json_decode($response,true);

        if(isset($res_array['trxID'])){
            $trxID = $res_array['trxID'];
            $paymentID = $res_array['paymentID'];
            $amount = $res_array['amount'];
            $paymentExecuteTime = $res_array['paymentExecuteTime'];
            $payerAccount = $res_array['payerAccount'];
            $statusMessage = $res_array['statusMessage'];
            $invoiceNo = $res_array['merchantInvoiceNumber'];
            $customerMsisdn = $res_array['customerMsisdn'];

            DB::table('payment_detail')->insert([
                "trxID" => $trxID,
                "amount" => $amount,
                "paymentExecuteTime" => $paymentExecuteTime,
                "payerAccount" => $payerAccount,
                "statusMessage" => $statusMessage,
            ]);

            
        }
    }

    public function query($paymentID)
    {

        $header =$this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID,
        );
        $body_data_json=json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/payment/status',$header,'POST',$body_data_json);

        $res_array = json_decode($response,true);

        if(isset($res_array['trxID'])){
            $trxID = $res_array['trxID'];
            $paymentID = $res_array['paymentID'];
            $amount = $res_array['amount'];
            $invoiceNo = $res_array['merchantInvoiceNumber'];
            $customerMsisdn = $res_array['customerMsisdn'];

            // your database insert operation

        }

        return $response;
    }

    public function callback(Request $request)
    {
        $allRequest = $request->all();

        if(isset($allRequest['status']) && $allRequest['status'] == 'failure'){
            // return view('CheckoutURL.fail')->with([
            //     'response' => 'Payment Failure'
            // ]);
            //return [["status"=>"failure"]];
            $status = 'failure';
            $course_id = Session::get('course_id');
            $combo_ids = Session::get('combo_ids');

            return view('callback', compact( 'status', 'course_id', 'combo_ids'));

        }
        else if(isset($allRequest['status']) && $allRequest['status'] == 'cancel'){
            // return view('CheckoutURL.fail')->with([
            //     'response' => 'Payment Cancell'
            // ]);
            //return [["status"=>"cancel"]];
            $status = 'cancel';
            $course_id = Session::get('course_id');
            $combo_ids = Session::get('combo_ids');
            
            return view('callback', compact( 'status', 'course_id', 'combo_ids'));

        }
        else{

            $response = $this->execute($allRequest['paymentID']);

            $arr = json_decode($response,true);

            $status = $request->query('status');
            $course_id = Session::get('course_id');
            $combo_ids = Session::get('combo_ids');

            DB::table('student')
                ->where('id', Session::get('user_id'))
                ->increment('student_paid_amount', Session::get('payment_amount'));


            return view('callback', compact( 'status', 'course_id', 'combo_ids'));

        //    if(array_key_exists("statusCode",$arr) && $arr['statusCode'] != '0000'){
        //        return view('CheckoutURL.fail')->with([
        //            'statusMessage' => $arr['statusMessage'],
        //        ]);
        //        return [["statusMessage"=>$arr['statusMessage']]];

        //    }else if(array_key_exists("message",$arr)){
        //        // if Execute Api Failed to response
        //        sleep(1);
        //        $queryResponse = $this->query($allRequest['paymentID']);
        //        return view('CheckoutURL.success')->with([
        //            'response' => $queryResponse
        //        ]);
        //        return [["statusMessage"=>$queryResponse]];
        //    }

            // return view('CheckoutURL.success')->with([
            //     'response' => $response
            // ]);
            //return [["statusMessage"=>$response]];
        }
    }


    public function search($trxID)
    {
        Session::forget('bkash_token');
        $token = $this->grant();
        Session::put('bkash_token', $token);

        $header =$this->authHeaders();

        $body_data = array(
            'trxID' => $trxID,
        );
        $body_data_json=json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/general/searchTransaction',$header,'POST',$body_data_json);

        //$res_array = json_decode($response,true);

        return $response;
    }
}
