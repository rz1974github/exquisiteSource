<!DOCTYPE HTML>
<!--
	Miniport by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>購物車清單</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
        <script type="text/javascript">
			var parameterChanged=function()
			{
				var oTotal=document.getElementById("id_total");
				
				//折扣
				var oOrderDiscount=document.getElementById("id_order_discount");				
				if(oOrderDiscount!=null)
				{
					js_orderDiscount=oOrderDiscount.value;
				}
				
				//點數
				var js_discountMerchant=Math.round(js_merchantTotal*js_orderDiscount);
				oRemainPoint=document.getElementById("id_remain");
				if(js_userLogged)
				{
					if(js_isDealer)
					{
						oPoint=document.getElementById("id_pointsToUse_input");
						js_pointsToUse=oPoint.value;
						var js_maxValue = Math.min(Math.min(js_discountMerchant,js_member_points),var_jsMaxPointsToUse);
						oPoint.setAttribute('maxvalue',js_maxValue);
					}
					else
					{
							js_pointsToUse = Math.min(Math.min(js_discountMerchant,js_member_points),var_jsMaxPointsToUse);
							oPoint=document.getElementById("id_pointsToUse");
							if(oPoint!=null)
							{
								oPoint.innerHTML = js_pointsToUse;
							}
					}
					js_remainPoint = js_member_points-js_pointsToUse;
					oRemainPoint.innerHTML =js_remainPoint;
				}				
				
				//折扣後金額
				js_discountMerchant-=js_pointsToUse;
				var oDiscountMerchant = document.getElementById("id_discount_merchant");
				if(oDiscountMerchant!=null)
				{
					oDiscountMerchant.innerHTML = "NT$ "+js_discountMerchant+"元";
				}
				
				//運費改變
				if(js_discountMerchant>=js_noFeeAmount)
				{
					js_shippingFee=0;
				}
				else
				{
					js_shippingFee=js_basicShipping;
				}
				var oShipping=document.getElementById("id_shippingFee");
				oShipping.innerHTML="NT$ "+js_shippingFee+"元";
				
				//總數
				var js_total = js_discountMerchant+js_shippingFee;
				oTotal.innerHTML =  "NT$ "+js_total+"元";
			}

			var cartNext=function(event,nextFile,checkLogIn)
			{
				event.preventDefault();
				var oForm = document.createElement("form");
				oForm.setAttribute("method","post");
				oForm.setAttribute("action","Cart-Next.php");
				var params=[];
				
				//點數
				oPoint=document.getElementById("id_pointToUse");
				if(oPoint!=null)
				{
					js_pointsToUse=oPoint.value;
				}
				params["js_pointsToUse"]=js_pointsToUse;
				
				oDiscount=document.getElementById("id_order_discount");
				if(oDiscount!=null)
				{
					js_orderDiscount = oDiscount.value;
				}
				params["js_orderDiscount"]=js_orderDiscount;
				
				params["nextFile"]=nextFile;
				params["checkLogIn"]=checkLogIn;
				
				for(var key in params)
				{
					var hiddenField = document.createElement("input");
					hiddenField.setAttribute("type","hidden");
					hiddenField.setAttribute("name",key);
					hiddenField.setAttribute("value",params[key]);
					oForm.appendChild(hiddenField);
				}//for
				
				document.body.appendChild(oForm);
				oForm.submit();
			}
		</script>

        		
		<?php

		include_once("../global.php");
		include('orderSerial.php');
		
		session_start();
		
		include_once("member_common.php");
		
		include("../common/sharedCode.php");
		?> 

</head>

