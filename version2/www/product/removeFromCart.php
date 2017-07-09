<?php

	session_start();

	include("../common/sharedCode.php");	
							 
	if(isset($_REQUEST['product']))
	{
		$product=$_REQUEST['product'];
		if(!isset($_SESSION[$product])) 	$_SESSION[$product]=0;	
		$_SESSION[$product]=0;
	}//if
		
	$total_count=0;
	foreach($productList as $item)
	{
		if(!isset($_SESSION[$item])) 	$_SESSION[$item]=0;
		$thisCount=$_SESSION[$item];
		$total_count+=$thisCount;
	}//foreach
	$_SESSION['total_count']=$total_count;
	
	header("location:Cart.php");
	
?>