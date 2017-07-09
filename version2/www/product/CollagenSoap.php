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
	<title>EXQUISITE 膠原矽皂</title>
	
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
				case "collagen100":
				oImage.src = "images/PIC00-7.png";
				break;
				case "collagen25":
				oImage.src = "images/PIC00-7-3.png";
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
				
				add_member_option("","CollagenSoap.php");
				
                ?>
			</ul>
		</nav>
	<!-- Home -->
		<div class="wrapper style5">
	      <article class="content container 75%">
		     <div class="row">
			    <div class="4u 6u(2) 12u(3)"><img id="productImage"  class="12u 6u(3)" src="images/PIC00-7.png"></div>
				<div class="8u 10u(2) 12u(3)">
                   <div class="row fr42">
                      <div class="2u"><img class="8u 4u(2) 2u(3)" src="images/BEST.png"></div>
                   </div>
                   <div class="row 25% fr42">
                      <ul class="12u item">
                         <li><h3>Nano Soap -</h3></li>
                         <li><h3>Collagen 100g / 25g</h3></li>
                      </ul>
                      <ul class="12u item">
                            <li><h4>膠原矽皂</h4></li>
                            <li><h4>[ 逆青春駐顏保養系列 ]</h4></li>
                      </ul>
                      <div class="12u item"><p>由高分子技術萃取魚鱗中(胜肽級)膠原蛋白，並採用純天然植物油脂，形成完美配方，連敏感性膚質也適用。<br>
用敷的就能深層清潔的神奇力量，極細緻泡沫讓清潔與吸收一次完成，體驗真正清潔又完全不緊繃的極致感受。</p></div>
                   </div>
                   <div class="row 25% fr403">
                      <div class="7u 4u(3)">
                         <div class="row no-collapse">
                            <div class="3u"><img class="12u 10u(3)" src="images/icon01.png"></div>
                            <div class="3u"><img class="12u 10u(3)" src="images/icon02-2.png"></div>
                            <div class="3u"><img class="12u 10u(3)" src="images/icon03.png"></div>
                            <div class="3u"><img class="12u 10u(3)" src="images/ICON5-Collagen (Element).png"></div>
                         </div>
                      </div>
                   </div>
                   <div class="row 50%">
                       <span class="price">售價　TWD NT$ 350 / $ 105</span>
                   </div>
                   <form action="<?php echo $_SERVER[PHP_SELF]; ?>" method="post" id="orderForm">
                   <div class="row 25%">
                      <div class="8u"><span>請選擇種類</span>
						 <div class="row 25% no-collapse">
                            <div class="2u"><label><img class="12u" src="images/ICON Collagen100g 200x250.png"><br>
                               <input type="radio" name="product" value="collagen100" onChange="selectionChanged()"
                               <?php echo (!isset($_POST['product']))||($_POST['product']=="collagen100")? "checked":""; ?> ></label>
                            </div>
                            <div class="2u"><label><img class="12u" src="images/ICON Collagen25g 200x250.png"><br>
                               <input type="radio" name="product" value="collagen25" onChange="selectionChanged()"
                               <?php echo ($_POST['product']=="collagen25")? "checked":""; ?> ></label>
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
                               <a href="Cart.php" onClick="submitForm(event)"><div class="button2">加入購物車</div></a>
                            </div>
                   </div><!-- row 25% no-collapse-->
				   </form>
                   <div class="row 25% fr42 fr321" id="labeling">
                      <span>貼心提醒：由於商品每批限量製作，因此顏色將會有些許誤差，屬正常範圍。</span>
                         <ul><p>〔天然成分〕</p>
                            <li>NSP天然淨化因子(奈米矽片)，棕櫚油，棕仁油，椰子油，天然產生之甘油，蓖麻油，高分子魚鱗膠原蛋白萃取。</li>
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
                <div class="12u"><img class="12u" src="images/NEW(EX)3(96).jpg"></div>
                <div class="12u"><img class="12u" src="images/NEW(EX)6(96).jpg"></div>
                <div class="12u"><img class="12u" src="images/NEW(EX)3-2(96).jpg"></div>
                <div class="12u"><img class="12u" src="images/NEW(EX)1-2(96).jpg"></div>
                <div class="12u"><img class="12u" src="images/NEW(EX)1-3(96).jpg"></div>
                <div class="12u"><img class="12u" src="images/NEW(EX)1-4(96).jpg"></div>
                <div class="12u"><img class="12u" src="images/NEW(EX)1-5(96).jpg"></div>
                <div class="12u"><img class="12u" src="images/NEW(EX)1-6(96).jpg"></div>
                <div class="12u"><img class="12u" src="images/NEW(EX)1-7(96).jpg"></div>
          </article>
       </div>
        <?
		
		include_once("part_Footer.php");
		
		echo $footerSec;
		
		?>       
	</body>
</html>