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
            
		<title>EXQUISITE後台管理系統</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <link rel="stylesheet" href="../css/rzOverride.css" />
        
        <?php
		
		session_start();
		
		$_SESSION['pageBase']='../admin/index.php';
		
		include_once("../product/member_common.php");
				
		if(isset($_GET['mode']))
		{
			$_SESSION['mode']=$_GET['mode'];
		}
		else
		{
			$_SESSION['mode']='monthMode';
		}		
		
		?>
        
	</head>
	<body>

		<!-- Header -->
			<div id="header">

				<div class="top">

					<!-- Logo -->
						<div id="logo">
							<span><img style='width:250px' src="images/logo.gif" alt="" /></span>
							<p>後台管理系統</p>
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
								<li><a href=<?php echo "{$_SERVER['PHP_SELF']}" ?> id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home">後台首頁</span></a></li>
								<li><a href=<?php echo "{$_SERVER['PHP_SELF']}?mode=memberListMode" ?> id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-th">會員列表</span></a></li>
								<li><a href=<?php echo "{$_SERVER['PHP_SELF']}?mode=dealerListMode" ?> id="about-link" class="skel-layers-ignoreHref"><span class="icon fa-user">經銷商列表</span></a></li>
                                <li><a href=<?php echo "{$_SERVER['PHP_SELF']}?mode=modeOrder&nonMember=true" ?> id="about-link" class="skel-layers-ignoreHref"><span class="icon fa-user">非會員代訂</span></a></li>
								<!--li><a href="#about" ><span><input type="checkbox" name="useTest" id="useTest" value='true' <?php echo $_GET['test']? "checked" : ""; ?> >包括測試資料</span></a></li-->
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
					<section id="top" class="one dark cover">
						<div class="container">
                            <nav id="topnav">
                                <ul>
                                	<?php  add_member_option("../product/","../admin/index.php"); ?>
                                </ul>
                            </nav>
							<header>
								<!--h2 class="alt">Hi! I'm <strong>Prologue</strong>, a <a href="http://html5up.net/license">free</a> responsive<br />
								site template designed by <a href="http://html5up.net">HTML5 UP</a>.</h2>
								<p>Ligula scelerisque justo sem accumsan diam quis<br />
								vitae natoque dictum sollicitudin elementum.</p-->
                                <script type="text/javascript">
								
								function clickMonth(event,year,month)
								{
									event.preventDefault();
									
									var oCheckTest = document.getElementById('useTest');
									
									//var testStr = oCheckTest.checked ? "&test=true" : "";
									
									window.location = "<?php echo $_SERVER['PHP_SELF'].'?mode=monthMode&year=' ?>" + year + "&month=" + month; // + testStr
								}
								</script>
                                
							</header>
                               
<?php
	
	include_once('monthMode.php');
	include_once('orderMode.php');
	include_once('memberMode.php');
	include_once('creditMode.php');
	include_once('memberListMode.php');
	include_once('dealerCashout.php');
	include_once('pointTransMode.php');
	include_once('reassignDealer.php');
	include_once('../dealer/dealerMemberList.php');
	include_once('../dealer/addMemberMode.php');
	include_once('modifyMemberForm.php');
	include_once('changePasswordForm.php');
	include_once('../dealer/modeOrder.php');
	include_once('../dealer/modeOrder3Confirm.php');
	
	if($_SESSION['privalege']>0)
	{
		switch($_SESSION['mode'])
		{
			case "monthMode":
				monthMode();
				break;
			case "orderMode":
				orderMode();
				break;
			case "memberMode":
				memberMode();
				break;
			case "creditMode":
				creditMode();
				break;
			case "memberListMode":
				memberListMode(false);
				break;
			case "dealerListMode":
				memberListMode(true);
				break;
			case "dealerCashout":
				dealerCashout();
				break;
			case "pointTransMode":
				pointTransMode();
				break;
			case "reassignDealer":
				reassignDealer();
				break;
			case "dealerMemberList":
				dealerMemberList();
				break;
			case "addMemberMode":
				addMemberMode();
				break;
			case "modifyMember":
				modifyMember();
				break;			
			case "changePassword":
				changePassword();
				break;			
			case "modeOrder":
				modeOrder();
				break;			
			case "modeOrder3Confirm":
				modeOrder3Confirm();
				break;			
		}//switch
	}//if
	else
	{
		echo "<h3>請先用系統管理者帳號登入!</h3>";
	}
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