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
<?php
/*
$toURL = $selectServer;
$post = array(
	"MID"=>$oMID,
	"ONO"=>$_POST['ONO'],
	"TYP"=>"01",
	"TRANSNUM"=>"",
	"VERSION"=>"01",
	"M"=>$oM,
);

echo "before curl<br />";
$ch = curl_init();
$options = array(
	CURLOPT_URL=>$toURL,
	CURLOPT_HEADER=>0,
	CURLOPT_VERBOSE=>0,
	CURLOPT_RETURNTRANSFER=>true,
	CURLOPT_USERAGENT=>"Mozilla/4.0 (compatible;)",
	CURLOPT_POST=>true,
	CURLOPT_POSTFIELDS=>http_build_query($post),
);
curl_setopt_array($ch, $options);

echo "before execute<br />";

// CURLOPT_RETURNTRANSFER=true 會傳回網頁回應,
// false 時只回傳成功與否
$result = curl_exec($ch);

echo "after curl_exec<br />";

curl_close($ch);
echo $result;

echo "after result<br />";
*/
	$ch = curl_init(); 

	// set url 
	curl_setopt($ch, CURLOPT_URL, "https://acqtest.esunbank.com.tw/acq_online/online/sale47.htm");

	//return the transfer as a string 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
	curl_setopt($ch, CURLOPT_PROTOCOLS,  CURLPROTO_HTTPS);
	//curl_setopt($ch, CURLOPT_HEADER, false);
	
	//curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
	//curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);	

	// $output contains the output string 
	$output = curl_exec($ch); 
	echo "curl_exec:".curl_error($ch);
	echo "<br />";

	// close curl resource to free up system resources 
	curl_close($ch);
	
	if($output==false)
	{
		echo "return false";
	}
	else
	{
		echo $output;
	}
?>

    </body>
</html>
