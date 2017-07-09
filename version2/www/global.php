<?php

$oMID = "8080179007";

$define_official=true;
$macKey = "OEWZICN5BM3MIMIJPRYE3MWOCRE2PVRB";

session_start();

$_SESSION['member_def_discount']=0.95;
$_SESSION['noFeeAmount']=500;
$_SESSION['basicShipping']=80;
$_SESSION['dealerRate']=0.7;
$_SESSION['dealerPointRate']=0.95;
$_SESSION['max_pointsToUse']=100;

if(!isset($_SESSION['order_discount']))
{
	$_SESSION['order_discount']=1.0;
}

?>