<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tropo;

use DB;

class TropoController extends Controller
{
    function sendMessage(Request $request) {
    	$token = env("TROPO_KEY", "NULL");
        $token = "062c2492bf2ce44c88dc558bc892824725712a4dceaf8228aceea3c2ee6d889d042e63b95b64629eeb706c8b";

    	$validRequest = TRUE; // Assume positive intent ;)
    	$result = Array();

    	// Validate required parameters are available
    	if ($token == '' || is_null($token)) { $validRequest = FALSE; }
    	if ($request->input('msg') == '') { $validRequest = FALSE; }
    	if ($request->input('numbertodial') == '') { $validRequest = FALSE; }

    	//$msg = isset($request->input('msg')) ? $request->input('msg') : FALSE;

    	if ($validRequest) {
    		$result['success'] = 'true';
    		$result['token'] = $token;
	    	$result['msg'] = $request->input('msg');
	    	$result['numbertodial'] = $request->input('numbertodial');

            try {
                $url = 'https://api.tropo.com/1.0/sessions?action=create&token='.$result['token'].'&numbertodial='.$result['numbertodial'].'&msg='.rawurlencode($result['msg']);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                $result['curl-response'] = curl_exec($ch);
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
        $token = env("TROPO_KEY", "NULL");
        $token = "062c2492bf2ce44c88dc558bc892824725712a4dceaf8228aceea3c2ee6d889d042e63b95b64629eeb706c8b";

        $validRequest = TRUE; // Assume positive intent ;)
        $result = Array();

        // Validate required parameters are available
        if ($token == '' || is_null($token)) { $validRequest = FALSE; }
        if ($request->input('msg') == '') { $validRequest = FALSE; }

        if ($validRequest) {
            $result['success'] = 'true';
            $result['token'] = $token;
            $result['msg'] = $request->input('msg');

            $users = DB::table('users')->where('sms_number','!=','')->get();

            foreach ($users as $user) {
                $numbertodial = $user->sms_number;
                try {
                    $url = 'https://api.tropo.com/1.0/sessions?action=create&token='.$result['token'].'&numbertodial='.$numbertodial.'&msg='.rawurlencode($result['msg']);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,$url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                    $result['curl-response'] = curl_exec($ch);
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
