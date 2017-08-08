<?php

	session_start();

	include("../common/sharedCode.php");	
							 
	if(isset($_REQUEST['product']))
	{
		//要刪除的商品名稱
		$product=$_REQUEST['product'];
		if(!isset($_SESSION[$product])) 	$_SESSION[$product]=0;
		if(($product=='set_tender') || ($product=='set_candy'))
		{
			//數量減1
			$_SESSION[$product]--;
			
			$detailName = $product."_detail";
			
			//禮盒組編號
			$setIndex = $_REQUEST['setIndex'];
			
			//從陣列中去除
			array_splice($_SESSION[$detailName],$setIndex,1);
		}
		else
		{
			$_SESSION[$product]=0;
		}//else
	}//if
		
	$total_count=0;
	foreach($productList as $item)
	{
		if(!isset($_SESSION[$item])) 	$_SESSION[$item]=0;
		$thisCount=$_SESSION[$item];
		$total_count+=$thisCount;
	}//foreach
	$_SESSION['total_count']=$total_count;
	
	header("location:Cart.php");
	
?>