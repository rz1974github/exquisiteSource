<?php
	include("../global.php");	
	include('orderSerial.php');
	
	$formalServer = "https://acq.esunbank.com.tw/acq_online/online/sale42.htm";
	$testServer = "https://acqtest.esunbank.com.tw/acq_online/online/sale42.htm";
	
	if($define_official)
	{
		$selectServer = $formalServer;
	}
	else
	{
		$selectServer = $testServer;
	}
	
	session_start();
	
	/*
	if(!isset($_SESSION['order_serial']))
	{
	}
	*/
	$_SESSION['order_serial']=orderSerial();
	
    //var strCombined = oMid.value + "&&" + oTid.value + "&" + oONO.value + "&" + oTA.value + "&" + oURL.value + "&" + macKey2;
	
	$oTID = "EC000001";
	$oURL="http://www.exquisite.com.tw/product/eSunReturn.php";
	$combinedStr = $oMID."&&".$oTID."&".$_SESSION['order_serial']."&".$_SESSION['total_money']."&".$oURL."&".$macKey;
	$oM = md5($combinedStr);	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>資料處理中...</title>
	<script src="js/md5.min.js"></script>
    <script type="text/javascript">
        
        /*
        <特店代碼> + "&" +
        <子特店代號> + "&" +
        <終端機代號> + "&" +
        <訂單編號> + "&" +
        <交易金額> + "&" +
        <URL> + "&" +
        <押碼 KEY > 
        */
    </script>
	</head>
    <body>
        <form id="commitForm" name="commitForm" action="<?php echo $selectServer ?>" method="post">
            <input type="hidden" name="MID" value="<?php echo $oMID; ?>" />
            <input type="hidden" name="CID" value="" />
            <input type="hidden" name="TID" value="<?php echo $oTID; ?>" />
            <input type="hidden" name="ONO" value="<?php echo $_SESSION['order_serial']; ?>"/>
            <input type="hidden" name="TA" value="<?php echo $_SESSION['total_money']; ?>"/>
            <input type="hidden" name="U" size="60" value="<?php echo $oURL; ?>" />
            <input type="hidden" name="M" size="40" value="<?php echo $oM; ?>" />            
        </form>
        <form method='post' id='submitOrderForm' name='submitOrderForm' action='submitOrder.php'>
            <input type='hidden' name='Submit2' value='true' />
        </form>
    </body>
</html>


<?php
if(isset($_POST['Submit2']))
{	
	if(!isset($_SESSION['order_serial']))
	{
		$_SESSION['order_serial']=orderSerial();
	}
	$_SESSION['rv_name']=$_POST['rv_name'];
	$_SESSION['rv_email']=$_POST['rv_email'];
	$_SESSION['rv_mobile']=$_POST['rv_mobile'];
	$_SESSION['rv_addr']=$_POST['rv_addr'];
	$_SESSION['rv_zip']=$_POST['rv_zip'];
	$_SESSION['message']=$_POST['message'];
	
	$errorString="";
	
	if(strlen($_SESSION['rv_name'])==0)
	{
		$errorString.="nameError=true";
	}
	
	if(!filter_var($_SESSION['rv_email'], FILTER_VALIDATE_EMAIL))
	{
		if(strlen($errorString)!=0) $errorString.="&";
		$errorString.="emailError=true";
	}
	
	if((strlen($_SESSION['rv_mobile'])==0) || (strlen($_SESSION['rv_mobile'])>10))
	{
		if(strlen($errorString)!=0) $errorString.="&";
		$errorString.="mobileError=true";
	}
	
	$order_status="A02"; //超商
	if($_SESSION['deliever']=="1")	
	{	
		$order_status="A06"; //宅配
		if(strlen($_SESSION['rv_addr'])==0)
		{
			if(strlen($errorString)!=0) $errorString.="&";
			$errorString.="addrError=true";
		}
	}
	
	if(strlen($errorString)>0)
	{
		header("location:Cart_step3.php?{$errorString}");
		exit(0);
	}//if
	
	if($_SESSION['order_type']=="10")
	{
		echo "連線到銀行刷卡服務...請稍候";
		echo(" <script>document.getElementById('commitForm').submit();</script> ");
		exit(0);
	}
	else
	{
		echo(" <script>document.getElementById('submitOrderForm').submit();</script> ");
		exit(0);
	}	
}

?>