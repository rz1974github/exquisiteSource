<!DOCTYPE HTML>
<!--
	Miniport by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>選擇付款方式</title>
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

		var submitStep2=function(event)
		{
			event.preventDefault();
			
			oForm = document.getElementById("Cart2Form");
			
			var oOrder=oForm.elements["order_type"];
			if(oOrder.value==0)
			{
				alert("請選擇付款方式");
				return;
			}
			
			var oDeliever=oForm.elements["deliever"];
			if(oDeliever.value==0)
			{
				alert("請選擇取貨方式");
				return;
			}
			
			var oDelieverTime=oForm.elements["deliever"];
			if((oDeliever.value==1) && (oDelieverTime.value==0))
			{
				alert("請指定送貨時間");
				return;
			}
			
			oForm.submit();
		}
		
		var delieverChanged=function()
		{
			var oDeliever=document.getElementById("id_deliever");
			var oDelieverTime=document.getElementById("id_delieverTime");
			
			if(oDeliever.value==1)
			{
				//宅配
				oDelieverTime.removeAttribute('disabled');
			}
			else
			{
				//超商店配
				oDelieverTime.value = 1;
				oDelieverTime.setAttribute('disabled','disabled');
			}
		}
		
		</script>
		<?php

		include('orderSerial.php');
		
		session_start();
		
		include_once("member_common.php");
		
		include("../common/sharedCode.php");

		if($_SESSION['total_count']<=0)
		{
			header("location:../index.php");
			exit(0);
		}

		?>        
	</head>
	<body onLoad="discount_changed()">
		<!-- Nav -->
		<nav id="nav">
			<ul class="container">
				<li><a href="../index.php">EXQUISITE</a></li>
				
				<li><a href="Cart.php">我的購物車<?php echo ($_SESSION['total_count']>0) ?  "(".$_SESSION['total_count'].")" : ""; ?></a></li>
				<?php
				
				add_member_option("","Cart_step2.php");

				?>                    
			</ul>
		</nav>
		<!-- Home -->
		<div class="wrapper step02">
			<article class="container 75%">
				<div class="row 0% baseline01 fr311">
					<div class="12u"><img class="12u" src="images/STEP2CC.png"></div>
				</div><!-- row 0% -->
				<div class="row">
					<div class="12u">
						<div class="choosing">Choosing a payment method<br>請先選擇付款方式再選擇取貨方式</div>
					</div>
				</div><!-- row -->
				<div class="row 0%">
					<div class="12u baseline01">
						<div class="row no-collapse fr312">
							<div class="4u 10u(3)">
								<div class="row">
									<div class="12u">                                        
										<select name="order_type" form="Cart2Form" style="width: 100%">
											<option value="0">--選擇付款方式--</option>
											<option value="3">ATM付款</option><!-- value 是 easyShip要用 -->
											<option value="1">貨到付款</option><!-- value 是 easyShip要用 -->
                                            <option value="10">信用卡線上刷卡</option>
										</select>                                        
									</div><!-- 12u -->
								</div><!-- row -->
							</div><!-- 4u -->
							<div class="4u 10u(3)">
								<div class="row">
									<div class="12u">                                        
										<select id="id_deliever" name="deliever" form="Cart2Form" style="width: 100%" onChange="delieverChanged()">
											<option value="0">--選擇取貨方式--</option>   
											<option value="1">宅配</option>
											<option value="3">超商店配(全家 萊爾富 OK)</option>
										</select>                                           
									</div>
								</div><!-- row -->
							</div><!-- 4u -->
							<div class="4u 10u(3)">
								<div class="row">
									<div class="12u">                                        
										<select id="id_delieverTime" name="delieverTime" form="Cart2Form" style="width: 100%" disabled>
											<option value="0" selected>--指定送貨時段--</option>
											<option value="1">不指定時間</option>
											<option value="2">中午以前</option>
											<option value="3">12~17時</option>
											<option value="4">17~20時</option>
										</select>                                        
									</div><!-- 12u -->
								</div><!-- row -->
							</div><!-- 4u -->
						</div><!-- row no-collapse-->
					</div><!-- 12u -->
				<!--/div--><!-- row 0% -->
                <form id="Cart2Form" action="Cart_step2Submit.php" method="post">
                	<input type="hidden" name="Submit2" value="true" />
                </form>
                </div>
				<div class="row">
					<div class="12u">
						<div class="row no-collapse">
							<div class="6u fr25">
								<a href="Cart.php">                                   
                                      <div class="button2">回購物車</div>
                                </a>
							</div><!-- 6u -->
							<div class="6u fr42">
								<a href="Cart_step3.php" onClick="submitStep2(event)">
                                   <div class="button2">下一步></div>
                                </a>
							</div><!-- 6u -->
						</div><!-- row -->
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