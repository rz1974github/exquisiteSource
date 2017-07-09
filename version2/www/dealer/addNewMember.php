<?php

session_start();

include_once("../common/sql_common.php");

$_SESSION['form_email']=$_POST['email'];
$_SESSION['form_passwd']=$_POST['passwd'];
$_SESSION['form_name']=$_POST['name'];
$_SESSION['form_mobile']=$_POST['mobile'];
$_SESSION['form_addr']=$_POST['addr'];
$_SESSION['form_zip']=$_POST['zip'];
$_SESSION['form_discount']=$_POST['discount'];

$sql="select * from member where email='{$_REQUEST['email']}'";

$result=Q($sql,"無法取得會員資料庫!");

$data = mysql_fetch_assoc($result);

if(empty($data))
{		
	if($_POST['passwd']!=$_POST['passwd2'])
	{
		header("location:index.php?mode=addMemberMode&error=31");
		exit(0);
	}

	$today=date("Y-m-d");
	$sql = "insert into member (email,passwd,name,mobile,addr,zip,discount,applyDate,belongDealer) values(
	'{$_POST['email']}',
	'{$_POST['passwd']}',
	'{$_POST['name']}',
	'{$_POST['mobile']}',
	'{$_POST['addr']}',
	'{$_POST['zip']}',
	{$_POST['discount']},
	CURDATE(),
	{$_SESSION['currentDealer']}
	)";
	Q($sql,"資料寫入發生錯誤!");
	
	$_SESSION['form_email']="";
	$_SESSION['form_passwd']="";
	$_SESSION['form_name']="";
	$_SESSION['form_mobile']="";
	$_SESSION['form_addr']="";
	$_SESSION['form_zip']="";
	$_SESSION['form_discount']="";
	
	header("location:{$_SESSION['pageBase']}?mode=addMemberMode&error=0");
	exit(0);	
}//if
else
{
		header("location:{$_SESSION['pageBase']}?mode=addMemberMode&error=30");
		exit(0);	
}//else

?>
