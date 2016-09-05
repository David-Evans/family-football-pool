<?php 

//use Illuminate\Http\Request;

	require 'tropo.class.php';

	$to = isset($_GET['numbertodial']) ? "+1".$_GET['numbertodial'] : FALSE;
	$msg = isset($_GET['msg']) ? rawurlencode($_GET['msg']) : FALSE; 
	    
	$tropo = new Tropo(); 
	    
	$tropo->call($to, array('network'=>'SMS')); 
	$tropo->say($msg); 

	return $tropo->RenderJson(); 

?> 
