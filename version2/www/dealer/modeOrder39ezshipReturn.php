
<?php

	session_start();
	
	include("../common/sharedCode.php");
	include("../product/sendEmail.php");
	include_once("../product/member_common.php");
	
	if($_REQUEST['sn_id']=="00000000")
	{
		echo "回傳order_id:".$_REQUEST['order_id']."<br />";
		echo "回傳sn_id:".$_REQUEST['sn_id']."<br />";
		echo "回傳order_status:".$_REQUEST['order_status']."<br />";

		//echo "回傳webPara:".$_REQUEST['webPara']."<br />";
		
		header("location:{$_SESSION['pageBase']}?mode=modeOrder3Confirm&Error=true&order_status={$_REQUEST['order_status']}");
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
                                        <td>姓名: {$_SESSION['ship_name']}</td><td>電話: {$_SESSION['ship_mobile']}</td><td>{$_SESSION['ship_email']}</td>
                                      </tr>
messageHTML2;

		$finalMessage.=$messageHTML2;
		
		if($_SESSION['deliever']=="1")
		{
			$finalMessage.="<tr><td colspan='3'>郵遞區號:{$_SESSION['ship_zip']}</td></tr>";
			$finalMessage.="<tr><td colspan='3'>地址:{$_SESSION['ship_addr']}</td></tr>";
		}
		
		if($_SESSION['order_type']=="10")
		{
			$finalMessage.="<tr><td colspan='3'>信用卡號:{$_SESSION['AN']}</td></tr>";
		}

		$TotalCount=0;
		
		$columnList="";
		$valueList="";
		foreach($_SESSION['productCart'] as $key => $obj)
		{	
			$thisCount=$obj->count;
			$TotalCount+=$thisCount;
			$price=$obj->price;
			
			$columnList.=",";
			$valueList.=",";
			$columnList.=$item;
			$valueList.="'{$thisCount}'";
			
			$smallPrice=$price * $thisCount;
			
			$finalMessage.="<tr><td>{$obj->name}</td><td colspan='2'>小計:\${$price}X{$thisCount}=\${$smallPrice}</td></tr>";
		}
		$finalMessage.="<tr><td style='text-align:right;'>總件數:{$TotalCount}</td><td colspan='2' style='text-align:right;'>商品總金額:\${$_SESSION['merchantTotal']}</td></tr>";
		if($_SESSION['order_discount']<0.999)
		{
			$discountStr=($_SESSION['order_discount']*10)."折";
			$finalMessage.="<tr><td></td><td>                                </td><td style='text-align:right;'>折扣:{$discountStr}</td></tr>";
		}
		if($_SESSION['pointsToUse']>0)
		{
			$pointsStr="使用".$_SESSION['pointsToUse']."點/原有".$_SESSION['oldPoints']."點";
			$finalMessage.="<tr><td></td><td>                                </td><td style='text-align:right;'>紅利點數:{$pointsStr}</td></tr>";
		}		
		if($_SESSION['order_discount']<0.999)
		{	
			$finalMessage.="<tr><td></td><td>                                </td><td style='text-align:right;'>折扣後金額:\${$_SESSION['discount_merchant']}</td></tr>";
		}		
		$finalMessage.="<tr><td></td><td>                                </td><td style='text-align:right;'>運費:\${$_SESSION['shippingFee']}</td></tr>";
		if($_SESSION['orderMode']!=0)
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

	include_once('../product/productSql.php');
	
	$order_sn=insertCustomerAndOrder(
		$_SESSION['ship_name'],
		$_SESSION['ship_email'],
		$_SESSION['ship_mobile'],
		$_SESSION['ship_addr'],
		$_SESSION['ship_zip'],
		$_SESSION['member_sn'],
		$_SESSION['order_member']);
	insertOrderDetail3($order_sn);
	insertCreditCart($order_sn);
	//不必updateMember
	insertUsedPoints($_SESSION['currentDealer'],$_SESSION['order_serial'],$_SESSION['oldPoints']);
	
	$finalMessage.=$messageHTML3;
	$_SESSION['finalMessage']=$finalMessage;

	sendOrderMail($finalMessage,$_SESSION['ship_email'],$_SESSION['ship_name'],$_SESSION['rv_email']);
	
	header("location:{$_SESSION['pageBase']}?mode=modeOrder3Confirm&success=true");
}//else

?>
