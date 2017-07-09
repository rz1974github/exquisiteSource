<?php

session_start();

include_once("../global.php");

function userLogged()
{
	return isset($_SESSION['member_email']) && ($_SESSION['member_email']!="guest");
}

function isDealer()
{
	$loggedIn=userLogged();
	
	return ($loggedIn && ($_SESSION['isDealer']));
}

function add_member_option($memberPath,$returnPage,$showDiscount=true)
{
$jsLogout=<<<jsLogout

<script type="text/javascript">

var confirmLogout = function(event)
{
	event.preventDefault();
	var answer = confirm("你確定要登出嗎?");
	if(answer == true)
	{
		window.location.href = "{$memberPath}logout.php";
	}
}

</script>

jsLogout;

	echo $jsLogout;
	
	if(userLogged())
	{
		$privaledge="";
        
        /*
		$percent = (string)($_SESSION['member_discount']*10)."折";        
        $points = "";
        if((isset($_SESSION['member_points']))&&($_SESSION['member_points']>0))
        {
        	$points = "(可用點數:{$_SESSION['member_points']})";
        }
        */
        
		$privaledge = "({$percent}){$points}";
        
		echo "<li><a href='../product/memberFunc.php'>{$_SESSION['member_email']}您好!</a></li>";  //{$privaledge}
		echo "<li><a href='#' onclick='confirmLogout(event)'>登出</a></li>";
		
        /*
		if(($_SESSION['member_discount']<$_SESSION['member_def_discount']) && ($showDiscount==true))
		{
			echo "<li>代訂折扣<select id='order_discount' name='order_discount' onChange='parameterChanged()'>";
			for($i=$_SESSION['member_def_discount']*100;$i>=($_SESSION['member_discount']*100);$i--)
			{
				$value=$i*0.01;
				$valueWord=$i*0.1;
				$preselected = "";
				if($i==($_SESSION['order_discount']*100))
				{
					$preselected="selected";
				}
				
				echo "<option value='{$value}' {$preselected}>{$valueWord}折</option>";
			}                               
			echo "</select></li>";
			if(!isset($_SESSION['order_discount']) || ($_SESSION['order_discount']<$_SESSION['member_discount']))
			{
				$_SESSION['order_discount']=$_SESSION['member_discount'];
			}
		}
        */
	}
	else
	{
		echo "<li><a href='{$memberPath}member.php?from={$returnPage}'>登入</a></li>";
        $_SESSION['order_discount']=1;
	}
}

?>