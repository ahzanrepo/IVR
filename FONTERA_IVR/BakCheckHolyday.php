<?php
/*$time= date("H:i");
print($timei."\n");
echo "Today is " . date("Y/m/d") . "<br>";
echo "Today is " . date("Y.m.d") . "<br>";
echo "Today is " . date("Y-m-d") . "<br>";
echo "Today is " . date("l");
*/

//Class IsHolyday
//{
require_once("CheckHolyday.php");

//$objHolidayCalander = new IsHolyday();
$date=date("Y-m-d");
//$result = $objHolidayCalander->IsVoicemail($date,"myCSVFile.csv","1:00","13:00");
IsVoicemail($date,"myCSVFile.csv",'06:00','23:00');

//$startTime = strtotime($startTime);
//$endTime  = strtotime($endTime);

function IsVoicemail($date,$holydayFile,$startTime,$endTime)
{
//$startTime = DateTime::createFromFormat("H:i",$startTime);
//strtotime($startTime);
//$endTime  = DateTime::createFromFormat("H:i",$endTime);
//strtotime($endTime);

//	$dateget=getdate();
//	$day = $dateget[weekday];
	$dateget=getdate();
$day =  $dateget['weekday'];

	if ($day != "Saturday" && $day != "Sunday")
	{ //echo $day;
//		$ary = $this->getHoliday($date,$holydayFile);
$ary =getHoliday($date,$holydayFile);
		$t=date("H:i");
		if($ary)
		{
echo "t\n";
$stVal=DateTime::createFromFormat("H:i",$ary[1]); 
//strtotime($ary[1]);
$endVal = DateTime::createFromFormat("H:i",$ary[2]); 
//strtotime($ary[2]);
		//	$t=date("H:i");
			if($t <= $startTime || $endTime <= $t)
			{
				//VOICEMAIL;
                                echo "11111TT\n";
			}
		        elseif($ary[1] <= $t && $t <= $ary[2])
//			if($stVal <= $t && $t <= $endVal)
		        {
				//VOICEMAIL;
				echo "1TT\n";
//			        return "true";
		        }
		        elseif($startTime <= $t && $t <= $ary[1])
//			elseif($startTime <= $t && $t <= $stVal)

		        {
			        //within ofc start time and holyday start time
                                echo "2FF\n";
//				return "false";
		        }
			elseif($ary[2] <= $t && $t <= $endTime)
//                       elseif($endVal <= $t && $t <= $endTime)
                        {
                                //within holyday end time and ofc end time
                                echo "3FF\n";  
//                              return "false";
                        }
			else
			{
                                echo "4TT\n";
//				return "true";
			}

		}
		else
		{
			if ($startTime <= $t && $t <= $endTime)
			{
				//OFC hours
                               echo "5FF\n";
//				return "false";
			}
			else
			{
				//after OFC
                               echo "66TT\n";
//				return "true";
			}
//			echo "RUN>>>>>>>>>>>>>>>>>>>>";
		}
	}
	else
	{
		//Saturday and Sunday
		echo "else";
//		return "true";
	}
}

function getHoliday($d,$fileName)
{
echo $fileName ."--".$d."\n";
	$file = fopen($fileName, 'r');
	while (($line = fgetcsv($file)) !== FALSE) {
	  //$line is an array of the csv elements
	if($line[0]==$d)
	{
	  print_r($line);
	//exit;
//echo $line;

	return $line;
	}
	}
	fclose($file);
}

//}
?>
