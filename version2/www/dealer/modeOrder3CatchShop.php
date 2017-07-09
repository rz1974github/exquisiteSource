<?php

	session_start();
			
	$order_id=12345;
			
	//接收ezship傳來資料
	if(isset($_REQUEST['order_id']))
	{
		$order_id=$_REQUEST['order_id'];
	}//if
	
	$shopType = array( 'TFM'=>'全家超商', 'TLF'=>'萊爾富超商','TOK'=>'OK超商');
	
	/*
	echo "回傳stCate:".$_REQUEST['stCate']."<br />";
	echo "回傳stCode:".$_REQUEST['stCode']."<br />";
	echo "回傳stName:".$_REQUEST['stName']."<br />";
	echo "回傳stAddr:".$_REQUEST['stAddr']."<br />";
	echo "回傳stTel:".$_REQUEST['stTel']."<br />";
	echo "回傳webPara:".$_REQUEST['webPara']."<br />";
	*/
	
	$_SESSION['st_code']=$_REQUEST['stCate'].$_REQUEST['stCode'];
	$_SESSION['stCode']	=$_REQUEST['stCode'];
	$_SESSION['stCate']	=$shopType[$_REQUEST['stCate']];
	$_SESSION['stName']	=$_REQUEST['stName'];
	$_SESSION['stTel']	=$_REQUEST['stTel'];
	$_SESSION['stAddr']	=$_REQUEST['stAddr'];
	
	header("location:modeOrder4Confirm.php");
?>