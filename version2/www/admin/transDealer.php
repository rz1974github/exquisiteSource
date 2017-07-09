<?php

include_once('../global.php');

session_start();

$privalege = $_SESSION['privalege'] > 0;
$disableStr = $privalege ? "":"disabled";

if(!$privalege)
{
	header("location:index.php");
	exit(0);
}

include_once("../common/sql_common.php");

$discount=$_SESSION['member_def_discount'];
if($_POST['isDealer']=='1')
{
	$discount=$_SESSION['dealerRate'];
	$_SESSION['showMessage']=1;
}
else
{
	$_SESSION['showMessage']=2;
}
	
$sql = "update member set isDealer='{$_POST['isDealer']}',discount='{$discount}' where member_sn='{$_POST['member_sn']}'";
$sqlReturn = Q($sql,"無法更新會員資料");

header("location:{$_SESSION['pageBase']}?mode=memberMode&member_sn={$_POST['member_sn']}");
exit(0);

?>