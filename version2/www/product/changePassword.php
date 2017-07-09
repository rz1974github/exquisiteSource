<?php

session_start();

$oldPass = $_POST['oldPassword'];

$newPass = $_POST['passwd'];
$newPassConfirm = $_POST['passwd2'];

if($oldPass != $_SESSION['passwd'])
{
	header("location:memberFunc.php?mode=Pass&error=30");
	exit(0);
}

if($newPass != $newPassConfirm)
{
	header("location:memberFunc.php?mode=Pass&error=31");
	exit(0);
}

include_once('../common/sql_common.php');

		$sql = "update member set passwd='{$newPass}' where member_sn='{$_SESSION['member_sn']}'";
		Q($sql,"無法更新會員資料!");;

$_SESSION['passwd'] = $newPass;

header("location:memberFunc.php?mode=Choose&error=0");
exit(0);

?>