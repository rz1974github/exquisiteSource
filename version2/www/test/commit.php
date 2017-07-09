<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>type42交易</title>
</head>

<?php

$formalServer = "https://acq.esunbank.com.tw/acq_online/online/sale42.htm";
$testServer = "https://acqtest.esunbank.com.tw/acq_online/online/sale42.htm";

?>

<script src="js/md5.min.js"></script>
<script type="text/javascript">

var macKey1 = "TNN4HI4VJLYD92RA7X9X93NWLIGAGI0K";
var macKey2 = "W6AC5THZGNMIEWLF9ZCOMCLD4UN0DXYR";

var submitForm = function(event,actionStr)
{
	event.preventDefault();
	var oForm=document.forms["commitForm"];
	combineCommitString();
	oForm.action = actionStr;
	/*
	var oSelect=document.forms["selectServer"];
	var oServer = oSelect.elements["server"];
	var serverName = oServer.value;
	oForm.action = serverName;
	*/
	
	oForm.submit();
}

/*
<特店代碼> + "&" +
<子特店代號> + "&" +
<終端機代號> + "&" +
<訂單編號> + "&" +
<交易金額> + "&" +
<URL> + "&" +
<押碼 KEY > 
*/

var combineCommitString = function()
{
	var oForm=document.forms["commitForm"];
	var oMid = oForm.elements["MID"];
	var oTid = oForm.elements["TID"];
	var oONO = oForm.elements["ONO"];
	var oTA = oForm.elements["TA"];
	var oURL = oForm.elements["U"];
	var oCombined = document.getElementById("COMBINED");
	var oMacKey = document.getElementById("macKey");
	
	var strCombined = oMid.value + "&&" + oTid.value + "&" + oONO.value + "&" + oTA.value + "&" + oURL.value + "&" +oMacKey.value;
	oCombined.value = strCombined;
	var oM = oForm.elements["M"];
	var strM = md5(strCombined);
	oM.value = strM;
}
</script>

<body>
	<h1>type42交易</h1>
	<!--目標伺服器:
	<form id="selectServer">    
    	<ul>
        <li><input type="radio" name="server" value="<?php echo $formalServer ?>" checked /> 正式伺服器<?php echo $formalServer ?></li>
        <li><input type="radio" name="server" value="<?php echo $testServer ?>" /> 測試伺服器<?php echo $testServer ?></li>
        </ul>
    </form>
    -->
    <li>MAC KEY<input type="text" id="macKey" name="macKey" size="48" value="W6AC5THZGNMIEWLF9ZCOMCLD4UN0DXYR"/>    </li>
    <li><input type="button" value="組合字串" onClick="combineCommitString()" /></li>
    <li>押碼字串(不傳送)<input id="COMBINED" type="text" size="128" value="" />    </li>
    
    <form id="commitForm" name="commitForm" action="<?php echo $formalServer ?>" method="post">
        <ul>
            <li>特店代碼<input type="text" name="MID" note="8080011817" value="8089007566" />    </li>
            <li>子特店代碼<input type="text" name="CID" value="" />    </li>
            <li>終端機代號<input type="text" name="TID" value="EC000001" />    </li>
            <li>訂單編號<input type="text" name="ONO" value="1285223782714"/>    </li>
            <li>消費金額<input type="text" name="TA" value="250"/>    </li>
            <li>URL<input type="text" name="U" size="60" remark="/TestACQ/print.html" value="http://www.exquisite.com.tw/test/return.php" />    </li>
            <li>押碼<input type="text" name="M" size="40" value="" />    </li>
            <li><input type="submit" value="送出測試伺服器" onClick="submitForm(event,'<?php echo $testServer ?>')" /></li>
            <li><input type="submit" value="送出正式伺服器" onClick="submitForm(event,'<?php echo $formalServer ?>')" /></li>
        </ul>
    </form>
</body>
</html>