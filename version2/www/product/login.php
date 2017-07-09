<?php 
	
	include_once('../global.php');
	
	session_start();
	
	include_once('../common/sql_common.php');

	$sql="select * from member where email='{$_REQUEST['email']}'";

	$result=Q($sql,"無法取得會員資料庫!");
	
	$data = mysql_fetch_assoc($result);
	
	if(empty($data))
	{
		$_SESSION['member_email']=null;
		$_SESSION['order_discount']=1;
		header("location:member.php?error=1&from={$_REQUEST['from']}");
		exit(0);
	}
	else
	{
		if($data['passwd']!=$_REQUEST['passwd'])
		{
			$_SESSION['member_email']=null;
			$_SESSION['order_discount']=1;
			header("location:member.php?error=2&from={$_REQUEST['from']}");
			exit(0);
		}
		else
		{	
			$_SESSION['passwd']=$data['passwd'];
			$_SESSION['member_sn']=$data['member_sn'];
			
			$_SESSION['member_email']=$data['email'];
			$_SESSION['rv_email']=$_SESSION['member_email'];
			
			$_SESSION['member_name']=$data['name'];
			$_SESSION['rv_name']=$data['name'];
			
			$_SESSION['rv_mobile']=$data['mobile'];
			
			$_SESSION['rv_addr']=$data['addr'];
			
			$_SESSION['rv_zip']=$data['zip'];
			
			$_SESSION['member_discount']=$data['discount'];
			$_SESSION['member_points']=$data['points'];
			
			//不管如何都預設折扣
			//$_SESSION['order_discount']=$_SESSION['member_def_discount'];
			
			//會員有更低折扣
			$_SESSION['order_discount']=$_SESSION['member_discount'];
			
			$_SESSION['pointsToUse']=0;
			$_SESSION['privalege']=$data['privalege'];
			$_SESSION['isDealer']=$data['isDealer'];
			$_SESSION['belongDealer']=$data['belongDealer'];

			header("location:{$_REQUEST['from']}");
			exit(0);
		}
	}
?>