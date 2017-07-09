<?php 
		
	include_once("../common/sharedCode.php");		
	include_once("../common/sql_common.php");	
	
	function memberMode()
	{
		$privalege = $_SESSION['privalege'] > 0;
		$disableStr = $privalege ? "":"disabled";
		
		if(isset($_GET['message']))
		{
			if($_GET['message']=='1')
			{
				echo "<h3>紅利兌換完成!</h3>";
			}
		}
		
		if(isset($_SESSION['showMessage']))
		{
			switch($_SESSION['showMessage'])
			{
				case 1:
					echo "<script>alert('轉換經銷商成功')</script>";
					break;
				case 2:
					echo "<script>alert('取消經銷商成功')</script>";
					break;
				case 3:
					echo "<script>alert('更改折扣成功')</script>";
					break;
				case 4:
					echo "<script>alert('折扣數和原本無異')</script>";
					break;
				case 5:
					echo "<script>alert('成功更改經銷商')</script>";
					break;
			}
			unset($_SESSION['showMessage']);
		}
		
		echo "<h2>會員資料</h2>";	
		$whereCond = "member_sn = {$_GET['member_sn']}";
		$sql = "select * from member where {$whereCond}";
		$sqlReturn = Q($sql,"無法查詢會員資料!");
					
		if($data=mysql_fetch_array($sqlReturn))
		{			
			echo "<table class='rzTable' border='1'>";
			if($data['isDealer']==1)
			{
				echo "<tr><th>經銷商</th></tr>";
			}
			echo "<tr><th class='rzTableHeader'>姓名			</th><td>{$data['name']}		</td><th class='rzTableHeader'>加入日期			</th><td>{$data['applyDate']}		</td></tr>";
			echo "<tr><th>email			</th><td>{$data['email']}		</td><th>mobile			</th><td>{$data['mobile']}		</td></tr>";
			echo "<tr><th>地址			</th><td>{$data['addr']}		</td><th>zip			</th><td>{$data['zip']}			</td></tr>";

			$discountStr=$data['discount'];			
			
			if(($_SESSION['member_sn']==$data['belongDealer']) || $privalege)
			{
$discountStr=<<<DISCOUNT_FORM
				
				<form id='memberForm' action='../dealer/updateDiscount.php' method='post'>
					<select id='newDiscount' name='newDiscount' class='rzFormInput' style='width:7em' >

						<option value='0.95' {$disableStr} >九五折</option>
						<option value='0.9'  >九折</option>
						<option value='0.85' >八五折</option>
						<option value='0.8'  >八折</option>
						<option value='0.75' >七五折</option>
						<option value='0.7'  {$disableStr} >七折</option>
					</select>
					<input type='submit' style='font-size:60%' value='更改折扣設定' class='rzFormSubmit' onClick='submitChange(event)'/>
					<input type='hidden' name='member_sn' value='{$data['member_sn']}'>
					<input type='hidden' name='oldDiscount' value='{$data['discount']}'>
				</form>
				
DISCOUNT_FORM;
			}
			
			echo "<tr>
				<th>享有折扣		</th>
				<td>
					{$discountStr}
				</td>
				<th>剩餘紅利點數		</th><td>{$data['points']}			</td>
			</tr>";
			if($data['belongDealer']!=0)
			{
				$selectField = "name";
				$whereCond = "member_sn = {$data['belongDealer']}";
				$sql = "select {$selectField} from member where {$whereCond}";
				$sqlReturn = Q($sql,"無法查詢經銷商資料!");
				if($adata=mysql_fetch_array($sqlReturn))
				{
					echo "<tr><th>隸屬經銷商</th><td><a href='index.php?mode=memberMode&member_sn={$data['belongDealer']}'>{$adata['name']}</td></tr>";
				}
			}
			echo "<tr><td colspan='4' style='text-align:right'>
			<a href='index.php?mode=pointTransMode&member_sn={$_GET['member_sn']}' style='border-bottom-style:none'>
				<button class='rzButton' style='width:12em'>紅利變動歷程</button>
			</a>";
			echo "<a href='index.php?mode=modifyMember&member_sn={$_GET['member_sn']}' style='border-bottom-style:none'>
				<button class='rzButton' style='width:12em' {$disableStr}>修改會員資料</button>
			</a>";
			echo "<a href='index.php?mode=changePassword&member_sn={$_GET['member_sn']}' style='border-bottom-style:none'>
				<button class='rzButton' style='width:12em' {$disableStr}>更改會員密碼</button>
			</a>";
			
			$submitText="";
			if($data['isDealer']==1)
			{
				echo "<button class='rzButton' style='width:12em' onclick='gotoCashout(event)' {$disableStr}>紅利兌換現金</button>";
				echo "<a href='index.php?mode=dealerMemberList&dealerSN={$_GET['member_sn']}&dealerName={$data['name']}' style='border-bottom-style:none'>
				<button class='rzButton' style='width:12em'                                           >旗下會員列表</button></a>";
				echo "<a href='index.php?mode=addMemberMode&dealerSN={$_GET['member_sn']}&dealerName={$data['name']}' style='border-bottom-style:none'>
				<button class='rzButton' style='width:12em'                                           >新增旗下會員</button></a>";
				echo "<a href='index.php?mode=monthMode&dealerSN={$_GET['member_sn']}&dealerName={$data['name']}' style='border-bottom-style:none'>
				<button class='rzButton' style='width:12em'                                           >經銷商訂單列表</button></a>";
				echo "<a href='index.php?mode=modeOrder&dealerSN={$_GET['member_sn']}&dealerName={$data['name']}' style='border-bottom-style:none'>
				<button class='rzButton' style='width:12em'                                           >代經銷商填訂單</button></a>";				
				$submitText="取消經銷商身份";
				$toDealer=0;
			}
			else
			{
				$submitText="成為經銷商身份";
				$toDealer=1;
				echo "<button class='rzButton' style='width:12em' onclick='reassignDealer(event)' {$disableStr}>更換/指定經銷商</button>";
				echo "<a href='index.php?mode=modeOrder&memberSN={$_GET['member_sn']}' style='border-bottom-style:none'>
				<button class='rzButton' style='width:12em'                                           >代會員填訂單</button></a>";
			}
			
$transDealerForm=<<<TRANS_FORM

<form id='transDealerForm' action='../admin/transDealer.php' method='post'>
	<input type='hidden' name='isDealer' value='{$toDealer}' />
	<input type='hidden' name='member_sn' value="{$_GET['member_sn']}" />
	<button class='rzButton' style='width:12em' {$disableStr}' {$disableStr} onclick='toTransDealer(event)'/>{$submitText}</button>
</form>

TRANS_FORM;

			echo $transDealerForm;
			echo "</td></tr>";
			echo "</table>";
		
			$jsCode=<<<JSCODE
		
<script>
	var memberPoint={$data['points']};
	
	var gotoCashout=function(event)
	{
		event.preventDefault();
		
		if(memberPoint<=0)
		{
			alert('紅利點數不足可兌換現金!');
			return;
		}
		
		window.location.href="index.php?mode=dealerCashout&dealer_sn={$_GET['member_sn']}";
	}
	
	var reassignDealer=function(event)
	{
		event.preventDefault();
				
		window.location.href="index.php?mode=reassignDealer&member_sn={$_GET['member_sn']}&oldDealer={$data['belongDealer']}&name={$data['name']}";
	}
	
	var toTransDealer=function(event)
	{
		event.preventDefault();
		
		if(confirm('確定{$submitText}?'))
		{
			$('#transDealerForm').submit();
		}
	}
	
	var submitChange=function(event)
	{
		event.preventDefault();
		
		var oForm=document.getElementById('memberForm');
		var oDiscount=document.getElementById('newDiscount');
		
		if(oDiscount.options[oDiscount.selectedIndex].value=={$data['discount']})
		{
			alert('折扣數和原本無異');
		}
		else
		{
			oForm.submit();
		}
	}
	
	var changeDiscount=function(value)
	{
		$('#newDiscount').val(value);
	}
	
	changeDiscount({$data['discount']});
	
</script>		
		
JSCODE;
			echo $jsCode;
        }//if mysql_get
		
		echo "<h3>購買紀錄</h3>";
		
		$selectField = "ordertable.order_sn,ordertable.order_serial,ordertable.date,ordertable.easyship,ordertable.pay,ordertable.send,ordertable.money,ordertable.customer_sn,ordertable.member_sn,ordertable.point_used,ordertable.point_gained,ordertable.canceled,customer.name,member.test";
		$whereCond = "ordertable.member_sn = {$_GET['member_sn']}";
		
		$sql = "select {$selectField} from ordertable inner join customer on ordertable.customer_sn = customer.customer_sn left join member on member.member_sn = ordertable.member_sn where {$whereCond}";
		$sqlReturn = Q($sql,"無法查詢資料庫!");
					
        if(mysql_num_rows($sqlReturn)==0)
        {
        	echo "<h3>查無購買紀錄</h3>";
        }
        else
        {
            echo "<table class='rzTable' style='font-size:80%'>";
            echo "<tr><th>訂單</th><th>EZSHIP</th><th>日期</th><th>付款</th><th>寄送</th><th>金額</th><th>使用紅利</th><th>新增紅利</th></tr>";
            while($data=mysql_fetch_array($sqlReturn))
            {
                $strikeLine = $data['canceled'] ? "style='text-decoration: line-through;'":"";
                echo "<tr {$strikeLine}>";
                echo "<td><a href='{$_SERVER['PHP_SELF']}?mode=orderMode&order_serial={$data['order_serial']}'>{$data['order_serial']}</a></td>";
                echo "<td>{$data['easyship']}</td>";
                echo "<td>{$data['date']}</td>";
                
                if($data['pay']=='信用卡')
                {
                    echo "<td><a href='{$_SERVER['PHP_SELF']}?mode=creditMode&order_sn={$data['order_sn']}'>信用卡</a></td>";
                }//if
                else
                {
                    echo "<td>{$data['pay']}</td>";
                }
                
                echo "<td>{$data['send']}</td>";
                echo "<td>{$data['money']}</td>";
                echo "<td>-{$data['point_used']}</td>";
                echo "<td>+{$data['point_gained']}</td>";
                echo "</tr>";
            }
            echo "</table>";
    	}//if rows 0
	}//memberMode

?>