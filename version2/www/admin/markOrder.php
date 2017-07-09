<?php
	include("../global.php");	
	
	$formalServer = "https://acq.esunbank.com.tw/acq_online/online/sale51.htm";
	$testServer = "https://acqtest.esunbank.com.tw/acq_online/online/sale51.htm";
	
	if($define_official)
	{
		$selectServer = $formalServer;
	}
	else
	{
		$selectServer = $testServer;
	}

	$combinedStr = $oMID."&".$_POST['ONO']."&".$macKey;
	$oM = md5($combinedStr);	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
	</head>
    <body>
        <form id="outputForm" name="outputForm" action="<?php echo $selectServer ?>" method="post">
            <input type="hidden" name="MID" value="<?php echo $oMID; ?>" />
            <input type="hidden" name="ONO" value="<?php echo $_POST['ONO']; ?>" />
            <input type="hidden" name="M" size="40" value="<?php echo $oM; ?>" />
        </form>
    </body>
</html>

<?php

	include_once("../common/sql_common.php");

	session_start();
	
	$dateStr = date("Y-m-d");

	switch($_POST['operation'])
	{
		case "delivery":
			$sql = "update ordertable set delivery='{$_POST['delivery']}',deliver_staff='{$_SESSION['member_sn']}',deliver_mark='{$dateStr}' where order_serial='{$_SESSION['order_serial']}'";
			Q($sql,"無法更新資料庫");
			break;
		case "collect":
		
			//更改訂單狀態
			$sql = "update ordertable set collected='{$_POST['collected']}',collected_staff='{$_SESSION['member_sn']}',collected_mark='{$dateStr}' where order_serial='{$_SESSION['order_serial']}'";
			Q($sql,"無法更新資料庫");			
			
			//更新會員紅利
			$sql = "select * from member where member_sn='{$_POST['order_member']}'";
			$sqlReturn = Q($sql,"無法查詢會員");
			$pointGained=$_POST['point_gained'];
			$comment="";
			if($pdata=mysql_fetch_array($sqlReturn))
			{
				if($_POST['collected']=='已收款')
				{
					$pointsSum=$pdata['points']+$_POST['point_gained'];
					$comment="收款紅利確認";
				}
				else
				{
					$pointGained=-1.0*$_POST['point_gained'];
					$pointsSum=$pdata['points']-$_POST['point_gained'];
					$comment="取消收款紅利抵消";
				}
				
				$sql = "update member set points='{$pointsSum}' where member_sn='{$_POST['order_member']}'";
				$sqlReturn = Q($sql,"無法更新會員資料");
				
				//紅利紀錄
				$sql = "insert into pointTrans (date,member_sn,fromPoint,trans,toPoint,order_serial,comment,operator) values('{$dateStr}','{$_POST['order_member']}','{$pdata['points']}',{$pointGained},{$pointsSum},'{$_SESSION['order_serial']}','{$comment}','{$_SESSION['member_sn']}')";
				$sqlReturn = Q($sql,"無法寫入紅利紀錄");
			}
			
			//更新經銷商紅利
			if($_POST['dealer_sn']!=0)
			{
				$sql = "select * from member where member_sn='{$_POST['dealer_sn']}'";
				$sqlReturn = Q($sql,"無法查詢經銷商");
				$comment="";
				if($pdata=mysql_fetch_array($sqlReturn))
				{
					if($_POST['discount']>$pdata['discount'])
					{
						$dealerPoints=round($_POST['merchantTotal']*($_POST['discount']-$pdata['discount']));
						if($_POST['collected']=='已收款')
						{
							$comment="經銷紅利";
						}
						else
						{
							$dealerPoints*=(-1.0);
							$comment="取消收款 經銷紅利抵消";
						}
						$pointsSum=$pdata['points']+$dealerPoints;
						$comment.=" 商品:{$_POST['merchantTotal']} x (訂單折扣:{$_POST['discount']}-經銷商折扣:{$pdata['discount']})";
						
						$sql = "update member set points='{$pointsSum}' where member_sn='{$_POST['dealer_sn']}'";
						$sqlReturn = Q($sql,"無法更新經銷商資料");
						
						//紅利紀錄
						$sql = "insert into pointTrans (date,member_sn,fromPoint,trans,toPoint,order_serial,comment,operator) values('{$dateStr}','{$_POST['dealer_sn']}','{$pdata['points']}',{$dealerPoints},{$pointsSum},'{$_SESSION['order_serial']}','{$comment}','{$_SESSION['member_sn']}')";
						$sqlReturn = Q($sql,"無法寫入紅利紀錄");
					}//if 如果訂單折扣大於經銷折扣
				}//mysql_fetch_array
			}//if dealer_sn!=0
			break;
		case "deauthor":
			$sql = "update ordertable set deauthor='{$_POST['deauthor']}',deauthor_staff='{$_SESSION['member_sn']}',deauthor_mark='{$dateStr}' where order_serial='{$_SESSION['order_serial']}'";
			Q($sql,"無法更新資料庫");
			break;
		case "cancel":
			$cancelStr = ($_POST['canceled']=="true") ? "1":"0";
			$sql = "update ordertable set canceled='{$cancelStr}',canceled_staff='{$_SESSION['member_sn']}',canceled_mark='{$dateStr}' where order_serial='{$_SESSION['order_serial']}'";
			Q($sql,"無法更新資料庫");
			break;
	}
	
	
	
	if($_POST['operation']=="deauthor")
	{
		echo(" <script>document.getElementById('outputForm').submit();</script> ");
		exit(0);
	}
	
	//echo $sql;
	header("location:{$_SESSION['pageBase']}?mode=orderMode&order_serial={$_SESSION['order_serial']}");
?>