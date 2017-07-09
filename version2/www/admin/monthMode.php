<?php
		
	include_once("../common/sql_common.php");

	function monthMode($dealerSN=0,$dealerName="")
	{		
		$whereDealerStr="";
		$privalege = $_SESSION['privalege'] > 0;
		
		if(isset($_GET['dealerSN']))
		{
			$dealerSN=$_GET['dealerSN'];
			$_SESSION['currentDealer']=$_GET['dealerSN'];
		}//if
		
		if(isset($_GET['dealerName']))
		{
			$dealerName=$_GET['dealerName'];
		}//if
		
		$dealerNote="";
		if($dealerSN!=0)
		{
			if(($dealerSN==$_SESSION['member_sn']) || ($privalege))
			{
				$whereDealerStr=" and ((dealer_sn={$dealerSN}) or (ordertable.member_sn={$dealerSN}))";
			}//if
			$dealerNote="<h4><a href='index.php?mode=memberMode&member_sn={$dealerSN}'>{$dealerName}</a>的訂單<h4>";
			$dealerStr="&dealerSN={$dealerSN}&dealerName={$dealerName}";
		}
		
$monthCode=<<<MONTH_CODE

<script type="text/javascript">

function clickMonth(event,year,month)
{
	event.preventDefault();
	
	window.location = "{$_SERVER['PHP_SELF']}"+'?mode=monthMode&year=' + year + "&month=" + month+"{$dealerStr}";
}
</script>               

MONTH_CODE;
		
        echo $monthCode;
		$selectYear = date("Y");
		$selectMonth = date("m");
		//m1
		$monthM1=$selectMonth-1;
		if($monthM1<1)
		{
			$monthM1 = ($monthM1+12)%12;
			$yearM1=$selectYear-1;
		}
		else
		{
			$yearM1=$selectYear;
		}									
		
		//m2
		$monthM2=$selectMonth-2;
		if($monthM2<1)
		{
			$monthM2 = ($monthM2+12)%12;
			$yearM2=$selectYear-1;
		}
		else
		{
			$yearM2=$selectYear;
		}
		
		//m3
		$monthM3=$selectMonth-3;
		if($monthM3<1)
		{
			$monthM3 = ($monthM3+12)%12;
			$yearM3=$selectYear-1;
		}
		else
		{
			$yearM3=$selectYear;
		}
		
		//m4
		$monthM4=$selectMonth-4;
		if($monthM4<1)
		{
			$monthM4 = ($monthM4+12)%12;
			$yearM4=$selectYear-1;
		}
		else
		{
			$yearM4=$selectYear;
		}
		
		echo "<a href='' onClick='clickMonth(event,{$yearM4},		{$monthM4})'	>{$yearM4}年 {$monthM4}月</a> | ";
		echo "<a href='' onClick='clickMonth(event,{$yearM3},		{$monthM3})'	>{$yearM3}年 {$monthM3}月</a> | ";
		echo "<a href='' onClick='clickMonth(event,{$yearM2},		{$monthM2})'	>{$yearM2}年 {$monthM2}月</a> | ";
		echo "<a href='' onClick='clickMonth(event,{$yearM1},		{$monthM1})'	>{$yearM1}年 {$monthM1}月</a> | ";
		echo "<a href='' onClick='clickMonth(event,{$selectYear},	{$selectMonth})'>{$selectYear}年 {$selectMonth}月</a>";
		
		if(isset($_GET['year']))
		{
			$selectYear = $_GET['year'];
		}//if
		else
		{
			$selectYear = date("Y");
		}
		
		if(isset($_GET['month']))
		{
			$selectMonth = $_GET['month'];
		}//if
		else
		{
			$selectMonth = date("m");
		}
		
		echo "<h3>{$selectYear}年 {$selectMonth}月 {$dealerNote}</h3>";
		
		$selectField = "ordertable.order_sn,ordertable.order_serial,ordertable.date,ordertable.easyship,ordertable.pay,ordertable.send,ordertable.money,ordertable.customer_sn,ordertable.member_sn,ordertable.canceled,ordertable.delivery, ordertable.collected, customer.name,member.test";
		$whereCond = "(Month(ordertable.date)= {$selectMonth}){$whereDealerStr}";
		
		$sql = "select {$selectField} from ordertable inner join customer on ordertable.customer_sn = customer.customer_sn left join member on member.member_sn = ordertable.member_sn where {$whereCond}";
		$sqlReturn = Q($sql,"無法查詢資料庫!");
		
		if(isset($_GET['test']))
		{
			$test=true;
		}
		
		if(mysql_num_rows($sqlReturn)>0)
		{
			echo "<table>";
			echo "<tr><th>訂單</th><th>EZSHIP</th><th>姓名</th><th>日期</th><th>付款</th><th>寄送</th><th>金額</th><th>出貨</th><th>收款</th></tr>";
										
			while($data=mysql_fetch_array($sqlReturn))
			{
				//先不管是否為測試資料
				/*
				if(!$test)
				{
					if(strpos($data['name'],'test')!==false)
					{
						continue;
					}
					if($data['test']==true)
					{
						continue;
					}
				}
				*/
				
				$strikeLine = $data['canceled'] ? "style='text-decoration: line-through; font-size:80%;'":"style='font-size:80%;'";
				echo "<tr {$strikeLine}>";
				echo "<td><a href='{$_SERVER['PHP_SELF']}?mode=orderMode&order_serial={$data['order_serial']}'>{$data['order_serial']}</a></td>";
				echo "<td>{$data['easyship']}</td>";
				
				if($data['member_sn']!=0)
				{
					echo "<td><a href='{$_SERVER['PHP_SELF']}?mode=memberMode&member_sn={$data['member_sn']}'>{$data['name']}</a></td>";
				}//if
				else
				{
					echo "<td>{$data['name']}</td>";
				}
				
				echo "<td>{$data['date']}</td>";
				
				if($data['pay']=='信用卡')
				{
					echo "<td><a href='{$_SERVER['PHP_SELF']}?mode=creditMode&order_sn={$data['order_sn']}'>信用卡</a></td>";
				}//if
				else
				{
					echo "<td>{$data['pay']}</td>";
				}
				
				echo "<td>{$data['send']}</td>";
				echo "<td>{$data['money']}</td>";
				echo "<td>{$data['delivery']}</td>";
				echo "<td>{$data['collected']}</td>";
				echo "</tr>";
			}
			echo "</table>";
		}//if
		else
		{
			echo "<h4>尚未有訂單資料</h4>";
		}
	}//monthMode

?>