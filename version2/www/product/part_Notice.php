<?php

$noticeSec=<<<NOTICE_SEC

		<!-- Notice -->
		<div class="wrapper underneath">
        <article class="container 75%">

            <div class="row 0% other-options not-mobile no-collapse">
                <div class="4u">
                    <a href="mailto:web@exquisite.com.tw" class="select"><img src="images/email-2.gif" style="width: 14%">E-mail我們</a>
                </div>
                <div class="4u">
                    <a href="https://www.facebook.com/exquisite.taipei" class="select"><img src="images/iconfb.gif" style="width: 13%">加入粉絲團</a>
                </div>
                <div class="4u">
                    <a href="member.php?from={$_SERVER['PHP_SELF']}" class="select"><img src="images/iconmenber-2.gif" style="width: 13%">加入新會員</a>
                </div>
            </div>
            <div class="row 0% only-mobile">
                <a class="12u select" href="mailto:web@exquisite.com.tw"><img src="images/email-2.gif" style="width:18%"> E-mail我們</a>
                <a class="12u select" href="https://www.facebook.com/exquisite.taipei"><img src="images/iconfb.gif" style="width: 20%">加入粉絲團</a>
                <a class="12u select" href="member.php?from={$_SERVER['PHP_SELF']}"><img src="images/iconmenber-2.gif" style="width: 20%">加入新會員</a>
            </div>

            <div class="row rule not-mobile">
                <a class="3u" target="_blank" href="Terms.html">
                    <p>網站使用條款<br>Terms of us</p>
                </a>
                <a class="3u" target="_blank" href="Shopping_Notes.html">
                    <p>購物須知<br>Shopping Notes</p>
                </a>
                <a class="3u" target="_blank" href="Privacy.html">
                    <p>隱私權政策<br>Privacy police</p>
                </a>
                <a class="3u" target="_blank" href="Disclaimer.html">
                    <p>免責聲明<br>Disclaimer</p>
                </a>
            </div>

        </article>
    </div>
    <div class="row no-collapse only-mobile">
        <a class="6u butbg" target="_blank" href="Terms.html">
            <p>網站使用條款<br><span>Terms of us</span></p>
        </a>

        <a class="6u butbg" target="_blank" href="Shopping_Notes.html">
            <p>購物須知<br><span>Shopping Notes</span></p>
        </a>

        <a class="6u butbg" target="_blank" href="Privacy.html">
            <p>隱私權政策<br><span>Privacy police</span></p>
        </a>

        <a class="6u butbg" target="_blank" href="Disclaimer.html">
            <p>免責聲明<br><span>Disclaimer</span></p>
        </a>

    </div>
NOTICE_SEC;

?>