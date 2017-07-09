<?php
		
	include_once("../common/sql_common.php");

function modifyMember()
{
	if(isset($_GET['dealerSN']))
	{
		$_SESSION['currentDealer']=$_GET['dealerSN'];
	}
	if(isset($_GET['dealerName']))
	{
		$_SESSION['currentDealerName']=$_GET['dealerName'];
	}
	if(isset($_GET['member_sn']))
	{
		$_SESSION['currentMember']=$_GET['member_sn'];
	}
	$dealerStr="<a href='index.php?mode=memberMode&member_sn={$_SESSION['currentDealer']}'>{$_SESSION['currentDealerName']}</a>";
	
	$discount9=($_SESSION['form_discount']==0.9) ? "selected" : "";
	$discount85=($_SESSION['form_discount']==0.85) ? "selected" : "";
	$discount8=($_SESSION['form_discount']==0.8) ? "selected" : "";
	$discount75=($_SESSION['form_discount']==0.75) ? "selected" : "";
	
	$whereCond = "member_sn = {$_SESSION['currentMember']}";
	$sql = "select * from member where {$whereCond}";
	$sqlReturn = Q($sql,"無法查詢會員資料!");
	if($data=mysql_fetch_array($sqlReturn))
	{
		$_SESSION['form_email']=$data['email'];
		$_SESSION['form_passwd']=$data['passwd'];
		$_SESSION['form_name']=$data['name'];
		$_SESSION['form_mobile']=$data['mobile'];
		$_SESSION['form_addr']=$data['addr'];
		$_SESSION['form_zip']=$data['zip'];
		$_SESSION['form_discount']=$data['discount'];
	}	
	
$memberForm=<<<ADD_MEMBER_SEC
		
	<form action='../admin/modifyMember.php' method='post'>
	<div class='row'>
		<div class='12u'>
			<h3>{$dealerStr}修改會員資料</h3>
			<table class='rzTable' style='font-size:90%'>
				<tr><th>email</th><td><input type='email' name='email' style='width:20em' class='rzFormInput' value="{$_SESSION['form_email']}" disabled /></td></tr>
				<tr><th>姓名</th><td><input type='text' name='name' style='width:8em' class='rzFormInput' value="{$_SESSION['form_name']}" required /></td></tr>
				<tr><th>行動電話</th><td><input type='text' name='mobile' style='width:12em' class='rzFormInput' value="{$_SESSION['form_mobile']}" /></td></tr>
				<tr><th>郵遞區號</th><td><input type='text' name='zip' style='width:5em' class='rzFormInput' value="{$_SESSION['form_zip']}"/></td></tr>
				<tr><th>地址</th><td><input type='text' name='addr' style='width:20em' class='rzFormInput' value="{$_SESSION['form_addr']}"/></td></tr>
				<input type='hidden' name='dealerSN' value="{$_SESSION['currentDealer']}" />
				<input type='hidden' name='member_sn' value="{$_GET['member_sn']}" />
			</table>
	
ADD_MEMBER_SEC;

$addTail=<<<ADD_TAIL

		</div><!--12u-->
	</div><!--row-->
	<input type='submit' class='rzFormSubmit' value='修改' />
	</form>

ADD_TAIL;
	
	if(isset($_GET['error']))
	{
		switch($_GET['error'])
		{
			case 0:
				echo "<div class='row'><div class='12u'><p><strong style='color:white'>修改會員資料成功!</strong></p></div></div>";
				echo "<a href='{$_SESSION['pageBase']}?mode=memberMode&member_sn={$data['member_sn']}'>{$data['name']}({$data['email']})</a>";
			break;
			case 31:
				echo "<div class='row'><div class='12u'><p><strong style='color:red'>*您兩次輸入的新密碼並不相同!</strong></p></div></div>";
				echo $memberForm;
				echo $addTail;
			break;
		}												  
	}
	else
	{
		echo $memberForm;
		echo $addTail;
	}
}//modifyMember

?>