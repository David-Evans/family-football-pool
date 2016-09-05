<?php 

	require 'tropo.class.php';

	$session = new Session(); 
	$to = "+1".$session->getParameters("numbertodial"); 
	$msg = $session->getParameters("msg"); 
	    
	$tropo = new Tropo(); 
	    
	$tropo->call($to, array('network'=>'SMS')); 
	$tropo->say($msg); 

	echo $tropo->RenderJson(); 

?> 
