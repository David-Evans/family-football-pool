<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tropo extends Model
{
    function sendSMS($message='testing',$recipient='4802053478') {
    	$token = config('tropo.key'); // Get from .env
        $message = rawurlencode($message);

		$smsNumber = $recipient;
		$url = 'https://api.tropo.com/1.0/sessions?action=create&token='.$token.'&numbertodial='.$smsNumber.'&msg='.$message;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		$result = curl_exec($ch);
		curl_close($ch);
    }
}