<body onload="parameterChanged()">

		<!-- Nav -->
			<nav id="nav">
               	<ul class="container">
                    <li><a href="../index.php">EXQUISITE</a></li>
                    
					<li><a href="#">我的購物車
					<?php echo ($_SESSION['total_count']>0) ?  "(".$_SESSION['total_count'].")" : ""; ?>
					</a>
					</li>
					<?php
					
					add_member_option("","Cart.php");

					?>                    
				</ul>
               
			</nav>
			<!-- Home -->
			<div class="wrapper cart">
			    <article class="content container 75%">
                   <div class="12u">
                      <div class="row 0%">
                         <div class="12u">
                            <div class="cartbg08"><span class="cartpad">購物車清單</span></div>
                            <div class="row">
                               <div class="12u cartpad">購物車清單</div>
                            </div>
                         </div>
                      </div>
                      
        <?php
			$merchantTotal=0;
			$setIndex=0;
			
			function iterateSet($detailName)
			{
				global $productName,$productPrice;
				$setCount=count($_SESSION[$detailName]);
				for($b=0;$b<$setCount;$b++)
				{
					$count = count($_SESSION[$detailName][$b]);
					$c=$b+1;
					if($setCount>1)
					{
						$setName="第{$c}組";
					}
					else
					{
						$setName="內容";
					}
$setHeader=<<<SET_HEADER
														
														<div class='12u'>
														   <div class='12u fr42'>{$setName}</div>
														</div><!-- 12u -->
													
												     														

SET_HEADER;

					echo $setHeader;
					$setTotal=0;
					$countInSet=count($_SESSION[$detailName][$b]);
					$counter=1;
					$oddItem="";
					$evenItem="";
					foreach($_SESSION[$detailName][$b] as $setItem=>$count)
					{
						$currentItem=$productName[$setItem]." x ".$count;
						if($counter%2==1) 
						{
							$oddItem=$currentItem;
						}
						else
						{
							$evenItem=$currentItem;
						}
						$setTotal+=$productPrice[$setItem]*$count;
$itemDetail=<<<ITEM_DETAIL
														
													   <div class='12u'>
													      <div class='row 0% no-collapse'>
													         <div class='2u fr42'>　</div>
															    <div class='10u fr42 pjtcolor02'>
															       <div class='row 0% no-collapse'>
																     <div class='6u'>{$oddItem}</div>
																	 <div class='6u'>{$evenItem}</div>
															      </div>
															   </div>
															</div><!-- row -->
														</div><!-- 12u -->

ITEM_DETAIL;
						if(($counter%2==0) || ($counter==$countInSet))
						{
							echo $itemDetail;
							$oddItem="";
							$evenItem="";
						}
						$counter++;
					}//for a
					$smallPrice+=$setTotal;
				}//for b
				return $smallPrice;
			}
			
			//列出所有商品
			foreach($productList as $item)
			{
				if(!isset($_SESSION[$item])) 	$_SESSION[$item]=0;			
				$thisCount=$_SESSION[$item];
				$price=$productPrice[$item];
				$category=$productCategory[$item];
				if($thisCount>0)
				{
					$smallPrice=$price * $thisCount;
					$merchantTotal+=$smallPrice;
					//前
					echo "
					<!-- Unit -->
					<div class='row'>
						<div class='12u'>
							<div class='row 0%'>
								<div class='12u cartbox'>
									<div class='row 0%'>
										<div class='12u cartpad02'>
											<div class='row no-collapse'>
												<div class='4u 6u(2) 12u(3)'>
												<a href='{$productLink[$item]}'>
												<img class='10u 6u(2) 6u(3)' src='images/{$productPhoto[$item]}'>
												</a>
												</div>
												<div class='8u 9u(2) 12u(3)'>
													<div class='row cartporjet'>
														<div class='12u fr42 pjtcolor01'>奈米矽皂--天然精油系列 [{$category}]</div>
													</div>
													<div class='row 0%'>
														<div class='12u'>
															<div class='row 0% no-collapse'>
															   <div class='2u fr42'>規格</div>
															   <div class='10u fr42 pjtcolor02'>{$productName[$item]}</div>
															</div><!-- row -->
														</div><!-- 12u -->
														";

					//禮盒組程式
					if($item=="set_tender")
					{	
						$smallPrice=iterateSet('set_tender_detail');
						$merchantTotal+=$smallPrice;
					}//if gift
					if($item=="set_candy")
					{	
						$smallPrice=iterateSet('set_candy_detail');
						$merchantTotal+=$smallPrice;
					}//if gift
														
					//後
					echo"								<div class='12u'>
															<div class='row 0% no-collapse'>
																<div class='2u fr42'>數量</div>
																<div class='4u fr42'>
																	<div class='row 0%'>
																		<div class='12u pjtcolor02'>
																		{$thisCount}
																		</div><!-- 12u -->
																	</div><!-- row -->
																</div><!-- 4u -->
																<div class='2u fr42'>小計</div>
																<div class='4u fr42 money01'>NT$ {$smallPrice}</div>
															</div><!-- row -->
														</div><!-- 12u -->
														<div class='12u delete01'>
															<a href='removeFromCart.php?product={$item}' class='icon02'><img class='1u' src='images/trash_can.png'></a>
														</div>
													</div><!-- row 0% -->
												</div><!-- 8u -->
											</div><!-- row no-collapse -->
										</div><!-- cartpad02 -->
									</div><!-- row 0% -->
								</div><!-- 12u cartbox -->
							</div><!-- row -->
						</div><!-- 12u -->
					</div><!-- row -->";
				}//if
			}//foreach
			
			//1.商品總計
			$_SESSION['merchantTotal']=$merchantTotal;
			
			//本次新增點數
			$_SESSION['discount_merchant'] = round($_SESSION['merchantTotal']*$_SESSION['order_discount']);			
			$_SESSION['newPoints']=floor($_SESSION['discount_merchant']*0.01)*5;
			
			//2.折扣
			$pointsToUseStr="";
			if(userLogged())
			{
				if(isDealer())
				{
					$_SESSION['pointsToUse'] = 0;
					//可調整使用點數
					$maxPoints = min(min($_SESSION['member_points'],$_SESSION['merchantTotal']),$_SESSION['max_pointsToUse']);
					$pointsToUseStr = "<input type='number' name='pointsToUse' id='id_pointsToUse_input' min='0' max='{$maxPoints}' value='{$_SESSION['pointsToUse']}' onChange='parameterChanged()'>";
				}
				else
				{				
					//設定最高金額點數
					$_SESSION['pointsToUse'] = min(min($_SESSION['member_points'],$_SESSION['discount_merchant']),$_SESSION['max_pointsToUse']);
					$pointsToUseStr = "<span id='id_pointsToUse'>{$_SESSION['pointsToUse']}</span>";
				}//else
			}		
			$_SESSION['discount_merchant']-=$_SESSION['pointsToUse'];
			if(!isset($_SESSION['total_count'])) $_SESSION['total_count']=0;			
			
			if($_SESSION['total_count']==0)
			{
				echo "<div class='row'>
						<div class='3u 6u(2) 12u(3)'><img class='8u' src='images/pic000-1.png'></div>
						<div class='4u 4u(2) 8u(3) fr03' style='color:#f00;'>沒有任何商品!</div>
					  </div>";
			}//else
			
			//3.運費
			$_SESSION['shippingFee']=$_SESSION['basicShipping'];
			$feeColor="#F00";
			
			if($_SESSION['discount_merchant']>=$_SESSION['noFeeAmount'])
			{
				$_SESSION['shippingFee']=0;
			}//if		
			
		?>
               <div class="row 0%">
                 <div class="12u baseline01"> 
        			<div class="choosing">
						
                            <div class="row 0% no-collapse fr42">
                                <div class="6u">
                                    <div class="row">
                                        <div class="12u">小計金額Subtotal</div>
                                    </div>
                                </div>
                                <div class="6u">
                                    <div class="row">
                                        <div class="12u"><?php echo "NT$ {$_SESSION['merchantTotal']}元(共 {$_SESSION['total_count']}件)"; ?></div>
                                    </div>
                                </div>
                            </div>
        <?php
			
		//經銷商可調折扣
		/*
		$discountString="";		 
		if(isset($_SESSION['member_discount']) && ($_SESSION['member_discount']<$_SESSION['member_def_discount']))
		{					
			$discountString="<select id='id_order_discount' name='order_discount' onChange='parameterChanged()'>";
			for($i=$_SESSION['member_def_discount']*100;$i>=($_SESSION['member_discount']*100);$i--)
			{
				$value=$i*0.01;
				$valueWord=$i*0.1;
				$preselected = "";
				if($i==($_SESSION['order_discount']*100))
				{
					$preselected="selected";
				}						
				$discountString.="<option value='{$value}' {$preselected}>{$valueWord}</option>";
			}                               
			$discountString.="</select>折";
		}
		else
		*/
		if($_SESSION['order_discount'] < 0.99)
		{
			$jer = $_SESSION['order_discount'] * 10;
			$discountString="{$jer}折";
		}
			
