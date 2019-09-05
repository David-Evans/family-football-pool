<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class NexmoController extends Controller
{
    function sendMessage(Request $request) {
        $nexmo_key=env('NEXMO_KEY','NULL');
        $nexmo_secret=env('NEXMO_SECRET','NULL');
        $nexmo_shortcode=env('NEXMO_SHORTCODE','NULL');
        $nexmo_number=env('NEXMO_NUMBER','NULL');

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
                sleep(2);
                $numbertodial = $user->sms_number;
                $url = 'https://rest.nexmo.com/sms/json';
                try {
                  $smsNumber = $numbertodial;
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
                  $result['curl_response'] = curl_exec($ch);
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

    public function inboundSMS(Request $request) {
        $nexmo_key=env("NEXMO_KEY","NULL");
        $nexmo_secret=env("NEXMO_SECRET","NULL");
        $nexmo_shortcode=env("NEXMO_SHORTCODE","NULL");
        $nexmo_number=env("NEXMO_NUMBER","NULL");
        // $request = Request::server('QUERY_STRING');

        // $queryStrings = array();
        // parse_str($request, $queryStrings);
        $inboundNumber = $request->input('msisdn');
        $inboundMessage = $request->input('text');

        if (!$inboundMessage) {
          return array(
            'status'=>'500',
            'error'=>'No message'
          );
        }

        try {

            $message = 'Inbound Msg from '.$inboundNumber.': '.$inboundMessage;
            $message = rawurlencode($message);

            $smsNumber = '4802053478';

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
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);

        } catch (Exception $e) {

        }


        $statusCode = 200;
        $contents = $request;
        $response = Response::make($queryStrings, $statusCode);

/*
{
  "msisdn": "447700900001",
  "to": "447700900000",
  "messageId": "0A0000000123ABCD1",
  "text": "Hello world",
  "type": "text",
  "keyword": "Hello",
  "message-timestamp": "2020-01-01T12:00:00.000+00:00",
  "timestamp": "1578787200",
  "nonce": "aaaaaaaa-bbbb-cccc-dddd-0123456789ab",
  "concat": "true",
  "concat-ref": "1",
  "concat-total": "3",
  "concat-part": "2",
  "data": "abc123",
  "udh": "abc123"
}
*/



        return $response;
    }

}
