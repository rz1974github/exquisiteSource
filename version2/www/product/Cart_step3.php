<!DOCTYPE HTML>
<!--
	Miniport by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>填寫訂購資訊</title>
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

			if($_SESSION['total_count']<=0)
			{
				header("location:../index.php");
				exit(0);
			}

			include("../common/sharedCode.php");
			include("sharedResult.php");
			
			updateSession();			
		?>        
	</head>
    
	<body>
		<!-- Nav -->
		<nav id="nav">
			<ul class="container">
				<li class="3u"><a href="../index.php">EXQUISITE</a></li>
				
				<li><a href="Cart.php">我的購物車<?php echo ($_SESSION['total_count']>0) ?  "(".$_SESSION['total_count'].")" : ""; ?></a></li>
				<?php
				
				add_member_option("","Cart_step3.php");

				?>                    
			</ul>
		</nav>
			<!-- Home -->
			<div class="wrapper step02">
			    <article class="container 50%">
					<div class="row 0% baseline01 fr311">
						<div class="12u"><img class="12u" src="images/STEP3CC.png"></div>
					</div>
					<div class="row 0%">
						<div class="12u baseline01">
							<div class="choosing">
								<div class="row 0% baseline03">
									<div class="12u fr42">付款方式：<?php echo $order_typeString; ?></div>
									<div class="12u fr42">取貨方式：<?php echo $delieverString; ?></div>
									<div class="12u fr42">其他：<?php echo $delieverTimeStr; ?></div>
									<div class="12u fr42">
										<a href="Cart_step2.php">
											<div class="12u">
												<div class="button2">回上一頁變更付款方式</div>
											</div>
										</a>
									</div><!-- 12u-->
								</div><!-- row 0%-->
								<div class="row 0% no-collapse fr42">
                                   <div class="6u">
                                      <div class="row">
                                         <div class="12u">小計金額Subtotal</div>
                                      </div>
                                   </div>
                                   <div class="6u">
                                      <div class="row">
                                         <div class="12u"><?php echo "NT$ {$_SESSION['merchantTotal']}元(共 {$_SESSION['total_count']}件)"; ?></div>
                                      </div>
                                   </div>
                                </div>
                                  <?php

$discountStr=($_SESSION['order_discount']*10)."折";

$offSec=<<<OFF_SEC

                                <div class="row 0% no-collapse fr42">
                                   <div class="6u">
                                      <div class="row">
                                         <div class="12u">會員折扣Off</div>
								      </div>
							       </div>
								   <div class="6u">
									  <div class="row">
										 <div class="12u">{$discountStr}</div>
									  </div>
								   </div>
								</div>

OFF_SEC;

if($_SESSION['order_discount']<0.999)
{
	echo $offSec;
}

$pointsStr="使用".$_SESSION['pointsToUse']."點/原有".$_SESSION['member_points']."點";

$pointSec=<<<POINT_SEC
                                
								<div class="row 0% no-collapse fr42 baseline03">
									<div class="6u">
										<div class="row">
											<div class="12u">使用點數Dividend</div>
										</div>
									</div>
									<div class="6u">
										<div class="row 0% no-collapse">
											<div class="12u">{$pointsStr}</div>
										</div>
									</div>
								</div>

POINT_SEC;
if($_SESSION['member_points']>0)
{
	echo $pointSec;
}

$discountSec=<<<DISCOUNT_SEC

                                <div class="row 0% no-collapse fr42">
                                   <div class="6u">
                                      <div class="row">
                                         <div class="12u">折扣後金額Discounted</div>
								      </div>
							       </div>
								   <div class="6u">
									  <div class="row">
										 <div class="12u">NT$ {$_SESSION['discount_merchant']}元</div>
									  </div>
								   </div>
								</div>

DISCOUNT_SEC;

if($_SESSION['order_discount']<0.999)
{
	echo $discountSec;
}
								?>
								<div class="row 0% no-collapse fr42">
									<div class="6u 8u(3)">
										<div class="row">
											<div class="12u">運費Shipping</div>
										</div>
									</div>
									<div class="6u 4u(3)">
										<div class="row">
											<div class="12u">NT$ <?php echo $_SESSION['shippingFee']; ?>元</div>
										</div>
									</div>
								</div><!-- row 0%-->
<?php                                

$newPointsSec=<<<NEWPOINT_SEC

								<div class="row 0% no-collapse fr42">
									<div class="6u">
										<div class="row">
											<div class="12u">獲得點數Gain</div>
										</div>
									</div>
									<div class="6u">
										<div class="row">
											<div class="12u fr42 money01">{$_SESSION['newPoints']}點</div>
										</div>
									</div><!-- 6u-->
								</div><!-- row 0%-->
								
NEWPOINT_SEC;
		
		if(userLogged())
		{
			echo $newPointsSec;
		}