$off_sec=<<<OFF_SEC
			
								<div class="row 0% no-collapse fr42">
									<div class="6u">
										<div class="row">
											<div class="12u">會員折扣Off</div>
										</div>
									</div>
									<div class="6u">
										<div class="row">
											<div class="12u">{$discountString}</div>
										</div>
									</div>
								</div>
								
OFF_SEC;
		
		//點數
$point_sec=<<<POINT_SESSION

								<div class="row 0% no-collapse fr42 baseline03">
									<div class="6u">
										<div class="row">
											<div class="12u">紅利點數Dividend</div>
										</div>
									</div>
									<div class="6u">
										<div class="row">
											<div class="12u">{$pointsToUseStr}點/尚有<span id="id_remain">{$_SESSION['member_points']}</span>點</div>
										</div>
									</div>
								</div>
								
POINT_SESSION;

			if(userLogged())
			{
				echo $off_sec;
				echo $point_sec;
			}

$dis_sec=<<<discount_session

								
								<div class="row 0% no-collapse fr42">
									<div class="6u">
										<div class="row">
											<div class="12u">折扣後金額Discounted</div>
										</div>
									</div>
									<div class="6u">
										<div class="row">
											<div class="12u" id="id_discount_merchant">NT$ {$_SESSION['discount_merchant']}元</div>
										</div>
									</div>
								</div>
discount_session;
		if($_SESSION['order_discount']<0.99)
		{
			echo $dis_sec;
		}
