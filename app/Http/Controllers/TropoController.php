<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tropo;

class TropoController extends Controller
{
    function sendMessage(Request $request) {
    	$token = env("TROPO_KEY", "NULL");

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
    	} else {
    		$result['success'] = 'false';
    	}

		$url = 'https://api.tropo.com/1.0/sessions?action=create&token='.$result['token'].'&numbertodial='.$result['numbertodial'].'&msg='.rawurlencode($result['msg']);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		$result['curl-response'] = curl_exec($ch);
		curl_close($ch);

        return view('pages.send-message')->with([
            'result' => $result
        ]);
    }
}