?>                                                                
								<div class="row 0% no-collapse fr42">
									<div class="6u">
										<div class="row">
											<div class="12u">總計Total</div>
										</div>
									</div>
									<div class="6u">
										<div class="row">
											<div class="12u fr42 money01">NT$ <?php echo $_SESSION['total_money']; ?>元</div>
										</div>
									</div><!-- 6u-->
								</div><!-- row 0%-->
							</div><!-- choosing-->
						</div><!-- 12u baseline-->
					</div><!-- row 0%-->
					<div class="row">
						<div class="12u">
							<div class="row 0% fr42 baseline03">
								<div class="8u">
									<div class="row 0%">
										<div class="12u fr27">收件人</div>
                                        <div class='row'>
                                            <div class="12u fr48"><font color="#CB1A5E">*</font>中文全名/提貨人姓名NAME<br>
                                                <input type="text" form="orderForm" name="rv_name" style="width:100%" placeholder="" value="<?php echo $_SESSION['rv_name']; ?>" required />
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class="12u fr48"><font color="#CB1A5E">*</font>電話/提貨人電話MOBILE<br>
                                                <input type="text" form="orderForm" name="rv_mobile" style="width:100%" placeholder="" value="<?php echo $_SESSION['rv_mobile']; ?>" required />
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class="12u fr48"><font color="#CB1A5E">*</font>電子信箱/提貨通知EMAIL<br>
                                                <input type="email" form="orderForm" name="rv_email" style="width:100%" placeholder="" value="<?php echo $_SESSION['rv_email']; ?>" required />
                                            </div>
                                        </div>
<?php

$addressSec=<<<ADDRESS_SEC
										<div class='row'>
											<div class="6u fr48"><font color="#CB1A5E">*</font>郵遞區號ZIP
												<input type="text" form="orderForm" name="rv_zip" style="width:100%" placeholder="" value="{$_SESSION['rv_zip']}" required />
											</div>
										</div>
										<div class='row'>
											<div class="12u fr48"><font color="#CB1A5E">*</font>地址ADDRESS
												<input type="text" form="orderForm" name="rv_addr" style="width:100%" placeholder="" value="{$_SESSION['rv_addr']}" required />
											</div>
										</div>

ADDRESS_SEC;

if($_SESSION['deliever']==1)
{
	echo $addressSec;
}

$chooseStoreSec=<<<CHOOSE_SEC
                                   </div>
								   <div class="row 25%">
								   	  <div class="12u">
									     <div class="row 25%">
										    <div class="6u"><font color="#CB1A5E">*</font>門市STORE</div>
											<div class="6u">
											   <a href="Cart_step3ReShop.php">
											      <div class="button2">重新選擇門市</div>
											   </a>
											</div><!-- 6u -->
										 </div><!-- row 25%-->
										   </div><!-- 12u -->
                                   </div><!-- row 0%-->
								   <div class="row">

CHOOSE_SEC;

$nowStoreStr="";
if($_SESSION['deliever']==3)
{
	echo $chooseStoreSec;
	$nowStoreStr="(取貨門市：{$_SESSION['stName']} / 代號：{$_SESSION['stCode']} / 門市電話：{$_SESSION['stTel']})";
}
?>
									
									  <div class="12u fr42 fr47"><?php echo $nowStoreStr; ?></div>
								   </div> 
								</div><!-- 6u -->
								<div class="4u money01 fr47">*訂單送出後將無法取消或修改內容，請仔細確認您的購物清單與資料是否正確。</div>
							</div><!-- row 0%-->
							<div class="row 0% fr42 fr311 baseline01">
								<div class="row">
									<div class="6u">
										<div class="row 0%">
											<div class="12u fr27">發票資訊</div>
											<div class="12u fr48">EXQUISITE 隨貨附發票如需統編請於備註欄中留下公司抬頭及統一編號。</div>
										</div>
									</div><!-- 6u -->
									<div class="6u fr27">備註<br><input type="text" name="message" form="orderForm" style="width:100%" placeholder="例：38492504 元基生技企業有限公司台北營業處" /></div>
								</div><!-- row -->
							</div><!-- row 0%-->
						</div><!-- 12u -->
					</div><!-- row -->
					<div class="row">
						<div class="12u">
                        	<form id="orderForm" method="post" action="Cart_step35Payment.php">
								<!--a href="Cart_step4.php"><div class="bgcolor03">確認送出訂單</div></a-->
                                <input type="hidden" name="Submit2" value="true" />
                                <input type="submit" value="確認送出訂單" />
                            </form>
						</div><!-- 12u -->
					</div><!-- row -->
     			</article>
			</div><!-- wrapper -->
        <?
		
		include_once("part_Notice.php");
		include_once("part_Footer.php");
		
		echo $noticeSec;
		echo $footerSec;
		
		?>
	</body>
</html>