<?php

session_start();

include_once("../common/sql_common.php");

$_SESSION['form_passwd']=$_POST['passwd'];
	
	if($_POST['passwd']!=$_POST['passwd2'])
	{
		header("location:{$_SESSION['pageBase']}?mode=changePassword&error=31");
		exit(0);
	}

	$today=date("Y-m-d");
	$sql = "update member set passwd='{$_POST['passwd']}' where member_sn='{$_POST['member_sn']}'";
	Q($sql,"資料寫入發生錯誤!");
	
	header("location:{$_SESSION['pageBase']}?mode=changePassword&error=0");
	exit(0);	

?>
