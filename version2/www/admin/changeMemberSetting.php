<?php

session_start();

if($_POST['oldDiscount'] == $_POST['newDiscount'])
{
	header("location:index.php?mode=memberMode&member_sn={$_POST['member_sn']}");
	$_SESSION['showMessage']=4;
	exit(0);
}

include_once('../common/sql_common.php');

		$sql = "update member set discount='{$_POST['newDiscount']}' where member_sn='{$_POST['member_sn']}'";
		Q($sql,"無法更新會員資料!");;
		
		$_SESSION['showMessage']=3;

//header("location:{$_SESSION['pageBase']}?mode=memberMode&member_sn={$_POST['member_sn']}");
//exit(0);

echo "showMessage={$_SESSION['showMessage']}";

?>