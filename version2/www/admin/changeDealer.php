<?php

session_start();

include_once('../common/sql_common.php');

		$sql = "update member set belongDealer='{$_POST['chooseDealer']}' where member_sn='{$_POST['member_sn']}'";
		Q($sql,"無法更新會員資料!");;
		
		$_SESSION['showMessage']=5;

header("location:{$_SESSION['pageBase']}?mode=memberMode&member_sn={$_POST['member_sn']}");
exit(0);

?>