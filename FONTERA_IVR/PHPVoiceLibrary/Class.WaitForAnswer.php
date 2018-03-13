<?php

/**
 * @author achintha
 * @copyright 2014
 */

class WaitForAnswer
{
   // private $file="TestRecord_1.wav";
    private $nexturl="http://192.168.1.195/IVR/end.php";
    private $result="result_1234";
    private $params='{"Params_Test":"test"}';
    private $display="DEFAULT";
    private $eventlog=false;
      
    
  public function SetNextUrl($targetUrl)
        {
        
            if( !empty( $targetUrl ) )
        
                $this->nexturl = $targetUrl;      
        }

  public function SetResult($targetResult)
        {
        
            if( !empty( $targetResult ) )
        
               $this->result = $targetResult;    
        } 	
   
   public function SetParams($targetParams)
        {        
            if( !empty( $targetParams ) )
        
               $this->params = $targetparams;
        }
		
   public function SetDisplay($targetDisplay)
        {        
            if( !empty( $targetDisplay ) )
        
               $this->display = $targetdisplay;
        }   
    
        
  public function SetEventLog($targetEventLog)
        {
        
            if( !empty( $targetEventlog ) )
        
                $this->eventlog = $targetEventlog;     
        }
        
      
  function GetResult()
  {
    try
    {
    $jsonStart='{';
    $jsonAction='"action": "waitforanswer",';
    $jsonNextUrl='"nexturl": "'.$this->nexturl.'",';
    $jsonResult='"result": "'.$this->result.'",';
    $jsonParams='"params": "'.$this->params.'",';
    $jsonDisplay='"display": "'.$this->display.'",';
    $jsonEventLog='"eventlog": "'.$this->eventlog.'"';
    $jsonEnd='}';
    
    return $jsonStart.$jsonAction.$jsonNextUrl.$jsonResult.$jsonParams.$jsonDisplay.$jsonEventLog.$jsonEnd;
    }
    catch(exception $ex)
    {
        return $ex; 
    }
  }
    
}

?>
