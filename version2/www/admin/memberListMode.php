<?php 
		
	include_once("../common/sharedCode.php");		
	include_once("../common/sql_common.php");	
	
	function memberListMode($dealer=false)
	{
		echo $dealer ? "<h2>經銷商列表</h2>" : "<h2>會員列表</h2>";
		
		$whereStr = $dealer ? " where isDealer=1" : "";
		$sql = "select * from member {$whereStr}";
		$sqlReturn = Q($sql,"無法查詢會員資料!");
					
		echo "<table class='rzTable' border='1' style='font-size:80%'>";
		echo "<tr><th>編號</th><th style='colsize=20em'>email</th><th>password</th><th>名字</th><th>mobile</th><th>zip</th><th style='colsize=20em'>addr</th></tr>";
		
		$privalege = $_SESSION['privalege'] > 0;
		while($data=mysql_fetch_array($sqlReturn))
		{
			if($privalege)
			{
				$passStr = $data['passwd'];
			}
			else
			{
				$passStr = "********";
			}
			
			echo "<tr style='font-size:80%'><td>{$data['member_sn']}</td><td><a href='{$_SERVER['PHP_SELF']}?mode=memberMode&isDealer&member_sn={$data['member_sn']}'>{$data['email']}</a></td><td>{$passStr}</td><td>{$data['name']}</td><td>{$data['mobile']}</td><td>{$data['zip']}</td><td>{$data['addr']}</td></tr>";
		}
		echo "</table>";
	}//memberListMode
?>