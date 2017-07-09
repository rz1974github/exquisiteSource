<!DOCTYPE HTML>
<!--
	Miniport by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>會員資料</title>
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
		
		session_start();
		
		if(isset($_GET['from']))
		{
			$_SESSION['from']=$_GET['from'];
		}
		
		if(isset($_GET['mode']))
		{
			$Mode=$_GET['mode'];
		}
		else
		{
			$Mode='Choose';
		}
		
		?>
        
        <script type="text/javascript">

		var confirmLogout = function(event)
		{
			event.preventDefault();
			var answer = confirm("你確定要登出嗎?");
			if(answer == true)
			{
				window.location.href = "logout.php";
			}
		}
		
		var changePassword = function()
		{
			window.location = window.location.pathname + "?mode=Pass";
		}
		
		var submitChange = function(event)
		{
			event.preventDefault();
			
			var oForm = document.getElementById('changeForm');
			
			oForm.submit();
		}
		</script>
	</head>
	<body>

		<!-- Nav -->
			<nav id="nav">
               	<ul class="container">
                    <li><a href="../index.php">EXQUISITE</a></li>
                    
					<li><a href="Cart.php">我的購物車<?php echo ($_SESSION['total_count']>0) ?  "(".$_SESSION['total_count'].")" : ""; ?></a></li>
                    <li><a href='#' onclick='confirmLogout(event)'>登出</a></li>
				</ul>
               
			</nav>
		<!-- Home -->
			<div class="wrapper cart01">
			    <article class="container 75%">
                
                   <div class="row">
                      <div class="12u memberbox">
                          <div class="row">
								  <div class="12u fr26">會員資訊</div>
                           </div>
<?php

$ModeChoose=<<<MODE_CHOOSE

                           <div class="row">
								  <div class="6u">
 									    <div class="row no-collapse">
										   <div class="12u fr25"><a href='#' onClick='changePassword()'>1.更改密碼</a></div>
									    </div>
								  </div>
                           </div><!-- row -->
                           <div class="row">
								  <div class="6u">
									 <div class="row no-collapse">
										<div class="12u fr25">2.購買紀錄</div>
									 </div>
								  </div>							  
                           </div><!-- row -->
MODE_CHOOSE;


$ModePass=<<<MODE_PASS
	<form action='changePassword.php' id='changeForm' name='changeForm' method='post'>
		<div class="row">
			<div class="12u">
				<div class="row no-collapse">
					<div class="4u 4u(3) fr25">輸入舊密碼</div>
					<div class="4u">
						<div class="row">
							<div class="12u fr42">
								<input type="password" name="oldPassword" display="密碼" required />
							</div>
						</div><!-- row -->
					</div><!-- 8u -->
				</div><!--row-->
			</div><!--12u-->
		</div><!--row-->
		<div class="row">
			<div class="12u">
				<div class="row no-collapse">
					<div class="4u 4u(3) fr25">設定新密碼</div>
						<div class="4u">
							<div class="row">
								<div class="12u fr42">
									<input type="password" name="passwd" display="設定密碼" required />
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="12u">
				<div class="row no-collapse">
					<div class="4u 4u(3) fr25">確認新密碼</div>
					<div class="4u">
						<div class="row">
							<div class="12u fr42">
								<input type="password" name="passwd2" planceholder="確認密碼" required />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="12u">
				<div class="row 150%">
					<div class="12u">
						<!--a herf="#" onclick="submitChange(event)"><div class="4u 6u(3) bgcolor03">更改密碼</div></a-->
						<div><input type='submit' value='更改密碼' /></div>
					</div>
				</div>
			</div>
		</div>
	</form>
MODE_PASS;
										
	if(isset($_GET['error']))
	{
		switch($_GET['error'])
		{
			case 0:
				echo "<div class='12u'><p><strong style=''>更改密碼成功</strong></p></div>";
			break;
			case 30:
				echo "<div class='12u'><p><strong style='color:red'>*舊密碼不符, 請再次輸入!</strong></p></div>";
			break;
			case 31:
				echo "<div class='12u'><p><strong style='color:red'>*您兩次輸入的新密碼並不相同!</strong></p></div>";
			break;
		}												  
	}

	switch($Mode)
	{
		case 'Choose':
			echo $ModeChoose;
			break;
		case 'Pass':
			echo $ModePass;
			break;
	}

?>
				
                        </div><!-- 6u 12u memberbox-->
                      </div>
                   </div>
	<!-- Contact -->
		<?php
		
		include_once("part_Notice.php");
		include_once("part_Footer.php");
		
		echo $noticeSec;
		echo $footerSec;
		
		?>
	</body>
</html>