<?php

session_start();

include_once("member_common.php");
include_once("sharedResult.php");

$_SESSION['pointsToUse']=$_POST['js_pointsToUse'];
$_SESSION['order_discount']=$_POST['js_orderDiscount'];

updateSession();

$nextfile = $_POST['nextFile'];
$checkLogIn = $_POST['checkLogIn'];

//如果有登入, 直接到Cart2.php
if(userLogged() || $checkLogIn=="false")
{
	header("location:{$nextfile}");
	exit(0);
}
else
{
	//如果沒有登入,到member.php	
	header("location:member.php?from={$nextfile}");
	exit(0);
}
?>