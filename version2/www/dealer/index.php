<!DOCTYPE HTML>
<!--
	Prologue by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollzer.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
            
		<title>EXQUISITE經銷體系</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <link rel="stylesheet" href="../css/rzOverride.css" />
        
        <?php
		
		session_start();
		
		$_SESSION['pageBase']='../dealer/index.php';
		
		include_once("../product/member_common.php");
				
		if(isset($_GET['mode']))
		{
			$_SESSION['mode']=$_GET['mode'];
		}
		else
		{
			$_SESSION['mode']='monthMode';
		}
		
		$dealerStr="&dealerSN={$_SESSION['member_sn']}&dealerName={$_SESSION['rv_name']}";
		$_SESSION['currentDealer']=$_SESSION['member_sn'];
		?>
        
	</head>
	<body>

		<!-- Header -->
			<div id="header">

				<div class="top">

					<!-- Logo -->
						<div id="logo">
							<span><img style='width:250px' src="images/logo.gif" alt="" /></span>
							<p>經銷商資訊系統</p>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<!--

								Prologue's nav expects links in one of two formats:

								1. Hash link (scrolls to a different section within the page)

								   <li><a href="#foobar" id="foobar-link" class="icon fa-whatever-icon-you-want skel-layers-ignoreHref"><span class="label">Foobar</span></a></li>

								2. Standard link (sends the user to another page/site)

								   <li><a href="http://foobar.tld" id="foobar-link" class="icon fa-whatever-icon-you-want"><span class="label">Foobar</span></a></li>

							-->
							<ul>
								<li><a href=<?php echo "{$_SERVER['PHP_SELF']}?mode=monthMode&dealerSN={$_SESSION['member_sn']}" ?> id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home">經銷商首頁</span></a></li>
								<li><a href=<?php echo "{$_SERVER['PHP_SELF']}?mode=dealerMemberList{$dealerStr}" ?> id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-th">旗下會員列表</span></a></li>
								<li><a href=<?php echo "{$_SERVER['PHP_SELF']}?mode=addMemberMode{$dealerStr}" ?> id="about-link" class="skel-layers-ignoreHref"><span class="icon fa-user">新增旗下會員</span></a></li>
								<li><a href="./index.php?mode=modeOrder&dealerSN=<?php echo $_SESSION['member_sn']?>" id="contact-link" class="skel-layers-ignoreHref"><span class="icon fa-envelope">代訂/自訂商品</span></a></li>                                
                                <li><a href="./index.php?mode=pointTransMode&member_sn=<?php echo "{$_SESSION['member_sn']}" ?>" id="contact-link" class="skel-layers-ignoreHref"><span class="icon fa-money">紅利變動歷程</span></a></li>
							</ul>
						</nav>
				</div>

				<!--div class="bottom">

					
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
						</ul>

				</div-->

			</div>

		<!-- Main -->
			<div id="main">

				<!-- Intro -->
					<section class="one dark"> <!---->
						<div class="container">
                            <nav id="topnav">
                                <ul>
                                	經銷商 <?php  add_member_option("../product/","../dealer/index.php"); ?>
                                </ul>
                            </nav>
							<header>
								<!--h2 class="alt">Hi! I'm <strong>Prologue</strong>, a <a href="http://html5up.net/license">free</a> responsive<br />
								site template designed by <a href="http://html5up.net">HTML5 UP</a>.</h2>
								<p>Ligula scelerisque justo sem accumsan diam quis<br />
								vitae natoque dictum sollicitudin elementum.</p-->
							</header>
                               
<?php
	
	include_once('../admin/monthMode.php');
	include_once('addMemberMode.php');
	include_once('dealerMemberList.php');
	include_once('../admin/memberMode.php');
	include_once('modeOrder.php');
	include_once('modeOrder3Confirm.php');
	include_once('../admin/pointTransMode.php');
	include_once('../admin/orderMode.php');
	include_once('../admin/creditMode.php');
	
	if(isDealer())
	{
		switch($_SESSION['mode'])
		{
			case "monthMode":
				monthMode($_SESSION['member_sn'],$_SESSION['rv_name']);
				break;
			case "addMemberMode":
				addMemberMode();
				break;
			case "dealerMemberList":
				dealerMemberList();
				break;
			case "modeOrder":
				modeOrder($_SESSION['member_sn'],$_SESSION['rv_name']);				
				break;
			case "modeOrder3Confirm":
				modeOrder3Confirm();
				break;
			case "orderMode":
				orderMode();
				break;
			case "creditMode":
				creditMode();
				break;
			case "memberMode":
				memberMode();
				break;
			case "pointTransMode":
				pointTransMode();
				break;
		}
	}//if
	else
	{
		echo "<h3>請先用經銷商帳號登入!</h3>";
	}//else
?>

							<footer>
								<!--a href="#portfolio" class="button scrolly">Magna Aliquam</a-->
							</footer>

						</div>
					</section>
		<!-- Footer -->
			<!--div id="footer">

					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>

			</div-->

	</body>
</html>