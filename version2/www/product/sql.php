<?php

include_once('member_common.php');
include_once('../common/sql_common.php');

	$sql = "insert into customer (name,email,mobile,addr,zip) values('{$_SESSION['rv_name']}','{$_SESSION['rv_email']}','{$_SESSION['rv_mobile']}','{$_SESSION['rv_addr']}','{$_SESSION['rv_zip']}')";

	Q($sql,"無法寫入顧客資料!");
	$customer_sn=mysql_insert_id();
	$payString = payEnum($_SESSION['order_type']);
	$sendString=sendEnum($_SESSION['deliever']);
	$dateStr = date("Y-m-d");
	
	$memberField="";
	$memberValue="";
	if(isset($_SESSION['member_email']) && ($_SESSION['member_email']!="guest"))
	{
		$memberField=",member_sn,discount,point_used,point_gained";
		$memberValue=",'{$_SESSION['member_sn']}','{$_SESSION['order_discount']}','{$_SESSION['pointsToUse']}','{$_SESSION['newPoints']}'";
	}
	
	$sql = "insert into ordertable (order_serial,easyship,customer_sn{$memberField},pay,send,market,date,message,money,shipping,merchantTotal) values('{$_SESSION['order_serial']}','{$_SESSION['sn_id']}','{$customer_sn}'{$memberValue},'{$payString}','{$sendString}', '{$_SESSION['stName']}','{$dateStr}','{$_SESSION['message']}','{$_SESSION['total_money']}','{$_SESSION['shippingFee']}','{$_SESSION['merchantTotal']}')";
	Q($sql,"無法寫入訂單資料!");
	
	$order_sn=mysql_insert_id();
	
	if($columnList!="")
	{
		$sql = "insert into orderdetail ( order_sn {$columnList}) values($order_sn {$valueList})";
		Q($sql,"無法寫入訂單明細!");
	}
	
	//新型細部資料表
	foreach($productList as $item)
	{
		$thisCount=$_SESSION[$item];
		$price=$productPrice[$item];
		$finalPrice = $price * $_SESSION['order_discount'];
		if($thisCount>0)
		{
			if($item=="set_tender")
			{				
			}//if
			elseif($item=="set_candy")
			{				
			}//if			

			$sql = "insert into order_detail ( order_sn,product,price,count,discount) values($order_sn,'{$item}',{$price},{$thisCount},{$_SESSION['order_discount']})";
			Q($sql,"無法寫入訂單明細!");			
		}//if
	}//foreach	
	
	if($_SESSION['order_type']=="10")
	{
		//
		//
		$sql = "insert into creditcard ( order_sn,LTD,LTT,RRN,AIR,AN)  values($order_sn,{$_SESSION['LTD']},{$_SESSION['LTT']},{$_SESSION['RRN']},{$_SESSION['AIR']},'{$_SESSION['AN']}')";
		Q($sql,"無法寫入刷卡資料!");
	}

	function insertSet($order_sn,$sqlName)
	{	
		if(!isset($_SESSION[$sqlName])) return;
		$setCount=count($_SESSION[$sqlName]);
		if($setCount>0)
		{
			for($b=0;$b<$setCount;$b++)
			{
				$setColumns=$_SESSION[$sqlName][$b]['columns'];
				$setCounts=$_SESSION[$sqlName][$b]['counts'];
				
				$sql = "insert into orderdetail ( order_sn {$setColumns}) values($order_sn {$setCounts})";
				Q($sql,"無法寫入禮盒明細!");
				//die("insertSet".$sql);
			}
		}//if
	}

	//新型禮盒組資料
	function insertSetNew($order_sn,$detailName)
	{	
		global $productPrice;
		if(!isset($_SESSION[$detailName])) return;
		$setCount=count($_SESSION[$detailName]);
		if($setCount>0)
		{
			for($b=0;$b<$setCount;$b++)
			{			
				$c=$b+1;	
				$count = count($_SESSION[$detailName][$b]);
				foreach($_SESSION[$detailName][$b] as $setItem => $itemCount)
				{
					if($setItem=='total') continue;
					
					//$currentItem=$productName[$setItem]." x ".$itemCount;
					//$setColumns.=$setItem;
					//$setCounts.="'{$itemCount}'";
					$price=$productPrice[$setItem];
					$sql = "insert into order_detail ( order_sn,product,price,count,discount,set_index) values($order_sn,'{$setItem}',{$price},{$itemCount},{$_SESSION['order_discount']},{$c})";
					Q($sql,"無法寫入禮盒明細!");					
				}//for a
				//die("insertSet".$sql);
			}
		}//if
	}
		
	insertSet($order_sn,'sqlSetTender');
	insertSet($order_sn,'sqlSetCandy');
		
	insertSetNew($order_sn,'set_tender_detail');
	insertSetNew($order_sn,'set_candy_detail');
	
	if(userLogged())
	{
		$addrUpdate="";
		if(isset($_SESSION['rv_addr']))
		{
			$addrUpdate=",addr='{$_SESSION['rv_addr']}'";
		}
	
		$zipUpdate="";
		if(isset($_SESSION['rv_zip']))
		{
			$zipUpdate=",zip='{$_SESSION['rv_zip']}'";
		}
		
		//memberPoints改由收款後才有效
		//$memberPoints=$_SESSION['remainPoints']+$_SESSION['newPoints'];
		//,points='{$memberPoints}' 
		
		$sql = "update member set name='{$_SESSION['rv_name']}' ,mobile='{$_SESSION['rv_mobile']}' {$addrUpdate} {$zipUpdate} where member_sn='{$_SESSION['member_sn']}'";
		Q($sql,"無法更新會員資料!");
		
		//die($sql);
	}

?>