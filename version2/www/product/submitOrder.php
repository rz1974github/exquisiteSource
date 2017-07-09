<?php

include('orderSerial.php');

if(isset($_POST['Submit2']))
{
	session_start();
	
	$ezshipOrderType=$_SESSION['order_type'];
	if($_SESSION['order_type']=="10")
	{
		$ezshipOrderType="3";
	}
	
	$errorString="";
	
	if(strlen($_SESSION['rv_name'])==0)
	{
		$errorString.="nameError=true";
	}
	
	if(!filter_var($_SESSION['rv_email'], FILTER_VALIDATE_EMAIL))
	{
		if(strlen($errorString)!=0) $errorString.="&";
		$errorString.="emailError=true";
	}
	
	if((strlen($_SESSION['rv_mobile'])==0) || (strlen($_SESSION['rv_mobile'])>10))
	{
		if(strlen($errorString)!=0) $errorString.="&";
		$errorString.="mobileError=true";
	}
	
	$order_status="A02"; //超商
	if($_SESSION['deliever']=="1")	
	{	
		$order_status="A06"; //宅配
		if(strlen($_SESSION['rv_addr'])==0)
		{
			if(strlen($errorString)!=0) $errorString.="&";
			$errorString.="addrError=true";
		}
	}
	
	if(strlen($errorString)>0)
	{
		header("location:Cart_step3.php?{$errorString}");
		exit(0);
	}//if

	header("Content-Type:text/html; charset=utf-8");
	echo "<html><head><meta http-equiv='content-type' content='text/html; charset=utf-8'></head><body>";
	echo("<form method='post' id='formsubmitout' name='simulation_to' action='http://www.ezship.com.tw/emap/ezship_request_order_api.jsp'> ");
	echo("	<input type='hidden' name='su_id' 			value='nsebest@gmail.com'> ");
	echo("	<input type='hidden' name='order_id' 		value='{$_SESSION['order_serial']}'> ");
	echo("	<input type='hidden' name='order_status' 	value='{$order_status}'> ");
	echo("	<input type='hidden' name='order_type' 		value='{$ezshipOrderType}'> ");
	
	$submitMoney=$_SESSION['total_money'];
	if($ezshipOrderType=="3")
	{
		$submitMoney=0;
	}//if
	
	echo("	<input type='hidden' name='order_amount' 	value='{$submitMoney}'> ");
	echo("	<input type='hidden' name='rv_name' 		value='{$_SESSION['rv_name']}'> ");
	echo("	<input type='hidden' name='rv_email' 		value='{$_SESSION['rv_email']}'> ");
	echo("	<input type='hidden' name='rv_mobile' 		value='{$_SESSION['rv_mobile']}'> ");
	echo("	<input type='hidden' name='st_code' 		value='{$_SESSION['st_code']}'> ");
	
	if(isset($_SESSION['rv_addr']))
	{
		echo("	<input type='hidden' name='rv_addr' 		value='{$_SESSION['rv_addr']}'> ");
	}

	if(isset($_SESSION['rv_zip']))
	{
		echo("	<input type='hidden' name='rv_zip' 			value='{$_SESSION['rv_zip']}'> ");
	}
	
	echo("	<input type='hidden' name='rtn_url' 		value='http://www.exquisite.com.tw/product/ezshipReturn.php'> ");
	echo("	<input type='hidden' name='web_para' 		value='Hello'> ");
	echo("</form></body></html>");
	
	echo(" <script>document.getElementById('formsubmitout').submit();</script> ");
}