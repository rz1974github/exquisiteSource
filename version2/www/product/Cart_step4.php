<!DOCTYPE HTML>
<!--
	Miniport by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>訂單成立</title>
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
		</script>
		<?php

		include('orderSerial.php');
		
		session_start();
		
		include_once("member_common.php");
		
		include("../common/sharedCode.php");
		include("sharedResult.php");
		
		?>        
	</head>
	<body onLoad="discount_changed()">

		<!-- Nav -->
			<nav id="nav">
               	<ul class="container">
                    <li class="3u"><a href="../index.php">EXQUISITE</a></li>
				</ul>
               
			</nav>
		<!-- Home -->
			<div class="wrapper step02">
			    <article class="container 50%">
                  <div class="row 0% baseline01 fr311">
                     <div class="12u"><img class="12u" src="images/STEP4CC.png"></div>
                  </div>
                  <div class="row 0%">
                     <div class="12u">
<?php
	if($_REQUEST['Error']==true)
	{
		echo "<h2>寄送訂單失敗</h2>";
		/*
S01 訂單新增成功
E00 參數傳遞內容有誤或欄位短缺
E01 <su_id>帳號不存在
E02 <su_id>帳號無建立取貨付款權限 或 無網站串接權限 或 無ezShip宅配權限
E03 <su_id>帳號無可用之 輕鬆袋 或 迷你袋
E04 <st_code>取件門市有誤
E05 <order_amount>金額有誤
E06 <rv_email>格式有誤
E07 <rv_mobile>格式有誤
E08 <order_status>內容有誤 或 為空值
E09 <order_type>內容有誤 或 為空值
E10 <rv_name>內容有誤 或 為空值
E11 <rv_addr>內容有誤 或 為空值
E98 系統發生錯誤無法載入
E99 系統錯誤
		*/
		
		$errorString="";
		switch($_REQUEST['order_status'])
		{
			case "S01":
				$errorString="訂單新增成功";
				break;
			case "E00":
				$errorString="參數傳遞內容有誤或欄位短缺";
				break;
			case "E01":
				$errorString="<su_id>帳號不存在";
				break;
			case "E02":
				$errorString="<su_id>帳號無建立取貨付款權限 或 無網站串接權限 或 無ezShip宅配權限";
				break;
			case "E03":
				$errorString="<su_id>帳號無可用之 輕鬆袋 或 迷你袋";
				break;
			case "E04":
				$errorString="<st_code>取件門市有誤";
				break;
			case "E05":
				$errorString="<order_amount>金額有誤";
				break;
			case "E06":
				$errorString="<rv_email>格式有誤";
				break;
			case "E07":
				$errorString="<rv_mobile>格式有誤";
				break;
			case "E08":
				$errorString="<order_status>內容有誤 或 為空值";
				break;
			case "E09":
				$errorString="<order_type>內容有誤 或 為空值";
				break;
			case "E10":
				$errorString="<rv_name>內容有誤 或 為空值";
				break;
			case "E11":
				$errorString="<rv_addr>內容有誤 或 為空值";
				break;
			case "E98":
				$errorString="系統發生錯誤無法載入";
				break;
			case "E99":
				$errorString="系統錯誤";
				break;
			default:
				$errorString="不知名的錯誤";
				break;
		}//switch
		
		echo "<p>{$_REQUEST['order_status']}:{$errorString}</p>";
		echo "<p>很抱歉! 請稍後再試,或聯絡客服人員</p>";
		echo "</header>";	
	}//if
	else
	{
		echo "<div class='choosing fr26'>Your order is completed<br>購物完成! 感謝您的訂購，我們將會依序為您處理訂單。</div>";
	}
?>                     
                        
                        <div class="row 0%">
                           <div class="12u baseline01">
                              <div class="choosing">
                                 <div class="row 0% fr42 baseline03">
                                    <div class="12u">
                                       <div class="row no-collapse">
                                          <div class="4u 6u(3) fr48">付款方式：</div>
                                          <div class="8u 6u(3)"><?php echo $order_typeString; ?></div>
                                       </div>
                                    </div>
                                    <div class="12u">
                                       <div class="row no-collapse">
                                          <div class="4u 6u(3) fr48">取貨方式：</div>
                                          <div class="8u 6u(3)"><?php echo $delieverString; ?></div>
                                       </div>
                                    </div>
                                    <div class="12u">
                                       <div class="row no-collapse">
                                          <div class="4u 6u(3) fr48">其他：</div>
                                          <div class="8u 6u(3)"><?php echo $delieverTimeStr; ?></div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row 0% fr42">
                                    <div class="12u">
                                       <div class="row no-collapse">
                                          <div class="6u fr48">小計金額Subtotal</div>
                                          <div class="6u"><?php echo "NT$ {$_SESSION['merchantTotal']}元(共 {$_SESSION['total_count']}件)"; ?></div>
                                       </div>
                                    </div>
<?php

$pointsStr="使用".$_SESSION['pointsToUse']."點/原有".$_SESSION['remainPoints']."點";

