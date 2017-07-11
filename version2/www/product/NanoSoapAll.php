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

    <!--script>
			function currentWidth()
			{
				var result = document.documentElement.clientWidth + "(" + skel.vars.stateId + ")";
				
				document.getElementById("viewportSize").innerHTML = result;
				
				var tc=document.getElementById("testContainer");
				
				tc.innerHTML = "12u is same as container　w=" +　tc.clientWidth;
			}
        </script-->
    <noscript>
	<link rel="stylesheet" href="css/skel.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/style-desktop.css" />
	<link rel="stylesheet" href="css/style-wide.css"/>
	<link rel="stylesheet" href="css/style-normal.css" />
    <link rel="stylesheet" href="css/style-narrow.css" />
    <link rel="stylesheet" href="css/style-narrower.css" />
    <link rel="stylesheet" href="css/style-mobile.css" />
    <link rel="stylesheet" href="css/gallery.css"/>
</noscript>
    <script type="text/javascript"></script>
    <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
    <!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
</head>
<!--body onResize="currentWidth()"-->

<body onLoad="discount_changed()">
    <!-- Nav -->
    <nav id="nav">
        <ul class="container">
            <li><a href="../index.php">EXQUISITE</a></li>
            <li><a href="Cart.php">我的購物車<?php echo ($_SESSION['total_count']>0) ?  "(".$_SESSION['total_count'].")" : ""; ?></a></li>
            <?php 							
				
				include("member_common.php");
				
				add_member_option("","NanoSoapAll.php");
				
                ?>
        </ul>
    </nav>
    <!-- Home -->
    <div class="wrapper style1 first not-mobile">
        <article class="content container">
            <img class="8u 12u(3)" src="images/ALLtitle(96)-2-1.png" style="padding-bottom: 2em" />
            <div class="row 0% no-collapse ">
                <div class="4u"><img class="10u 12u(7)" src="images/ALLtitle(96)-2-2.png" /></div>
                <div class="4u"><img class="10u 12u(7)" src="images/ALLtitle(96)-2-3.png" /></div>
                <div class="4u"><img class="10u 12u(7)" src="images/ALLtitle(96)-2-4.png" /></div>
            </div>
        </article>
    </div>
    <!-- Work -->
    <div class="wrapper introduction not-mobile">
        <article class="content container 75%">
            <h3 class="baseline01">您的肌膚真的洗對方式了嗎?</h3>
            <p>一般而言，保養精華都是由「毛孔」所吸收，因此維持毛孔環境的健康，就等於是為保養及健康肌膚打下第一步。若沒清潔乾淨，長久以來使油脂髒污堆積其中，保養成分無法好好吸收，無論再好成份的保養品，效果大大打折，在所難免，所以肌膚清潔真的很重要。</p>
            <p>過度清潔則容易造成肌膚敏感及油水不平衡的狀況。洗臉不是次數越多越好，也不是搓大力、搓很久就等於乾淨，對肌膚不夠輕、溫柔去呵護它，皆是現代人常有的問題。若能在每次清潔的過程中皆達到真正的毛孔清潔，不僅減少了每日的時間成本，長期下來也能養成健康的蛋白肌。</p>
        </article>
    </div>
    <div class="wrapper introduction only-mobile">
        <article class="content container 75%">
            <h3 class="baseline01">您的肌膚真的洗對方式了嗎?</h3>
            <p>一般而言，保養精華都是由「毛孔」所吸收，因此維持毛孔環境的健康，就等於是為保養及健康肌膚打下第一步。若沒清潔乾淨，長久以來使油脂髒污堆積其中，保養成分無法好好吸收，無論再好成份的保養品，效果大大打折，在所難免，所以肌膚清潔真的很重要。</p>
            <!--p>過度清潔則容易造成肌膚敏感及油水不平衡的狀況。洗臉不是次數越多越好，也不是搓大力、搓很久就等於乾淨，對肌膚不夠輕、溫柔去呵護它，皆是現代人常有的問題。若能在每次清潔的過程中皆達到真正的毛孔清潔，不僅減少了每日的時間成本，長期下來也能養成健康的蛋白肌。</p-->
        </article>
    </div>
    <div class="wrapper product01">
        <article class="container 75%">
            <header>
                <h2>ALL / 全系列</h2>
                <!--h4>從嚴選天然原料與潔淨因子-NSP<br>
				    從最佳配方的形成到完美手工製作完成　都是用心的成果</h4-->
            </header>
            <div class="row no-collapse not-mobile">
                <div class="4u 6u(2) 12u(3) productbox">
                    <a href="NanoSoap1.php"><img class="12u 10u(2) 8u(3)" src="images/ALLpic1(480).jpg">
                        <h4>[基礎輕洗顏]</h4>
                        <p class="shinako">奈米矽皂--100g <span>(6 款天然精油可供選擇)</span></p>
                        <p>TWD NT$ 280</p>

                    </a>
                </div>
                <div class="4u 6u(2) 12u(3) productbox">
                    <a href="NanoSoap2.php"><img class="12u 10u(2) 8u(3)" src="images/ALLpic2(480).jpg">
                        <h4>[基礎輕洗顏]</h4>
                        <p class="shinako">奈米矽皂--25g <span>(4 款天然精油可供選擇)</span></p>
                        <p>TWD NT$ 80</p>
                    </a>
                </div>
                <div class="4u 6u(2) 12u(3) productbox">
                    <a href="CollagenSoap.php"><img class="12u 10u(2) 8u(3)" src="images/ALLpic3(480).jpg">
                        <h4>[逆青春駐顏]</h4>
                        <p class="shinako">膠原矽皂 100g / 25g <span>(親膚長效保水)</span></p>
                        <p>TWD NT$ 350 / $ 105</p>
                    </a>
                </div>
                <div class="4u 6u(2) 12u(3) productbox">
                    <a href="EggshellSoap.php"><img class="12u 10u(2) 8u(3)" src="images/ALLpic4(480).jpg">
                        <h4>[逆青春駐顏]</h4>
                        <p class="shinako">蛋殼矽皂 100g / 25g <span>(軟性去角質)</span></p>
                        <p>TWD NT$ 380 / $ 120</p>
                    </a>
                </div>
                <div class="4u 6u(2) 12u(3) productbox">
                    <a href="PearlSoap.php"><img class="12u 10u(2) 8u(3)" src="images/ALLpic5(480).jpg">
                        <h4>[逆青春駐顏]</h4>
                        <p class="shinako">珍珠矽皂 100g / 25g <span>(維持水嫩滋養)</span></p>
                        <p>TWD NT$ 420 / $ 135</p>
                    </a>
                </div>
            </div>
            <div class="row 0% only-mobile">
                <div class="12u productbox">
                    <a href="NanoSoap1.php"><img class="12u" src="images/ALLpic1(480).jpg">
                        <h4>[基礎輕洗顏]</h4>
                        <p class="shinako">奈米矽皂--100g <span>(6 款天然精油可供選擇)</span></p>
                        <p>TWD NT$ 280</p>
                    </a>
                </div>
                <div class="12u productbox">
                    <a href="NanoSoap2.php"><img class="12u" src="images/ALLpic2(480).jpg">
                        <h4>[基礎輕洗顏系列]</h4>
                        <p class="shinako">奈米矽皂--25g <span>(4 款天然精油可供選擇)</span></p>
                        <p>TWD NT$ 80</p>
                    </a>
                </div>
                <div class="12u productbox">
                    <a href="CollagenSoap.php"><img class="12u" src="images/ALLpic3(480).jpg">
                        <h4>[逆青春駐顏系列]</h4>
                        <p class="shinako">膠原矽皂 100g / 25g <span>(親膚長效保水)</span></p>
                        <p>TWD NT$ 350 / $ 105</p>
                    </a>
                </div>
                <div class="12u productbox">
                    <a href="EggshellSoap.php"><img class="12u" src="images/ALLpic4(480).jpg">
                        <h4>[逆青春駐顏系列]</h4>
                        <p class="shinako">卵殼矽皂 100g / 25g <span>(軟性高功去角質)</span></p>
                        <p>TWD NT$ 380 / $ 120</p>
                    </a>
                </div>
                <div class="12u productbox">
                    <a href="PearlSoap.php"><img class="12u" src="images/ALLpic5(480).jpg">
                        <h4>[逆青春駐顏系列]</h4>
                        <p class="shinako">珍珠矽皂 100g / 25g <span>(維持水嫩滋養)</span></p>
                        <p>TWD NT$ 420 / $ 135</p>
                    </a>
                </div>
            </div>
        </article>
    </div>
    <?php
		
		include_once("part_Notice.php");
		include_once("part_Footer.php");
		
		echo $noticeSec;
		echo $footerSec;
		
		?>

</body>

</html>
