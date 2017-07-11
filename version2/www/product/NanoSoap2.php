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
	<title>EXQUISITE 奈米矽皂</title>
	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/init.js"></script>
        <script>
		
		var submitForm=function(event)
		{
			event.preventDefault();
			
			var oForm=document.getElementById("orderForm");
			var oQty=document.getElementById("qty");
			var oSelect=oForm.elements["product"];
			
			if(qty.value==0)
			{
				alert("請選擇購買數量!");
			}
			else
			{
				if(!oSelect.value)
				{
					alert("請先選擇種類!");
				}
				oForm.submit();
			}			
		}
		var selectionChanged=function()
		{
			var oForm=document.getElementById("orderForm");
			var oSelect=oForm.elements["product"];
			var oImage = document.getElementById("productImage");
			switch(oSelect.value)
			{
				case "gardenia25":
				oImage.src = "images/PIC00-1-3.png";
				break;
				case "rose25":
				oImage.src = "images/PIC00-2-3.png";
				break;
				/*case "lavender25":
				oImage.src = "images/PIC00-3.png";
				break;*/
				case "lemongrass25":
				oImage.src = "images/PIC00-4-3.png";
				break;
				/*case "magnolia25":
				oImage.src = "images/PIC00-5.png";
				break;*/
				case "cypress25":
				oImage.src = "images/PIC00-6-3.png";
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
				
				add_member_option("","NanoSoap2.php");
				
                ?>
			</ul>
		</nav>
	<!-- Home -->
		<div class="wrapper style5">
	      <article class="content container 75%">
		     <div class="row">
					<div class="4u 6u(2) 12u(3)">
                       <img id="productImage" class="12u" src="images/25-1-1 326x326.png"></div>
					<div class="8u 10u(2) 12u(3)">
                       <div class="row fr42">
                          <div class="2u"><img class="8u 4u(2) 2u(3)" src="images/BEST.png"></div>
                       </div>
                       <div class="row 25% fr42">
                      <ul class="12u item">
                         <li><h3>Nano Soap -</h3></li>
                         <li><h3>Natural essential oils 25g</h3></li>
                      </ul>
                      <ul class="12u item">
                         <li><h4>奈米矽皂-天然精油系列</h4></li>
                         <li><h4>[ 基礎輕洗顏 ]</h4></li>
                      </ul>
                      <div class="12u item"><p>以輕洗顏的方式，強調輕柔呵護肌膚的重要性。並以最新科技達到用敷的來深層清潔的神奇力量，重現肌膚會呼吸的柔細與光澤。</p></div>
                       </div>
                       <div class="row 25% fr403">
                      <div class="7u 4u(7)">
                             <div class="row no-collapse">
                                <div class="3u"><img class="12u 10u(3)" src="images/icon01.png"></div>
                                <div class="3u"><img class="12u 10u(3)" src="images/icon02-2.png"></div>
                                <div class="3u"><img class="12u 10u(3)" src="images/icon03.png"></div>
                                <div class="3u"><img class="12u 10u(3)" src="images/icon04.png"></div>
                             </div>
                          </div>
                       </div>
                   <div class="row 50%">
                          <span class="price">售價　TWD NT$ 80</span>
                       </div>
                       <form action="<?php echo $_SERVER[PHP_SELF]; ?>" method="post" id="orderForm">
                       <div class="row 25%">
					  <div class="8u"><span>請選擇香氛</span>
                             <div class="row 25% no-collapse">
                                <div class="2u"><label><img class="12u" src="images/icon05.png"><br>
                                   <input type="radio" name="product" value="gardenia25" onChange="selectionChanged()"
                                   <?php echo (!isset($_POST['product']))||($_POST['product']=="gardenia25")? "checked":""; ?> ></label>
                                </div>
                                <div class="2u"><label><img class="12u" src="images/icon06.png"><br>
                                   <input type="radio" name="product" value="rose25" onChange="selectionChanged()"
                                   <?php echo ($_POST['product']=="rose25")? "checked":""; ?> ></label>
                                </div>
                                <!--div class="2u"><img class="12u" src="images/icon07.png"><br>
                                   <input type="radio" name="order_type" value="">
                                </div-->
                                <div class="2u"><label><img class="12u" src="images/icon09.png"><br>
                                   <input type="radio" name="product" value="lemongrass25" onChange="selectionChanged()"
                                   <?php echo ($_POST['product']=="lemongrass25")? "checked":""; ?> ></label>
                                </div>
                                <!--div class="2u"><img class="12u" src="images/icon10.png"><br>
                                   <input type="radio" name="order_type" value="">
                                </div-->
                                <div class="2u"><label><img class="12u" src="images/icon11.png"><br>
                                   <input type="radio" name="product" value="cypress25" onChange="selectionChanged()"
                                   <?php echo ($_POST['product']=="cypress25")? "checked":""; ?> ></label>
                                </div>
                             </div>
                          </div>
				   </div> <!-- row 25%-->				   
                       <div class="row 25% no-collapse fr330 fr403">
                          <div class="4u 6u(2) 6u(3)">
								<select class="12u" name="qty" id="qty">
                                   <option value="0">請選擇數量</option>
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
                          <div class="4u 6u(3)">
                                   <a href="Cart.php" onClick="submitForm(event)"><div class="bgcolor03">加入購物車</div></a>
                                </div>
                       </div><!-- row 25% no-collapse-->
                       </form>
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
                <img class="12u" src="images/NEW(EX)1-1(96).jpg">
                <img class="12u" src="images/NEW(EX)1-2(96).jpg">
                <img class="12u" src="images/NEW(EX)1-3(96).jpg">
                <img class="12u" src="images/NEW(EX)1-4(96).jpg">
                <img class="12u" src="images/NEW(EX)1-5(96).jpg">
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