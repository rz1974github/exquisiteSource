<!DOCTYPE HTML>
<!--
	Miniport by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
    <title>購物車清單</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.scrolly.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/init.js"></script>
    <noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
    <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
    <!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->

    <script type="text/javascript">
        var parameterChanged = function() {
            var oTotal = document.getElementById("id_total");

            //折扣
            var oOrderDiscount = document.getElementById("id_order_discount");
            if (oOrderDiscount != null) {
                js_orderDiscount = oOrderDiscount.value;
            }

            //點數
            var js_discountMerchant = Math.round(js_merchantTotal * js_orderDiscount);
            oRemainPoint = document.getElementById("id_remain");
            if (js_userLogged) {
                if (js_isDealer) {
                    oPoint = document.getElementById("id_pointsToUse_input");
                    js_pointsToUse = oPoint.value;
                    var js_maxValue = Math.min(Math.min(js_discountMerchant, js_member_points), var_jsMaxPointsToUse);
                    oPoint.setAttribute('maxvalue', js_maxValue);
                } else {
                    js_pointsToUse = Math.min(Math.min(js_discountMerchant, js_member_points), var_jsMaxPointsToUse);
                    oPoint = document.getElementById("id_pointsToUse");
                    if (oPoint != null) {
                        oPoint.innerHTML = js_pointsToUse;
                    }
                }
                js_remainPoint = js_member_points - js_pointsToUse;
                oRemainPoint.innerHTML = js_remainPoint;
            }

            //折扣後金額
            js_discountMerchant -= js_pointsToUse;
            var oDiscountMerchant = document.getElementById("id_discount_merchant");
            if (oDiscountMerchant != null) {
                oDiscountMerchant.innerHTML = "NT$ " + js_discountMerchant + "元";
            }

            //運費改變
            if (js_discountMerchant >= js_noFeeAmount) {
                js_shippingFee = 0;
            } else {
                js_shippingFee = js_basicShipping;
            }
            var oShipping = document.getElementById("id_shippingFee");
            oShipping.innerHTML = "NT$ " + js_shippingFee + "元";

            //總數
            var js_total = js_discountMerchant + js_shippingFee;
            oTotal.innerHTML = "NT$ " + js_total + "元";
        }

        var cartNext = function(event, nextFile, checkLogIn) {
            event.preventDefault();
            var oForm = document.createElement("form");
            oForm.setAttribute("method", "post");
            oForm.setAttribute("action", "Cart-Next.php");
            var params = [];

            //點數
            oPoint = document.getElementById("id_pointsToUse");
            if (oPoint != null) {
                js_pointsToUse = oPoint.value;
            }
            params["js_pointsToUse"] = js_pointsToUse;

            oDiscount = document.getElementById("id_order_discount");
            if (oDiscount != null) {
                js_orderDiscount = oDiscount.value;
            }
            params["js_orderDiscount"] = js_orderDiscount;

            params["nextFile"] = nextFile;
            params["checkLogIn"] = checkLogIn;

            for (var key in params) {
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", key);
                hiddenField.setAttribute("value", params[key]);
                oForm.appendChild(hiddenField);
            } //for

            document.body.appendChild(oForm);
            oForm.submit();
        }

    </script>


    <?php

		include_once("../global.php");
		include('orderSerial.php');
		
		session_start();
		
		include_once("member_common.php");
		
		include("../common/sharedCode.php");
		?>

</head>

