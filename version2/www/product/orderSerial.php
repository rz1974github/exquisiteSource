<?php
	
	define("_SERIAL_FILE","../product/data/serialFile.txt");
	define("_COUNT_FILE","../product/data/special20141231.txt");
		
	function orderSerial()
	{		
		$todaySerial=1;			
		$thisYear = (int)date('Y');
		$thisMonth= (int)date('m');
		$thisDay = (int)date('d');
		
		if(file_exists(_SERIAL_FILE))
		{
			$fp = fopen(_SERIAL_FILE,"r");
			$recYear = (int)fgets($fp);
			$recMonth = (int)fgets($fp);
			$recDay = (int)fgets($fp);
			$recSerial = (int)fgets($fp);
						
			if(($recYear == $thisYear) && ($recMonth == $thisMonth) && ($recDay == $thisDay))
			{
				$todaySerial = $recSerial+1;
				//echo "Equal!<br />";
			}
			else
			{
				//debug
				//echo "not equal!<br />";
			}
			
			fclose($fp);
		}//if
		
		$writeString = $thisYear.PHP_EOL.$thisMonth.PHP_EOL.$thisDay.PHP_EOL.$todaySerial;
		file_put_contents(_SERIAL_FILE,$writeString);
		
		$serialString=sprintf("%04d%02d%02d%05d",$thisYear,$thisMonth,$thisDay,$todaySerial+57);
		
		return $serialString;
	}		
		
	function currentSpecialCount()
	{		
		$recCount=250;
		
		if(file_exists(_COUNT_FILE))
		{
			$fp = fopen(_COUNT_FILE,"r");
			$recCount = (int)fgets($fp);
			fclose($fp);
		}//if
		
		if($recCount<0) $recCount=0;
	
		return $recCount;
	}		
		
	function specialCountDec()
	{		
		$currentCount=currentSpecialCount();
		
		$countString = sprintf("%d",$currentCount-1);
		
		$writeString = $countString.PHP_EOL;
		file_put_contents(_COUNT_FILE,$writeString);
	
		return $countString;
	}		

?>