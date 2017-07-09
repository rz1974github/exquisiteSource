<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>沖正交易</title>
</head>
<body>
	<h1>沖正交易</h1>
    <form id="flushForm" name="flushForm" action="flush.php" method="post">
        訂單編號:<input type="text" 			name="ONO" 		size="40" /><br />
        交易類別:<select name="TYP" id="TYP">
							 <option value="05">授權</option>
							 <option value="51">取消授權</option>
						  </select><br />
        操作人員授權碼:<input type="text" 		name="authorize" size="20" />
        <input type="hidden" 	name="Submit2" value="true" />
        <input type="submit" value="送出">
    </form>
</body>
</html>