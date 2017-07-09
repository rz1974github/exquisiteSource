<!DOCTYPE HTML>
<!--
	Miniport by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>加入會員</title>
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
	
		</script>
        
        <?php
		
		session_start();
		
		if(isset($_GET['from']))
		{
			$_SESSION['from']=$_GET['from'];
		}
		
		?>
	</head>
	<body onLoad="discount_changed()">

		<!-- Nav -->
			<nav id="nav">
               	<ul class="container">
                    <li><a href="../index.php">EXQUISITE</a></li>
                    
					<li><a href="Cart.php">我的購物車<?php echo ($_SESSION['total_count']>0) ?  "(".$_SESSION['total_count'].")" : ""; ?></a></li>
				</ul>
               
			</nav>
		<!-- Home -->
			<div class="wrapper cart01">
			    <article class="container 75%">
                
                   <div class="row">
                      <div class="6u 12u(3) memberbox">
                          <div class="row">
							<script>
                            var submitLogin=function(event)
                            {
                                event.preventDefault();
                                var loginForm = document.forms['loginForm'];
								if(loginForm.checkValidity())
								{
                                	loginForm.submit();
								}
								else
								{
									alert("請輸入正確的資訊");
								}
                            }
							
                            var submitRegister=function(event)
                            {
                                event.preventDefault();
                                var Form = document.forms['formRegister'];
								if(Form.checkValidity())
								{
                                	Form.submit();
								}
								else
								{
									alert("請輸入正確的資訊");
								}
                            }							
                            </script>                          
                          	 
								  <div class="12u fr26">會員登入</div>
                           </div>
                           <form id="loginForm" action="login.php" method="post">
                           <div class="row">
								  <div class="12u">
 									    <div class="row no-collapse">
										   <div class="4u fr25">會員帳號</div>
										   <div class="8u fr42">
										      <div class="row">
											     <div class="12u">
                                                    <div class="row 0%">
												       <input type="email" name="email" placeholder="輸入E-mail" required />
                                                    </div>
											     </div>
										      </div>
										   </div>
									    </div>
								  </div>
								  <div class="12u">
									 <div class="row no-collapse">
										<div class="4u fr25">登入密碼</div>
										<div class="8u">
										   <div class="row">
											  <div class="12u fr42">
                                                 <div class="row 0%">
												    <input type="password" name="passwd" placeholder="登入密碼" required />
                                                    <?php echo "<input type='hidden' name='from' value='{$_GET['from']}' />"; ?>
                                                 </div>
											  </div>
										   </div>
										</div>                                    
									 </div>
								  </div>
								  <?php 
                                  if(isset($_GET['error']))
                                  {
                                    switch($_GET['error'])
                                    {
                                        case 1:
                                            echo "<div class='12u'><p><strong style='color:red'>*查無此email信箱</strong></p></div>";
                                        break;
                                        case 2:
                                            echo "<div class='12u'><p><strong style='color:red'>*帳號密碼不正確</strong></p></div>";
                                        break;
                                    }												  
                                  }
                                  ?>
								  <div class="12u">
									 <!--a herf="#" onclick="submitLogin(event)"><div class="4u 6u(3) bgcolor03">登入</div></a-->
                                     <input class="4u 6u(3) button2" type="submit" value="登入" />
								  </div>
							  
                           </div><!-- row -->
                           </form>
                        </div><!-- 6u 12u memberbox-->
                        <div class="6u 12u(3) memberbox line">
                            <div class="row">
							
								<div class="12u fr26">加入會員</div>
                            </div>
                            <form id="formRegister" action="register.php" method="post">
                            <div class="row">
								<div class="12u">
								 <div class="row no-collapse">
									<div class="4u 4u(3) fr25">E-mail</div>
									<div class="8u">
									   <div class="row">
										  <div class="12u fr42">
											 <input type="email" name="email" planceholder="設定帳號" required />
										  </div>
									   </div>
									</div>
								 </div>
								</div><!-- 12u -->
								<div class="12u">
								 <div class="row no-collapse">
									<div class="4u 4u(3) fr25">設定密碼</div>
									<div class="8u">
									   <div class="row">
										  <div class="12u fr42">
											 <input type="password" name="passwd" display="設定密碼" required />
										  </div>
									   </div>
									</div>
								 </div>
								</div>
								<div class="12u">
								 <div class="row no-collapse">
									<div class="4u 4u(3) fr25">確認密碼</div>
									<div class="8u">
									   <div class="row">
										  <div class="12u fr42">
											 <input type="password" name="passwd2" planceholder="確認密碼" required />
										  </div>
									   </div>
									</div>
								 </div>
								</div>
								<div class="12u">
								 <div class="row no-collapse">
									<div class="4u 4u(3) fr25">真實姓名</div>
									<div class="8u">
									   <div class="row">
										  <div class="12u fr42">
											 <input type="name" name="name" planceholder="(你的名字)" required />
										  </div>
									   </div>
									</div>
								 </div>
								</div>
								<div class="12u">
                                    <div class="row">
                                        <div class="12u fr43"><input type="radio" name="legal" value="是的" planceholder="" required />
                                        是的，我已閱讀並同意服務條款與購物須知。</div>
                                    </div>
                                
                                    
									<?php 
                                    if(isset($_GET['error']))
                                    {
										switch($_GET['error'])
										{
											case 30:
												echo "<div class='12u'><p><strong style='color:red'>*這個email信箱已經註冊過了!</strong></p></div>";
											break;
											case 31:
												echo "<div class='12u'><p><strong style='color:red'>*您兩次輸入的密碼並不相同!</strong></p></div>";
											break;
											case 35:
												echo "<div class='12u'><p><strong style='color:red'>*您是否勾選已同意服務條款?</strong></p></div>";
											break;
										}												  
                                    }
                                    ?>
                                    <!--div class="row 0% no-collapse">
                                    </div-->
								</div>
								<div class="12u">
								 <div class="row 150%">
									<div class="12u">
									   <!--a href="#">
										  <!--div class="4u 6u(3)"-->
											 <a herf="#" onclick="submitRegister(event)"><div class="4u 6u(3) bgcolor03">加入會員</div></a-->
                                             <!--input class="button2" type="button" value="加入會員" />
										  <!--/div-->
									   </a>
									</div>
								 </div>
								</div>
							  
                            </div><!-- row -->
                            </form>
                         </div>
                      </div>
                      <div class="6u 12u(3) memberbox">
                         <div class="row">
                              <div class="12u fr26">訪客結帳</div>
                              <div class="12u memberstyle04">以訪客方式繼續購買，選擇配送方式</div>
                              <div class="12u">
                                 <a href="<?php echo $_GET['from']; ?>">
                                    <div class="4u 6u(3) button2">前往＞</div>
                                 </a>
                              </div>
                         </div>
                      </div>
                      <div class="6u memberbox">
                         <div class="row">
                            <div class="12u"></div>
                         </div>
                      </div>
                   </div>
	<!-- Contact -->
		<?php
		
		include_once("part_Notice.php");
		include_once("part_Footer.php");
		
		echo $noticeSec;
		echo $footerSec;
		
		?>
	</body>
</html>