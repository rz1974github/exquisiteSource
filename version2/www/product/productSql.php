<?php

include_once('../product/member_common.php');
include_once('../common/sql_common.php');

function insertCustomerAndOrder($name,$email,$mobile,$addr,$zip,$dealerSN,$memberSN)
{
	$sql = "insert into customer (name,email,mobile,addr,zip) values('{$name}','{$email}','{$mobile}','{$addr}','{$zip}')";

	Q($sql,"無法寫入顧客資料!");
	$customer_sn=mysql_insert_id();
	$payString = payEnum($_SESSION['order_type']);
	$sendString=sendEnum($_SESSION['deliever']);
	$dateStr = date("Y-m-d");
	
	$memberField="";
	$memberValue="";
	if(isset($_SESSION['member_email']) && ($_SESSION['member_email']!="guest"))
	{
		$memberField=",dealer_sn,member_sn,discount,point_used,point_gained";
		$memberValue=",'{$dealerSN}','{$memberSN}','{$_SESSION['order_discount']}','{$_SESSION['pointsToUse']}','{$_SESSION['newPoints']}'";
		//,'{$_SESSION['member_sn']}','{$_SESSION['order_member']}','{$_SESSION['order_discount']}','{$_SESSION['pointsToUse']}','{$_SESSION['newPoints']}'
		//			     ,'{$_SESSION['member_sn']}'   ,'{$_SESSION['order_discount']}','{$_SESSION['pointsToUse']}','{$_SESSION['newPoints']}'
	}
	
	$sql = "insert into ordertable (order_serial,easyship,customer_sn{$memberField},pay,send,market,date,message,money,shipping,merchantTotal) values('{$_SESSION['order_serial']}','{$_SESSION['sn_id']}','{$customer_sn}'{$memberValue},'{$payString}','{$sendString}', '{$_SESSION['stName']}','{$dateStr}','{$_SESSION['message']}','{$_SESSION['total_money']}','{$_SESSION['shippingFee']}','{$_SESSION['merchantTotal']}')";
	Q($sql,"無法寫入訂單資料!");
	
	$order_sn=mysql_insert_id();
	return $order_sn;
}	

function insertOrderDetail3($order_sn)
{
	//新型細部資料表
	foreach($_SESSION['productCart'] as $key => $obj)
    {	
		//$javaAdd.="<script>productAdded[{$key}]=new productItem('{$obj->type}','{$obj->name}',{$obj->count},{$obj->price});
		$thisCount=$obj->count;
		$price=$obj->price;
		$finalPrice = $price * $_SESSION['order_discount'];
		$sql = "insert into order_detail ( order_sn,product,price,count,discount) values($order_sn,'{$obj->type}',{$price},{$thisCount},{$_SESSION['order_discount']})";
		Q($sql,"無法寫入訂單明細!");			
	}
}
    
function insertOrderDetail2($order_sn)
{
	global $productList,$productPrice;
	
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
	
		
	insertSetNew($order_sn,'set_tender_detail');
	insertSetNew($order_sn,'set_candy_detail');
}

function insertCreditCart($order_sn)
{
	if($_SESSION['order_type']=="10")
	{
		//
		//
		$sql = "insert into creditcard ( order_sn,LTD,LTT,RRN,AIR,AN)  values($order_sn,{$_SESSION['LTD']},{$_SESSION['LTT']},{$_SESSION['RRN']},{$_SESSION['AIR']},'{$_SESSION['AN']}')";
		Q($sql,"無法寫入刷卡資料!");
	}
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

function updateMember()
{	
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
		
		$sql = "update member set name='{$_SESSION['rv_name']}' ,mobile='{$_SESSION['rv_mobile']}' {$addrUpdate} {$zipUpdate} where member_sn='{$_SESSION['member_sn']}'";
		Q($sql,"無法更新會員資料!");
	}
}

function insertUsedPoints($memberSN,$orderSerial,$oldPoints)
{	
	if($_SESSION['pointsToUse']==0) return;
	
	if(userLogged())
	{
		//$_SESSION['member_points']
		//$_SESSION['pointsToUse']
		
		$dateStr = date("Y-m-d");
		$pointTrans=$_SESSION['pointsToUse']*(-1.0);
		$pointsSum=$oldPoints+$pointTrans;		
		
		//更新會員紅利
		$sql = "update member set points='{$pointsSum}' where member_sn='{$memberSN}'";
		$sqlReturn = Q($sql,"無法更新會員資料");
		
		//紅利紀錄
		$comment.="訂單使用紅利抵購物金";
		
		$sql = "insert into pointTrans 
		(date,member_sn,fromPoint,trans,toPoint,order_serial,comment)  values('{$dateStr}','{$memberSN}','{$oldPoints}',{$pointTrans},{$pointsSum},'{$orderSerial}','{$comment}')";
		$sqlReturn = Q($sql,"無法寫入紅利紀錄");
	}
}

?>