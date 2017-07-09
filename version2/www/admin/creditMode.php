<?php 
		
	include_once("../common/sharedCode.php");		
	include_once("../common/sql_common.php");	
	
	function creditMode()
	{
		echo "<h2>刷卡資料</h2>";
		
		
		$selectField = "customer.name,creditcard.*";
		$whereCond = "creditcard.order_sn = {$_GET['order_sn']}";

		$sql = "select {$selectField} from (ordertable inner join creditcard on ordertable.order_sn = creditcard.order_sn ) inner join customer on customer.customer_sn = ordertable.customer_sn where {$whereCond}";
		$sqlReturn = Q($sql,"無法查詢刷卡資料!");
		
		if($data=mysql_fetch_array($sqlReturn))
		{			
			echo "<table class='rzTable' border='1'>";
			echo "<tr><th class='rzTableHeader'>姓名</th><td>{$data['name']}		</td></tr>";
			echo "<tr><th>交易日期LTD</th><td>{$data['LTD']}		</td><th class='rzTableHeader'>交易時間LTT</th><td>{$data['LTT']}	</td></tr>";
			echo "<tr><th>簽帳單序號RRN	</th><td>{$data['RRN']}		</td><th>授權碼AIR</th><td>{$data['AIR']}		</td></tr>";
			echo "<tr><th>卡號AN</th><td colspan='2'>{$data['AN']}		</td></tr>";
			echo "</table>";
		}
	}//creditMode

?>