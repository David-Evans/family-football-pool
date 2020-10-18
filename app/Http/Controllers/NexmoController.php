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
         $message = $request->input('msg');
         $smsNumber = $request->input('numbertodial');

            try {
              $basic  = new \Nexmo\Client\Credentials\Basic($nexmo_key, $nexmo_secret);
              $client = new \Nexmo\Client($basic);
              $smsNumber = $request->input('numbertodial');

              $response = $client->message()->send([
                  'to' => '1'.$smsNumber,
                  'from' => $nexmo_number,
                  'text' => $message
              ]);
              $result['response'] = $response;
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
            $result = Array();
            $message = $request->input('msg');
            $result['msg'] = $message;

            $basic  = new \Nexmo\Client\Credentials\Basic($nexmo_key, $nexmo_secret);
            $client = new \Nexmo\Client($basic);

            $users = DB::table('users')->where('sms_number','!=','')->get();

            foreach ($users as $user) {
                sleep(2); // Nexmo only allows one SMS per second
                $smsNumber = $user->sms_number;
                try {
                    $response = $client->message()->send([
                        'to' => '1'.$smsNumber,
                        'from' => $nexmo_number,
                        'text' => $message
                    ]);

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
          exit();
        }

        try {

            $basic  = new \Nexmo\Client\Credentials\Basic($nexmo_key, $nexmo_secret);
            $client = new \Nexmo\Client($basic);

            $message = 'Inbound from '.$inboundNumber.': '.$inboundMessage;
            $message = $message;

            // $fields = array();
            $smsNumber = '4802053478';

            $response = $client->message()->send([
                'to' => '1'.$smsNumber,
                'from' => $nexmo_number,
                'text' => $message
            ]);

        } catch (Exception $e) {

        }

        // $statusCode = 200;
        // $contents = $request;
        // $response = Response::make($queryStrings, $statusCode);

        // return $response;
    }

}
