<?php

date_default_timezone_set('Europe/London');

function curl($url) {
  $rand = rand(1,4);
  switch ($rand) {
    case 1:
      $userAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; AOL 9.7; AOLBuild 4343.19; Windows NT 5.1; Trident/4.0; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; .NET CLR 3.0.04506.648; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET4.0C; .NET4.0E)';
      break;
    case 2:
      $userAgent = 'Mozilla/5.0 (Windows; U; MSIE 9.0; WIndows NT 9.0; en-US)';
      break;
    case 3:
      $userAgent = 'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1a2pre) Gecko/2008073000 Shredder/3.0a2pre ThunderBrowse/3.2.1.8';
      break;  
    case 4:
      $userAgent = 'Mozilla/5.0 Slackware/13.37 (X11; U; Linux x86_64; en-US) AppleWebKit/534.16 (KHTML, like Gecko) Chrome/12.0.742.91';
      break;        
  }
  
  $options = Array(
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_FOLLOWLOCATION => TRUE,
    CURLOPT_AUTOREFERER => TRUE,
    CURLOPT_CONNECTTIMEOUT => 120, 
    CURLOPT_TIMEOUT => 120,
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_USERAGENT => $userAgent,
    CURLOPT_URL => $url,
  );
   
  $ch = curl_init(); 
  curl_setopt_array($ch, $options);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

function scrape_between($data, $start, $end){
  $data = stristr($data, $start);
  $data = substr($data, strlen($start));
  $stop = stripos($data, $end);
  $data = substr($data, 0, $stop);
  return $data;
}