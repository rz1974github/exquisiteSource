<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查詢交易歷程</title>
</head>

<?php

$formalServer = "https://acq.esunbank.com.tw/acq_online/online/sale47.htm";
$testServer = "https://acqtest.esunbank.com.tw/acq_online/online/sale47.htm";

?>

<script src="js/md5.min.js"></script>
<script type="text/javascript">

//var strYAMA = "TNN4HI4VJLYD92RA7X9X93NWLIGAGI0K";
var macKey = "W6AC5THZGNMIEWLF9ZCOMCLD4UN0DXYR";

var combineQueryString = function()
{
	var oForm=document.forms["queryForm"];
	var oMid = oForm.elements["MID"];
	var oONO = oForm.elements["ONO"];
	var oTYP = oForm.elements["TYP"];
	var oTRANS = oForm.elements["TRANSNUM"];
	var oVer = oForm.elements["VERSION"];
	var oCombined = document.getElementById("COMBINED");
	var strCombined = oMid.value + "&" + oONO.value + "&" + oTYP.value + "&" + oTRANS.value + "&" + oVer.value + "&" +macKey;
	oCombined.value = strCombined;
	var oM = oForm.elements["M"];
	var strM = md5(strCombined);
	oM.value = strM;
}

var submitForm = function(event,actionStr)
{
	event.preventDefault();
	var oForm=document.forms["queryForm"];
	combineQueryString();
	oForm.action = actionStr;
	
	/*
	var oSelect=document.forms["selectServer"];
	var oServer = oSelect.elements["server"];
	var serverName = oServer.value;
	*/
	oForm.submit();
}
</script>

<body>
	<h1>查詢交易歷程</h1>
	目標伺服器:
	<!--form id="selectServer">    
    	<ul>
        <li><input type="radio" name="server" value="<?php echo $formalServer ?>" checked />正式伺服器<?php echo $formalServer ?></li>
        <li><input type="radio" name="server" value="<?php echo $testServer ?>" /> 測試伺服器<?php echo $testServer ?></li>
        </ul>
    </form-->
    <li><input type="button" value="組合字串" onClick="combineQueryString()" /></li>
    <li>押碼字串(不傳送)<input id="COMBINED" type="text" size="128" value="" />    </li>
    
    <form id="queryForm" name="queryForm" method="post" action="<?php echo $formalServer ?>">
        <ul>
            <li>特店代碼<input type="text" name="MID" value="8089007566" />    </li>
            <li>訂單編號<input type="text" name="ONO" value="12345678"/>    </li>
            <li>交易類別<input type="text" name="TYP" value="01" />    </li>
            <li>交易序號<input type="text" name="TRANSNUM" value="2132154552" />    </li>
            <li>版本<input type="text" name="VERSION" value="01" />    </li>
            <li>押碼<input type="text" name="M" size="40" value="" />    </li>
            <li><input type="submit" value="送出測試伺服器" onClick="submitForm(event,'<?php echo $testServer ?>')" /></li>
            <li><input type="submit" value="送出正式伺服器" onClick="submitForm(event,'<?php echo $formalServer ?>')" /></li>
        </ul>
    </form>
</body>
</html>