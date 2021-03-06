<!DOCTYPE HTML>
<!--
	Miniport by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
	<?php 
	
	session_start(); 
	?>
	
	<title>EXQUISITE 產品介紹</title>
	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/init.js"></script>
        <script>
			function currentWidth()
			{
				var result = document.documentElement.clientWidth + "(" + skel.vars.stateId + ")";
				
				document.getElementById("viewportSize").innerHTML = result;
				
				var tc=document.getElementById("testContainer");
				
				tc.innerHTML = "12u is same as container　w=" +　tc.clientWidth;
			}
        </script>        
	<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
	<body onResize="currentWidth()">
	<!-- Nav -->
		<nav id="nav">
			<ul class="container">
				<li><a href="../index.php">EXQUISITE</a></li>
				<li><a href="Cart.php">我的購物車<?php echo ($_SESSION['total_count']>0) ?  "(".$_SESSION['total_count'].")" : ""; ?></a></li>
				<?php 							
				
					include("member_common.php");
				
					add_member_option("","gifts_All.php");
				
                		?>
			</ul>
		</nav>
	<!-- Home -->
		<div class="wrapper style2 first">
	       <article class="content container">
           <img class="4u" src="images/gifts3C.png">
              <div class="row 0% no-collapse">
                 <div class="5u"><img class="10u" src="images/gifts-1C.png"></div>
                 <div class="3u"><img class="10u" src="images/gifts2C.png"></div>
                 <div class="4u"></div>
              </div>
          </article>   
	    </div>
	<!-- Work -->
        <div class="wrapper introduction">
           <article class="content container 75%">
              <h3 class="baseline01">您的肌膚真的洗對方式了嗎?</h3>
              <p>一般而言，保養精華都是由「毛孔」所吸收，因此維持毛孔環境的健康，就等於是為保養及健康肌膚打下第一步。若沒清潔乾淨，長久以來使油脂髒污堆積其中，保養成分無法好好吸收，無論再好成份的保養品，效果大大打則，在所難免，所以肌膚清潔真的很重要。</p>
              <p>過度清潔則容易造成肌膚敏感及油水不平衡的狀況。洗臉不是次數越多越好，也不是搓大力、搓很久就等於乾淨，對肌膚不夠輕、溫柔去呵護它，皆是現代人常有的問題。若能在每次清潔的過程中皆達到真正的毛孔清潔，不僅減少了每日的時間成本，長期下來也能養成健康的蛋白肌。</p>
           </article>
        </div>
		<div class="wrapper product01">
			<article class="container 75%">
				<header>
					<h2>SET / 組合</h2>
					<!--<p>從嚴選天然原料與潔淨因子-NSP<br>
				    從最佳配方的形成到完美手工製作完成　都是用心的成果</p>-->
				</header>
						<div class="row no-collapse">
						   <div class="4u 6u(2) 12u(3) productbox">
                              <a href="gifts_100g.php"><img class="12u 10u(2) 8u(3)" src="images/SETpic1(480).jpg">
                                 <h4>[任選系列]</h4>                                             
                                 <p class="shinako">植淬賦活組 100g x 4 /set</p>
                                 <p>TWD NT$ 1120~1680</p>
                              </a>
                           </div>
						   <div class="4u 6u(2) 12u(3) productbox">
                              <a href="gifts_25g.php"><img class="12u 10u(2) 8u(3)" src="images/SETpic2(480).jpg">
                                 <h4>[任選系列]</h4>
                                 <p class="shinako">植淬賦活組 25g x 5 /set</p>
                                 <p>TWD NT$ 400~675</p>
                              </a>
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