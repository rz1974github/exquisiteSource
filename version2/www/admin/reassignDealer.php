<?php
		
	include_once("../common/sql_common.php");
	
	function reassignDealer()
	{
		$whereStr = " where isDealer=1";
		$sql = "select * from member {$whereStr}";
		$sqlReturn = Q($sql,"無法查詢會員資料!");

		$dealerOptions="<option value='0'>取消經銷商</option>";
		while($data=mysql_fetch_array($sqlReturn))
		{
			if($data['member_sn']==$_GET['oldDealer'])
			{
				$dealerStr=$data['name']."(".$data['email'].")";
				continue;
			}
			$dealerOptions.="<option value='{$data[member_sn]}'>{$data['name']}({$data['email']})</option>";
		}
		
$html=<<<HTML_SEC
		<script>
		
		var submitForm=function(event)
		{
			event.preventDefault();
			
			if(confirm('確定要更換經銷商?'))
			{
				$('#chooseForm').submit();
			}
		}		
		
		</script>
		
		<form id='chooseForm' action='changeDealer.php' method='post'>
		<table class='rzTable'>
        	<th>會員</th><td>{$_GET['name']}</td><th>經銷商</th><td>{$dealerStr}</td>
			<tr>
				<input type='hidden' name='member_sn' value='{$_GET['member_sn']}'>
				<th colspan='3' style='text-align:right'>更換經銷商</th>
				<td>
					<select id='chooseDealer' name='chooseDealer' class='rzFormInput' style='width:20em' >
                    {$dealerOptions}
					</select>
                </td>
			</tr>		
		</table>
		<input type='submit' class='rzButton' value='確定' onclick='submitForm(event)' />
		</form>
HTML_SEC;
	
		echo $html;		
	}//reassignDealer
?>