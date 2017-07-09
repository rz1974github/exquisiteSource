<?php

session_start();

include_once("../common/sql_common.php");

$_SESSION['form_email']=$_POST['email'];
$_SESSION['form_name']=$_POST['name'];
$_SESSION['form_mobile']=$_POST['mobile'];
$_SESSION['form_addr']=$_POST['addr'];
$_SESSION['form_zip']=$_POST['zip'];
$_SESSION['form_discount']=$_POST['discount'];

	$today=date("Y-m-d");
	$sql = "update member set name='{$_POST['name']}',mobile='{$_POST['mobile']}',addr='{$_POST['addr']}',zip='{$_POST['zip']}' where member_sn='{$_POST['member_sn']}'";
	Q($sql,"資料寫入發生錯誤!");
	
	header("location:{$_SESSION['pageBase']}?mode=modifyMember&error=0");
	exit(0);	

?>
