<?php 
		
	include_once("../common/sharedCode.php");		
	include_once("../common/sql_common.php");	
	
	function dealerMemberList()
	{
		$dealerStr="<a href='index.php?mode=memberMode&member_sn={$_GET['dealerSN']}'>{$_GET['dealerName']}</a>";
		echo "<h3>{$dealerStr}旗下會員列表</h3>";
		
		$sql = "select * from member where belongDealer={$_GET['dealerSN']}";
		$sqlReturn = Q($sql,"無法查詢會員資料!");
		
		if(mysql_num_rows($sqlReturn)>0)
		{					
			echo "<table class='rzTable' style='font-size:90%'>";
			echo "<tr><th>編號</th><th style='colsize=20em'>email</th><th>折扣</th><th>名字</th><th>mobile</th><th>zip</th><th style='colsize=20em'>addr</th></tr>";
			
			$privalege = $_SESSION['privalege'] > 0;
			while($data=mysql_fetch_array($sqlReturn))
			{
				echo "<tr style='font-size:80%'><td>{$data['member_sn']}</td><td>{$data['email']}</td><td>{$data['discount']}</td><td><a href='{$_SERVER['PHP_SELF']}?mode=memberMode&member_sn={$data['member_sn']}'>{$data['name']}</a></td><td>{$data['mobile']}</td><td>{$data['zip']}</td><td>{$data['addr']}</td></tr>";
			}
			echo "</table>";
		}
		else
		{
			echo "<h3>尚無旗下會員</h3>";
		}
	}//dealerMemberList
?>