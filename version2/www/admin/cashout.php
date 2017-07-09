<?php
		
	include_once("../common/sql_common.php");	

	session_start();
	
	$dateStr = date("Y-m-d");
	
	$trans=$_POST['pointsToUse']*(-1.0);
	$pointsSum=$_POST['fromPoint']+$trans;
	
	//更新經銷商紅利
	$comment.="經銷商紅利兌換現金";
	
	$sql = "update member set points='{$pointsSum}' where member_sn='{$_POST['dealer_sn']}'";
	$sqlReturn = Q($sql,"無法更新經銷商資料");
	
	//紅利紀錄
	$sql = "insert into pointTrans (date,member_sn,fromPoint,trans,toPoint,comment,operator) values('{$dateStr}','{$_POST['dealer_sn']}','{$_POST['fromPoint']}',{$trans},{$pointsSum},'{$comment}','{$_SESSION['member_sn']}')";
	$sqlReturn = Q($sql,"無法寫入紅利紀錄");

	header("location:index.php?mode=memberMode&member_sn={$_POST['dealer_sn']}&message=1");
?>