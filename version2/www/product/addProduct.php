<?php

	include('orderSerial.php');
	
	session_start();

	include("../common/sharedCode.php");
	
	$_SESSION['showMessage']=false;
	if(isset($_REQUEST['order_discount']))
	{
		$_SESSION['order_discount']=$_REQUEST['order_discount'];
	}
	
	function addSet($detailName,$currentIndex)
	{
			$slot=$_REQUEST['slot'];
			
			if(!isset($_SESSION[$detailName]))
			{
				$_SESSION[$detailName]= array();
			}
			$_SESSION[$detailName][$currentIndex]=array();
			
			foreach($slot as $item)
			{
				if(!isset($_SESSION[$detailName][$currentIndex][$item]))
				{
					$_SESSION[$detailName][$currentIndex][$item]=1;
				}
				else
				{
					$_SESSION[$detailName][$currentIndex][$item]++;
				}
			}
	}
	
	if(isset($_REQUEST['product']))
	{
		$product=$_REQUEST['product'];
		$count=number_format($_REQUEST['qty']);
		if(!isset($_SESSION[$product])) 	$_SESSION[$product]=0;	
		$_SESSION[$product]+=$count;
		$_SESSION['showMessage']=true;
		
		if($product=="set_tender")
		{
			$currentIndex = $_SESSION[$product]-1;
			addSet('set_tender_detail',$currentIndex);
		}
		
		if($product=="set_candy")
		{
			$currentIndex = $_SESSION[$product]-1;
			addSet('set_candy_detail',$currentIndex);
		}
	}//if
		
	$total_count=0;
	foreach($productList as $item)
	{
		if(!isset($_SESSION[$item])) 	$_SESSION[$item]=0;
		$thisCount=$_SESSION[$item];
		$total_count+=$thisCount;
	}//foreach
	$_SESSION['total_count']=$total_count;
			
	//specialCode
	$_SESSION['activity']="normal";
	if(($_SESSION['gift_small']>0) || ($_SESSION['gift_care']>0) || ($_SESSION['gift_energy']>0) || ($_SESSION['gift_young']>0))
	{
		$_SESSION['activity']="gift20150207";
	}
?>