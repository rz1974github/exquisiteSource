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
		
		var	selectionChanged=function()
		{
			var sum=0;
			var oSlot0=document.getElementById("id_slot0");
			if(oSlot0.value!="0")
			{
				sum+=getPrice(oSlot0.value);
			}//if
			var oSlot1=document.getElementById("id_slot1");
			if(oSlot1.value!="0")
			{
				sum+=getPrice(oSlot1.value);
			}//if
			var oSlot2=document.getElementById("id_slot2");
			if(oSlot2.value!="0")
			{
				sum+=getPrice(oSlot2.value);
			}//if
			var oSlot3=document.getElementById("id_slot3");
			if(oSlot3.value!="0")
			{
				sum+=getPrice(oSlot3.value);
			}//if
			var oSlot4=document.getElementById("id_slot4");
			if(oSlot4.value!="0")
			{
				sum+=getPrice(oSlot4.value);
			}//if
			
			var oTotal=document.getElementById("id_set_total");
			oTotal.innerHTML = sum;
		}
		
		var submitForm=function(event)
		{
			event.preventDefault();
			
			var oForm=document.getElementById("orderForm");
			var oSlot0=document.getElementById("id_slot0");
			if(oSlot0.value=="0")
			{
				alert("請選擇第一項商品");
				return;
			}//if
			var oSlot1=document.getElementById("id_slot1");
			if(oSlot1.value=="0")
			{
				alert("請選擇第二項商品");
				return;
			}//if
			var oSlot2=document.getElementById("id_slot2");
			if(oSlot2.value=="0")
			{
				alert("請選擇第三項商品");
				return;
			}//if
			var oSlot3=document.getElementById("id_slot3");
			if(oSlot3.value=="0")
			{
				alert("請選擇第四項商品");
				return;
			}//if
			var oSlot4=document.getElementById("id_slot4");
			if(oSlot4.value=="0")
			{
				alert("請選擇第五項商品");
				return;
			}//if
			
			oForm.submit();
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
				
				add_member_option("","gifts_25g.php");
				
                ?>
                <!--li id="viewportSize"><script>currentWidth();</script></li-->
			</ul>
		</nav>
	<!-- Home -->
		<div class="wrapper style5">
	      <article class="content container 75%">
				 <div class="row">
					<div class="4u 6u(2) 12u(3)"><img id="productImage" class="12u 6u(3)" src="images/PIC00-10-3.png"></div>
					<div class="8u 10u(2) 12u(3)">
                       <div class="row fr42">
                          <div class="2u"><img class="8u 4u(2) 2u(3)" src="images/BEST.png"></div>
                       </div>
                       <div class="row 25% fr42">
                          <ul class="12u item">
                                <li><h3>Optional -</h3></li>
                                <li><h3>Vibrant skin set 25g</h3></li>
                          </ul>
                          <ul class="12u item">
                                <li><h4>超彈潤 植淬賦活組</h4><li>
                                <li><h4>[ 任選系列 ]</h4><li>
                          </ul>
                          <div class="12u item"><p>以低彩度顏色的設計概念，表達即使無在臉上妝點太多也能擁有發亮似的質感肌膚。適合喜歡多樣體驗的選擇，更可揪好友多樣合併選購，讓每日溫柔的呵護能健康、輕透、水嫩完全兼顧。</div>
                       </div>
                       <div class="row 25% fr403">
                          <div class="7u 4u(3)">
                             <div class="row no-collapse">
                                <div class="3u"><img class="12u 10u(3)" src="images/icon01.png"></div>
                                <div class="3u"><img class="12u 10u(3)" src="images/icon02-2.png"></div>
                                <div class="3u"><img class="12u 10u(3)" src="images/icon03.png"></div>
                                <div class="3u"><img class="12u 10u(3)" src="images/icon04-2.png"></div>
                             </div>
                          </div>
                       </div>
                       <div class="row 50%">
                          <span>請直接於下方選單選擇欲搭配的組合內容(可複選)</span>
                       </div>
                       <form action="<?php echo $_SERVER[PHP_SELF]; ?>" method="post" id="orderForm">
                       <div class="row 25% no-collapse fr403">
                          <div class="4u" id="options">
                             <ul>
                                <li>
                                   <select class="12u" name="slot[0]" id="id_slot0" onChange="selectionChanged()">
                                      <option value="0">--請選擇--</option>
                                      <option value="gardenia25">梔子花25g</option>
                                      <option value="rose25">玫瑰花25g</option>
                                      <option value="lemongrass25">檸檬草25g</option>
                                      <option value="cypress25">檜木25g</option>
                                      <option value="collagen25">膠原矽皂25g</option>
                                      <option value="egg25">蛋殼矽皂25g</option>
                                      <option value="pearl25">珍珠矽皂25g</option>
                                  </select>
                                </li>
                                <li>
                                   <select class="12u" name="slot[1]" id="id_slot1" onChange="selectionChanged()">
                                      <option value="0">--請選擇--</option>
                                      <option value="gardenia25">梔子花25g</option>
                                      <option value="rose25">玫瑰花25g</option>
                                      <option value="lemongrass25">檸檬草25g</option>
                                      <option value="cypress25">檜木25g</option>
                                      <option value="collagen25">膠原矽皂25g</option>
                                      <option value="egg25">蛋殼矽皂25g</option>
                                      <option value="pearl25">珍珠矽皂25g</option>
                                   </select>
                                </li>
                                <li>
                                   <select class="12u" name="slot[2]" id="id_slot2" onChange="selectionChanged()">
                                      <option value="0">--請選擇--</option>
                                      <option value="gardenia25">梔子花25g</option>
                                      <option value="rose25">玫瑰花25g</option>
                                      <option value="lemongrass25">檸檬草25g</option>
                                      <option value="cypress25">檜木25g</option>
                                      <option value="collagen25">膠原矽皂25g</option>
                                      <option value="egg25">蛋殼矽皂25g</option>
                                      <option value="pearl25">珍珠矽皂25g</option>
                                   </select>
                                </li>
                                <li>
                                   <select class="12u" name="slot[3]" id="id_slot3" onChange="selectionChanged()">
                                      <option value="0">--請選擇--</option>
                                      <option value="gardenia25">梔子花25g</option>
                                      <option value="rose25">玫瑰花25g</option>
                                      <option value="lemongrass25">檸檬草25g</option>
                                      <option value="cypress25">檜木25g</option>
                                      <option value="collagen25">膠原矽皂25g</option>
                                      <option value="egg25">蛋殼矽皂25g</option>
                                      <option value="pearl25">珍珠矽皂25g</option>
                                   </select>
                                </li>
                                <li>
                                   <select class="12u" name="slot[4]" id="id_slot4" onChange="selectionChanged()">
                                      <option value="0">--請選擇--</option>
                                      <option value="gardenia25">梔子花25g</option>
                                      <option value="rose25">玫瑰花25g</option>
                                      <option value="lemongrass25">檸檬草25g</option>
                                      <option value="cypress25">檜木25g</option>
                                      <option value="collagen25">膠原矽皂25g</option>
                                      <option value="egg25">蛋殼矽皂25g</option>
                                      <option value="pearl25">珍珠矽皂25g</option>
                                   </select>
                                </li>
                             </ul>
                          </div>
                          <div class="6u" id="combination">
                                <div class="price">小計金額　TWD NT$ <span id="id_set_total">0</span></div>
                                   <a href="Cart.php" onClick="submitForm(event)" class="button2">加入購物車</a>
                          </div>
                          
                       <input type="hidden" name="product" value="set_candy" />
                       <input type="hidden" name="qty" value="1" />
                       
                       </form>
                       </div>
                       
                       <div class="row 25% fr42 fr321" id="labeling">
                      <span>貼心提醒：由於商品每批限量製作，因此顏色將會有些許誤差，屬正常範圍。</span>
                         <ul><p>〔天然成分〕</p>
                            <li>NSP天然淨化因子(奈米矽片)，棕櫚油，棕仁油，椰子油，天然產生之甘油，蓖麻油，頂級植物萃取香氛精油。</li>
                         </ul>
                         <ul><p>〔使用方法〕</p>
                            <li>1.沾水將其在手上搓揉後產生極細緻奶油般泡沫。</li>
                            <li>2.敷於肌膚上，並輕揉按摩易出油或T字部位(物理吸附力自動產生作用)。</li>
                            <li>3.用清水將泡沫沖淨，毛孔即溫柔洗淨。</li>
                         </ul>
                         <ul><p>〔適用肌膚〕</p>
                            <li>本產品為天然成份及特殊自然物理吸附力作用，不限膚質皆可使用。</li>
                            <li>較敏感者在初次使用可感受到稍為的吸附感(非皮膚刺激)。</li>
                         </ul>
                          </div>
                         
                      </div> 
                   </div>
                <div class="row">
            <div class="12u fr37 fr42 fr100 fr403">Made in Taiwan</div>
            　</div>
          </article>
       </div>
       <div class="wrapper style6">
	      <article class="content container">
                      <header>
                        <h1>Product details</h1>
                        <h3>商品詳細介紹</h3>
                      </header>
               <img class="12u" src="images/NEW(EX)8(96).jpg">
               <img class="12u" src="images/NEW(EX)8-2(96).jpg">
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
		
		include_once("part_Footer.php");
		
		echo $footerSec;
		
		?> 
	</body>
</html>