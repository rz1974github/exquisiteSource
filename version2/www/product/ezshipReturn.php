
<?php

	session_start();
	
	include("../common/sharedCode.php");
	include("sendEmail.php");
	include_once("member_common.php");
	
	if($_REQUEST['sn_id']=="00000000")
	{
		echo "回傳order_id:".$_REQUEST['order_id']."<br />";
		echo "回傳sn_id:".$_REQUEST['sn_id']."<br />";
		echo "回傳order_status:".$_REQUEST['order_status']."<br />";

		//echo "回傳webPara:".$_REQUEST['webPara']."<br />";
		
		header("location:Cart_step4.php?Error=true&order_status={$_REQUEST['order_status']}");
		exit(0);
	}//if
	else
	{
		$_SESSION['sn_id']=$_REQUEST['sn_id'];
		$finalMessage="";

$messageHTML1=<<<messageHTML1
                     <div class="notice">
                       <table class="default">
                               <thead>購物清單資訊<span style="color:#C0F">
messageHTML1;

		$finalMessage.=$messageHTML1;
		$finalMessage.=purchaseType($_SESSION['order_type'],$_SESSION['deliever']);

$messageHTML2=<<<messageHTML2
                               </span></thead>
                                  <tbody>
                                      <tr>
                                        <th colspan="3">訂單號碼:{$_SESSION['order_serial']}</th>
                                      </tr>
                                      <tr>
                                        <th>物流號碼:{$_SESSION['sn_id']}</th>
                                      </tr>
                                      <tr>
                                        <td>姓名: {$_SESSION['rv_name']}</td><td>電話: {$_SESSION['rv_mobile']}</td><td>{$_SESSION['rv_email']}</td>
                                      </tr>
messageHTML2;

		$finalMessage.=$messageHTML2;
		
		if($_SESSION['deliever']=="1")
		{
			$finalMessage.="<tr><td colspan='3'>地址:{$_SESSION['rv_addr']}</td></tr>";
		}
		
		if($_SESSION['order_type']=="10")
		{
			$finalMessage.="<tr><td colspan='3'>信用卡號:{$_SESSION['AN']}</td></tr>";
		}

		$TotalCount=0;
		
		function listSet($item,$detailName,$sqlName)
		{
			global $finalMessage,$productName;
			
			if(!isset($_SESSION[$sqlName]))
			{
				$_SESSION[$sqlName]=array();
			}
			$finalMessage.="<tr><td>{$productName[$item]}</td><td colspan='2'></td></tr>";
			$setCount=count($_SESSION[$detailName]);
			
			for($b=0;$b<$setCount;$b++)
			{
				$setColumns=",";
				$setCounts=",";
				$setColumns.=$item;
				$setCounts.="'1'";
				$_SESSION[$sqlName][$b]=array();
				
				$count = count($_SESSION[$detailName][$b]);
				$c=$b+1;
				if($setCount>1)
				{
					$finalMessage.="<tr><td style='text-align:right;'>第{$c}組</td><td colspan='2'></td></tr>";
				}
				else
				{
					$finalMessage.="<tr><td style='text-align:right;'>內容:</td><td colspan='2'></td></tr>";
				}
				foreach($_SESSION[$detailName][$b] as $setItem => $itemCount)
				{
					if($setItem=='total') continue;
					
					$currentItem=$productName[$setItem]." x ".$itemCount;
					$finalMessage.="<tr><td></td><td colspan='2'>{$currentItem}</td></tr>";
					$setColumns.=",";
					$setCounts.=",";
					$setColumns.=$setItem;
					$setCounts.="'{$itemCount}'";
				}//for a
				$_SESSION[$sqlName][$b]['columns']=$setColumns;
				$_SESSION[$sqlName][$b]['counts']=$setCounts;
			}//for b
		}//listSet
		
		$columnList="";
		$valueList="";
		foreach($productList as $item)
		{
			$thisCount=$_SESSION[$item];
			$TotalCount+=$thisCount;
			$price=$productPrice[$item];
			if($thisCount>0)
			{
				if($item=="set_tender")
				{
					listSet($item,'set_tender_detail','sqlSetTender');
				}//if
				elseif($item=="set_candy")
				{
					listSet($item,'set_candy_detail','sqlSetCandy');
				}//if
				else
				{
					$columnList.=",";
					$valueList.=",";
					$columnList.=$item;
					$valueList.="'{$thisCount}'";
					
					$smallPrice=$price * $thisCount;
					$finalMessage.="<tr><td>{$productName[$item]}</td><td colspan='2'>小計:\${$price}X{$thisCount}=\${$smallPrice}</td></tr>";
				}
			}//if
		}//foreach
		$finalMessage.="<tr><td style='text-align:right;'>總件數:{$_SESSION['total_count']}</td><td colspan='2' style='text-align:right;'>商品總金額:\${$_SESSION['merchantTotal']}</td></tr>";
		if($_SESSION['order_discount']<0.999)
		{
			$discountStr=($_SESSION['order_discount']*10)."折";
			$finalMessage.="<tr><td></td><td>                                </td><td style='text-align:right;'>會員折扣:{$discountStr}</td></tr>";
		}
		if($_SESSION['pointsToUse']>0)
		{
			$pointsStr="使用".$_SESSION['pointsToUse']."點/原有".$_SESSION['member_points']."點";
			$finalMessage.="<tr><td></td><td>                                </td><td style='text-align:right;'>紅利點數:{$pointsStr}</td></tr>";
		}		
		if($_SESSION['order_discount']<0.999)
		{	
			$finalMessage.="<tr><td></td><td>                                </td><td style='text-align:right;'>折扣後金額:\${$_SESSION['discount_merchant']}</td></tr>";
		}		
		$finalMessage.="<tr><td></td><td>                                </td><td style='text-align:right;'>運費:\${$_SESSION['shippingFee']}</td></tr>";
		if(userLogged())
		{
			$finalMessage.="<tr><td></td><td>                                </td><td style='text-align:right;'>獲得點數:{$_SESSION['newPoints']}點</td></tr>";
		}		
		$finalMessage.="<tr><td></td><td>                                </td><td style='text-align:right;'>總金額:\${$_SESSION['total_money']}</td></tr>";
		
$shopSection=<<<shopSection
                                      <tr>
                                      	<td>取貨門市</td><td>門市電話</td><td>地址</td>
                                      </tr>
                                      <tr>  
                                        <td>{$_SESSION['stName']}</td><td>{$_SESSION['stTel']}</td><td>{$_SESSION['stAddr']}</td>
                                      </tr>
shopSection;

if($_SESSION['deliever']=="3")
{
	$finalMessage.=$shopSection;
}//if

$ATMSection=<<<ATMSection
                                      <tr>
                                      	<th>ATM匯款帳號:</th>
                                      </tr>
                                      <tr>
                                          <td>銀行代碼:</td><td colspan="2">銀行名稱:</td>
                                      </tr>
                                      <tr>
                                          <td>808</td><td colspan="2">玉山銀行</td>
                                      </tr>
                                      <tr>
                                          <td>分行名稱:</td><td colspan="2">帳號:</td>
                                      </tr>
                                      <tr>
                                          <td>中工分行</td><td colspan="2">1252-940-009256</td>
                                      </tr>
ATMSection;

if($_SESSION['order_type']=="3")
{
	$finalMessage.=$ATMSection;
}

$messageHTML3=<<<messageHTML3

										<tr>
                                        	<td>備註事項</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">{$_SESSION['message']}</td>                                        
                                        </tr>
                                    </tbody>
                            </table>
                    </div>
messageHTML3;

	include_once('productSql.php');
	
	$order_sn=insertCustomerAndOrder($_SESSION['rv_name'],$_SESSION['rv_email'],$_SESSION['rv_mobile'],$_SESSION['rv_addr'],$_SESSION['rv_zip'],0,$_SESSION['member_sn']);
	insertOrderDetail2($order_sn);
	insertCreditCart($order_sn);
	updateMember();
	insertUsedPoints($_SESSION['member_sn'],$_SESSION['order_serial'],$_SESSION['member_points']);
	
	$finalMessage.=$messageHTML3;
	$_SESSION['finalMessage']=$finalMessage;

	sendOrderMail($finalMessage,$_SESSION['rv_email'],$_SESSION['rv_name'],"");
	
	header("location:Cart_step4.php");
}//else

?>
