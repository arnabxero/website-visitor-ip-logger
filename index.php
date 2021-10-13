<?php 
//Get Visitor IP
$ip=$_SERVER['REMOTE_ADDR'];

//Open Last Visitor's File to replace data to current visitor
$file = fopen('last_visitor.txt','w');

//Open Main IP Log File
$file2 = fopen('Total_IP_Log.txt', 'a');
//Add current visitor to IP Log
fwrite($file2, "\n".$ip);

//Get Server Timezone
//$timezone = date_default_timezone_get();

//Get Time of BD Zone
$today = new DateTime("now", new DateTimeZone('Asia/Dhaka') );

//Print Data On Webpage
//Print visitor ip
echo "Your IP Address is $ip ";
//Print Current Date And Time
echo "BD Time - ";
echo $today->format('Y/m/d - h:i:sa');

//Adding Time Date and Zone to Log
$saveTime =  $today->format('Y/m/d          h:i:sa');
fwrite($file2,"          ".$saveTime."          BDT");

//Writing Last visitor file
fwrite($file,'Last Visitor Was '.$ip.", Time Stamp : ".$saveTime." BDT");

 ?> 
