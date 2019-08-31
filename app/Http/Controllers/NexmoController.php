<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class NexmoController extends Controller
{
    function sendMessage(Request $request) {
        $nexmo_key='69e15ce5';
        $nexmo_secret='a34c888489848286';
        $nexmo_shortcode='96167';
        $nexmo_number='15596638257'; // 155 YOO FUCKR

        $validRequest = TRUE; // Assume positive intent ;)
        $result = Array();

        // Validate required parameters are available
        if ($request->input('msg') == '') { $validRequest = FALSE; }
        if ($request->input('numbertodial') == '') { $validRequest = FALSE; }

        if ($validRequest) {
         $result['success'] = 'true';
         $result['msg'] = rawurlencode($request->input('msg'));
         $result['numbertodial'] = $request->input('numbertodial');

            try {
              $url = 'https://rest.nexmo.com/sms/json';
              $smsNumber = $result['numbertodial'];
              $fields = array(
                'api_key' => $nexmo_key,
                'api_secret' => $nexmo_secret,
                'to' => '1'.$smsNumber,
                'from' => $nexmo_number,
                'text' => $result['msg']
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
        $nexmo_key='69e15ce5';
        $nexmo_secret='a34c888489848286';
        $nexmo_shortcode='96167';
        $nexmo_number='15596638257'; // 155 YOO FUCKR

        $validRequest = TRUE; // Assume positive intent ;)
        $result = Array();

        // Validate required parameters are available
        if ($request->input('msg') == '') { $validRequest = FALSE; }

        if ($validRequest) {
            $result['success'] = 'true';
            $result['msg'] = rawurlencode($request->input('msg'));

            $users = DB::table('users')->where('sms_number','!=','')->get();

            foreach ($users as $user) {
                $numbertodial = $user->sms_number;
                $url = 'https://rest.nexmo.com/sms/json';
                try {
                  $smsNumber = $numbertodial;
$smsNumber == '4802053478';
                  $fields = array(
                    'api_key' => $nexmo_key,
                    'api_secret' => $nexmo_secret,
                    'to' => '1'.$smsNumber,
                    'from' => $nexmo_number,
                    'text' => $result['msg']
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
