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
    <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><[endif]-->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.scrolly.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/init.js"></script>
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
    <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><[endif]-->
    <!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><[endif]-->
    <script type="text/javascript"></script>
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
                    <h3>會員登入</h3>
                    <p class="only-mobile">(請確認已為會員，再由此登入)</p>
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
                    <form id="loginForm" action="login.php" method="post">
                        <div class="row">
                            <div class="4u not-mobile fr25">會員帳號</div>
                            <div class="8u fr42">
                                <input type="email" name="email" placeholder="請輸入E-mail" required />
                            </div>
                            <div class="4u not-mobile fr25">登入密碼</div>
                            <div class="8u fr42">
                                <input type="password" name="passwd" placeholder="請輸入密碼" required />
                                <?php echo "<input type='hidden' name='from' value='{$_GET['from']}' />"; ?>
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
                                <input class="4u 6u(3) button2" type="submit" value="登入" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="6u(1) 12u(3) memberbox line">
                    <h3>加入會員</h3>
                    <p class="only-mobile">(歡迎成為新會員，請依提示新增資料)</p>
                    <form id="formRegister" action="register.php" method="post">
                        <div class="row">
                            <div class="4u not-mobile fr25">E-mail</div>
                            <div class="8u">
                                <input type="email" name="email" placeholder="請設定會員登入帳號" required />
                            </div>
                            <div class="4u not-mobile fr25">設定密碼</div>
                            <div class="8u">
                                <input type="password" name="passwd" placeholder="請設定會員登入密碼" required />
                            </div>
                            <div class="4u not-mobile fr25">確認密碼</div>
                            <div class="8u">
                                <input type="password" name="passwd2" placeholder="再次確認會員登入密碼" required />
                            </div>
                            <div class="4u not-mobile fr25">真實姓名</div>
                            <div class="8u">
                                <input type="name" name="name" placeholder="真實(收件者)姓名" required />
                            </div>
                            <div class="12u">
                                <input type="radio" name="legal" value="是的" required /><span class="sp12">是的，我已閱讀並同意服務條款與購物須知。</span>
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
                            <div class="12u">
                                <input class="4u 6u(3) button2" type="button" onclick="submitRegister(event)" value="加入會員" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="6u 12u(3) memberbox">
                    <h3>訪客直接結帳</h3>
                    <p>(以訪客身份，繼續選擇配送方式)</p>
                    <div class="row">
                        <div class="12u">
                            <input class="4u 6u(3) button2" type="button" value="前往結帳" onclick="location.href='<?php echo $_GET[ 'from']; ?>'" />
                        </div>
                    </div>
                </div>
            </div>
        </article>
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
