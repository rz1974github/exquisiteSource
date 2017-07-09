<?php 

define("_USER","vhost83020");
define("_PASSWD","38492504jk");
define("_DB","vhost83020");

$link = @mysql_connect("localhost:3306",_USER,_PASSWD) or die("無法連上資料庫!".mysql_error());

mysql_query("SET NAMES UTF8");

if (!mysql_select_db(_DB, $link)) 
{
	echo 'Could not select database';
	exit;
}

function Q($sql,$error)
{
	global $link;
	
	$result=mysql_query($sql,$link) or die($error."<br />".$sql);
	return $result;
}

?>