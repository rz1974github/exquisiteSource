<?php
if(isset($_POST['Submit2']))
{
	session_start();
	
	$_SESSION['order_type']=$_POST['order_type'];
	$_SESSION['delieverTime']=$_POST['delieverTime'];
	$_SESSION['deliever']=$_POST['deliever'];
	
	//超商
	if($_SESSION['deliever']=="3")
	{
		header("Content-Type:text/html; charset=Big5");
		echo("<form method='post' id='formsubmitout' name='simulation_to' action='http://map.ezship.com.tw/ezship_map_web.jsp'> ");
		echo("	<input type='hidden' name='suID' value='" .iconv("UTF-8", "Big5","nsebest@gmail.com"). "'> ");
		echo("	<input type='hidden' name='processID' value='" .iconv("UTF-8", "Big5","123"). "'> ");
		echo("	<input type='hidden' name='rtURL' value='" .iconv("UTF-8", "Big5","http://www.exquisite.com.tw/product/Cart_step2CatchShop.php"). "'> ");
		echo("</form> ");
		echo(" <script>document.getElementById('formsubmitout').submit();</script> ");
	}
	else
	{
		//宅配
		header("location:Cart_step3.php");
	}
}