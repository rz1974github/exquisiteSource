<?php

function sendOrderMail(&$finalMessage,$customerEmal,$customerName,$dealerEmail)
{
   $_toEmailAddress = "sale@exquisite.com.tw";
   $_ccEmailAddress = $customerEmal.",".$dealerEmail;
   //$_SESSION['rv_email']
   //$_SESSION['ship_email']
   $_bccEmailAddress = "";

   $_comments = $_SESSION[ "message" ];
   $_partialComment = substr($_comments,0,30);
   $orderType = purchaseType($_SESSION['order_type'],$_SESSION['deliever']);
   
   $_subject = "EXQUISITE 精雕細琢[{$_SESSION['order_serial']}][{$orderType}][{$customerName}][金額:{$_SESSION['total_money']}]";
   //$_SESSION['rv_name']
   //$_SESSION[ "ship_name" ]

   $_from = "\"$customerName\" <{$customerEmal}>";

   $_headers = "";
   $_headers .= "MIME-Version: 1.0\r\n";
   $_headers .= "Subject: =?UTF-8?B?".base64_encode($_subject)."?=\r\n";
   $_headers .= "Content-type: text/html; charset=utf-8\r\n";
   //$_headers .= "From: $_from\r\n";
   //$_headers .= "To: ".$_toEmailAddress."\r\n";
   
   if (! empty($_bccEmailAddress) ) {
       $_headers .= "BCC: ".$_bccEmailAddress."\r\n";
   }
   if (! empty($_ccEmailAddress) ) {
       $_headers .= "CC: ".$_ccEmailAddress."\r\n";
   }
   $_headers .= "Reply-To: $_from\r\n";
   $_headers .= "X-Priority: 1\r\n";
   $_headers .= "X-MSMail-Priority: High\r\n";
   $_headers .= "X-Mailer: Hero Network Email System\r\n";
   
   $mailSubject = "=?UTF-8?B?".base64_encode($_subject)."?=";

$messageHeader=<<<messageHeader
                    <header>
						<a href='http://www.exquisite.com.tw'><img src='http://www.exquisite.com.tw/images/IMG_3437mail3.jpg' alt='EXQUISITE 精雕細琢'/></a>
						<h2>感謝您的訂購!</h2>
					</header>
messageHeader;

	$message.=$messageHeader;
	if(!empty($dealerEmail))
	{
		$message.="本訂單由{$dealerEmail}代訂";
	}
	$message.=$finalMessage;
	$messageNotice="<P style='color:#099;'> 此為系統自動發送郵件，請勿回覆。如有客服需求請上公司網站首頁詢問。</p>";
	$message.=$messageNotice;
	$mailresponse = mail("$_toEmailAddress",
                        "$mailSubject",
                        "$message",
                        $_headers
                        );						
}

?>