<body onload="parameterChanged()">

    <!-- Nav -->
    <nav id="nav">
        <ul class="container">
            <li><a href="../index.php">EXQUISITE</a></li>

            <li><a href="#">我的購物車
         
					<?php echo ($_SESSION['total_count']>0) ?  "(".$_SESSION['total_count'].")" : ""; ?>
				
					</a>
            </li>

            <?php
            add_member_option("","Cart.php"); ?>

        </ul>

    </nav>
    <!-- Home -->
    <div class="wrapper cart">
        <article class="content container 75%">
            <div class="row not-mobile">
                <div class="12u oderStep">
                    <ul>
                        <li>
                            <div class="Step-Select-image">STEP1 訂單確認</div>
                        </li>
                        <li>
                            <div class="Step-int"></div>
                        </li>
                        <li>
                            <div class="Step-Not-choose">STEP2 金額確認</div>
                        </li>
                        <li>
                            <div class="Step-int"></div>
                        </li>
                        <li>
                            <div class="Step-Not-choose">STEP3 付款方式</div>
                        </li>
                        <li>
                            <div class="Step-int"></div>
                        </li>
                        <li>
                            <div class="Step-Not-choose">STEP4 結帳完成</div>
                        </li>
                    </ul>
                </div>
            </div>
            <h3>訂單確認<br>Order Confirmation</h3>
            <p></p>
            <div class="row not-mobile">
                <div class="12u">
                    <table class="fr206">
                        <tr>
                            <td style="width:40%">商品明細</td>
                            <td style="width:30%">內容</td>
                            <td style="width:10%">數量</td>
                            <td style="width:10%">小計</td>
                            <td style="width:10%">確認</td>
                        </tr>
                    </table>
                    <ul class="fr205">


                        <?php
	$merchantTotal=0;
	$setIndex=0;

	function iterateSet($_detailName,$_SetProductName,$_SetCategory,$_item,$_mobile)
	{
				global $productName,$productPrice,$productPhoto,$chineseNumber;
				$setCount=count($_SESSION[$_detailName]);
				$smallPrice=0;
				for($setIndex=0;$setIndex<$setCount;$setIndex++)
				{
					$count = count($_SESSION[$_detailName][$setIndex]);
					$c=$chineseNumber[$setIndex+1];
					if($setCount>1)
					{
						$setName="第{$c}組";
					}
					else
					{
						$setName="";
					}
					$setTotal=0;
					$countInSet=count($_SESSION[$_detailName][$setIndex]);
					$counter=1;

					$itemList="";
					foreach($_SESSION[$_detailName][$setIndex] as $setItem=>$count)
					{
						$currentItem=$productName[$setItem]." x ".$count;
						if($counter>1)
						{
							$itemList.="<br>";
						}
						$itemList.=$currentItem;
						$setTotal+=$productPrice[$setItem]*$count;

						$counter++;
					}//foreach
					
					if($_SESSION['order_discount'] < 0.99)
					{
						$smallPriceDisc = round($setTotal*$_SESSION['order_discount']);
						$strikedStr="<font style='text-decoration-line:line-through;color:#ccc'>{$setTotal}</font><br>";
						$mobileStrikedStr="<font style='font-size:0.75em;color:#999'>原價</font>
                                                        <font style='text-decoration-line:line-through;color:#999'>{$setTotal}</font>                                                        <br>";
						$mobileDiscStr="<font style='font-size:0.75em'>優惠價</font>
                                                        <font style='color:#f00'>{$smallPriceDisc}</font>";
						$setTotal=$smallPriceDisc;
					}
					else
					{
						$strikedStr="";
						$mobileStrikedStr="";
						$mobileDiscStr="<font style='font-size:0.75em'>小計</font>
                                                        <font style='color:#f00'>{$setTotal}</font>";
					}
										
$setSegment=<<<SET_SEGMENT
                        <li>
                            <table>
                                <tr>
                                    <td style="width:20%"><img style="width:100%" src="images/{$productPhoto[$_item]}">

                                    </td>
                                    <td style="width:20%">
                                        {$setName}<br>【{$_SetCategory}】{$_SetProductName}
                                    </td>

                                    <td style="width:30%">{$itemList}
                                    </td>
                                    <td style="width:10%">
                                        1<br>set

                                    </td>
                                    <td style="width:10%">
										{$strikedStr}
                                        <font style="color:#f00">{$setTotal}</font>

                                    </td>
                                    <td style="width:10%">
                                        <a href="removeFromCart.php?product={$_item}&setIndex={$setIndex}" class="icon02">
                                            <img class="4u" src="images/trash_can.png"></a>
                                    </td>
                                </tr>

                            </table>
                        </li>
SET_SEGMENT;

$mobileSet=<<<MOBILE_SET
                                    
                                        <li>
                                            <table>
                                                <tr>
                                                    <td class="7u"><img class="12u" src="images/{$productPhoto[$_item]}"></td>
                                                    <td class="5u">
													    {$setName}<br>【{$_SetCategory}】{$_SetProductName}
                                                        </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:0.85em">{$itemList}
                                                    </td>
                                                    <td>1<br>set</td>
                                                </tr>
                                                <tr style="background-color:#ccc;border-top:1px solid #bbb;border-bottom:1px solid #bbb">
                                                    <td>
                                                        {$mobileStrikedStr}
                                                        {$mobileDiscStr}
                                                    </td>

                                                    <td style="padding-right: 10px"><input class="button2" type="button" value="刪除" onClick="window.location.href='removeFromCart.php?product={$_item}&setIndex={$setIndex}'" /></td>
                                                </tr>

                                            </table>
                                        </li>

MOBILE_SET;

				if($_mobile)
				{
					echo $mobileSet;
				}
				else
				{
					echo $setSegment;
				}//else
				$smallPrice+=$setTotal;
			}//for b
		return $smallPrice;
	}//iterateSet

			foreach($productList as $item)
			{
				if(!isset($_SESSION[$item])) $_SESSION[$item]=0;
				$thisCount=$_SESSION[$item];
				$price=$productPrice[$item];
				$category=$productCategory[$item];
				if($thisCount>0)
				{
										
					$smallPrice=$price * $thisCount;
					if($_SESSION['order_discount'] < 0.99)
					{
						$smallPriceDisc = round($smallPrice*$_SESSION['order_discount']);
						$strikedStr="<font style='text-decoration-line: line-through;color:#ccc'>{$smallPrice}</font><br>";
						$smallPrice=$smallPriceDisc;
					}
					else
					{
						$strikedStr="";
					}
					
					//禮盒組程式
					if($item=="set_tender")
					{	
						$smallPrice=iterateSet('set_tender_detail',$productName[$item],$category,$item,false);
						$merchantTotal+=$smallPrice;
						continue;
					}//if gift
					if($item=="set_candy")
					{	
						$smallPrice=iterateSet('set_candy_detail',$productName[$item],$category,$item,false);
						$merchantTotal+=$smallPrice;
						continue;
					}//if gift					

$productLine=<<<PRODUCT_LINE

					<!-- Unit -->
					<li>
						<table>
							<tr>
								<td style="width:20%">
									<a href='{$productLink[$item]}'>
										<img style="width:60%" src='images/{$productPhoto[$item]}'>
									</a>
								</td>
								<td style="width:20%">【{$category}】                                        
								</td>
								<td style="width:30%">{$productName[$item]}

								</td>
								<td style="width:10%">
									{$thisCount}
								</td>
								<td style="width:10%">
									{$strikedStr}
									<font style="color:#f00">{$smallPrice}</font>
								</td>
								<td style="width:10%">
									<a href="removeFromCart.php?product={$item}" class="icon02">
										<img class="4u" src="images/trash_can.png"></a>
								</td>
							</tr>
						</table>
					</li>
PRODUCT_LINE;
					
					echo $productLine;
					$merchantTotal+=$smallPrice;
				}//if
			}//foreach
						
			//1.商品總計
			$_SESSION['merchantTotal']=$merchantTotal;
			
			//本次新增點數
			$_SESSION['discount_merchant'] = round($_SESSION['merchantTotal']*$_SESSION['order_discount']);			
			$_SESSION['newPoints']=floor($_SESSION['discount_merchant']*0.01)*5;
			
			//2.折扣
			$pointsToUseStr="";
			if(userLogged())
			{
				if(isDealer())
				{
					if(!isset($_SESSION['pointsToUse'])) $_SESSION['pointsToUse'] = 0;
					//可調整使用點數
					$maxPoints = min(min($_SESSION['member_points'],$_SESSION['merchantTotal']),$_SESSION['max_pointsToUse']);
					$pointsToUseStr = "<input type='number' name='pointsToUse' id='id_pointsToUse_input' min='0' max='{$maxPoints}' value='{$_SESSION['pointsToUse']}' onChange='parameterChanged()'>";
				}
				else
				{				
					//設定最高金額點數
					$_SESSION['pointsToUse'] = min(min($_SESSION['member_points'],$_SESSION['discount_merchant']),$_SESSION['max_pointsToUse']);
					$pointsToUseStr = "<span id='id_pointsToUse'>{$_SESSION['pointsToUse']}</span>";
				}//else
				
				$str_UserPoints="本次使用紅利點數<font style='color:#f00'>{$pointsToUseStr}</font>點，新增點數
                                        <font style='color:#f00'>{$_SESSION['newPoints']}</font>點，";
			}		
			$_SESSION['discount_merchant']-=$_SESSION['pointsToUse'];
			if(!isset($_SESSION['total_count'])) $_SESSION['total_count']=0;			
			
			if($_SESSION['total_count']==0)
			{
				echo "  <li>
                            <table>
                                <tr>
                                    <td style='width:25%'><img style='width:60%' src='images/pic000-1.png'></td>
                                    <td style='width:25%;color:#f00;'>沒有任何商品!</td>
                                    <td style='width:30%'></td>
                                    <td style='width:10%'></td>
                                    <td style='width:10%'></td>
                                </tr>
                            </table>
                        </li>";
			}//else
			
			//3.運費
			$_SESSION['shippingFee']=$_SESSION['basicShipping'];
			$feeColor="#F00";
			
			if($_SESSION['discount_merchant']>=$_SESSION['noFeeAmount'])
			{
				$_SESSION['shippingFee']=0;
			}//if	

