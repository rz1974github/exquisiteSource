<?php
		
	include_once("../common/sql_common.php");
	
	function dealerCashout()
	{
		$dealerSN=$_GET['dealer_sn'];
		$whereCond = "member_sn = {$dealerSN}";
		$sql = "select * from member where {$whereCond}";
		$sqlReturn = Q($sql,"無法查詢會員資料!");
					
		if($data=mysql_fetch_array($sqlReturn))
		{
	
$html=<<<HTML_SEC
		<script>
		
		var submitForm=function(event)
		{
			event.preventDefault();
			
			if($('#pointsToUse').val()>0)
			{			
				$('#cashForm').submit();
			}//if
			else
			{
				alert('兌換點數要大於0!');
			}
		}		
		
		</script>
		
		<form id='cashForm' action='cashout.php' method='post'>
		<table class='rzTable'>
			<tr><th>會員</th><td>{$data['name']}</td><th>紅利</th><td>{$data['points']}</td></tr>
			<tr>
				<input type='hidden' name='dealer_sn' value='{$dealerSN}'>
				<input type='hidden' name='fromPoint' value="{$data['points']}">
				<th colspan='3' style='text-align:right'>兌換現金</th>
				<td><input type='number' class='rzFormInput' style='width:4em' name='pointsToUse' id='pointsToUse' min='0' max={$data['points']} value='0' />點</td>
			</tr>		
		</table>
		<input type='submit' class='rzButton' value='確定' onclick='submitForm(event)' />
		</form>
HTML_SEC;
	
			echo $html;		
		}//if
	}
?>