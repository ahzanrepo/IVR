<?php

/**
 * @author achintha
 * @copyright 2014
 */

require_once("PHPVoiceLibrary/class.PlayFileAndGetDigits.php");
require_once("PHPVoiceLibrary/class.DialNumber.php");
require_once("config.php");
include_once("WriteLog.php");


$objPlayFile = new PlayFileAndGetDigits();
$wrtLg = new WriteLog();
$wrtLg->WriteFile("menu");

//$objPlayFile->
$calldata = json_decode($HTTP_RAW_POST_DATA,true);

//$calldata = json_decode('{"session":"9618e180-6332-46df-9877-bcbb9c59fd72","direction":"inbound","ani":"3726027093","dnis":"99051000278670","name":"achinthau","result":"none","dev_params":{"result":"6"}}',true);
$wrtLg->WriteFile("menu \t - ".$HTTP_RAW_POST_DATA." - ".date("Y-m-d H:i:s"));

$result= $calldata["result"];
$session = $calldata["session"];
$ani=$calldata["ani"];
$dnis=$calldata["dnis"];
$callerdirection=$calldata["direction"];
$calleridname=$calldata["name"];


$wrtLg->WriteFile("menu \t  result  \t - ".$result." - ".date("Y-m-d H:i:s"));
$wrtLg->WriteFile("menu \t  session \t - ".$session." - ".date("Y-m-d H:i:s"));
$wrtLg->WriteFile("menu \t  ani \t - ".$ani." - ".date("Y-m-d H:i:s"));
$wrtLg->WriteFile("menu \t  dnis \t - ".$dnis." - ".date("Y-m-d H:i:s"));
$wrtLg->WriteFile("menu \t  callerdirection  \t - ".$callerdirection." - ".date("Y-m-d H:i:s"));
$wrtLg->WriteFile("menu \t  calleridname \t - ".$calleridname." - ".date("Y-m-d H:i:s"));
//{"action": "playandgetdigits","file": "Duo_IVR_Menu.wav","nexturl": "http://192.168.1.195/IVR/Process.php","result": "result","errorfile": "","digittimeout": "20","inputtimeout": "100","loops": "2","terminator": "#","strip": "#","maxdigits"3""digits": "1"}
//{"action": "playandgetdigits","file": "Duo_IVR_Menu.wav","nexturl": "http://192.168.1.195/IVR/ivrProcess.php","result": "result","errorfile": "","digittimeout" : 20,"inputtimeout" : 100,"loops" : 2,"terminator" : "#","strip" : "#","maxdigits" : "2","digits" : 1}';

$lines_array = file("PhoneNumber.conf");
//print_r($lines_array);
//print(trim($lines_array[0]));
$dialNumber=trim($lines_array[0]);

$folder=substr($_SERVER['REQUEST_URI'],0,strrpos($_SERVER['REQUEST_URI'],"/")+1);
//$nextURL="http://".$GLOBALS['host'].":".$GLOBALS['port'].$folder.$nextFile;
//print ("MMMMMM--".$nextURL);

$dateget=getdate();
$day =  $dateget['weekday'];
//echo $day;
$time= date("H.i");
if ($day == "Sunday")
{
//dial Exten
  if( (07.00<$time) && ($time<23.00))
  {
  //  print(date("H:i:s"));
//Menue
        $nextURL="ProcessMenu.php";
        $playFile="fon_language_selection.wav";
	$display="LANG_SELECTION";
        $result = PlayFileAndGetDigits($nextURL,$playFile,$display);
        print $result;
  }
  else
  {
//dial exten
	//$result= DirectDial($nextFile,"",$result,"public",$dev_params,"Dial_ext","XML",$ani,$ani,$dialNumber,"true");
        $nextURL="Hangup.php";
        $playFile="fon_close.wav";
	$display="OFC_CLOSED";
        $result = PlayFileAndGetDigits($nextURL,$playFile,$display);
	print $result;
  }

}
elseif ($day == "Saturday")
{
  //     $time= date("H.i");
  if( (07.00<$time) && ($time<23.00))
  {
  //  print(date("H:i:s"));
//Menue
	$nextURL="ProcessMenu.php";
	$playFile="fon_language_selection.wav";
	$display="LANG_SELECTION";
        $result = PlayFileAndGetDigits($nextURL,$playFile,$display);
        print $result;
  }
  else
  {
//dial exten
//        $result= DirectDial($nextFile,"",$result,"public",$dev_params,"Dial_ext","XML",$ani,$ani,$dialNumber,"true");
	$nextURL="Hangup.php";
	$playFile="fon_close.wav";
	$display="OFC_CLOSED";
	$result = PlayFileAndGetDigits($nextURL,$playFile,$display);
        print $result;

  }

}
else
{
   if( (07.00<$time) && ($time<23.00))
   {
//      print(date("H:i:s"));
	$nextURL="ProcessMenu.php";
	//$playFile="FonteraMenu.wav";
	$playFile="fon_language_selection.wav";
	$display="LANG_SELECTION";
        $result = PlayFileAndGetDigits($nextURL,$playFile,$display);
	print $result;
   }
   else
   {
//    $result= DirectDial($nextFile,"",$result,"public",$dev_params,"Dial_ext","XML",$ani,$ani,$dialNumber,"true");
	$nextURL="Hangup.php";
	$playFile="fon_close.wav";
	$display="OFC_CLOSED";
	$result = PlayFileAndGetDigits($nextURL,$playFile,$display);
       	print $result;
   }
}

function PlayFileAndGetDigits($nextURL,$playFile,$display)
        {
        try
          {
               $objPlayFile = new PlayFileAndGetDigits();
//		$nextURL="ProcessMenu.php";

		//$objPlayFile->SetFile("ivr-menu.wav");
		$objPlayFile->SetFile($playFile);
		$objPlayFile->SetNextUrl($nextURL);
		$objPlayFile->SetResult("result");
		$objPlayFile->SetErrorFile("");
		$objPlayFile->SetDigitTimeout("5000");
		$objPlayFile->SetInputTimeout("5000");
		$objPlayFile->SetLoops("3");
		$objPlayFile->SetTerminator("#");
		$objPlayFile->SetStrip("#");
		$objPlayFile->SetMaxDigits(1);
		$objPlayFile->SetDigits(1);
		$objPlayFile->SetEventLog(true);
		$objPlayFile->SetSkillDisplay($display);
		$objPlayFile->SetDisplay($display);
		//$objPlayFile->etResult();
		//print($objPlayFile->GetResult());
                $result = $objPlayFile->GetResult();
                return $result;
                }
                catch (exception $ex)
                {
                        return $ex;
                }
        }


        function DirectDial($nexturl,$app,$result,$context,$params,$display,$dialplan,$callername,$callernumber,$number,$eventLog)
        {
            try
             {
                $dialNum = new DialNumber();

                $dialNum->SetNextUrl($nexturl);
                $dialNum->SetApp("");
                $dialNum->SetResult($result);
                $dialNum->SetContext($context);
                $dialNum->SetParams($params);
                $dialNum->SetDisplay($display);
                $dialNum->SetDialplan($dialplan);
                $dialNum->SetCallerName($callername);
                $dialNum->SetCallerNumber($callernumber);
                $dialNum->SetNumber($number);
                $dialNum->SetEventlog($eventLog);

                $result = $dialNum->GetResult();
                return $result;

             }
            catch(exception $ex)
             {
                return $ex;
             }
        }

?>
 