$calculateSeg=<<<CALCULATE_SEG

                        <li>
                            <table class="fr25 total">
                                <tr>

                                    <td style="width:50%">共
                                        <font style="font-size:1.2em;color:#f00">{$_SESSION['total_count']}
                                        </font>件商品，本次消費總金額為NT$
                                        <font style="font-size:1.2em;color:#f00">{$_SESSION['merchantTotal']}</font>元
                                    </td>
                                </tr>
                                <tr>
                                    <td>{$str_UserPoints}運費
                                        <font style="color:#f00">{$_SESSION['shippingFee']}</font>元
									</td>
                                </tr>
                            </table>
                        </li>

CALCULATE_SEG;


		if($_SESSION['total_count']>0)
		{
			echo $calculateSeg;
		}

		//總金額
		$_SESSION['total_money']=$_SESSION['discount_merchant']+$_SESSION['shippingFee'];
		
		$pointJS="var js_pointsToUse=".(isset($_SESSION['pointsToUse']) ? "{$_SESSION['pointsToUse']};" : "0;");
		$memberPointJS="";
		if(isset($_SESSION['member_points']))
		{
			$memberPointJS="var js_member_points={$_SESSION['member_points']};";
		}
		
		$userLoggedBool = userLogged();
		$isDealerBool = isDealer();
		
		echo "
						
                    </ul>
                </div>
            </div>
			
			<script type='text/javascript'>
			var js_merchantTotal={$merchantTotal};
			var js_orderDiscount={$_SESSION['order_discount']};	
			var js_shippingFee={$_SESSION['shippingFee']};
			var js_basicShipping={$_SESSION['basicShipping']};
			var js_noFeeAmount={$_SESSION['noFeeAmount']};
			var_jsMaxPointsToUse={$_SESSION['max_pointsToUse']};
			var js_isDealer='{$isDealerBool}';
			var js_userLogged='{$userLoggedBool}';						
			{$pointJS}
			{$memberPointJS}
			</script>
		";	
