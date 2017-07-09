<?php
		
	include_once("../common/sql_common.php");

function addMember()
{
	if(isset($_GET['dealerSN']))
	{
		$_SESSION['currentDealer']=$_GET['dealerSN'];
	}
	if(isset($_GET['dealerName']))
	{
		$_SESSION['currentDealerName']=$_GET['dealerName'];
	}
	$dealerStr="<a href='index.php?mode=memberMode&member_sn={$_SESSION['currentDealer']}'>{$_SESSION['currentDealerName']}</a>";
	$discount9=($_SESSION['form_discount']==0.9) ? "selected" : "";
	$discount85=($_SESSION['form_discount']==0.85) ? "selected" : "";
	$discount8=($_SESSION['form_discount']==0.8) ? "selected" : "";
	$discount75=($_SESSION['form_discount']==0.75) ? "selected" : "";
	
$addMember=<<<ADD_MEMBER_SEC
		
	<form action='../dealer/addNewMember.php' method='post'>
	<div class='row'>
		<div class='12u'>
			<h3>{$dealerStr}新增旗下會員</h3>
			<table class='rzTable' style='font-size:90%'>
				<tr><th>email</th><td><input type='email' name='email' style='width:20em' class='rzFormInput' value="{$_SESSION['form_email']}" required /></td></tr>
				<tr><th>密碼</th><td><input type='password' name='passwd' style='width:13em' class='rzFormInput' value="{$_SESSION['form_passwd']}" required /></td></tr>
				<tr><th>再次輸入密碼</th><td><input type='password' name='passwd2' style='width:13em' class='rzFormInput' required /></td></tr>
				<tr><th>姓名</th><td><input type='text' name='name' style='width:8em' class='rzFormInput' value="{$_SESSION['form_name']}" required /></td></tr>
				<tr><th>行動電話</th><td><input type='text' name='mobile' style='width:12em' class='rzFormInput' value="{$_SESSION['form_mobile']}" /></td></tr>
				<tr><th>郵遞區號</th><td><input type='text' name='zip' style='width:5em' class='rzFormInput' value="{$_SESSION['form_zip']}"/></td></tr>
				<tr><th>地址</th><td><input type='text' name='addr' style='width:20em' class='rzFormInput' value="{$_SESSION['form_addr']}"/></td></tr>
				<input type='hidden' name='dealerSN' value="{$_SESSION['currentDealer']}" />
				<tr>
					<th >折扣數</th>
					<td>
						<select name='discount' class='rzFormInput' style='width:7em' >
							<option value='0.9' {$discount9}>九折</option>
							<option value='0.85' {$discount85}>八五折</option>
							<option value='0.8' {$discount8}>八折</option>
							<option value='0.75' {$discount75}>七五折</option>
						</select>
					</td>
				</tr>
			</table>
	
ADD_MEMBER_SEC;

$addTail=<<<ADD_TAIL

		</div><!--12u-->
	</div><!--row-->
	<input type='submit' class='rzFormSubmit' value='新增' />
	</form>

ADD_TAIL;
	
	if(isset($_GET['error']))
	{
		switch($_GET['error'])
		{
			case 0:
				echo "<div class='row'><div class='12u'><p><strong style='color:white'>新增會員成功!</strong></p></div></div>";
			break;
			case 30:
				echo "<div class='row'><div class='12u'><p><strong style='color:red'>*這個email信箱已經註冊過了!請洽元基生技</strong></p></div></div>";
				echo $addMember;
				echo $addTail;
			break;
			case 31:
				echo "<div class='row'><div class='12u'><p><strong style='color:red'>*您兩次輸入的新密碼並不相同!</strong></p></div></div>";
				echo $addMember;
				echo $addTail;
			break;
		}												  
	}
	else
	{
		echo $addMember;
		echo $addTail;
	}
}//addMember

?>