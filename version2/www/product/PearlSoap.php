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
	
	include("../global.php");
	include('addProduct.php');
	
	if($_SESSION['showMessage'])
	{
		echo "<script>alert('成功加入購物車!')</script>";
		$_SESSION['showMessage']=false;
	}	
	
	?>
	<title>EXQUISITE 珍珠矽皂</title>
	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/init.js"></script>
        <script>
        var submitForm = function(event) {
            event.preventDefault();

            var oForm = document.getElementById("orderForm");
            var oQty = document.getElementById("qty");
            var oSelect = oForm.elements["product"];

            if (oQty.value == 0) {
                alert("請選擇購買數量!");
            } else {
                if (!oSelect.value) {
                    alert("請先選擇種類!");
                } else {
                    oForm.submit();
                }
            }
        }

        var submitFormB = function(event) {
            event.preventDefault();

            var oForm = document.getElementById("orderFormB");
            var oQty = document.getElementById("qtyB");
            var oSelect = oForm.elements["product"];

            if (oQty.value == 0) {
                alert("請選擇購買數量!");
            } else {
                if (!oSelect.value) {
                    alert("請先選擇種類!");
                } else {
                    oForm.submit();
                }
            }
        }
        var selectionChanged = function() {
            var oForm = document.getElementById("orderForm");
            var oSelect = oForm.elements["product"];
            var oImage = document.getElementById("productImage");
            switch (oSelect.value) {
                case "pearl100":
                    oImage.src = "images/PIC00-9.png";
                    break;
                case "pearl25":
                    oImage.src = "images/PIC00-9-3.png";
                    break;
            }

        }
        var selectionChangedB = function() {
            var oForm = document.getElementById("orderFormB");
            var oSelect = oForm.elements["product"];
            var oImage = document.getElementById("productImageB");
            switch (oSelect.value) {
                case "pearl100":
                    oImage.src = "images/PIC00-9.png";
                    break;
                case "pearl25":
                    oImage.src = "images/PIC00-9-3.png";
                    break;
            }

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
	<body onLoad="selectionChanged()">
	<!-- Nav -->
		<nav id="nav">
			<ul class="container">
				<li><a href="../index.php">EXQUISITE</a></li>
				<li><a href="Cart.php">我的購物車<?php echo ($_SESSION['total_count']>0) ?  "(".$_SESSION['total_count'].")" : ""; ?></a></li>
				<?php 							
				
				include("member_common.php");
				
				add_member_option("","PearlSoap.php");
				
                ?>
			</ul>
		</nav>
	<!-- Home -->
		<div class="wrapper style5">
	      <article class="content container 75%">
            <div class="row not-mobile">
                <div class="5u">
                    <img id="productImage" class="10u" src="images/PIC00-9.png">
                    <!--div class="row"-->
                    <h4>售價　TWD NT$ 420 / 135</h4>
                    <!--/div-->
                </div>
                <div class="7u">
                    <div class="row">
                        <div class="12u fr42">
                            <ul class="fr49 item">
                                <li id="best">BEST</li>
                                <li>
                                    <h3>Nano Soap - Pearl 100g / 25g</h3>
                                </li>
                            </ul>
                            <ul class="item">
                                <li>
                                    <div class="lsbelSeries">
                                        <font style="font-weight: normal;font-size:0.9em">逆青春駐妍</font>
                                        <font style="color:brown;font-size:0.5em;font-weight:normal">series</font>
                                    </div>
                                </li>
                                <li>
                                    <h4> 珍珠矽皂</h4>
                                </li>
                            </ul>
                            <p>首重保養的最高規格配方，特採頂級
                                <font style="color:darkorange;font-weight: 500">高分子奈米珍珠精華</font>，運用珍珠獨有的淡化黑色素修護能量，加持呵護您的每一吋肌膚。同步保養一次到位，連小資族都驚嘆超精省。
                                <font style="color:brown;font-size:1.25em">超人氣 高CP值商品!</font>
                            </p>
                            <div class="row fr403">
                                <div class="8u">
                                    <div class="row no-collapse">
                                        <div class="3u"><img class="12u" src="images/icon01.png"></div>
                                        <div class="3u"><img class="12u" src="images/icon02-2.png"></div>
                                        <div class="3u"><img class="12u" src="images/icon03.png"></div>
                                        <div class="3u"><img class="12u" src="images/ICON7-Pearl (Element).png"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h4>請於下方選擇公克數後再選擇數量</h4>
                    </div>
                    <form action="<?php echo $_SERVER[PHP_SELF]; ?>" method="post" id="orderForm">
                        <div class="row fr330 fr403">
                            <div class="4u">
                                <table class="aromas">
                                    <tr>
                                        <th class="2u">
                                            <div class="pearl100"></div>
                                        </th>
                                        <th class="2u">
                                            <div class="pearl25"></div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>100g</td>
                                        <td>25g</td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="product" value="pearl100" onChange="selectionChanged()"
                                            <?php echo (!isset($_POST['product']))||($_POST['product']=="pearl100")? "checked":""; ?> >
                                        </td>
                                        <td><input type="radio" name="product" value="pearl25" onChange="selectionChanged()"
                                            <?php echo ($_POST['product']=="pearl25")? "checked":""; ?> >
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="10u fr42">
                                <div class="row no-collapse">
                                    <div class="5u">
                                        <select class="12u select" name="qty" id="qty">
						          <option value="0">--請選擇數量--</option>
							      <option value="1">1</option>
							      <option value="2">2</option>
							      <option value="3">3</option>
							      <option value="4">4</option>
							      <option value="5">5</option>
							      <option value="6">6</option>
							      <option value="7">7</option>
							      <option value="8">8</option>
							      <option value="9">9</option>
							      <option value="10">10</option>
							      <option value="11">11</option>
							      <option value="12">12</option>
						        </select>
                                    </div>
                                    <div class="7u">
                                        <input class="8u button2" type="button" onclick="submitForm(event)" href="Cart.php" value="加入購物車" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row 25% fr42 fr321" id="labeling">
                        <span>貼心提醒：由於商品當批製作，因此顏色將會有些許誤差，屬正常範圍。</span>
                        <ul>
                            <p>〔天然成分〕</p>
                            <li>NSP天然淨化因子(奈米矽片)，棕櫚油，棕仁油，椰子油，天然甘油，蓖麻油，蘆薈油，
                                <font style="color:darkorange;font-weight: 500">頂級(食用級)高分子奈米級珍珠粉。</font>
                            </li>
                        </ul>

                        <p>〔使用方法〕</p>
                        <table class="12u stepStyle">
                            <tr class="12u">
                                <td><span id="step">STEP1</span></td>
                                <td>沾水將奈米矽皂在手上搓揉後，即產生極細緻奶油般泡沫。</td>
                            </tr>
                            <tr class="12u">
                                <td><span id="step">STEP2</span></td>
                                <td>敷於清洗部位肌膚上，並輕揉按摩易出油或T字部位(物理吸附力即自動產生作用)。</td>
                            </tr>
                            <tr class="12u">
                                <td><span id="step">STEP3</span></td>
                                <td>用清水將泡沫完全沖淨即可，肌膚毛孔瞬間完成溫柔洗淨。</td>
                            </tr>
                        </table>
                        <ul>
                            <p>〔適用肌膚〕</p>
                            <li>本產品為天然成份及特殊自然物理吸附力作用，不限膚質皆可使用。</li>
                            <li>較敏感者在初次使用可感受到稍為的吸附感(非皮膚刺激)。</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row only-mobile">
                <div class="12u">
                    <img class="8u" id="productImageB" src="images/PIC00-9.png">
                </div>
                <div class="12u fr42 fr403">
                    <ul class="fr49 item">
                        <li id="best">BEST
                        </li>
                        <li>
                            <h3>Nano Soap -Collagen 100g / 25g</h3>
                        </li>
                    </ul>
                    <ul class="item">
                        <li>
                            <div class="lsbelSeries">
                                <font style="font-weight: normal;font-size:0.85em">逆青春駐妍</font>
                                <font style="color:brown;font-size:0.5em;font-weight:normal">series</font>
                            </div>
                        </li>
                        <li>
                            <h4> 珍珠矽皂</h4>
                        </li>
                    </ul>
                    <p>特採頂級
                        <font style="color:darkorange;font-weight: 500">高分子奈米珍珠精華</font>，運用珍珠獨有的淡化黑色素的修護能量，更加持呵護您的每一吋肌膚。連小資族都驚嘆超精省。
                        <font style="color:brown;font-size:1.1em;font-weight:600">人氣高CP商品!</font>
                    </p>
                    <div class="row">
                        <div class="10u fr42">
                            <div class="row no-collapse">
                                <img class="2u" src="images/icon01.png">
                                <img class="2u" src="images/icon02-2.png">
                                <img class="2u" src="images/icon03.png">
                                <img class="2u" src="images/ICON7-Pearl (Element).png">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="12u fr403 fr331">
                    <h3>請選擇您所喜愛的香氛與數量</h3>
                    <!--/div-->
                    <form action="<?php echo $_SERVER[PHP_SELF]; ?>" method="post" id="orderFormB">
                        <div class="row">
                            <div class="12u">
                                <table class="6u aromas">
                                    <tr>
                                        <th class="2u">
                                            <div class="pearl100"></div>
                                        </th>
                                        <th class="2u">
                                            <div class="pearl25"></div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>100g</td>
                                        <td>25g</td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="product" value="pearl100" onChange="selectionChangedB()">
                                            <!--?php echo (!isset($_POST['product']))||($_POST['product']=="pearl100")? "checked":""; ?-->
                                        </td>
                                        <td><input type="radio" name="product" value="pearl25" onChange="selectionChangedB()">
                                            <!--?php echo ($_POST['product']=="pearl25")? "checked":""; ?-->
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="12u">
                                <select class="12u select" name="qty" id="qtyB">
						          <option value="0">--請選擇數量--</option>
							      <option value="1">1</option>
							      <option value="2">2</option>
							      <option value="3">3</option>
							      <option value="4">4</option>
							      <option value="5">5</option>
							      <option value="6">6</option>
							      <option value="7">7</option>
							      <option value="8">8</option>
							      <option value="9">9</option>
							      <option value="10">10</option>
							      <option value="11">11</option>
							      <option value="12">12</option>
						        </select>
                            </div>
                            <div class="12u">
                                <div class="row" id="combination">
                                    <div class="12u">
                                        <input class="8u button2" type="button" onclick="submitFormB(event)" href="Cart.php" value="加入購物車" />
                                    </div>
                                    <p class="oder4price">貼心提醒：由於商品當批製作，因此顏色將會有些許誤差，為正常範圍。</p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="12u">
                    <div class="row" id="labeling">
                        <h3>商品相關介紹</h3>
                        <div class="12u fr42">
                            <p>〔天然成分〕</p>
                            <span>NSP天然淨化因子(奈米矽片)，棕櫚油，棕仁油，椰子油，天然甘油，蓖麻油，蘆薈油，
                                <font style="color:darkorange;font-weight: 500">頂級(食用)奈米珍珠粉。</font></span>
                        </div>
                        <div class="12u fr42" -->
                            <p>〔超簡單使用方法〕</p>
                            <table class="12u">
                                <tr class="12u">
                                    <td><span id="step">STEP1</span></td>
                                    <td>沾水將奈米矽皂在手上搓揉後，即產生極細緻奶油般泡沫。</td>
                                </tr>
                                <tr class="12u">
                                    <td><span id="step">STEP2</span></td>
                                    <td>敷於清洗部位肌膚上，並輕揉按摩易出油或T字部位(物理吸附力即自動產生作用)。</td>
                                </tr>
                                <tr class="12u">
                                    <td><span id="step">STEP3</span></td>
                                    <td>用清水將泡沫j完全沖淨即可，肌膚毛孔瞬間完成溫柔洗淨。</td>
                                </tr>
                            </table>
                        </div>
                        <div class="12u fr42">
                            <p>〔全肌膚適用〕</p>
                            <span>本產品為創新特殊自然物理吸附力作用，及純天然成份所製作，完全不刺激肌膚，任何膚質皆可使用。</span>
                            <span>較容易敏感者，在初次使用可感受到稍為的吸附感(此非皮膚刺激)敬請安心使用。</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row not-mobile">
                <div class="12u fr37 fr42 fr100 fr403">Made in Taiwan</div>
            </div>

        </article>
        <article class="content container not-mobile">
            <header>
                <h1>Product details</h1>
                <h3>商品詳細介紹</h3>
            </header>
            <img class="12u" src="images/NEW(EX)5(96).jpg" />
            <img class="12u" src="images/NEW(EX)5-2(96).jpg" />
            <img class="12u" src="images/NEW(EX)1-2(96).jpg" />
            <img class="12u" src="images/NEW(EX)1-3(96).jpg" />
            <img class="12u" src="images/NEW(EX)1-4(96).jpg" />
            <img class="12u" src="images/NEW(EX)1-5(96).jpg" />
            <img class="12u" src="images/NEW(EX)1-6(96).jpg" />
            <img class="12u" src="images/NEW(EX)1-7(96).jpg" />
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