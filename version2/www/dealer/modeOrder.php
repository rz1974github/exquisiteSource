<?php
	
	include_once("../global.php");	
	include_once("../common/sharedCode.php");		
	include_once("../common/sql_common.php");	
	
	function modeOrder($dealerSN=0,$dealerName="",$memberSN=0)
	{	
		if(isset($_SESSION['pointsToUse']))
		{
			echo "<script>var js_pointsToUse={$_SESSION['pointsToUse']};</script>";
		}
		else
		{
			echo "<script>var js_pointsToUse=0;</script>";
		}
				
		if(isset($_GET['nonMember']))
		{
			//非會員模式
			$_SESSION['orderMode']=0;
			$_SESSION['order_discount']=1.0;
		}
				
		if(isset($_GET['dealerSN']))
		{
			$dealerSN=$_GET['dealerSN'];
			//經銷商模式
			$_SESSION['orderMode']=1;
		}
				
		if(!isset($_SESSION['useDealer']))
		{
			$_SESSION['useDealer']=false;
			//echo 'useDealer is false';
		}
		else
		{
			$_SESSION['useDealer']=true;
			//echo 'useDealer is true';
		}
		
		$_SESSION['currentDealer']=$dealerSN;
				
		if(isset($_GET['memberSN']))
		{
			$memberSN=$_GET['memberSN'];
			//會員模式
			$_SESSION['orderMode']=2;
			$_SESSION['currentMember']=$memberSN;
		}
		
		if(!isset($_SESSION['shippingFee']))
		{
			$_SESSION['shippingFee']=$_SESSION['basicShipping'];
		}
		
        //經銷商模式
		if($_SESSION['orderMode']==1)
		{
			$sql = "select * from member where member_sn={$_SESSION['currentDealer']}";
			$sqlReturn = Q($sql,"無法查詢會員資料!");
			$dataD=mysql_fetch_array($sqlReturn);
		}
		
$javaCode=<<<JAVA_CODE_SEC
		
		<script type='text/javascript'>		
		
		//copy value from PHP
		var js_noFeeAmount={$_SESSION['noFeeAmount']};
		var js_shippingFee={$_SESSION['shippingFee']};
		var js_basicShipping={$_SESSION['basicShipping']};
		var js_useDealer={$_SESSION['useDealer']};
		
		function memberData(member_sn,discount,email,name,mobile,zip,addr,point,isDealer)
		{
			this.member_sn = member_sn;
			this.discount = discount;
			this.email = email;
			this.name = name;
			this.mobile = mobile;
			this.zip = zip;
			this.addr = addr;
			this.point=point;
			this.isDealer = isDealer;
		}
		
		var mdArray = new Array();
		
		var totalProduct=0;
		var productAdded=new Array();
		
		function productItem(pType,pName,count,price)
		{
			this.type=pType;
			this.name=pName;
			this.count=count;
			this.price=price;
		}
		
		function addProduct()
		{
			var oProductType=document.getElementById('productType');
			var oProductQty=document.getElementById('productQty');
			var oAddLine=document.getElementById('addLine');
			
			var product=oProductType.options[oProductType.selectedIndex].text;
			var productTP=oProductType.options[oProductType.selectedIndex].value;
			var price=oProductType.options[oProductType.selectedIndex].getAttribute('data-price');
			var count=oProductQty.options[oProductQty.selectedIndex].value;
			
			if(oProductType.selectedIndex==0)
			{
				alert('請選擇種類!');
				return;
			}
			
			if(count<=0)
			{
				alert('請選擇數量!');
				return;
			}
			
			oProductType.value = "gardenia100";
			oProductQty.value=0;
			
			productAdded[totalProduct]=new productItem(productTP,product,count,price);
			totalProduct++;
			repaintTable();
		}

		var totalCount=0;
		var totalAmount=0;

		function repaintTable()
		{
			var adder=$('#addLine').clone();
			var titleLine=$('#titleLine').clone();
			var headerLine=$('#headerLine').clone();
			var totalLine=$('#totalLine').clone();
			
			totalCount=0;
			totalAmount=0;
			
			$('#addTable').empty();
			$('#addTable').append(titleLine);
			$('#addTable').append(headerLine);
			$('#addTable').append(adder);
			
			for(var index in productAdded)
			{
				var obj=productAdded[index];
				var haLine=$('<tr>');
				var buttonStr="<button onclick='removeCart(event,"+index+")' class='rzFormInput'>X</button>";
				haLine.append($('<td>').html(buttonStr));
				haLine.append($('<td>').text(obj.name));
				haLine.append($('<td style="text-align:right">').text(obj.price));
				haLine.append($('<td style="text-align:right">').text(obj.count));
				totalCount+=parseInt(obj.count);
				var smallAmount=obj.price * obj.count;
				haLine.append($('<td style="text-align:right">').text(smallAmount));
				totalAmount+=smallAmount;				
				$('#addTable tr:last').before(haLine);
			}
			
			updateCalculate();
		}
		
		function updateCalculate()
		{			
			dealerPoints();
			
			//因為已經 append到 addTable, 所以可以找到
			$('#totalCount').text(totalCount);
			$('#merchantTotal').val(totalAmount);
			
			//折扣後金額
			var js_discount_merchant=Math.round(totalAmount*$('#order_discount').val())-js_pointsToUse;			
			$('#discount_merchant').val(js_discount_merchant);
			
			//運費
			if(js_discount_merchant>=js_noFeeAmount)
			{
				js_shippingFee=0;
			}
			else
			{
				js_shippingFee=js_basicShipping;
			}
			$('#shippingFee').val(js_shippingFee);
			
			//新增點數
			var newPoints=Math.floor(js_discount_merchant*0.01)*5.0;
			$('#newPoints').val(newPoints);
			
			//計算金額
			var totalMoney=js_discount_merchant+js_shippingFee;
			$('#total_money').val(totalMoney);
		}
		
		function submitProduct(event)
		{
			event.preventDefault();
			
			if(productAdded.length<1)
			{
				alert('請至少選擇一樣商品!');
				return;
			}
			
			if($('#order_type').val()==0)
			{
				alert('請選擇付款方式');
				return;
			}
			
			if($('#deliever').val()==0)
			{
				alert('請選擇取貨方式');
				return;
			}
			
			if($('#ship_name').val()=="")
			{
				alert('請輸入提貨人姓名');
				return;
			}
			
			if($('#ship_mobile').val()=="")
			{
				alert('請輸入提貨人電話');
				return;
			}
			
			if($('#ship_email').val()=="")
			{
				alert('請輸入提貨通知email');
				return;
			}

			if($('#deliever').val()=="1")
			{
				if($('#ship_addr').val()=="")
				{
					alert('請輸入提貨人地址');
					return;
				}
				if($('#ship_zip').val()=="")
				{
					alert('請輸入提貨人郵遞區號');
					return;
				}
			}
			
			var oForm=document.getElementById('productForm');
			var oJason=document.getElementById('jasonData');
			
			oJason.value=JSON.stringify(productAdded);
			
			oForm.submit();
		}
		
		function removeCart(event,index)
		{
			event.preventDefault();
			
			productAdded.splice(index,1);
			
			repaintTable();
		}
		
		function chooseMember(event,index)
		{
			if(event!=null)
			{
				event.preventDefault();
			}
			
			var pmember=mdArray[index];
			$('#order_discount').val(pmember.discount);
			$('#ship_name').val(pmember.name);
			$('#ship_mobile').val(pmember.mobile);
			$('#ship_email').val(pmember.email);
			$('#ship_addr').val(pmember.addr);
			$('#ship_zip').val(pmember.zip);
			$('#order_member').val(pmember.member_sn);
			$('#order_member_email').val(pmember.email);
			
			if(pmember.isDealer)
			{
				js_useDealer=true;
				$('#useDealer').val('true');
			}
			else
			{
				js_useDealer=false;
				js_pointsToUse=0;
				$('#useDealer').val('false');
				$('#toPoint').html('<input type="hidden" name="pointsToUse" value="0">');
				$('#oldPoints').val(0);
			}
			updateCalculate();
		}
		
		function pointChanged(event)
		{
			event.preventDefault();
			
			js_pointsToUse=$('#id_pointsToUse').val();
			
			updateCalculate();
		}
		
		var discountChanged=function()
		{
			updateCalculate();
		}
		
		var delieverChanged=function()
		{
			var oDeliever=document.getElementById("deliever");
			
			if(oDeliever.value==3)
			{
				//超商店配
				$('#delieverTime').val(1);
				$('#delieverTime').prop('disabled',true);
				$('#zipLine').hide();
				$('#addrLine').hide();
				$('#shopLine').show();
			}
			else
			{
				//宅配
				$('#delieverTime').prop('disabled',false);
				$('#zipLine').show();
				$('#addrLine').show();
				$('#shopLine').hide();
			}
		}
		
		var reshop=function(event)
		{
			event.preventDefault();
			
			$('#forceReshop').val('true');
			submitProduct(event);
		}
		
		</script>
        
JAVA_CODE_SEC;

        echo $javaCode;			
		
        echo "<div class='row'>";
        echo "<div class='12u' style='padding:0em 2em 2em 2em;'>";
            
        $privalege = $_SESSION['privalege'] > 0;
        
        $mIndex=0;
        //經銷商模式
        if($_SESSION['orderMode']==1)
        {
            //會員名單
            $sql = "select * from member where belongDealer={$_SESSION['currentDealer']}";
            $sqlReturn = Q($sql,"無法查詢會員資料!");
            
            echo "<table class='rzTable'>";
            echo "<tr><th>代訂會員</th><th style='colsize=20em'>email</th><th>折扣</th><th>名字</th></tr>";
            
            //代訂名單
            while($data=mysql_fetch_array($sqlReturn))
            {
$memberSec=<<<MEMBER_SEC
    
                <script type='text/javascript'>            
                    mdArray[{$mIndex}]=new memberData('{$data['member_sn']}','{$data['discount']}','{$data['email']}','{$data['name']}','{$data['mobile']}','{$data['zip']}','{$data['addr']}',0,false);
                </script>
    
MEMBER_SEC;
    
                echo $memberSec;
                
                echo "<tr style='font-size:80%'><td><button class='rzFormInput' onclick='chooseMember(event,{$mIndex})'>代訂</button></td><td><a href='{$_SERVER['PHP_SELF']}?mode=memberMode&member_sn={$data['member_sn']}'>{$data['email']}</a></td><td>{$data['discount']}</td><td>{$data['name']}</td></tr>";
                $mIndex++;            
            }
            //以上為旗下會員
            
            if($dataD)
            {
            	$_SESSION['maxPoints']=$dataD['points'];
$dealerData=<<<DEALER_DATA
            
                <script type='text/javascript'>            
                    mdArray[{$mIndex}]=new memberData('{$dealerSN}','{$dataD['discount']}','{$dataD['email']}','{$dataD['name']}','{$dataD['mobile']}','{$dataD['zip']}','{$dataD['addr']}','{$dataD['points']}',true);
                </script>
    
DEALER_DATA;
    
            echo $dealerData;
            echo "<tr style='font-size:80%'><td><button class='rzFormInput' onclick='chooseMember(event,{$mIndex})'>經銷商自訂</button></td><td><a href='{$_SERVER['PHP_SELF']}?mode=memberMode&member_sn={$dealerSN}'>{$dataD['email']}</a></td><td>{$dataD['discount']}</td><td>{$dataD['name']}</td></tr>";
            }
            echo "</table>";
		}//if memberSN
		else
        {
        	//個別會員模式
            
        	if($_SESSION['orderMode']==2)
            {
                //會員資料
                $sql = "select * from member where member_sn={$_SESSION['currentMember']}";
                $sqlReturn = Q($sql,"無法查詢會員資料!");
                if($dataM=mysql_fetch_array($sqlReturn))
                {
            
$memberData=<<<MEMBER_DATA
            
                <script type='text/javascript'>            
                    mdArray[{$mIndex}]=new memberData('{$_SESSION['currentMember']}',
                    '{$dataM['discount']}',
                    '{$dataM['email']}',
                    '{$dataM['name']}',
                    '{$dataM['mobile']}',
                    '{$dataM['zip']}',
                    '{$dataM['addr']}',
                    '{$dataM['points']}',false);
                </script>
    
MEMBER_DATA;
                    $_SESSION['maxPoints']=$dataM['points'];
                    echo $memberData;        	
                }//if
            }//if
            else
            {
            	
                //非會員模式 orderMode==0
                
$memberData=<<<MEMBER_DATA
            
                <script type='text/javascript'>            
                    mdArray[0]=new memberData('0',
                    {$_SESSION['order_discount']},
                    '{$_SESSION['ship_email']}',
                    '{$_SESSION['ship_name']}',
                    '{$_SESSION['ship_mobile']}',
                    '{$_SESSION['ship_zip']}',
                    '{$_SESSION['ship_addr']}',
                    0,false);
                </script>
    
MEMBER_DATA;
                    $_SESSION['maxPoints']=0;
                    echo $memberData;        	
            }
        }//else        
        
$dealerPointJava=<<<DEALER_POINT

		<script>
		function dealerPoints()
		{
			if(!js_useDealer) return;
			
			var totalAmount=parseInt($('#merchantTotal').val());
			var maxPoints=Math.min({$_SESSION['maxPoints']},totalAmount);
			var pointsToUseStr = "<input type='number' class='rzFormInput' style='width:4em' name='pointsToUse' id='id_pointsToUse' min='0' max='" +maxPoints+"' value='"+js_pointsToUse+"' onchange='pointChanged(event)' >點/尚有<span id='id_remain'>{$_SESSION['maxPoints']}</span>點";
			$('#toPoint').html(pointsToUseStr);
            $('#oldPoints').val({$_SESSION['maxPoints']});
		}
        </script>

DEALER_POINT;

		echo $dealerPointJava;        
        $nowStoreStr="";
        if(isset($_SESSION['stName']))
        {
            $nowStoreStr="{$_SESSION['stName']} / 代號：{$_SESSION['stCode']} / 門市電話：{$_SESSION['stTel']} <a href='../dealer/modeOrder25Reshop.php'><button onclick='reshop(event)'>重新選擇門市</button></a>";
        }
        
        if($_GET['nameError']=='true')
        {
        	echo "<script>alert('姓名不能為空白!');</script>";
        }
        
        if($_GET['emailError']=='true')
        {
        	echo "<script>alert('email格式有誤!');</script>";
        }
        
        if($_GET['mobileError']=='true')
        {
        	echo "<script>alert('連絡電話不能為空白!');</script>";
        }
        
        if($_GET['mobileTooLong']=='true')
        {
        	echo "<script>alert('連絡電話不能超過10個字元!');</script>";
        }
        
        if($_GET['addrError']=='true')
        {
        	echo "<script>alert('宅配地址不得為空白!');</script>";
        }
        
        //收件人
$recieverSec=<<<RECEIVER_SEC

		<form id='productForm' action='../dealer/modeOrder20Collect.php' method='post'>
		<table class='rzTable' style='font-size:90%'>
           	<tr><th>收件人</th></tr>
            <tr>
            	<th style='width:18em'><font color="#CB1A5E">*</font>中文全名/提貨人姓名NAME</th>
                <td colspan='3'><input type="text" class='rzFormInput' id="ship_name" name="ship_name" style="width:10em" placeholder="" value="{$_SESSION['ship_name']}" required /></td>
            </tr>
            <tr>
            	<th><font color="#CB1A5E">*</font>電話/提貨人電話MOBILE</th>
                <td colspan='3'><input type="text" class='rzFormInput' id="ship_mobile" name="ship_mobile" style="width:10em" placeholder="" value="{$_SESSION['ship_mobile']}" required /></td>
            </tr>
            <tr>
                <th><font color="#CB1A5E">*</font>電子信箱/提貨通知EMAIL</th>
                <td colspan='3'><input type="email" class='rzFormInput' id="ship_email" name="ship_email" style="width:25em" placeholder="" value="{$_SESSION['ship_email']}" required /></td>
			</tr>
            <tr id='zipLine'>
                <th><font color="#CB1A5E">*</font>郵遞區號ZIP</th>
                <td><input type="text" class='rzFormInput' id="ship_zip" name="ship_zip" style="width:6em" placeholder="" value="{$_SESSION['ship_zip']}" required /></td>
            </tr>
            <tr id='addrLine'>
                <th><font color="#CB1A5E">*</font>地址ADDRESS</th>
                <td><input type="text" class='rzFormInput' id="ship_addr" name="ship_addr" style="" placeholder="" value="{$_SESSION['ship_addr']}" required /></td>
            </tr>
            <tr id='shopLine'>
            	<th>取貨門市</th>
                <td colspan='3'>{$nowStoreStr}</td>
            </tr>
		</table>
RECEIVER_SEC;

		echo $recieverSec;

		//商品
		$productSelect="<select id='productType' class='rzFormInput' style='font-size:80%'><option value='0'>選擇種類</option>";
        
		$sql = "select * from productList";
		$sqlReturn = Q($sql,"無法查詢產品資料!");
		
		while($pdata=mysql_fetch_array($sqlReturn))
		{
        	$option="<option value='{$pdata['product']}' data-price='{$pdata['price']}'>{$pdata['name']}</option>";
            $productSelect.=$option;
        }
        $productSelect.="</select>";

$countSelect=<<<COUNT_SELECT

								<select class='rzFormInput' name='qty' id='productQty' style='font-size:80%'>
                                   <option value='0'>選擇數量</option>
                                   <option value='1'>1</option>
                                   <option value='2'>2</option>
                                   <option value='3'>3</option>
                                   <option value='4'>4</option>
                                   <option value='5'>5</option>
                                   <option value='6'>6</option>
                                   <option value='7'>7</option>
                                   <option value='8'>8</option>
                                   <option value='9'>9</option>
                                   <option value='10'>10</option>
                                   <option value='11'>11</option>
                                   <option value='12'>12</option>
                                </select>

COUNT_SELECT;

$adderStr="<tr id='addLine' style='font-size:80%'><td></td><td style='width:16em'>{$productSelect}</td><td style='width:6em'>{$countSelect}</td><td colspan='2' align='right'><button type='button' onclick='addProduct()'>新增</button></td></tr>";

$productCart="";
$javaAdd="";
if(isset($_SESSION['productCart']))
{
    foreach($_SESSION['productCart'] as $key => $obj)
    {	
        $button="<button onclick='removeCart(event,{$key})' class='rzFormInput'>X</button>";
        $newLine="<tr><td>{$button}</td><td>{$obj->name}</td><td>{$obj->count}</td></tr>";
        $productCart.=$newLine;
        $javaAdd.="<script>productAdded[{$key}]=new productItem('{$obj->type}','{$obj->name}',{$obj->count},{$obj->price});</script>";    
    }
    $productCount=count($_SESSION['productCart']);
    $javaAdd.="<script>totalProduct={$productCount};</script>";
}

$order_typeSel[3]="";
$order_typeSel[1]="";
$order_typeSel[10]="";
if(isset($_SESSION['order_type']))
{
	$order_typeSel[$_SESSION['order_type']]="selected";
}

$delieverSel[1]="";
$delieverSel[3]="";
if(isset($_SESSION['deliever']))
{
	$delieverSel[$_SESSION['deliever']]="selected";
}

$delieverTimeSel[0]="selected";
$delieverTimeSel[1]="";
$delieverTimeSel[2]="";
$delieverTimeSel[3]="";
$delieverTimeSel[4]="";
if(isset($_SESSION['delieverTime']))
{
	$delieverTimeSel[0]="";
	$delieverTimeSel[$_SESSION['delieverTime']]="selected";
}


$selectDiscount=<<<SELECT_DISCOUNT

						<select name='order_discount' id='order_discount' class='rzFormInput' value='{$_SESSION['order_discount']}' style='width:7em' onchange='discountChanged()'>
	                        <option value='1.0'  >原價</option>
	                        <option value='0.95' >九五折</option>
							<option value='0.9'  >九折</option>
							<option value='0.85' >八五折</option>
							<option value='0.8'  >八折</option>
							<option value='0.75' >七五折</option>
                            <option value='0.7'  >七折</option>
                            <option value='0.65' >六五折</option>
                            <option value='0.6'  >六折</option>
						</select>

SELECT_DISCOUNT;

$pointSec=<<<POINT_SEC

        <tr>
        	<th>新增紅利</th><td><input class='rzReadOnlyNumber' type='text' name='newPoints' id='newPoints' value='{$_SESSION['newPoints']}' readonly></td>
            <th>使用紅利</th><td id='toPoint' style='text-align:right'><input type='hidden' name='pointsToUse' value='0'></td>
        </tr>

POINT_SEC;

$readonlyDiscount="<input class='rzReadOnlyNumber' type='text' name='order_discount' id='order_discount' value='{$_SESSION['order_discount']}' readonly>";

if($_SESSION['orderMode']==0)
{
	$discountStr=$selectDiscount;
    $pointSectionStr="";
}
else
{
	$discountStr=$readonlyDiscount;
    $pointSectionStr=$pointSec;
}

$tableSec=<<<TABLE_SEC

    <table id='addTable'  class='rzTable' style='font-size:90%'>
        <tr id='titleLine'><th colspan=5 style='text-align:center'>購物車</th></tr>
        <tr id='headerLine'><th></th><th>名稱</th><th >單價</th><th>數量</th><th>小計</th></tr>
        {$productCart}        
		<tr id='addLine'><td></td><td style='width:12em' colspan='2'>{$productSelect}</td><td style='width:10em'>{$countSelect}</td><td><button type='button' onclick='addProduct()'>新增</button></td></tr>
    </table>
    <table class='rzTable' style='font-size:90%'>
    	
        <tr id='totalLine'>
        	<th style='width:9em'>總件數</th><td id='totalCount' style='text-align:right'>{$totalCount}</td>
            <th>總計</th><td><input class='rzReadOnlyNumber' type='text' name='merchantTotal' id='merchantTotal' value='0' readonly></td>
        </tr>
        {$pointSectionStr}
        <tr>
        	<th>折扣</th><td>{$discountStr}</td>
        	<th>折扣後金額</th><td><input class='rzReadOnlyNumber' type='text' name='discount_merchant' id='discount_merchant' value='{$_SESSION['discount_merchant']}' readonly></td>
        </tr>
        <tr>
        	<th style='border-left:hidden;border-bottom:hidden;'></th><td style='border-left:hidden;border-bottom:hidden;'></td>
        	<th>運費</th><td><input class='rzReadOnlyNumber' type='text' name='shippingFee' id='shippingFee' value='{$_SESSION['shippingFee']}' readonly></td>
        </tr>
        <tr>
        	<th style='border:hidden;'></th><td style='border-left:hidden;border-top:hidden;border-bottom:hidden;'></td>
            <th>計算後總金額</th><td><input class='rzReadOnlyNumber' type='text' name='total_money' id='total_money' value='{$_SESSION['total_money']}' readonly></td>
        </tr>
    </table>
    </div>
    </div>
    <div class="row">
		<div class="4u"> 
            <select id="order_type" name="order_type" class='rzFormInput' style="width: 100%;font-size:80%">
                <option value="0">--選擇付款方式--</option>
                <option value="3" {$order_typeSel[3]}>ATM付款</option><!-- value 是 easyShip要用 -->
                <option value="1" {$order_typeSel[1]}>貨到付款</option><!-- value 是 easyShip要用 -->
                <option value="10" {$order_typeSel[10]}>信用卡線上刷卡</option>
            </select>        
	    </div>                                
		<div class="4u"> 
            <select id="deliever" class='rzFormInput' name="deliever" style="width: 100%;font-size:80%" onChange="delieverChanged()">
                <option value="0">--選擇取貨方式--</option>   
                <option value="1" {$delieverSel[1]}>宅配</option>
                <option value="3" {$delieverSel[3]}>超商店配(全家 萊爾富 OK)</option>
            </select>                                           
	    </div>
		<div class="4u"> 
            <select id="delieverTime" class='rzFormInput' name="delieverTime" style="width: 100%;font-size:80%" readonly>
                <option value="0" {$delieverTimeSel[0]}>--指定送貨時段--</option>
                <option value="1" {$delieverTimeSel[1]}>不指定時間</option>
                <option value="2" {$delieverTimeSel[2]}>中午以前</option>
                <option value="3" {$delieverTimeSel[3]}>12~17時</option>
                <option value="4" {$delieverTimeSel[4]}>17~20時</option>
            </select>                                        
	    </div>                                
    </div>
	<div class='row'>
		<div class="6u">
            <div class="row 0%">
                <div class="12u">發票資訊</div>
                <div class="12u">EXQUISITE 隨貨附發票如需統編請於備註欄中留下公司抬頭及統一編號。</div>
            </div>
        </div><!-- 6u -->    	
	    <div class='6u'>
           	備註:<input class='rzFormInput' type='text' name='message' value='{$_SESSION['message']}'/>
        </div>
    </div>
    
    <input type='hidden' name='jasonData' id='jasonData' />
    <input type='hidden' name='useDealer' id='useDealer' value='false' />
    <input type='hidden' name='order_member' id='order_member' value='{$_SESSION['order_member']}' />
    <input type='hidden' name='order_member_email' id='order_member_email' value='{$_SESSION['order_member_email']}' />
    <input type='hidden' name='oldPoints' id='oldPoints' value='0' />
    <input type='hidden' id='forceReshop' name='forceReshop' value='false' />
{$javaAdd}
<script>repaintTable();</script>
<script>delieverChanged();</script>

TABLE_SEC;
        echo $tableSec;
        
$formTail=<<<FORM_TAIL
        
	<div class='row'>
	    <div class='12u'>
    		<input type='submit' class='rzFormSubmit' value='送出' onclick='submitProduct(event)' />
        </div>
    </div>
</form>

FORM_TAIL;

	echo $formTail;
        if($_SESSION['useDealer']=='true')
        {
        	echo "<script>chooseMember(event,{$mIndex})</script>";
        }
        
        if(($_SESSION['orderMode']==0) || ($_SESSION['orderMode']==2))
        {
        	echo "<script>chooseMember(event,0)</script>";
        }
        
	}//modeOrder	
?>