$discountStr=($_SESSION['order_discount']*10)."折";

$offSec=<<<OFF_SEC

                                    <div class="12u">
                                       <div class="row no-collapse">
                                          <div class="6u fr48">會員折扣Off</div>
                                          <div class="6u">{$discountStr}</div>
                                       </div>
                                    </div>
OFF_SEC;

if($_SESSION['order_discount']<0.999)
{
	echo $offSec;
}

$pointSec=<<<POINT_SEC
                                
                                    <div class="12u">
                                       <div class="row no-collapse">
                                          <div class="6u fr48">使用點數Dividend</div>
                                          <div class="6u">{$pointsStr}</div>
                                       </div>
                                    </div>
POINT_SEC;
if($_SESSION['member_points']>0)
{
	echo $pointSec;
}

$disountSec=<<<DISCOUNT_SEC

                                    <div class="12u">
                                       <div class="row no-collapse">
                                          <div class="6u fr48">折扣後金額Discounted</div>
                                          <div class="6u">NT$ {$_SESSION['discount_merchant']}元</div>
                                       </div>
                                    </div>
									
DISCOUNT_SEC;
if($_SESSION['order_discount']<0.999)
{
	echo $discountSec;
}
?>
                                    <div class="12u">
                                       <div class="row no-collapse">
                                          <div class="6u fr48">運費Shipping</div>
                                          <div class="6u">NT$ <?php echo $_SESSION['shippingFee']; ?>元</div>
                                       </div>
                                    </div>
<?php                                

$newPointsSec=<<<NEWPOINT_SEC

                                    <div class="12u">
                                       <div class="row no-collapse">
                                          <div class="6u fr48">獲得點數Gain</div>
                                          <div class="6u">{$_SESSION['newPoints']}點</div>
                                       </div>
                                    </div>
								
NEWPOINT_SEC;
		
		if(userLogged())
		{
			echo $newPointsSec;
		}

?>                                    
                                    <div class="12u">
                                       <div class="row no-collapse">
                                          <div class="6u fr48">總計Total</div>
                                          <div class="6u money01">NT$ <?php echo $_SESSION['total_money']; ?>元</div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="12u">
                              <div class="choosing baseline01">
                                 <div class="row 0%  baseline03">
                                    <div class="12u">
                                       <div class="row 0%">
                                          <div class="12u fr27">收件人資訊</div>
                                       </div>
                                       <div class="row 0% fr42">
                                          <div class="12u">
                                             <div class="row 0% no-collapse">
                                                <div class="6u 5u(3) fr48">訂單號碼No：</div>
                                                <div class="6u 7u(3)"><?php echo $_SESSION['order_serial']; ?></div>
                                             </div>
                                          </div>
                                          <div class="12u">
                                             <div class="row 0% no-collapse">
                                                <div class="6u 5u(3) fr48">物流號碼No：</div>
                                                <div class="6u 7u(3)"><?php echo $_SESSION['sn_id']; ?></div>
                                             </div>
                                          </div>                                          
                                          <div class="12u">
                                             <div class="row 0% no-collapse">
                                                <div class="6u 5u(3) fr48">收件人Name：</div>
                                                <div class="6u 7u(3)"><?php echo $_SESSION['rv_name']; ?></div>
                                             </div>
                                          </div>
                                          <div class="12u">
                                             <div class="row 0% no-collapse">
                                                <div class="6u 5u(3) fr48">電話Moble：</div>
                                                <div class="6u 7u(3)"><?php echo $_SESSION['rv_mobile']; ?></div>
                                             </div>
                                          </div>
                                          <div class="12u">
                                             <div class="row 0% no-collapse">
                                                <div class="6u 5u(3) fr48">信箱E-mail：</div>
                                                <div class="6u 7u(3)"><?php echo $_SESSION['rv_email']; ?></div>
                                             </div>
                                          </div>
<?php
$addressSec=<<<ADDRESS_SEC


                                          <div class="12u">
                                             <div class="row 0% no-collapse">
                                                <div class="6u 5u(3) fr48">收貨地址Address：</div>
                                                <div class="6u 7u(3)">{$_SESSION['rv_addr']}</div>
                                             </div>
                                          </div>

ADDRESS_SEC;
if($_SESSION['deliever']=="1")
{
	echo $addressSec;
}
?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row 0% fr42">
                                    <div class="12u　fr48">備註：<?php echo $_SESSION['message']; ?></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="12u">
                        <a href="../index.php">
                           <div class="button2">回到首頁</div>
                        </a>
                     </div>
                  </div>
				</div>					
				</div>
                </article>
              </div>
       <?php 
	   
	   	//unset varaibles
		foreach($productList as $item)
		{
			unset($_SESSION[$item]);
		}
		unset($_SESSION['total_count']);
		
		include_once("part_Notice.php");
		include_once("part_Footer.php");
		
		echo $noticeSec;
		echo $footerSec;
		
		?>
 	</body>
</html>