<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>線上授權取消</title>
</head>
<body>
	<h1>線上授權取消</h1>
    <form id="cancelForm" name="cancelForm" action="cancel.php" method="post">
        訂單編號:<input type="text" 			name="ONO" 		size="40" /><br />
        操作人員授權碼:<input type="text" 		name="authorize" size="20" />
        <input type="hidden" 	name="Submit2" value="true" />
        <input type="submit" value="取消授權">
    </form>
</body>
</html>