<?php 

	session_start();

	include_once('../global.php');
	include_once('../common/sql_common.php');
	
	if($_REQUEST['passwd']!=$_REQUEST['passwd2'])
	{
		$_SESSION['member_email']=null;
		$_SESSION['order_discount']=1;
		//die("兩次密碼並不相同");
		header("location:member.php?error=31");
		exit(0);
	}
	
	if($_REQUEST['legal']!="是的")
	{
		$_SESSION['member_email']=null;
		$_SESSION['order_discount']=1;
		//die("未勾選服務條款");
		header("location:member.php?error=35");
		exit(0);
	}	

	$sql="select * from member where email='{$_REQUEST['email']}'";

	$result=Q($sql,"無法取得會員資料庫!");
	
	$data = mysql_fetch_assoc($result);
	
	if(empty($data))
	{
		//沒有人註冊過	
		$today=date("Y-m-d");
		$sql = "insert into member (email,passwd,name,discount,applyDate) values('{$_REQUEST["email"]}','{$_REQUEST["passwd"]}','{$_REQUEST["name"]}',{$_SESSION['member_def_discount']},CURDATE())";
		Q($sql,"資料寫入發生錯誤!");
		
		$_SESSION['member_sn']=mysql_insert_id();
		$_SESSION['member_email']=$_REQUEST['email'];
		$_SESSION['member_name']=$_REQUEST['name'];
		$_SESSION['member_mobile']="";
		$_SESSION['member_addr']="";
		$_SESSION['member_zip']="";
		$_SESSION['member_discount']=$_SESSION['member_def_discount'];
		$_SESSION['member_points']=0;
		$_SESSION['pointsToUse']=0;
		$_SESSION['order_discount']=$_SESSION['member_def_discount'];
		
		$_SESSION['rv_email']=$_SESSION['member_email'];		
		$_SESSION['rv_name']=$_SESSION['member_name'];
								
		header("location:{$_SESSION['from']}");
		exit(0);
	}
	else
	{
		if(empty($data['passwd']))
		{
			//有人留過email但沒有成為會員
			/*
			$sql = "update customer set passwd='{$_REQUEST["passwd"]}' ,discount='{$_SESSION['member_def_discount']}' where email='{$_REQUEST["email"]}'";
			Q($sql,"資料寫入發生錯誤!");
			
			$_SESSION['member_email']=$_REQUEST['email'];
			$_SESSION['member_name']="";
			$_SESSION['member_mobile']="";
			$_SESSION['member_addr']="";
			$_SESSION['member_zip']="";
			$_SESSION['member_discount']=$_SESSION['member_def_discount'];
			$_SESSION['order_discount']=$_SESSION['member_def_discount'];
						
			header("location:{$_REQUEST['from']}");
			exit(0);
			*/
		}
		else
		{	
			$_SESSION['member_email']=null;
			$_SESSION['order_discount']=1;
			header("location:member.php?error=30&from={$_SESSION['from']}");
			exit(0);
		}
	}
?>