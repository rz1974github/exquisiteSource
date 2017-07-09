<?php

	include_once('../global.php');
	
	$order_typeString="";
	switch($_SESSION['order_type'])
	{
		case "1":
			$order_typeString="貨到付款";
		break;
		case "10":
			$order_typeString="信用卡線上刷卡";
		break;
		case "3":
			$order_typeString="ATM付款";
		break;
	}
	
	$delieverString="";
	switch($_SESSION['deliever'])
	{
		case "1":
			$delieverString="宅配";
		break;
		case "3":
			$delieverString="超商店配(OK 全家 萊爾富)";
		break;
	}
	
	$delieverTimeStr="";
	switch($_SESSION['delieverTime'])
	{
		case "0":
		case "1":
			$delieverTimeStr="不指定送貨時間";
		break;
		case "2":
			$delieverTimeStr="中午以前送貨";
		break;
		case "3":
			$delieverTimeStr="12~17時送貨";
		break;
		case "4":
			$delieverTimeStr="17~20時送貨";
		break;
	}
	
	function updateSession()
	{		
		//Calculate
		$_SESSION['discount_merchant']=round($_SESSION['merchantTotal']*$_SESSION['order_discount']);
		$_SESSION['newPoints']=floor($_SESSION['discount_merchant']*0.01)*5;
		if(userLogged())
		{
			if(!isDealer())
			{
				$_SESSION['pointsToUse'] = min(min($_SESSION['member_points'],$_SESSION['discount_merchant']),$_SESSION['max_pointsToUse']);
			}
		}		
		$_SESSION['discount_merchant']-=$_SESSION['pointsToUse'];
		
		//Fee
		$_SESSION['shippingFee']=$_SESSION['basicShipping'];
		if($_SESSION['discount_merchant']>=$_SESSION['noFeeAmount'])
		{
			$_SESSION['shippingFee']=0;
		}
		$_SESSION['total_money']=$_SESSION['discount_merchant']+$_SESSION['shippingFee'];
	}

?>