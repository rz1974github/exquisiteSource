<?php
		
	include_once("../common/sql_common.php");

	function pointTransMode()
	{
		$jsCode=<<<JSCODE
		
		<script>
		
		function checkOrder(order_serial,date,money,discount)
		{
			this.order_serial=order_serial;
			this.date=date;
			this.money=money;
			this.discount=discount;
		}
		
		var orderArray=new Array();
		
		var checkout=function(event)
		{
			event.preventDefault();
			
			/*
			for(var key in orderArray)
			{
				alert("orderArray["+key+"].orderSerial="+orderArray[key].order_serial);
			}
			*/
			
			if(orderArray.length>0)
			{
				var oJason=document.getElementById('jasonData');
				
				oJason.value=JSON.stringify(orderArray);
				$('#checkOutForm').submit();
			}
			else
			{
				alert('沒有符合條件的訂單紅利可領取');
			}
		}
		
		</script>
		
JSCODE;
		
        echo $jsCode;
		echo "<h2>紅利紀錄</h2>";

		$whereCond = "member_sn={$_GET['member_sn']}";
		
		$sql = "select * from pointTrans where {$whereCond}";
		$sqlReturn = Q($sql,"無法查詢紅利資料!");
		
        $orderIndex=0;
        
        if(mysql_num_rows($sqlReturn)>0)        
        {
            echo "<table class='rzTable' style='font-size:80%'>";
            echo "<tr><th>日期</th><th>原紅利數</th><th>新增紅利</th><th>新紅利數</th><th>訂單</th><th>備註</th><th>登錄人員</th></tr>";
            while($data=mysql_fetch_array($sqlReturn))
            {
                echo "<tr>";
                
                echo "<td>{$data['date']}</td>";
                echo "<td>{$data['fromPoint']}</td>";
                echo "<td>{$data['trans']}</td>";
                echo "<td>{$data['toPoint']}</td>";
                echo "<td><a href='{$_SERVER['PHP_SELF']}?mode=orderMode&order_serial={$data['order_serial']}'>{$data['order_serial']}</a></td>";
                echo "<td style='width:12em'>{$data['comment']}</td>";
                
                if($data['operator']!=0)
                {
                    $sqlM = "select * from member where member_sn={$data['operator']}";
                    $sqlReturnM = Q($sqlM,"無法查詢登記員工編號!");
                    if($dataM=mysql_fetch_array($sqlReturnM))
                    {
                        echo "<td>{$dataM['name']}</td>";
                    }
                    else
                    {
                        echo "<td>編號:{$data['operator']}</td>";
                    }
                }
                else
                {
	                echo "<td></td>";
                }
                echo "</tr>";
            }
            echo "</table>";
		}//if
        else
        {
        	echo "<h3>尚未有紅利紀錄</h3>";
        }
	}//pointTransMode
?>