<?php

function payEnum(&$order_type)
{
	if($order_type=="1")
	{
			return "貨到付款";
	}//if 
	
	if($order_type=="10")
	{
			return "信用卡";
	}//if 
	//order_type=="3" 
	return "ATM";
}

function sendEnum(&$deliever)
{
	if($deliever=="1")
	{
		return "宅配";
	}
	
	return "超商取貨";	
}

function purchaseType(&$order_type,&$deliever)
{
	if($order_type=="1")
	{
		if($deliever=="1")
		{
			return "宅配貨到付款";
		}
		else
		{
			return "超商取貨付款";
		}//else
	}//if 
	else
	{
		if($order_type=="3")
		{
			if($deliever=="1")
			{
				return "ATM匯款後宅配";
			}
			else
			{
				return "ATM匯款後超商取貨";
			}//else
		}
		else
		{
			if($deliever=="1")
			{
				return "信用卡付款後宅配";
			}
			else
			{
				return "信用卡付款後超商取貨";
			}//else
		}
	}//else
	
	return "(None)";
}

		$chineseNumber = array( '零',
								'一',
								'二',
								'三',
								'四',
								'五',
								'六',
								'七',
								'八',
								'九',
								'十',
								'十一',
								'十二',
								'十三',
								'十四',
								'十五',
								'十六',
								'十七',
								'十八',
								'十九',
								'二十');
		
		$productList = array('gardenia100','gardenia25',
							 'rose100','rose25',
							 'lavender100','lavender25',
							 'lemongrass100','lemongrass25',
							 'magnolia100','magnolia25',
							 'cypress100','cypress25',
							 'collagen100','collagen25',
							 'egg100','egg25',
							 'pearl100','pearl25',
							 'SpecialNanoSoap25','SpecialPearl25',
							 'gift_small','gift_care',
							 'gift_energy','gift_young',
							 'set_tender','set_candy'
							 );
		$productName = array('gardenia100'=>'梔子花 100g',
							 'gardenia25'=>'梔子花 25g',
							 'rose100'=>'玫瑰花 100g',
							 'rose25'=>'玫瑰花 25g',
							 'lavender100'=>'薰衣草 100g',
							 'lavender25'=>'薰衣草 25g',
							 'lemongrass100'=>'檸檬草 100g',
							 'lemongrass25'=>'檸檬草 25g',
							 'magnolia100'=>'玉蘭花 100g',
							 'magnolia25'=>'玉蘭花 25g',							 
							 'cypress100'=>'檜木 100g',
							 'cypress25'=>'檜木 25g',
							 'collagen100'=>'膠原矽皂 100g',
							 'collagen25'=>'膠原矽皂 25g',
							 'egg100'=>'蛋殼矽皂 100g',
							 'egg25'=>'蛋殼矽皂 25g',
							 'pearl100'=>'珍珠矽皂 100g',
							 'pearl25'=>'珍珠矽皂 25g',
							 'SpecialNanoSoap25'=>'免費體驗-奈米矽皂',
							 'SpecialPearl25'=>'珍珠矽皂 25g 特價',
							 'gift_small'=>'小資體驗組 5入/盒',
							 'gift_care'=>'精選保養組 4入/盒',
							 'gift_energy'=>'輕洗顏活力組 4入/組',
							 'gift_young'=>'逆青春駐顏組 4入/盒',
							 'gift-100A'=>'經典組合A',
							 'set_tender'=>'植淬賦活組 100g 4入/組',
							 'set_candy'=>'植淬賦活組 25g 5入/組'
							 );
		$productCategory = array(
							 'gardenia100'=>'基礎清洗顏',
							 'gardenia25'=>'基礎清洗顏',
							 'rose100'=>'基礎清洗顏',
							 'rose25'=>'基礎清洗顏',
							 'lavender100'=>'基礎清洗顏',
							 'lavender25'=>'基礎清洗顏',
							 'lemongrass100'=>'基礎清洗顏',
							 'lemongrass25'=>'基礎清洗顏',
							 'magnolia100'=>'基礎清洗顏',
							 'magnolia25'=>'基礎清洗顏',							 
							 'cypress100'=>'基礎清洗顏',
							 'cypress25'=>'基礎清洗顏',
							 'collagen100'=>'逆青春駐顏保養系列',
							 'collagen25'=>'逆青春駐顏保養系列',
							 'egg100'=>'逆青春駐顏保養系列',
							 'egg25'=>'逆青春駐顏保養系列',
							 'pearl100'=>'逆青春駐顏保養系列',
							 'pearl25'=>'逆青春駐顏保養系列',
							 'SpecialNanoSoap25'=>'特惠活動',
							 'SpecialPearl25'=>'特惠活動',
							 'gift_small'=>'任選系列',
							 'gift_care'=>'任選系列',
							 'gift_energy'=>'任選系列',
							 'gift_young'=>'任選系列',
							 'gift-100A'=>'任選系列',
							 'set_tender'=>'任選系列',
							 'set_candy'=>'任選系列'
							 );
							 
		$productPrice = array('gardenia100'=>280,
							 'gardenia25'=>80,
							 'rose100'=>280,
							 'rose25'=>80,
							 'lavender100'=>280,
							 'lavender25'=>80,
							 'lemongrass100'=>280,
							 'lemongrass25'=>80,
							 'magnolia100'=>280,
							 'magnolia25'=>80,							 
							 'cypress100'=>280,
							 'cypress25'=>80,
							 'collagen100'=>350,
							 'collagen25'=>105,
							 'egg100'=>380,
							 'egg25'=>120,
							 'pearl100'=>420,
							 'pearl25'=>135,
							 'SpecialNanoSoap25'=>0,
							 'SpecialPearl25'=>101,
							 'gift_small'=>360,
							 'gift_care'=>390,
							 'gift_energy'=>980,
							 'gift_young'=>1190,
							 'set_tender'=>0,
							 'set_candy'=>0
							 );
							 
		$productPhoto= array('gardenia100'=>'PIC00-1.png',
							 'gardenia25'=>'PIC00-1-3.png',
							 'rose100'=>'PIC00-2.png',
							 'rose25'=>'PIC00-2-3.png',
							 'lavender100'=>'PIC00-3.png',
							 /*'lavender25'=>'pic03-8.jpg',*/
							 'lemongrass100'=>'PIC00-4.png',
							 'lemongrass25'=>'PIC00-4-3.png',
							 'magnolia100'=>'PIC00-5.png',
							 /*'magnolia25'=>'pic05-8.jpg',*/							 
							 'cypress100'=>'PIC00-6.png',
							 'cypress25'=>'PIC00-6-3.png',
							 'collagen100'=>'PIC00-7.png',
							 'collagen25'=>'PIC00-7-3.png',
							 'egg100'=>'PIC00-8.png',
							 'egg25'=>'PIC00-8-3.png',
							 'pearl100'=>'PIC00-9.png',
							 'pearl25'=>'PIC00-9-3.png',
							 'SpecialNanoSoap25'=>'pic01-8.jpg',
							 'SpecialPearl25'=>'pic07-8.jpg',
							 'gift_small'=>'pic24-3.jpg',
							 'gift_care'=>'pic24-3.jpg',
							 'gift_energy'=>'pic25-2.jpg',
							 'gift_young'=>'pic25-2.jpg',
							 'set_tender'=>'pic25-2.jpg',
							 'set_candy'=>'pic24-3.jpg'
							 );	
		$productLink=  array('gardenia100'=>'NanoSoap1.php',
							 'gardenia25'=>'NanoSoap2.php',
							 'rose100'=>'NanoSoap1.php',
							 'rose25'=>'NanoSoap2.php',
							 'lavender100'=>'NanoSoap1.php',
							 'lavender25'=>'NanoSoap2.php',
							 'lemongrass100'=>'NanoSoap1.php',
							 'lemongrass25'=>'NanoSoap2.php',
							 'magnolia100'=>'NanoSoap1.php',
							 'magnolia25'=>'NanoSoap2.php',							 
							 'cypress100'=>'NanoSoap1.php',
							 'cypress25'=>'NanoSoap2.php',
							 'collagen100'=>'CollagenSoap.php',
							 'collagen25'=>'CollagenSoap.php',
							 'egg100'=>'EggshellSoap.php',
							 'egg25'=>'EggshellSoap.php',
							 'pearl100'=>'PearlSoap.php',
							 'pearl25'=>'PearlSoap.php',
							 'SpecialNanoSoap25'=>'Activity.php',
							 'SpecialPearl25'=>'Activity.php',
							 'gift_small'=>'#',
							 'gift_care'=>'#',
							 'gift_energy'=>'#',
							 'gift_young'=>'#',
							 'set_tender'=>'gifts_100g.php',
							 'set_candy'=>'gifts_25g.php'
							 );			


?>