?>
                                                            
								<div class="row 0% no-collapse fr42">
									<div class="6u 8u(3)">
										<div class="row">
											<div class="12u">運費Shipping</div>
										</div>
									</div>
									<div class="6u 4u(3)">
										<div class="row">
											<div id="id_shippingFee" class="12u">NT$ <?php echo $_SESSION['shippingFee'] ?>元</div>
										</div>
									</div>
								</div>
					
<?php
		//本次新增點數

$newPointsSec=<<<NEWPOINT_SEC
                                                            
								<div class="row 0% no-collapse fr42">
									<div class="6u 8u(3)">
										<div class="row">
											<div class="12u">獲得點數Gain</div>
										</div>
									</div>
									<div class="6u 4u(3)">
										<div class="row">
											<div id="id_shippingFee" class="12u">{$_SESSION['newPoints']}點</div>
										</div>
									</div>
								</div>
                                
NEWPOINT_SEC;
		
		if(userLogged())
		{
			echo $newPointsSec;
		}

		//總金額
		$_SESSION['total_money']=$_SESSION['discount_merchant']+$_SESSION['shippingFee'];
		
		$pointString="var js_pointsToUse=".(isset($_SESSION['pointsToUse']) ? "{$_SESSION['pointsToUse']};" : "0;");
		$memberPointString="";
		if(isset($_SESSION['member_points']))
		{
			$memberPointString="var js_member_points={$_SESSION['member_points']};";
		}
		
		$userLoggedBool = userLogged();
		$isDealerBool = isDealer();
		
		echo "
			 
				<div class='row'>
				   <div class='12u'>
				      <div id='id_total' class='subtotallist money01'>NT$ {$_SESSION['total_money']}</div>
				   </div>
				</div>
			 
			<script type='text/javascript'>
			var js_merchantTotal={$merchantTotal};
			var js_orderDiscount={$_SESSION['order_discount']};	
			var js_shippingFee={$_SESSION['shippingFee']};
			var js_basicShipping={$_SESSION['basicShipping']};
			var js_noFeeAmount={$_SESSION['noFeeAmount']};
			var_jsMaxPointsToUse={$_SESSION['max_pointsToUse']};
			var js_isDealer='{$isDealerBool}';
			var js_userLogged='{$userLoggedBool}';						
			{$pointString}
			{$memberPointString}
			</script>
		";
?>                     
                     </div><!--  choosing  -->
                     
<?php

$nonMemberSec=<<<NON_SEC

                        <div class="row fr42">
                           <div class="12u">
                              <ul>
                                 <li>提醒您加入會員即刻享有95折優惠，另加紅利點數回饋下次購物即享折抵。</li>
                              </ul>
                           </div>
                        </div>
                                    
NON_SEC;

$memberSec=<<<MEMBER_SEC
                     
                       　<div class="row fr42">
                        　  <div class="12u">
                              <ul>
                                 <li><h8>會員折扣與紅利點數計算說明：</h8></li>
                                 <li>1.加入會員首筆訂單起即享售價＊95折優惠，特殊活動則另依公告執行。</li>
                                 <li>2.紅利點數使用：會員優惠價(小計金額＊95折)→使用點數折抵後滿500可再享免運優惠。(1點折抵1元;當次最高可抵100點)</li>
                                 <li>3.紅利點數獲得：滿100元即贈5點，下次購物可抵用。(小計金額＊95折後金額之計算(不含運費)。例：小計金額510元＊95折=485元，獲得20點。)</li>
                              </ul>
                        　　　</div>
                     　　</div>
MEMBER_SEC;

if(userLogged())
{
	echo $memberSec;
}
else
{
	echo $nonMemberSec;
}
?>                     
                 </div><!-- 12u baseline -->
              </div>
               
                  
                  <div class="row">	 
					 <div class="12u">
						<div class="row no-collapse">
						   <div class="6u">
							  <div class="row">
								 <div class="12u fr25">
									<a href="NanoSoapAll.php" onClick="cartNext(event,'../index.php#products','false')">
                                       <div class="button2">繼續購物</div>
                                    </a>
								 </div>
							  </div>
						   </div>
                        
                           
                           <?php
						   
						   if($_SESSION['total_count'] > 0)
						   {
$nextSec=<<<NEXT_SEC

							   <div class="6u">
								  <div class="row">
									 <div class="12u fr42">
										<a href="#" onClick="cartNext(event,'Cart_step2.php','true')">
										   <div class="button2">立即結帳</div>
										</a>
									 </div>
								  </div>
							   </div>
NEXT_SEC;
							   
							   echo $nextSec;
						   }
						   ?>
                           
						</div>
					 </div>
				  <!--/div-->
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