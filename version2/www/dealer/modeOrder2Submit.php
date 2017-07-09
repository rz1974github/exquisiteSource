<!DOCTYPE HTML>
<!--
	Prologue by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>EXQUISITE經銷體系</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <link rel="stylesheet" href="assets/css/rzOverride.css" />

<?php 

session_start();

$_SESSION['pointsToUse']=$_POST['pointsToUse'];
$_SESSION['useDealer']=$_POST['useDealer'];
$_SESSION['order_discount']=$_POST['order_discount'];
$_SESSION['merchantTotal']=$_POST['merchantTotal'];
$_SESSION['discount_merchant'] = $_POST['discount_merchant'];
$_SESSION['total_money'] = $_POST['total_money'];
$_SESSION['newPoints']=$_POST['newPoints'];
$_SESSION['order_type']=$_POST['order_type'];
$_SESSION['deliever']=$_POST['deliever'];
$_SESSION['delieverTime']=$_POST['delieverTime'];
$_SESSION['ship_name']=$_POST['ship_name'];
$_SESSION['ship_mobile']=$_POST['ship_mobile'];
$_SESSION['ship_email']=$_POST['ship_email'];
$_SESSION['ship_addr']=$_POST['ship_addr'];
$_SESSION['order_member']=$_POST['order_member'];
$_SESSION['order_member_email']=$_POST['order_member_email'];
$_SESSION['message']=$_POST['message'];

//重新整理購物車
$jasonData = $_POST['jasonData'];
unset($_SESSION['productCart']);
$_SESSION['productCart']=array();

$tempArray=json_decode($jasonData);

$itemCount=0;
foreach($tempArray as $key => $obj)
{	
	if($obj==null) continue;
	
	//echo 'index:'.$key.' type:'.$obj->type.' name:'.$obj->name.' count:'.$obj->count.'<br />';
	
	$_SESSION['productCart'][$itemCount]=$obj;
	$itemCount++;
}
	
	$errorString="";
	
	if(strlen($_SESSION['ship_name'])==0)
	{
		$errorString.="nameError=true";
	}
	
	if(!filter_var($_SESSION['ship_email'], FILTER_VALIDATE_EMAIL))
	{
		if(strlen($errorString)!=0) $errorString.="&";
		$errorString.="emailError=true";
	}
	
	if((strlen($_SESSION['ship_mobile'])==0) || (strlen($_SESSION['ship_mobile'])>10))
	{
		if(strlen($errorString)!=0) $errorString.="&";
		$errorString.="mobileError=true";
	}
	
	$order_status="A02"; //超商
	if($_SESSION['deliever']=="1")	
	{	
		$order_status="A06"; //宅配
		if(strlen($_SESSION['ship_addr'])==0)
		{
			if(strlen($errorString)!=0) $errorString.="&";
			$errorString.="addrError=true";
		}
	}
	
	if(strlen($errorString)>0)
	{
		header("location:index.php?mode=modeOrder{$errorString}");
		exit(0);
	}//if

echo "PointToUse:".$_SESSION['pointsToUse']."<br />";
echo "UseDealer:".$_SESSION['useDealer']."<br />";
echo "OrderDiscount:".$_SESSION['order_discount']."<br />";
echo "merchantTotal:".$_SESSION['merchantTotal']."<br />";
echo "discount_merchant:".$_SESSION['discount_merchant']."<br />";
echo "total_money:".$_SESSION['total_money']."<br />";
echo "newPoints:".$_SESSION['newPoints']."<br />";
echo "order_type:".$_SESSION['order_type']."<br />";
echo "deliever:".$_SESSION['deliever']."<br />";
echo "delieverTime:".$_SESSION['delieverTime']."<br />";
echo "ship_name:".$_SESSION['ship_name']."<br />";
echo "ship_mobile:".$_SESSION['ship_mobile']."<br />";
echo "ship_email:".$_SESSION['ship_email']."<br />";
echo "ship_addr:".$_SESSION['ship_addr']."<br />";
echo "order_member:".$_SESSION['order_member']."<br />";
echo "order_member_email:".$_SESSION['order_member_email']."<br />";
echo "message:".$_SESSION['message']."<br />";

//echo $jasonData.'<br />';
/*
//呼叫超商選擇頁
if((($_SESSION['deliever']=="3") && (!isset($_SESSION['stName']))) || ($_POST['forceReshop']=='true'))
{
	header("location:modeOrder25Reshop.php");
	exit(0);
}
else
{
	header("location:index.php?mode=modeOrder3Confirm");
	exit(0);
}
*/
?>

<button type='button' onclick="window.location.href='index.php?mode=modeOrder'" >回上頁</button>
<button type='button' onclick="window.location.href='index.php?mode=modeOrder3Confirm'" >到確認頁</button>

</head>
</html>