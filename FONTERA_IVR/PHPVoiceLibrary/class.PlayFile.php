<?php

/**
 * @author achintha
 * @copyright 2014
 */

class PlayFile
{
    private $file="";
    private $nexturl="http://192.168.1.195/IVR/end.php";
    private $app="";
    private $result="result_1234";
    private $errorFile="";
    private $display="";
    private $digitTimeOut="0";
    private $inputTimeOut="0";
    private $loops="0";
    private $terminator="*";
    private $strip="*";
    private $eventlog=false;
    private $digits="9";
    
    
     
    
  public function SetFile($targetFile)
        {
        
            if( !empty( $targetFile ) )
        
               $this->file = $targetFile;

        }
        
        
  public function SetNextUrl($targetUrl)
        {
        
            if( !empty( $targetUrl ) )
        
               $this->nexturl = $targetUrl;

        }
        
  public function SetApp($targetApp)
        {        
            if( !empty( $targetApp ) )
        
               $this->app = $targetApp;
        }
        
        
  public function SetResult($targetResult)
        {
        
            if( !empty( $targetResult ) )
        
               $this->result = $targetResult;
          
        }
        
  public function SetErrorFile($targetErrorFile)
        {
        
            if( !empty( $targetErrorFile ) )
        
                $this->errorFile = $targetErrorFile;
  
        }

  public function SetDisplay($targetDisplay)
        {

            if( !empty( $targetDisplay ) )

                $this->display = $targetDisplay;

        }
 
       
  public function SetDigitTimeout($targetDigitTimeOut)
        {
        
            if( !empty( $targetDigitTimeOut ) )
        
               $this->digitTimeOut = $targetDigitTimeOut;
          
        }
        
  public function SetInputTimeout($targetInputTimeOut)
        {
        
            if( !empty( $targetInputTimeOut ) )
        
                $this->inputTimeOut = $targetInputTimeOut;  
        }
        
  public function SetLoops($targetLoops)
        {
        
            if( !empty( $targetLoops ) )
        
                $this->loops = $targetLoops;  
        }
        
  public function SetTerminator($targetTerminator)
        {
        
            if( !empty( $targetTerminator ) )
        
                $this->terminator = $targetTerminator;  
        }
        
   public function SetStrip($targetStrip)
        {
        
            if( !empty( $targetStrip ) )
        
                $this->strip = $targetStrip;  
        }

   public function SetEventLog($targetEventLog)
        {

            if( !empty( $targetEventLog ) )

                $this->eventlog = $targetEventLog;
        }

        
   public function SetDigits($targetDigits)
        {
        
            if( !empty( $targetDigits ) )
        
                $this->digits = $targetDigits;
        }
 
    
  function GetResult()
  {
    try
    {
        $jsonStart='{';
        $jsonAction='"action": "play",';
        $jsonFile='"file": "'.$this->file.'",';
        $jsonNextUrl='"nexturl": "'.$this->nexturl.'",';
        $jsonApp='"app": "'.$this->app.'",';
        $jsonResult='"result": "'.$this->result.'",';
        $jsonErrorFile='"errorfile": "'.$this->errorFile.'",';
        $jsonDisplay='"display": "'.$this->display.'",';
        $jsonDigitTimeOut='"digittimeout": "'.$this->digitTimeOut.'",';
        $jsonInputTimeOut='"inputtimeout": "'.$this->inputTimeOut.'",';
        $jsonLoops='"loops": "'.$this->loops.'",';
        $jsonTerminator='"terminator": "'.$this->terminator.'",';
        $jsonStrip='"strip": "'.$this->strip.'",';
        $jsonEventLog='"eventlog": "'.$this->eventlog.'",';
        $jsonDigits='"digits": "'.$this->digits.'"';
        $jsonEnd='}';
        
        return $jsonStart.$jsonAction.$jsonFile.$jsonNextUrl.$jsonApp.$jsonResult.$jsonErrorFile.$jsonDisplay.$jsonDigitTimeOut.$jsonInputTimeOut.$jsonLoops.$jsonTerminator.$jsonStrip.$jsonEventLog.$jsonDigits.$jsonEnd;
    }
    catch(exception $ex)
    {
        return $ex;
    }
  }
    
}

?>
