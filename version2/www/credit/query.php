<?php
	include("../global.php");	
	
	$formalServer = "https://acq.esunbank.com.tw/acq_online/online/sale47.htm";
	$testServer = "https://acqtest.esunbank.com.tw/acq_online/online/sale47.htm";
	
	if($define_official)
	{
		$selectServer = $formalServer;
	}
	else
	{
		$selectServer = $testServer;
	}
	
	$combinedStr = $oMID."&".$_POST['ONO']."&01&&01&".$macKey;
	$oM = md5($combinedStr);	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>信用卡交易</title>
	</head>
    <body>
        <form id="outputForm" name="outputForm" action="<?php echo $selectServer ?>" method="post">
            <input type="hidden" name="MID" value="<?php echo $oMID; ?>" />
            <input type="hidden" name="ONO" value="<?php echo $_POST['ONO']; ?>" />
            <input type="hidden" name="TYP" value="01" />
            <input type="hidden" name="TRANSNUM" value="" />
            <input type="hidden" name="VERSION" value="01" />
            <input type="hidden" name="M" size="40" value="<?php echo $oM; ?>" />
        </form>
    </body>
</html>

<?php
if(isset($_POST['Submit2']))
{	
	echo(" <script>document.getElementById('outputForm').submit();</script> ");
	exit(0);
}
?>
