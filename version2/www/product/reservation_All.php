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
	<title>EXQUISITE 當批預約</title>
	
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
		
		/*var selectionChanged=function()
		{
			var oForm=document.getElementById("orderForm");
			var oSelect=oForm.elements["product"];
			var oImage = document.getElementById("productImage");
			switch(oSelect.value)
			{
				case "gardenia100":
				oImage.src = "images/PIC00-1.png";
				break;
				case "rose100":
				oImage.src = "images/PIC00-2.png";
				break;
				case "lavender100":
				oImage.src = "images/PIC00-3.png";
				break;
				case "lemongrass100":
				oImage.src = "images/PIC00-4.png";
				break;
				case "magnolia100":
				oImage.src = "images/PIC00-5.png";
				break;
				case "cypress100":
				oImage.src = "images/PIC00-6.png";
				break;
			}

		}*/
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
				<li><h3><a href="../index.php">EXQUISITE</a></h3></li>
				<li><a href="Cart.php">我的購物車<?php echo ($_SESSION['total_count']>0) ?  "(".$_SESSION['total_count'].")" : ""; ?></a></li>
                <?php 							
				
				include("member_common.php");
				
				add_member_option("","NanoSoap1.php");
				
                ?>
			</ul>
		</nav>
	<!-- Home -->
		<div class="wrapper">
           <!--<div class="12u"><img class="12u" src="images/alltitle01.jpg">-->
			<article class="container">
				<div class="row">
                   <div class="12u"><img class="12u" src="images/003-3.jpg"></div>
				</div>
             </div>   
			</article>
            <!--</div>-->
		</div>
	<!-- Work -->
        <section class="wrapper introduction">
           <article class="container 75%">
              <div class="12u">
                 <div class="row">
                    <div class="12u">
                       <div class="row">
                          <div class="12u baseline01">
                             <div class="row 0%">
                                <div class="12u"><h3>限時排程預約訂購[會員獨享]</h3></div>
                             </div>
                          </div>
                             
                       </div>
                    </div>
                    <div class="12u fr42">在標準製程中，每一批從原料篩選到測試檢驗，皆經過嚴格控管。且經當批原物料採樣調整配方後才經由生產部門進行生產，原先在這個過程中經常以大量出單為優先考量，並採安全庫存機制進行製造，在維護廣大愛用者的需求下，將每批生產的數量調整為1/3來開放會員預約訂購，讓該批生產的產品更能貼近使用者。</div>
                    <div class="12u fr42">[DAY60]生產製程(約莫60天)<br>除了當批採購的原物料嚴格篩選外，歷經幾個重要的部驟：<br>1.調整最適配方進行原物料預作攪拌視其完整融合=>2.注入專用模具關注變化靜置準熟成=>3.模組給壓緊實(增加透明度及扎實度)=>4.脫模自然乾燥至全熟成=>5.檢驗擦拭包裝 全程超過60天的完工製程。</div>
                 </div>
              </div>
           </article>
        </section>
		<div class="wrapper product01">
			<article class="container 75%">
				<header>
					<h2>Reservation / 預約</h2>
					<!--<p>從嚴選天然原料與潔淨因子-NSP<br>
				    從最佳配方的形成到完美手工製作完成　都是用心的成果</p>-->
				</header>
             </article>                   
					<div class="container 75%">
						<div class="row no-collapse">
							<div class="4u 6u(2) 12u(3)">
								<section class="productbox">
                                    <div class="row">
                                       <div class="12u"><img class="12u 10u(2) 8u(3) 6u(4) 4u(5)" src="images/Lemongrass01.jpg">
                                          <div class="row 0% fr42 fr45">
                                             <div class="12u">[製程排定]2015/2/18~2015/4/21</div>                                             
                                             <div class="12u shinako">檸檬草 100g</div>
                                             <div class="12u">TWD NT$ 280*9折[會員獨享]</div>
                                          </div>
                                          <form action="<?php echo $_SERVER[PHP_SELF]; ?>" method="post" id="orderForm">
                                          <div class="row 25%">
                                             <div class="12u">
                                                <div class="row no-collapse">
                                                   <div class="5u 6u(3)">
                                                         <select class="12u" name="gty" form="gty">
                                                            <option value="0">數量</option>
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
                                                   <div class="7u 6u(3)">
                                                      <div class="row">
                                                         <div class="12u fr43">
                                                            <a href="Cart.php" onClick="submitForm(event)">
                                                               <div class="bgcolor03">加入預約清單</div>
                                                            </a>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                </section>
                            </div>
							<div class="4u 6u(2) 12u(3)">
								<section class="productbox">
                                   <div class="row">
                                      <div class="12u"><img class="12u 10u(2) 8u(3) 6u(4) 4u(5)" src="images/Lavender02.jpg">
                                            <div class="row 0% fr42 fr45">
                                               <div class="12u">[製程排定]2015/2/22~2015/4/29</div>
                                               <div class="12u shinako">薰衣草 100g</div>
                                               <div class="12u">TWD NT$ 280*9折[會員獨享]</div>
                                            </div>
                                            <div class="row 25%">
                                             <div class="12u">
                                                <div class="row no-collapse">
                                                   <div class="5u 6u(3)">
                                                         <select class="12u" name="gty" form="gty">
                                                            <option value="0">數量</option>
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
                                                   <div class="7u 6u(3)">
                                                      <div class="row">
                                                         <div class="12u fr43">
                                                            <a href="Cart.php" onClick="submitForm(event)">
                                                               <div class="bgcolor03">加入預約清單</div>
                                                            </a>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          </form>
                                      </div>
                                   </div>
								</section>
							</div>
                            <div class="4u 6u(2) 12u(3)">
								<section class="productbox">
                                    <div class="row">
                                       <div class="12u"><img class="12u 10u(2) 8u(3) 6u(4) 4u(5)" src="images/Gardenia01.jpg">
                                             <div class="row 0% fr42 fr45">
                                                <div class="12u">[製程排定]2015/3/9~2015/5/13</div>                                             
                                                <div class="12u shinako">梔子花 100g</div>
                                                <div class="12u">TWD NT$ 280*9折[會員獨享]</div>
                                             </div>
                                             <div class="row 25%">
                                             <div class="12u">
                                                <div class="row no-collapse">
                                                   <div class="5u 6u(3)">
                                                         <select class="12u" name="qty" form="qty">
                                                            <option value="0">數量</option>
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
                                                   <div class="7u 6u(3)">
                                                      <div class="row">
                                                         <div class="12u fr43">
                                                            <a href="Cart.php" onClick="submitForm(event)">
                                                               <div class="bgcolor03">加入預約清單</div>
                                                            </a>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                </section>
                            </div>
                           </div> 
						</div>
                        </section>
                        </div>
                        <div class="warpper underneath">
                           <article class="container 75%">
                              <div class="12u">
                                 <div class="row test">
                                    <div class="12u">
                                       <div class="row baseline01">
                                          <div class="12u">
                                             <div class="row">
                                                <div class="12u fr42">
                                                   <a href="#"><img class="5u 8u(2) 12u(3)" src="images/email-1.png"></a>
                                                </div>
                                             </div>
                                          </div>
                                          
                                       </div>
                                    </div>
                                    <div class="12u">
                                       <div class="row no-collapse">
                                          <div class="3u">
                                             <div class="row 0%">
                                                <div class="12u">
                                                   <a target="_blank" href="Terms.html"><img class="7u 10u(2) 12u(3)" src="images/terms.png"></a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="3u">
                                             <div class="row 0%">
                                                <div class="12u">
                                                   <a target="_blank" href="Shopping_Notes.html"><img class="7u 10u(2) 12u(3)" src="images/shopping.png"></a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="3u">
                                             <div class="row 0%">
                                                <div class="12u">
                                                   <a target="_blank" href="Privacy.html"><img class="7u 10u(2) 12u(3)" src="images/privacy.png"></a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="3u">
                                             <div class="row 0%">
                                                <div class="12u">
                                                   <a target="_blank" href="Disclaimer.html"><img class="7u 10u(2) 12u(3)" src="images/disclaimer.png"></a>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </article>
                        </div>
                                       
					
	<!-- Contact -->
		<div class="wrapper style4">
			<article id="contact" class="container 75%">
               <!--<div>
			      <h3>EXQUISITE　精雕細琢</h3>
               </div>-->
                  <div class="row">
                     <div class="12u">
                        <div class="row">
                           <div class="12u fr31">元基生技企業有限公司</div>
                           <div class="12u">
                              <div class="row">
                                 <div class="6u">
                                    <div class="row">
                                       <div class="12u"><img class="10u" src="images/iconC-6.png"></div>
                                    </div>
                                 </div>
                                 <div class="6u">
                                    <div class="row">
                                       <div class="12u"><img class="10u" src="images/iconC-7.png"></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="12u">
                              <div class="row">
                                 <div class="6u">
                                    <div class="row">
                                       <div class="12u">
                                          <a href="#"><img class="6u 6u(2) 8u(3)" src="images/iconC-8.png"></a>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="6u">
                                    <div class="row">
                                       <div class="12u">
                                          <a href="#"><img class="6u 6u(2) 8u(3)" src="images/iconC-9.png"></a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                       </div>
                    </div>
                 </div>
				<footer>
					<ul id="copyright">
						<li>COPYRIGHT &copy; 2014 All rights reserved.</li>
                        <li>Design:Exquisite Design Cooperation.</li>
					</ul>
				</footer>
			</article>
		</div>
	</body>
</html>