?>

                            <div class="row only-mobile">
                                <div class="12u">
                                    <ul class="fr205">

                                        <?php
			
			//Mobile Only
			$setIndex=0;
	
			foreach($productList as $item)
			{
				if(!isset($_SESSION[$item])) $_SESSION[$item]=0;
				$thisCount=$_SESSION[$item];
				$price=$productPrice[$item];
				$category=$productCategory[$item];
				if($thisCount>0)
				{
										
					$smallPrice=$price * $thisCount;
					if($_SESSION['order_discount'] < 0.99)
					{
						$smallPriceDisc = $smallPrice*$_SESSION['order_discount'];
						$strikedStr="<font style='font-size:0.75em;color:#999'>原價</font>
                                     <font style='text-decoration-line:line-through;color:#999'>{$smallPrice}</font><br>";
						$smallPrice=$smallPriceDisc;
						$smallPriceStr="<font style='font-size:0.75em'>優惠價</font>
                                                        <font style='color:#f00'>{$smallPriceDisc}</font>";
					}
					else
					{
						$strikedStr="";
						$smallPriceStr="<font style='font-size:0.75em'>小計</font>
                                                        <font style='color:#f00'>{$smallPrice}</font>";
					}
					
					//禮盒組程式
					if($item=="set_tender")
					{	
						$smallPrice=iterateSet('set_tender_detail',$productName[$item],$category,$item,true);

						continue;
					}//if gift
					if($item=="set_candy")
					{	
						$smallPrice=iterateSet('set_candy_detail',$productName[$item],$category,$item,true);

						continue;
					}//if gift	

$mobileLine=<<<MOBILE_LINE

                                        <li>
                                            <table>
                                                <tr>
                                                    <td class="7u"><img class="10u" src="images/{$productPhoto[$item]}"></td>
                                                    <td class="5u">
                                                        【{$category}】</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:0.85em">{$productName[$item]}</td>
                                                    <td>{$thisCount}</td>
                                                </tr>
                                                <tr style="background-color:#ccc;border-top:1px solid #bbb;border-bottom:1px solid #bbb">
                                                    <td>
                                                        {$strikedStr}
                                                        {$smallPriceStr}
                                                    </td>
                                                    <td style="padding-right: 10px">
                                                        <input class="button2" type="button" value="刪除" onClick="window.location.href='removeFromCart.php?product={$item}'" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </li>

MOBILE_LINE;

					echo $mobileLine;

				}//if this count > 0
				else
				{
				}//else
			}//foreach
			
