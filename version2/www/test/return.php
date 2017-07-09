<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>無標題文件</title>
        <?php 
        
        include_once('IndexA.php');
		
        ?>
        
		
		</script>
    </head>

    <body>
    
    <ul>
        <li>回覆碼RC=<?php echo $_GET['RC'].":".getReturnString($_GET['RC']);  ?></li>
        <li>特店代碼MID=<?php echo $_GET['MID'] ?></li>
        <li>訂單編號ONO=<?php echo $_GET['ONO'] ?></li>    
    </ul>
    
    <?php 
	
	$mac = "W6AC5THZGNMIEWLF9ZCOMCLD4UN0DXYR";
    
    if($_GET['RC']=="00")
    {

$detailSec=<<<DETAIL_SEC

			<ul>
				<li>收單交易日期LTD={$_GET['LTD']}</li>
				<li>收單交易時間LTT={$_GET['LTT']}</li>
				<li>簽帳單序號RRN={$_GET['RRN']}</li>
				<li>授權碼AIR={$_GET['AIR']}</li>
				<li>卡號AN={$_GET['AN']}</li>
				<li>M={$_GET['M']}</li>
			</ul>
    
DETAIL_SEC;

        echo $detailSec;
		
		$strRC = $_GET['RC'];
		$strMID = $_GET['MID'];
		$strONO = $_GET['ONO'];
		$strLTD = $_GET['LTD'];
		$strLTT = $_GET['LTT'];
		$strRRN = $_GET['RRN'];
		$strAIR = $_GET['AIR'];
		$strAN = $_GET['AN'];
		$strM = $_GET['M'];
		
		$combine = $strRC."&".$strMID."&".$strONO."&".$strLTD."&".$strLTT."&".$strRRN."&".$strAIR."&".$strAN."&".$mac;
        $myM = md5($combine);
		
		echo "檢查碼:".$myM;
    }
    else
    {
		
    }
    
    ?>
    
    </body>
</html>