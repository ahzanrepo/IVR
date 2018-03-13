<?php

$str = "Hello world!";
/*print ("\n".stristr($str," ",true)."\n");
print ("\n".trim(strrchr($str," "))."\n");*/
$lines_array = file("PhoneNumber.conf");
//print_r($lines_array);
print(trim($lines_array[0]));
//echo chunk_split($str," ");

?>