$mobileNothing=<<<MOBILE_NOTHING

                                        <li>
                                            <table>
                                                <tr>
                                                    <td><img class="10u" src="images/pic000-1.png"></td>
                                                    <td style="width:50%;color:#f00;">沒有任何商品!</td>
                                                </tr>
                                            </table>
                                        </li>

MOBILE_NOTHING;

			
			//2.折扣
			$pointsToUseStr="";
			if(userLogged())
			{
				if(isDealer())
				{					
					$pointsToUseStr = "<input type='number' name='pointsToUse' id='id_pointsToUse_input' min='0' max='{$maxPoints}' value='{$_SESSION['pointsToUse']}' onChange='parameterChanged()'>";
				}
				else
				{				
					//設定最高金額點數
					$pointsToUseStr = "<span id='id_pointsToUse'>{$_SESSION['pointsToUse']}</span>";
				}//else
				$str_UserPoints="本次使用紅利點數<font style='color:#f00'>{$pointsToUseStr}</font>點, 新增點數
                                                        <font style='color:#f00'>
                                                            {$_SESSION['newPoints']}
                                                        </font>點，";
			}		
			
$mobileSummary=<<<MOBILE_SUMMARY

                                        <li>
                                            <table>
                                                <tr>共
                                                    <font style="color:#f00">{$_SESSION['total_count']}
                                                    </font>件商品
                                                </tr>
                                                <tr>
                                                    <p>本次消費總金額為NT$
                                                        <font style="font-size:1.2em;color:#f00">
                                                            {$_SESSION['merchantTotal']}</font>元</p>

                                                </tr>
                                                <tr>{$str_UserPoints}</tr>
                                                <tr>
                                                    <td>
														運費
                                                        <font style="color:#f00">
                                                            {$_SESSION['shippingFee']}
                                                        </font>元</td>
                                                </tr>
                                            </table>
                                        </li>

MOBILE_SUMMARY;

			
			if($_SESSION['total_count']==0)
			{
				echo $mobileNothing;
			}//else
			else
			{
				 echo $mobileSummary;
			}//else

?>



                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="12u baseline01">

								<?php
									if(!userLogged())
									{
                                    	echo "<h3>提醒您加入會員即刻享有<font style='color:brown'>95折</font>優惠，另加紅利點數回饋下次購物即享折抵。</h3>";
									}
								?>
                                    <div class="row fr42 memberList">
                                        <ol>會員折扣與紅利點數計算說明：

                                            <li>加入會員後，首筆訂單起，即開始享 95折優惠。(特殊活動則另依公告執行)
                                            </li>
                                            <li>紅利點數使用：會員優惠價(小計金額＊95折)→可再使用點數折抵，滿500再享免運優惠。<br>
                                                <font style="color:brown">(1點即可折抵1元；當次最高可抵100點)</font>
                                            </li>
                                            <li>紅利點數獲得：(小計金額＊95折後金額之計算(不包含運費)滿100元即贈5點，下次購物可抵用。。<br>例：小計金額510元＊95折=485元，獲得20點。</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                            <div class="row not-mobile">
                                <div class="12u">
                                    <input class="2u button2" type="button" value="繼續購物" onclick="cartNext(event,'../index.php#products','false')" />

                                    <input class="2u button2" type="button" value="前往結帳" onClick="cartNext(event,'Cart_step2.php','true')" />
                                </div>

                            </div>
                            <div class="row only-mobile">
                                <div class="12u">
                                    <input class="button2" type="button" value="繼續購物" onclick="cartNext(event,'../index.php#products','false')" />
                                </div>
                                <div class="12u">

                                    <input class="button2" type="button" value="前往結帳" onClick="cartNext(event,'Cart_step2.php','true')" />
                                </div>

                            </div>

        </article>
        </div>

        <?
		
		include_once("part_Notice.php");
		include_once("part_Footer.php");
		
		echo $noticeSec;
		echo $footerSec;
		
		?>
</body>

</html>
