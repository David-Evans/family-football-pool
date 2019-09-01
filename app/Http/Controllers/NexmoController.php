<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class NexmoController extends Controller
{
    function sendMessage(Request $request) {
        $nexmo_key=env("NEXMO_KEY","NULL");
        $nexmo_secret=env("NEXMO_SECRET","NULL");
        $nexmo_shortcode=env("NEXMO_SHORTCODE","NULL");
        $nexmo_number=env("NEXMO_NUMBER","NULL");

        $validRequest = TRUE; // Assume positive intent ;)
        $result = Array();

        // Validate required parameters are available
        if ($request->input('msg') == '') { $validRequest = FALSE; }
        if ($request->input('numbertodial') == '') { $validRequest = FALSE; }

        if ($validRequest) {
         $result['success'] = 'true';
         $message = rawurlencode($request->input('msg'));
         $smsNumber = $request->input('numbertodial');

            try {
              $url = 'https://rest.nexmo.com/sms/json';
              $fields = array(
                'api_key' => $nexmo_key,
                'api_secret' => $nexmo_secret,
                'to' => '1'.$smsNumber,
                'from' => $nexmo_number,
                'text' => $message
              );

              $fields_string = '';
              foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
              rtrim($fields_string, '&');

              $ch = curl_init();
              curl_setopt($ch,CURLOPT_URL, $url);
              curl_setopt($ch,CURLOPT_POST, count($fields));
              curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
              $result = curl_exec($ch);
              curl_close($ch);
            } catch (Exception $e) {
                $result['success'] = 'false';
                $result['error'] = $e->getMessage();
            }
        } else {
         $result['success'] = 'false';
        }

        return view('pages.send-message')->with([
            'result' => $result
        ]);

    }
    function sendGroupMessage(Request $request) {
        $nexmo_key=env("NEXMO_KEY","NULL");
        $nexmo_secret=env("NEXMO_SECRET","NULL");
        $nexmo_shortcode=env("NEXMO_SHORTCODE","NULL");
        $nexmo_number=env("NEXMO_NUMBER","NULL");

        $validRequest = TRUE; // Assume positive intent ;)
        $result = Array();

        // Validate required parameters are available
        if ($request->input('msg') == '') { $validRequest = FALSE; }

        if ($validRequest) {
            $result['success'] = 'true';
            $message = rawurlencode($request->input('msg'));

            $users = DB::table('users')->where('sms_number','!=','')->get();

            foreach ($users as $user) {
                $numbertodial = $user->sms_number;
                $url = 'https://rest.nexmo.com/sms/json';
                try {
                  $smsNumber = $numbertodial;
if($smsNumber == '4802053478' || $smsNumber == '4802038364') {
                  $fields = array(
                    'api_key' => $nexmo_key,
                    'api_secret' => $nexmo_secret,
                    'to' => '1'.$smsNumber,
                    'from' => $nexmo_number,
                    'text' => $message
                  );

                  $fields_string = '';
                  foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                  rtrim($fields_string, '&');
                  $ch = curl_init();
                  curl_setopt($ch,CURLOPT_URL, $url);
                  curl_setopt($ch,CURLOPT_POST, count($fields));
                  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
                  $result = curl_exec($ch);
                  curl_close($ch);
}
                } catch (Exception $e) {
                    $result['success'] = 'false';
                    $result['error'] = $e->getMessage();
                    return view('pages.send-message')->with([
                        'result' => $result
                    ]);
                }
            }
        } else {
            $result['success'] = 'false';
        }

        return view('pages.send-message')->with([
            'result' => $result
        ]);
    }
}
