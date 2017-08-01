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
			var parameterChanged=function()
			{
				var oTotal=document.getElementById("id_total");
				
				//折扣
				var oOrderDiscount=document.getElementById("id_order_discount");				
				if(oOrderDiscount!=null)
				{
					js_orderDiscount=oOrderDiscount.value;
				}
				
				//點數
				var js_discountMerchant=Math.round(js_merchantTotal*js_orderDiscount);
				oRemainPoint=document.getElementById("id_remain");
				if(js_userLogged)
				{
					if(js_isDealer)
					{
						oPoint=document.getElementById("id_pointsToUse_input");
						js_pointsToUse=oPoint.value;
						var js_maxValue = Math.min(Math.min(js_discountMerchant,js_member_points),var_jsMaxPointsToUse);
						oPoint.setAttribute('maxvalue',js_maxValue);
					}
					else
					{
							js_pointsToUse = Math.min(Math.min(js_discountMerchant,js_member_points),var_jsMaxPointsToUse);
							oPoint=document.getElementById("id_pointsToUse");
							if(oPoint!=null)
							{
								oPoint.innerHTML = js_pointsToUse;
							}
					}
					js_remainPoint = js_member_points-js_pointsToUse;
					oRemainPoint.innerHTML =js_remainPoint;
				}				
				
				//折扣後金額
				js_discountMerchant-=js_pointsToUse;
				var oDiscountMerchant = document.getElementById("id_discount_merchant");
				if(oDiscountMerchant!=null)
				{
					oDiscountMerchant.innerHTML = "NT$ "+js_discountMerchant+"元";
				}
				
				//運費改變
				if(js_discountMerchant>=js_noFeeAmount)
				{
					js_shippingFee=0;
				}
				else
				{
					js_shippingFee=js_basicShipping;
				}
				var oShipping=document.getElementById("id_shippingFee");
				oShipping.innerHTML="NT$ "+js_shippingFee+"元";
				
				//總數
				var js_total = js_discountMerchant+js_shippingFee;
				oTotal.innerHTML =  "NT$ "+js_total+"元";
			}

			var cartNext=function(event,nextFile,checkLogIn)
			{
				event.preventDefault();
				var oForm = document.createElement("form");
				oForm.setAttribute("method","post");
				oForm.setAttribute("action","Cart-Next.php");
				var params=[];
				
				//點數
				oPoint=document.getElementById("id_pointToUse");
				if(oPoint!=null)
				{
					js_pointsToUse=oPoint.value;
				}
				params["js_pointsToUse"]=js_pointsToUse;
				
				oDiscount=document.getElementById("id_order_discount");
				if(oDiscount!=null)
				{
					js_orderDiscount = oDiscount.value;
				}
				params["js_orderDiscount"]=js_orderDiscount;
				
				params["nextFile"]=nextFile;
				params["checkLogIn"]=checkLogIn;
				
				for(var key in params)
				{
					var hiddenField = document.createElement("input");
					hiddenField.setAttribute("type","hidden");
					hiddenField.setAttribute("name",key);
					hiddenField.setAttribute("value",params[key]);
					oForm.appendChild(hiddenField);
				}//for
				
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
            <div class="row not-mobile">
                <div class="12u">
                    <h3>訂單確認</h3>
                    <table class="fr206">
                        <tr>
                            <td style="width:40%">商品明細</td>
                            <td style="width:20%">內容</td>
                            <td style="width:10%">規格</td>
                            <td style="width:10%">數量</td>
                            <td style="width:10%">小計</td>
                            <td style="width:10%">確認</td>
                        </tr>
                    </table>
                    <ul class="fr205">
            
                    
<?php
	$merchantTotal=0;
	$setIndex=0;
				function iterateSet($detailName)
				{
				}//iterateSet			
            
$setHeader=<<<SET_HEADER

                        <li>
                            <table>
                                <tr>
                                    <td style="width:20%"><img style="width:100%" src="images/pic25-1.jpg">

                                    </td>
                                    <td style="width:20%">
                                        <!--{$setName}-->第一組<br>【植萃賦活】精選4入組
                                    </td>

                                    <td style="width:20%">奈米矽皂-梔子花
                                        <!--{$oddItem}--><br>奈米矽皂-玫瑰
                                        <!--{$evenItem}--><br>膠原矽皂
                                        <!--{$oddItem}--><br>珍珠矽皂
                                        <!--{$evenItem}-->

                                    </td>
                                    <td style="width:10%">
                                        <!--{$productName[$item]}-->100g
                                    </td>
                                    <td style="width:10%">
                                        <!--{$thisCount}-->1<br>set

                                    </td>
                                    <td style="width:10%">
                                        <font style="text-decoration-line:line-through;color:#ccc">1330</font>
                                        <!--{$smallPrice}--><br>
                                        <font style="color:#f00">1264</font>

                                    </td>
                                    <td style="width:10%">
                                        <a href="removeFromCart.php?product={$item}" class="icon02">
                                            <img class="4u" src="images/trash_can.png"></a>
                                    </td>
                                </tr>

                            </table>
                        </li>
SET_HEADER;

	echo $setHeader;
	echo $setHeader;

$productLine=<<<PRODUCT_LINE

                        <!-- Unit -->
                        <li>
                            <table>
                                <tr>
                                    <td style="width:20%"><img style="width:60%" src="images/PIC00-1.png">
                                        <!--{$productPhoto[$item]}-->
                                    </td>
                                    <td style="width:20%">【輕洗顏】
                                        <!--[{$category}]-->
                                    </td>
                                    <td style="width:20%">奈米矽皂-梔子花

                                    </td>
                                    <td style="width:10%">
                                        <!--{$productName[$item]}-->100g
                                    </td>

                                    <td style="width:10%">
                                        <!--{$thisCount}-->1
                                    </td>
                                    <td style="width:10%">
                                        <font style="text-decoration-line: line-through;color:#ccc">280</font><br>
                                        <!--{$smallPrice}-->
                                        <font style="color:#f00">266</font>
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
	echo $productLine;						

?>
                        <li>
                            <table class="fr25 total">
                                <tr>

                                    <td style="width:50%">共
                                        <font style="font-size:1.2em;color:#f00">2
                                            <!--?php echo"{$_SESSION['total_count']}"; -->
                                        </font>件商品，本次消費總金額為NT$
                                        <font style="font-size:1.2em;color:#f00">
                                            <!-- {$_SESSION['merchantTotal']}-->1530</font>元
                                    </td>
                                </tr>
                                <tr>
                                    <td>本次使用紅利點數
                                        <font style="color:#f00">50</font>點，新增點數
                                        <font style="color:#f00">77
                                            <!--{$_SESSION['newPoints']}-->
                                        </font>點，運費
                                        <font style="color:#f00">0
                                            <!--?php echo $_SESSION['shippingFee'] ?-->
                                        </font>元</td>
                                </tr>
                            </table>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row only-mobile">
                <div class="12u">
                    <h3>訂單確認</h3>

                    <ul class="fr205">
                        <li>
                            <table>
                                <tr>
                                    <td colspan="2"><img class="12u" src="images/pic25-1.jpg"></td>
                                    <td style="" class="4u">
                                        <!--{$setName}-->第一組<br>【植萃賦活】精選4入組</td>
                                </tr>
                                <tr>
                                    <td style="font-size:0.85em">奈米矽皂-梔子花
                                        <!--{$oddItem}--><br>奈米矽皂-玫瑰
                                        <!--{$evenItem}--><br>膠原矽皂
                                        <!--{$oddItem}--><br>珍珠矽皂
                                        <!--{$evenItem}-->
                                    </td>
                                    <td>100g</td>
                                    <td>1<br>/set</td>
                                </tr>
                                <tr style="background-color:#ccc;border-top:1px solid #bbb;border-bottom:1px solid #bbb">
                                    <td colspan="2">
                                        <font style="font-size:0.75em;color:#999">原價</font>
                                        <font style="text-decoration-line:line-through;color:#999">1330</font>
                                        <!--{$smallPrice}--><br>
                                        <font style="font-size:0.75em">優惠價</font>
                                        <font style="color:#f00">1264</font>
                                    </td>

                                    <td style="padding-right: 10px"><input class="6u button2" type="button" value="下次再買" href="removeFromCart.php?product={$item}" onClick="" /></td>
                                </tr>

                            </table>


                        </li>

                        <!-- Unit -->
                        <li>
                            <table>
                                <tr>
                                    <td colspan="2"><img class="12u" src="images/PIC00-1.png"></td>
                                    <td style="" class="4u">
                                        <!--{$setName}-->【輕洗顏】</td>
                                </tr>
                                <tr>
                                    <td style="font-size:0.85em">奈米矽皂-梔子花

                                    </td>
                                    <td>100g</td>
                                    <td>1</td>
                                </tr>
                                <tr style="background-color:#ccc;border-top:1px solid #bbb;border-bottom:1px solid #bbb">
                                    <td colspan="2">
                                        <font style="font-size:0.75em;color:#999">原價</font>
                                        <font style="text-decoration-line:line-through;color:#999">280</font>
                                        <!--{$smallPrice}--><br>
                                        <font style="font-size:0.75em">優惠價</font>
                                        <font style="color:#f00">266</font>
                                    </td>

                                    <td style="padding-right: 10px">

                                        <input class="6u button2" type="button" value="下次再買" href="removeFromCart.php?product={$item}" onClick="" />
                                    </td>
                                </tr>

                            </table>

                        </li>

                        <li>
                            <table>
                                <tr>
                                    <td><img class="10u" src="images/pic000-1.png"></td>
                                    <td style="width:50%;color:#f00;">沒有任何商品!</td>
                                </tr>

                            </table>

                        </li>

                        <li>
                            <table>
                                <tr>共
                                    <font style="color:#f00">2
                                        <!--?php echo"{$_SESSION['total_count']}"; -->
                                    </font>件商品
                                </tr>
                                <tr>
                                    <p>本次消費總金額為NT$
                                        <font style="font-size:1.2em;color:#f00">
                                            <!-- {$_SESSION['merchantTotal']}-->1530</font>元</p>

                                </tr>
                                <tr>本次使用紅利點數50點</tr>
                                <tr>
                                    <td>新增點數
                                        <font style="color:#f00">77
                                            <!--{$_SESSION['newPoints']}-->
                                        </font>點，運費
                                        <font style="color:#f00">0
                                            <!--?php echo $_SESSION['shippingFee'] ?-->
                                        </font>元</td>
                                </tr>
                            </table>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="12u baseline01">

                    <h3>提醒您加入會員即刻享有
                        <font style="color:brown">95折</font>優惠，另加紅利點數回饋下次購物即享折抵。</h3>

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
                <!-- 12u baseline -->
            </div>
            <div class="row not-mobile">
                <div class="12u">
                    <input class="2u button2" type="button" value="繼續購物" onclick="cartNext(event,'../index.php#products','false')" />

                    <input class="2u button2" type="button" value="前往結帳" onClick="cartNext(event,'Cart_step2.php','true')" />
                </div>

            </div>
            <div class="row only-mobile">
                <div class="12u">
                    <input class="2u button2" type="button" value="繼續購物" onclick="cartNext(event,'../index.php#products','false')" />
                </div>
                <div class="12u">

                    <input class="2u button2" type="button" value="前往結帳" onClick="cartNext(event,'Cart_step2.php','true')" />
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
