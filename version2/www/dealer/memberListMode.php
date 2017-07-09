<?php 
		
	include_once("../common/sharedCode.php");		
	include_once("../common/sql_common.php");	
	
	function memberListMode()
	{
		echo "<h2>旗下會員列表</h2>";
		
		$sql = "select * from member where belongDealer={$_SESSION['member_sn']}";
		$sqlReturn = Q($sql,"無法查詢會員資料!");
		
		if(mysql_num_rows($sqlReturn)>0)
		{					
			echo "<table class='rzTable' border='1'>";
			echo "<tr><th>編號</th><th style='colsize=20em'>email</th><th>折扣</th><th>名字</th><th>mobile</th><th>zip</th><th style='colsize=20em'>addr</th></tr>";
			
			$privalege = $_SESSION['privalege'] > 0;
			while($data=mysql_fetch_array($sqlReturn))
			{
				echo "<tr style='font-size:80%'><td>{$data['member_sn']}</td><td><a href='{$_SERVER['PHP_SELF']}?mode=memberMode&member_sn={$data['member_sn']}'>{$data['email']}</a></td><td>{$data['discount']}</td><td>{$data['name']}</td><td>{$data['mobile']}</td><td>{$data['zip']}</td><td>{$data['addr']}</td></tr>";
			}
			echo "</table>";
		}
		else
		{
			echo "<h3>尚無旗下會員</h3>";
		}
	}//memberListMode
?>