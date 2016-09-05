<?php 

echo 'inside sendSMS...<br />';

	require 'tropo.class.php';

echo 'post require...<br />';

	$session = new Session(); 
echo 'got session...<br />';

	$to = "+1".$session->getParameters("numbertodial"); 
	$msg = $session->getParameters("msg"); 
	    
	$tropo = new Tropo(); 
	    
	$tropo->call($to, array('network'=>'SMS')); 
	$tropo->say($msg); 

	echo $tropo->RenderJson(); 

?> 
