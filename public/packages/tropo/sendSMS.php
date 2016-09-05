<?php 

//use Illuminate\Http\Request;

echo 'inside sendSMS...<br />';

	require 'tropo.class.php';

echo 'post require...<br />';

echo 'got session...<br />';

	$to = isset($_GET['numbertodial']) ? "+1".$session->getParameters("numbertodial") : FALSE;
	$msg = isset($_GET['msg']) ? rawurlencode($_GET['msg']) : FALSE; 
	    
	$tropo = new Tropo(); 
	    
	$tropo->call($to, array('network'=>'SMS')); 
	$tropo->say($msg); 

	echo $tropo->RenderJson(); 

?> 
