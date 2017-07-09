<?php
	
	include_once("../global.php");	
	include_once("../common/sharedCode.php");		
	include_once("../common/sql_common.php");
	include("../product/sharedResult.php");		
	
	function modeOrder3Confirm()
	{	
		global $order_typeString,$delieverString,$delieverTimeStr;
		
$javaCode=<<<JAVA_CODE_SEC
		
		<script type='text/javascript'>		
		
		//copy value from PHP
		//var js_noFeeAmount={$_SESSION['noFeeAmount']};
		
		function delieverChanged()
		{
			switch(delieverType)
			{
				case 1:
					$('#zipLine').show();
					$('#addrLine').show();
					$('#shopLine').hide();
				break;
				case 3:
					$('#zipLine').hide();
					$('#addrLine').hide();
					$('#shopLine').show();
				break;
			}
		}
		
		var comeback=function(event)
		{
			event.preventDefault();
			window.location.href="index.php?mode=modeOrder";
		}
		
		var confirm=function(event)
		{
			event.preventDefault();
			
			$('#confirmForm').submit();
		}
		
		</script>
        
JAVA_CODE_SEC;

        echo $javaCode;			
		
        echo "<div class='row'>";
        echo "<div class='12u' style='padding:2em'>";

        if($_GET['success']=='true')
        {
            if($_REQUEST['Error']==true)
            {
                echo "<h2>寄送訂單失敗</h2>";
                /*
        S01 訂單新增成功
        E00 參數傳遞內容有誤或欄位短缺
        E01 <su_id>帳號不存在
        E02 <su_id>帳號無建立取貨付款權限 或 無網站串接權限 或 無ezShip宅配權限
        E03 <su_id>帳號無可用之 輕鬆袋 或 迷你袋
        E04 <st_code>取件門市有誤
        E05 <order_amount>金額有誤
        E06 <rv_email>格式有誤
        E07 <rv_mobile>格式有誤
        E08 <order_status>內容有誤 或 為空值
        E09 <order_type>內容有誤 或 為空值
        E10 <rv_name>內容有誤 或 為空值
        E11 <rv_addr>內容有誤 或 為空值
        E98 系統發生錯誤無法載入
        E99 系統錯誤
                */
                
                $errorString="";
                switch($_REQUEST['order_status'])
                {
                    case "S01":
                        $errorString="訂單新增成功";
                        break;
                    case "E00":
                        $errorString="參數傳遞內容有誤或欄位短缺";
                        break;
                    case "E01":
                        $errorString="<su_id>帳號不存在";
                        break;
                    case "E02":
                        $errorString="<su_id>帳號無建立取貨付款權限 或 無網站串接權限 或 無ezShip宅配權限";
                        break;
                    case "E03":
                        $errorString="<su_id>帳號無可用之 輕鬆袋 或 迷你袋";
                        break;
                    case "E04":
                        $errorString="<st_code>取件門市有誤";
                        break;
                    case "E05":
                        $errorString="<order_amount>金額有誤";
                        break;
                    case "E06":
                        $errorString="<rv_email>格式有誤";
                        break;
                    case "E07":
                        $errorString="<rv_mobile>格式有誤";
                        break;
                    case "E08":
                        $errorString="<order_status>內容有誤 或 為空值";
                        break;
                    case "E09":
                        $errorString="<order_type>內容有誤 或 為空值";
                        break;
                    case "E10":
                        $errorString="<rv_name>內容有誤 或 為空值";
                        break;
                    case "E11":
                        $errorString="<rv_addr>內容有誤 或 為空值";
                        break;
                    case "E98":
                        $errorString="系統發生錯誤無法載入";
                        break;
                    case "E99":
                        $errorString="系統錯誤";
                        break;
                    default:
                        $errorString="不知名的錯誤";
                        break;
                }//switch
                
                echo "<p>{$_REQUEST['order_status']}:{$errorString}</p>";
                echo "<p>很抱歉! 請稍後再試,或聯絡客服人員</p>";
                echo "</header>";	
            }//if
            else
            {
                echo "<div class='choosing fr26'>Your order is completed<br>購物完成! 感謝您的訂購，我們將會依序為您處理訂單。</div>";
            }
        }
                
		echo "<table class='rzTable' border='1' style='font-size:90%'>";
        $memberStr="";
        if($_SESSION['orderMode']==0)
        {
		    $memberStr="代訂";
        }//if
        else
        {
            if($_SESSION['useDealer']=='true')
            {
                $memberStr="經銷商自訂";
            }
            else
            {
                $memberStr="代訂會員";
            }
        }
		echo "<tr><th>{$memberStr}</th><td style='width:16em'>{$_SESSION['order_member_email']}</td></tr>";
        
        $nowStoreStr="";
        if(isset($_SESSION['stName']))
        {
            $nowStoreStr="{$_SESSION['stName']} / 代號：{$_SESSION['stCode']} / 門市電話：{$_SESSION['stTel']}";
        }
        
        //收件人
$recieverSec=<<<RECEIVER_SEC

            <tr>
            	<th style='width:15em'>中文全名/提貨人姓名NAME</th>
                <td>{$_SESSION['ship_name']}</td>
            </tr>
            <tr>
            	<th>電話/提貨人電話MOBILE</th>
                <td>{$_SESSION['ship_mobile']}</td>
            </tr>
            <tr>
                <th>電子信箱/提貨通知EMAIL</th>
                <td>{$_SESSION['ship_email']}</td>
			</tr>
            <tr id='zipLine'>
                <th>郵遞區號ZIP</th>
                <td>{$_SESSION['ship_zip']}</td>
            </tr>
            <tr id='addrLine'>
                <th>地址ADDRESS</th>
                <td>{$_SESSION['ship_addr']}</td>
            </tr>
            <tr id='shopLine'>
            	<th>取貨門市</th>
                <td>{$nowStoreStr}</td>
            </tr>
RECEIVER_SEC;

		echo $recieverSec;

		echo "<script>";
		echo "var delieverType={$_SESSION['deliever']};";
		echo "delieverChanged();";
		echo "</script>";
$totalCount=0;
$productCart="";
$javaAdd="";
if(isset($_SESSION['productCart']))
{
    foreach($_SESSION['productCart'] as $key => $obj)
    {
		$smallAmount=intval($obj->price) * intval($obj->count);
        $newLine="<tr><td>{$obj->name}</td><td style='text-align:right'>{$obj->price}</td><td style='text-align:right'>{$obj->count}</td><td style='text-align:right'>{$smallAmount}</td></tr>";
        $productCart.=$newLine;
        $totalCount+=$obj->count;
    }
}

$pointSection=<<<POINT_SECTION

            <tr>
                <th>新增紅利</th><td style='text-align:right'>{$_SESSION['newPoints']}</td>
                <th>使用紅利</th><td id='toPoint' style='text-align:right;width:10em;'>{$_SESSION['pointsToUse']}</td>
            </tr>

POINT_SECTION;

if($_SESSION['orderMode']==0)
{
	$pointSectionStr="";
}
else
{
	$pointSectionStr=$pointSection;
}

$tableSec=<<<TABLE_SEC

            <tr id='titleLine'><th colspan=4 style='text-align:center'>購物清單</th></tr>
            <tr id='headerLine'><th>名稱</th><th >單價</th><th style='text-align:right;width:10em;'>數量</th><th>小計</th></tr>
            {$productCart}        
            <tr id='totalLine'>
                <th style='width:9em'>總件數</th><td id='totalCount' style='text-align:right'>{$totalCount}</td>
                <th>總計</th><td style='text-align:right'>{$_SESSION['merchantTotal']}</td>
            </tr>
            {$pointSectionStr}
            <tr>
                <th>折扣</th><td style='text-align:right'>{$_SESSION['order_discount']}</td>
                <th>折扣後金額</th><td style='text-align:right'>{$_SESSION['discount_merchant']}</td>
            </tr>
            <tr>
                <th>運費</th><td style='text-align:right'>{$_SESSION['shippingFee']}</td>
            </tr>
            <tr>
                <th>計算後總金額</th><td style='text-align:right'>{$_SESSION['total_money']}</td>
            </tr>
            <tr><th>付款方式</th><td>{$order_typeString}</td></tr>
            <tr><th>取貨方式</th><td>{$delieverString}</td></tr>
            <tr><th>其他</th><td>{$delieverTimeStr}</td></tr>
            <tr><th>備註</th><td>{$_SESSION['message']}</td></tr>
		</table>
        
TABLE_SEC;

        echo $tableSec;
        
$formTail=<<<FORM_TAIL
        
    <form id='confirmForm' action='../dealer/modeOrder35Payment.php' method='post'>
	<div class='row'>
	    <div class='12u'>
            	<input type='hidden' name='Submit2' value='true' onclick='comeback(event)' />
	        	<input type='submit' class='rzFormSubmit' value='修改資料' onclick='comeback(event)' />
    			<input type='submit' class='rzFormSubmit' value='送出訂單' onclick='confirm(event)' />
        </div>
    </div>
    </form>

FORM_TAIL;

	if($_GET['success']=='true')
    {
    	unset($_SESSION['productCart']);
        unset($_SESSION['order_serial']);
        unset($_SESSION['stName']);
        unset($_SESSION['pointsToUse']);
        unset($_SESSION['newPoints']);
        unset($_SESSION['ship_name']);
        unset($_SESSION['ship_email']);
        unset($_SESSION['ship_mobile']);
        unset($_SESSION['ship_zip']);
        unset($_SESSION['ship_addr']);
        unset($_SESSION['deliever']);
        unset($_SESSION['delieverTime']);
        unset($_SESSION['order_type']);
        unset($_SESSION['message']);
    }
    else
    {
        echo $formTail;
    }
        
	}//modeOrder3Confirm
?>