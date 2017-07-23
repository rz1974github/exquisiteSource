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
	
	echo "<script>";
	
	foreach($productPrice as $key => $value)
	{
		echo "var js_{$key}={$value};\n";
	}//foreach	

		
	echo "var getPrice=function(product){switch(product){";	
	foreach($productPrice as $key => $value)
	{
		echo "case '{$key}':";
		echo "return js_{$key};";
	}
	echo "}return 0;";
	echo "}";
	
	echo "</script>";
	
	?>
    <title>EXQUISITE 任選組合</title>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.scrolly.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/init.js"></script>
    <script>
        var selectionChanged = function() {
            var sum = 0;
            var oSlot0 = document.getElementById("id_slot0");
            if (oSlot0.value != "0") {
                sum += getPrice(oSlot0.value);
            } //if
            var oSlot1 = document.getElementById("id_slot1");
            if (oSlot1.value != "0") {
                sum += getPrice(oSlot1.value);
            } //if
            var oSlot2 = document.getElementById("id_slot2");
            if (oSlot2.value != "0") {
                sum += getPrice(oSlot2.value);
            } //if
            var oSlot3 = document.getElementById("id_slot3");
            if (oSlot3.value != "0") {
                sum += getPrice(oSlot3.value);
            } //if

            var oTotal = document.getElementById("id_set_total");
            oTotal.innerHTML = sum;
        }

        var submitForm = function(event) {
            event.preventDefault();

            var oForm = document.getElementById("orderForm");
            var oSlot0 = document.getElementById("id_slot0");
            if (oSlot0.value == "0") {
                alert("請選擇第一項商品");
                return;
            } //if
            var oSlot1 = document.getElementById("id_slot1");
            if (oSlot1.value == "0") {
                alert("請選擇第二項商品");
                return;
            } //if
            var oSlot2 = document.getElementById("id_slot2");
            if (oSlot2.value == "0") {
                alert("請選擇第三項商品");
                return;
            } //if
            var oSlot3 = document.getElementById("id_slot3");
            if (oSlot3.value == "0") {
                alert("請選擇第四項商品");
                return;
            } //if

            oForm.submit();
        }
        var selectionChangedB = function() {
            var sum = 0;
            var oSlot0 = document.getElementById("id_slot0B");
            if (oSlot0.value != "0") {
                sum += getPrice(oSlot0.value);
            } //if
            var oSlot1 = document.getElementById("id_slot1B");
            if (oSlot1.value != "0") {
                sum += getPrice(oSlot1.value);
            } //if
            var oSlot2 = document.getElementById("id_slot2B");
            if (oSlot2.value != "0") {
                sum += getPrice(oSlot2.value);
            } //if
            var oSlot3 = document.getElementById("id_slot3B");
            if (oSlot3.value != "0") {
                sum += getPrice(oSlot3.value);
            } //if

            var oTotal = document.getElementById("id_set_totalB");
            oTotal.innerHTML = sum;
        }

        var submitFormB = function(event) {
            event.preventDefault();

            var oForm = document.getElementById("orderFormB");
            var oSlot0 = document.getElementById("id_slot0B");
            if (oSlot0.value == "0") {
                alert("請選擇第一項商品");
                return;
            } //if
            var oSlot1 = document.getElementById("id_slot1B");
            if (oSlot1.value == "0") {
                alert("請選擇第二項商品");
                return;
            } //if
            var oSlot2 = document.getElementById("id_slot2B");
            if (oSlot2.value == "0") {
                alert("請選擇第三項商品");
                return;
            } //if
            var oSlot3 = document.getElementById("id_slot3B");
            if (oSlot3.value == "0") {
                alert("請選擇第四項商品");
                return;
            } //if

            oForm.submit();
        }
    </script>
    <noscript>
			<link rel="stylesheet" href="css/skel.css" />
	<link rel="stylesheet" href="css/style.css" />
	<!--link rel="stylesheet" href="css/style-desktop.css" /-->
	<link rel="stylesheet" href="css/style-wide.css"/>
	<link rel="stylesheet" href="css/style-normal.css" />
    <link rel="stylesheet" href="css/style-narrow.css" />
    <link rel="stylesheet" href="css/style-narrower.css" />
    <link rel="stylesheet" href="css/style-mobile.css" />
    <link rel="stylesheet" href="css/gallery.css"/>
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
				
				add_member_option("","gifts_100g.php");
				
                ?>
            <!--li id="viewportSize">
                <!--script>
                    currentWidth();
                </script-->
            <!--/li-->
        </ul>
    </nav>
    <!-- Home -->
    <div class="wrapper style5">
        <article class="content container 75%">
            <div class="row not-mobile">
                <div class="5u">
                    <img id="productImage" class="12u" src="images/pic25-1.jpg">
                </div>
                <div class="7u">
                    <div class="row">
                        <div class="12u fr42">
                            <ul class="fr49 item">
                                <li id="best">BEST</li>
                                <li>
                                    <h3>Optional -Vibrant skin set 100g</h3>
                                </li>
                            </ul>
                            <ul class="item">
                                <li>
                                    <div class="lsbelSeriesW">
                                        <font style="font-weight: normal;font-size:0.9em">植淬賦活</font>
                                        <font style="color:brown;font-size:0.5em;font-weight:normal">set</font>
                                    </div>
                                </li>
                                <li>
                                    <h4>精選4入組</h4>
                                </li>
                            </ul>
                            <p>無論是
                                <font style="color:darkorange">輕洗顏</font>，還是
                                <font style="color:darkorange">逆青春駐妍保養</font>，可多重搭配的100g隨選4入組，讓肌膚健康完全不受限。包裝呈現出最能擁有完美裸肌的想像，是最佳餽贈好禮的體現，分享給朋友或愛護全家人，讓餽贈 自用 防護超精省。
                                <font style="color:brown;font-size:1.25em">超值好禮!</font>
                            </p>
                            <div class="row fr403">
                                <div class="8u">
                                    <div class="row no-collapse">
                                        <div class="3u"><img class="12u" src="images/icon01.png"></div>
                                        <div class="3u"><img class="12u" src="images/icon02-2.png"></div>
                                        <div class="3u"><img class="12u" src="images/icon03.png"></div>
                                        <div class="3u"><img class="12u" src="images/icon04-2.png"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h4>請直接於下方選擇欲搭配的組合內容(4入可複選)</h4>
                    </div>
                    <form action="<?php echo $_SERVER[PHP_SELF]; ?>" method="post" id="orderForm">
                        <div class="row no-collapse fr403">
                            <div class="4u" id="options">
                                <ul>
                                    <li>
                                        <select class="12u" name="slot[0]" id="id_slot0" onChange="selectionChanged()">
                                      <option value="0">--請選擇--</option>
                                      <option value="gardenia100">梔子花100g</option>
                                      <option value="rose100">玫瑰花100g</option>
                                      <option value="lavender100">薰衣草100g</option>
                                      <option value="lemongrass100">檸檬草100g</option>
                                      <option value="magnolia100">玉蘭花100g</option>
                                      <option value="cypress100">檜木100g</option>
                                      <option value="collagen100">膠原矽皂100g</option>
                                      <option value="egg100">蛋殼矽皂100g</option>
                                      <option value="pearl100">珍珠矽皂100g</option>
                                  </select>
                                    </li>
                                    <li>
                                        <select class="12u" name="slot[1]" id="id_slot1" onChange="selectionChanged()">
                                      <option value="0">--請選擇--</option>
                                      <option value="gardenia100">梔子花100g</option>
                                      <option value="rose100">玫瑰花100g</option>
                                      <option value="lavender100">薰衣草100g</option>
                                      <option value="lemongrass100">檸檬草100g</option>
                                      <option value="magnolia100">玉蘭花100g</option>
                                      <option value="cypress100">檜木100g</option>
                                      <option value="collagen100">膠原矽皂100g</option>
                                      <option value="egg100">蛋殼矽皂100g</option>
                                      <option value="pearl100">珍珠矽皂100g</option>
                                   </select>
                                    </li>
                                    <li>
                                        <select class="12u" name="slot[2]" id="id_slot2" onChange="selectionChanged()">
                                      <option value="0">--請選擇--</option>
                                      <option value="gardenia100">梔子花100g</option>
                                      <option value="rose100">玫瑰花100g</option>
                                      <option value="lavender100">薰衣草100g</option>
                                      <option value="lemongrass100">檸檬草100g</option>
                                      <option value="magnolia100">玉蘭花100g</option>
                                      <option value="cypress100">檜木100g</option>
                                      <option value="collagen100">膠原矽皂100g</option>
                                      <option value="egg100">蛋殼矽皂100g</option>
                                      <option value="pearl100">珍珠矽皂100g</option>
                                   </select>
                                    </li>
                                    <li>
                                        <select class="12u" name="slot[3]" id="id_slot3" onChange="selectionChanged()">
                                      <option value="0">--請選擇--</option>
                                      <option value="gardenia100">梔子花100g</option>
                                      <option value="rose100">玫瑰花100g</option>
                                      <option value="lavender100">薰衣草100g</option>
                                      <option value="lemongrass100">檸檬草100g</option>
                                      <option value="magnolia100">玉蘭花100g</option>
                                      <option value="cypress100">檜木100g</option>
                                      <option value="collagen100">膠原矽皂100g</option>
                                      <option value="egg100">蛋殼矽皂100g</option>
                                      <option value="pearl100">珍珠矽皂100g</option>
                                   </select>
                                    </li>
                                </ul>
                            </div>
                            <div class="6u" id="combination">
                                <div class="row">
                                    <div class="12u">
                                        <h4 class="price">小計金額(TWD)</h4>
                                        <p>NT$：<span id="id_set_total">0</span></p>
                                        <input class="7u 6u(3) button2" type="button" value="加入購物車" href="Cart.php" onClick="submitForm(event)" />
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="product" value="set_tender" />
                            <input type="hidden" name="qty" value="1" />
                        </div>
                    </form>
                    <div class="row 25% fr42 fr321" id="labeling">
                        <span>貼心提醒：由於商品當批製作，因此顏色將會有些許誤差，屬正常範圍。</span>
                        <ul>
                            <p>〔天然成分〕</p>
                            <li>NSP天然淨化因子(奈米矽片)，棕櫚油，棕仁油，椰子油，天然甘油，蓖麻油，頂級植物萃取香氛精油。</li>
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
                    <img id="productImage" class="12u" src="images/pic25-1.jpg">
                </div>
                <div class="12u fr42 fr403">
                    <ul class="fr49 item">
                        <li id="best">BEST
                        </li>
                        <li>
                            <h3>Optional -Vibrant skin set 100g</h3>
                        </li>
                    </ul>
                    <ul class="item">
                        <li>
                            <div class="lsbelSeriesW">
                                <font style="font-weight: normal;font-size:0.85em">植淬賦活</font>
                                <font style="color:brown;font-size:0.5em;font-weight:normal">set</font>
                            </div>
                        </li>
                        <li>
                            <h4>精選4入組</h4>
                        </li>
                    </ul>
                    <p>無論是
                        <font style="color:darkorange">輕洗顏</font>，還是
                        <font style="color:darkorange">逆青春駐妍保養</font>，可多重搭配的100g隨選4入組，讓肌膚健康完全不受限。能分享給朋友或愛護全家人，讓餽贈 自用 防護超精省。
                        <font style="color:brown;font-size:1.25em">超值好禮!</font>
                    </p>
                    <div class="row">
                        <div class="10u fr42">
                            <div class="row no-collapse">
                                <img class="2u" src="images/icon01.png">
                                <img class="2u" src="images/icon02-2.png">
                                <img class="2u" src="images/icon03.png">
                                <img class="2u" src="images/icon04-2.png">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="12u fr403 fr331">
                    <h3>請選擇組合內容(4入可複選)</h3>
                    <form action="<?php echo $_SERVER[PHP_SELF]; ?>" method="post" id="orderFormB">
                        <div class="row">
                            <div class="12u" id="options">
                                <ul>
                                    <li>
                                        <select class="12u" name="slot[0]" id="id_slot0B" onChange="selectionChangedB()">
                                      <option value="0">--請選擇--</option>
                                      <option value="gardenia100">梔子花100g</option>
                                      <option value="rose100">玫瑰花100g</option>
                                      <option value="lavender100">薰衣草100g</option>
                                      <option value="lemongrass100">檸檬草100g</option>
                                      <option value="magnolia100">玉蘭花100g</option>
                                      <option value="cypress100">檜木100g</option>
                                      <option value="collagen100">膠原矽皂100g</option>
                                      <option value="egg100">蛋殼矽皂100g</option>
                                      <option value="pearl100">珍珠矽皂100g</option>
                                  </select>
                                    </li>
                                    <li>
                                        <select class="12u" name="slot[1]" id="id_slot1B" onChange="selectionChangedB()">
                                      <option value="0">--請選擇--</option>
                                      <option value="gardenia100">梔子花100g</option>
                                      <option value="rose100">玫瑰花100g</option>
                                      <option value="lavender100">薰衣草100g</option>
                                      <option value="lemongrass100">檸檬草100g</option>
                                      <option value="magnolia100">玉蘭花100g</option>
                                      <option value="cypress100">檜木100g</option>
                                      <option value="collagen100">膠原矽皂100g</option>
                                      <option value="egg100">蛋殼矽皂100g</option>
                                      <option value="pearl100">珍珠矽皂100g</option>
                                   </select>
                                    </li>
                                    <li>
                                        <select class="12u" name="slot[2]" id="id_slot2B" onChange="selectionChangedB()">
                                      <option value="0">--請選擇--</option>
                                      <option value="gardenia100">梔子花100g</option>
                                      <option value="rose100">玫瑰花100g</option>
                                      <option value="lavender100">薰衣草100g</option>
                                      <option value="lemongrass100">檸檬草100g</option>
                                      <option value="magnolia100">玉蘭花100g</option>
                                      <option value="cypress100">檜木100g</option>
                                      <option value="collagen100">膠原矽皂100g</option>
                                      <option value="egg100">蛋殼矽皂100g</option>
                                      <option value="pearl100">珍珠矽皂100g</option>
                                   </select>
                                    </li>
                                    <li>
                                        <select class="12u" name="slot[3]" id="id_slot3B" onChange="selectionChangedB()">
                                      <option value="0">--請選擇--</option>
                                      <option value="gardenia100">梔子花100g</option>
                                      <option value="rose100">玫瑰花100g</option>
                                      <option value="lavender100">薰衣草100g</option>
                                      <option value="lemongrass100">檸檬草100g</option>
                                      <option value="magnolia100">玉蘭花100g</option>
                                      <option value="cypress100">檜木100g</option>
                                      <option value="collagen100">膠原矽皂100g</option>
                                      <option value="egg100">蛋殼矽皂100g</option>
                                      <option value="pearl100">珍珠矽皂100g</option>
                                   </select>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row" id="combination">
                            <div class="12u">
                                <p class="price">小計金額　TWD NT$ <span id="id_set_totalB">0</span></p>
                                <input class="4u 6u(3) button2" type="button" value="加入購物車" href="Cart.php" onClick="submitFormB(event)" />
                            </div>
                            <p class="oder4price">貼心提醒：由於商品每批限量製作，因此顏色將會有些許誤差，為正常範圍。</p>
                        </div>
                        <input type="hidden" name="product" value="set_tender" />
                        <input type="hidden" name="qty" value="1" />
                    </form>
                </div>
                <div class="12u">
                    <div class="row" id="labeling">
                        <h3>商品相關介紹</h3>
                        <div class="12u fr42">
                            <p>〔天然成分〕</p>
                            <span>NSP天然淨化因子(奈米矽片)，棕櫚油，棕仁油，椰子油，天然甘油，蓖麻油，頂級植物萃取香氛精油。</span>
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
            <img class="12u" src="images/NEW(EX)7(96).jpg">
            <img class="12u" src="images/NEW(EX)7-2(96).jpg">
            <img class="12u" src="images/NEW(EX)1-2(96).jpg">
            <img class="12u" src="images/NEW(EX)1-3(96).jpg">
            <img class="12u" src="images/NEW(EX)1-4(96).jpg">
            <img class="12u" src="images/NEW(EX)1-5(96).jpg">
            <img class="12u" src="images/NEW(EX)6(96).jpg">
            <img class="12u" src="images/NEW(EX)3-2(96).jpg">
            <img class="12u" src="images/NEW(EX)4-2(96).jpg">
            <img class="12u" src="images/NEW(EX)5-2(96).jpg">
            <img class="12u" src="images/NEW(EX)1-6(96).jpg">
            <img class="12u" src="images/NEW(EX)1-7(96).jpg">
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
