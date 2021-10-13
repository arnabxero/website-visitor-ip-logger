<?php 
//Get Visitor IP
$ip=$_SERVER['REMOTE_ADDR'];

//Open Last Visitor's File to replace data to current visitor
$file = fopen('last_visitor.txt','w');


//Content Type Imgage
header("Content-type: image/svg+xml");

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
//echo "Your IP Address is $ip ";
//Print Current Date And Time
//echo "BD Time - ";
//echo $today->format('Y/m/d - h:i:sa');

//Adding Time Date and Zone to Log
$saveTime =  $today->format('Y/m/d          h:i:sa');
fwrite($file2,"          ".$saveTime."          BDT");

//Writing Last visitor file
fwrite($file,'Last Visitor Was '.$ip.", Time Stamp : ".$saveTime." BDT");

// get contents of a URL with curl
function curl_get_contents($url): string
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

// set parameters for the shields.io URL
$params = [
    "label" => $ip,
    "logo" => "none",
    "message" => $saveTime,
    "color" => "purple",
];

// build the URL with an SVG image of the view counter
$url = "https://img.shields.io/static/v1?" . http_build_query($params);

// output the response (svg image)
echo curl_get_contents($url);
 ?> 
