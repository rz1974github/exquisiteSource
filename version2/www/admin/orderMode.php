<?php 
		
	include_once("../common/sharedCode.php");		
	include_once("../common/sql_common.php");
	
	class productData
	{
		public $name;
		public $price;
		public $category;
	}
	
	function orderMode()
	{
		global $productList;
		global $productName;
		
		$_SESSION['order_serial']=$_GET['order_serial'];
		$privalege = $_SESSION['privalege'] > 0;
		$disableStr = $privalege ? "":"disabled";
		//ordertable.order_sn,ordertable.order_serial,ordertable.date,ordertable.easyship,ordertable.discount,ordertable.pay,ordertable.send,ordertable.money,ordertable.market,ordertable.message,ordertable.shipping,ordertable.point_used,ordertable.point_gained,ordertable.customer_sn,ordertable.member_sn
		$selectField = "ordertable.*,customer.name,customer.email,customer.mobile,customer.addr,customer.zip";
		$whereCond = "ordertable.order_serial = {$_GET['order_serial']}";
		$sql = "select {$selectField} from ordertable inner join customer on ordertable.customer_sn = customer.customer_sn where {$whereCond}";
		$sqlReturn = Q($sql,"無法查詢訂單資料!");
					
		if($data=mysql_fetch_array($sqlReturn))
		{			
			$currentOrderSN=$data['order_sn'];
			if($data['member_sn']!=0)
			{
				$memberAsterik="是";
				$nameStr="<a href='{$_SERVER['PHP_SELF']}?mode=memberMode&member_sn={$data['member_sn']}'>{$data['name']}</a>";
			}//if
			else
			{
				$memberAsterik="";
				$nameStr=$data['name'];
			}
$buttonJS=<<<BUTTON_JS
			
<script type='text/javascript'>
	
	function deliver_click()
	{
		var butt=document.getElementById('deliveryButt');
		
		if(confirm('你確定要'+butt.value))
		{
			var form=document.getElementById('deliver_form');
			form.submit();
		}
	}
	
	function collect_click()
	{
		var butt=document.getElementById('collectButt');
		
		if(confirm('你確定要'+butt.value))
		{
			var form=document.getElementById('collect_form');
			form.submit();
		}
	}
	
	function deauthor_click()
	{
		if(confirm('你確定要取消授權'))
		{
			var form=document.getElementById('deauthor_form');
			form.submit();
		}
	}
	
	function cancel_click()
	{
		var butt=document.getElementById('cancelButt');
		
		if(confirm('你確定要'+butt.value))
		{
			var form=document.getElementById('cancel_form');
			form.submit();
		}
	}
</script>
			
BUTTON_JS;
			echo $buttonJS;
		
            $strikeLine = $data['canceled'] ? "style='text-decoration: line-through;'":"";
            echo "<h3>訂單號碼<span {$strikeLine}>{$_GET['order_serial']}</span></h3>";
			echo "<table class='rzTable' border='1'>";			
			if($data['canceled'])
			{
				$cancelStr="訂單已取消 <form id='cancel_form' action='markOrder.php' method='post' style='display:inline-block'><input type='hidden' name='operation' value='cancel'><input type='hidden' name='canceled' value='false'><input type='button' id='cancelButt' class='rzButton' value='恢復訂單' onClick='cancel_click()' {$disableStr}></form>";
			}
			else
			{
				$cancelStr="一般訂單 <form id='cancel_form' action='markOrder.php' method='post' style='display:inline-block'><input type='hidden' name='operation' value='cancel'><input type='hidden' name='canceled' value='true'><input type='button' id='cancelButt' class='rzButton' value='訂消訂單' onClick='cancel_click()' {$disableStr}></form>";
			}
			
			if($data['canceled_staff']!=0)
			{
                $sql = "select * from member where member_sn={$data['canceled_staff']}";
                $sqlReturn = Q($sql,"無法查詢登記員工編號!");
                if($mdata=mysql_fetch_array($sqlReturn))
                {
	                
       				$cancelDetail="<th class='rzTableHeader'>登記人員</th><td>{$mdata['name']}<br />{$data['canceled_mark']}</td>";
                }
                else
                {
	                $cancelDetail="<th class='rzTableHeader'>登記人員</th><td>編號:{$data['collected_staff']} {$data['canceled_mark']}</td>";
				}
			}
			else
			{
				$cancelDetail="";
			}
            			
			echo "<tr><th class='rzTableHeader'>訂單狀態</th><td>{$cancelStr}</td>{$cancelDetail}</tr>";
			echo "<tr><th>EZSHIP		</th><td>{$data['easyship']}	</td></tr>";
			echo "<tr><th>日期			</th><td>{$data['date']}		</td></tr>";
			echo "<tr><th>姓名			</th><td>{$nameStr}		</td><th>會員			</th><td>{$memberAsterik}		</td></tr>";
			echo "<tr><th>email			</th><td>{$data['email']}		</td><th>mobile			</th><td>{$data['mobile']}		</td></tr>";
			echo "<tr><th>地址			</th><td>{$data['addr']}		</td><th>zip			</th><td>{$data['zip']}			</td></tr>";
			
			if($data['pay']=='信用卡')
			{
				$creditLink="<a href='{$_SERVER['PHP_SELF']}?mode=creditMode&order_sn={$data['order_sn']}'>{$data['pay']}</a>";
			}//if
			else
			{
				$creditLink="{$data['pay']}";
			}
			
			echo "<tr><th>付款方式		</th><td>{$creditLink}</td></tr>";
			echo "<tr><th>寄送方式		</th><td>{$data['send']}		</td>";
				if($data['send']=="超商取貨")
				{
					echo "<th>超商		</th><td>{$data['market']}		</td></tr>";
				}//if
				else
				{
					echo "</tr>";
				}
			echo "<tr><th>備註			</th><td>{$data['message']}		</td></tr>";

			//舊式訂單細節
            /*
			$selectField = "";
			$firstItem=true;
			foreach($productList as $item)
			{
				if(!$firstItem)
				{
					$selectField = $selectField." ,";
				}
				$firstItem=false;
				$selectField=$selectField.$item;
			}
			$whereCond = "order_sn = {$currentOrderSN}";
			$sql = "select {$selectField} from orderdetail where {$whereCond}";
			$sqlReturn = Q($sql,"無法查詢訂單細節!");
						
			while($pdata=mysql_fetch_array($sqlReturn))
			{
				echo "<tr><th>商品內容(7/23之前紀錄)</th><td colspan='3'><table class='rzDetailTable'>";
				foreach($productList as $item)
				{
					$itemName = $productName[$item];
					if($pdata[$item]!=0)
					{
						echo "<tr><td>{$itemName} x $pdata[$item]</td></tr>";
					}					
				}
				echo "</table></td></tr>";
			}
            */
            
            //讀取商品資料
            $productItems = array();
			$sql = "select product,name,category,price from productList";
			$sqlReturn = Q($sql,"無法查詢商品資料庫!");
			while($dataP=mysql_fetch_array($sqlReturn))
			{
            	$productName=$dataP['product'];
            	$productItems[$productName]=new productData();
                $productItems[$productName]->name=$dataP['name'];
                $productItems[$productName]->price=$dataP['price'];
                $productItems[$productName]->category=$dataP['category'];
			}
            
            
            //新式訂單細節            
			$whereCond = "order_sn = {$currentOrderSN}";
			$sql = "select * from order_detail where {$whereCond}";
			$sqlReturn = Q($sql,"無法查詢訂單細節!");
						
			echo "<tr><th>商品內容</th><td colspan='3'><table class='rzDetailTable'>";
			while($pdata=mysql_fetch_array($sqlReturn))
			{
            	$productName=$productItems[$pdata['product']]->name;
                
	            echo "<tr><td>{$productName}</td><td>{$pdata['price']} x {$pdata['count']}</td></tr>";
			}
			echo "</table></td></tr>";
            
            
			echo "<tr><th>商品金額</th><td>{$data['merchantTotal']}		</td><th>折扣			</th><td>{$data['discount']}	</td></tr>";
			echo "<tr><th>運費</th><td>{$data['shipping']}	</td><th>結算金額</th><td>{$data['money']}		</td></tr>";
			echo "<tr><th>使用紅利		</th><td>{$data['point_used']}	</td><th>獲得紅利		</th><td>{$data['point_gained']}	</td></tr>";
            
			if($data['delivery']=='未出貨')
			{
				$deliver_function = "<form id='deliver_form' action='markOrder.php' method='post' style='display:inline-block'><input type='hidden' name='operation' value='delivery'><input type='hidden' name='delivery' value='已出貨'><input type='button' id='deliveryButt' name='delivery' class='rzButton' value='出貨' onClick='deliver_click()' {$disableStr}></form>";
			}
			else
			{
				$deliver_function = "<form id='deliver_form' action='markOrder.php' method='post' style='display:inline-block'><input type='hidden' name='operation' value='delivery'><input type='hidden' name='delivery' value='未出貨'><input type='button' id='deliveryButt' name='delivery' class='rzButton' value='取消出貨' onClick='deliver_click()' {$disableStr}></form>";
			}
			
			if($data['deliver_staff']!=0)
			{
                $sql = "select * from member where member_sn={$data['deliver_staff']}";
                $sqlReturn = Q($sql,"無法查詢登記員工編號!");
                if($mdata=mysql_fetch_array($sqlReturn))
                {
	                $deliverStaff="{$mdata['name']}<br />{$data['deliver_mark']}";
                }
                else
                {
	                $deliverStaff="編號:{$data['deliver_staff']} {$data['deliver_mark']}";
				}
			}
			else
			{
				$deliverStaff="";
			}
			
			if($data['collected']=='未收款')
			{
            	//值剛好相反
            	$collectedValue='已收款';
                $buttonValue='收款登記';
			}
			else
			{
            	//值剛好相反
            	$collectedValue='未收款';
                $buttonValue='取消收款';
			}
            $collect_function = "<form id='collect_form' action='../admin/markOrder.php' method='post' style='display:inline-block'>
                                    <input type='hidden' name='operation' value='collect'>
                                    <input type='hidden' name='collected' value='{$collectedValue}'>
                                    <input type='hidden' name='order_member' value='{$data['member_sn']}'>
                                    <input type='hidden' name='dealer_sn' value='{$data['dealer_sn']}'>
                                    <input type='hidden' name='point_gained' value='{$data['point_gained']}'>
                                    <input type='hidden' name='merchantTotal' value='{$data['merchantTotal']}'>
                                    <input type='hidden' name='discount' value='{$data['discount']}'>
                                    <input type='button' class='rzButton' id='collectButt' value='{$buttonValue}' onClick='collect_click()' {$disableStr}>
                                 </form>";
			
			if($data['collected_staff']!=0)
			{
                $sql = "select * from member where member_sn={$data['collected_staff']}";
                $sqlReturn = Q($sql,"無法查詢登記員工編號!");
                if($mdata=mysql_fetch_array($sqlReturn))
                {
	                $collectStaff="{$mdata['name']}<br />{$data['collected_mark']}";
                }
                else
                {
	                $collectStaff="編號:{$data['collected_staff']} {$data['collected_mark']}";
				}
			}
			else
			{
				$collectStaff="";
			}
			
            if($data['pay']=='信用卡')
            {
                if($data['deauthor']==0)
                {
                    $deauthor_function = "未取消<span class='tab'></span>
                    <form id='deauthor_form' action='markOrder.php' method='post' style='display:inline-block'>
                    	<input type='hidden' name='operation' value='deauthor'>
                        <input type='hidden' name='deauthor' value='1'>
                        <input type='hidden' name='ONO' value='{$data['order_serial']}'>
                        <input type='button' class='rzButton' id='deauthorButt' value='取消授權' onClick='deauthor_click()' {$disableStr}>
                    </form>";
                }
                else
                {
                    $deauthor_function = "已取消";
                }
			}
            else
            {
            	$deauthor_function = "";
            }
            
			if($data['deauthor_staff']!=0)
			{
                $sql = "select * from member where member_sn={$data['deauthor_staff']}";
                $sqlReturn = Q($sql,"無法查詢登記員工編號!");
                if($mdata=mysql_fetch_array($sqlReturn))
                {
	                $deauthorStaff="{$mdata['name']}<br />{$data['deauthor_mark']}";
                }
                else
                {
	                $deauthorStaff="編號:{$data['deauthor_staff']} {$data['deauthor_mark']}";
				}
			}
			else
			{
				$deauthorStaff="";
			}
			
			if($data['dealer_sn']!=0)
			{
                $sql = "select * from member where member_sn={$data['dealer_sn']}";
                $sqlReturn = Q($sql,"無法查詢經銷商!");
                if($mdata=mysql_fetch_array($sqlReturn))
                {
	                $dealerStr="<a href='index.php?mode=memberMode&member_sn={$data['dealer_sn']}'>{$mdata['name']}</a>";
                }
                else
                {
	                $dealerStr="編號:{$data['dealer_sn']}";
				}
			}
			else
			{
				$dealerStr="";
			}
            
			echo "<tr><th>出貨</th><td>{$data['delivery']}<span class='tab'></span>{$deliver_function}</td><th>登記人員</th><td>{$deliverStaff}</td></tr>";
			echo "<tr><th>收款並確認紅利</th><td>{$data['collected']}<span class='tab'></span>{$collect_function}</td><th>登記人員</th><td>{$collectStaff}</td></tr>";
			echo "<tr><th>取消授權</th><td>{$deauthor_function}</td><th>登記人員</th><td>{$deauthorStaff}</td></tr>";
			echo "<tr><th>經銷商</th><td>{$dealerStr}</td></tr>";
			echo "</table>";
		}
	}//orderMode


?>