<?php

require 'functions.php';

// Scrape results
$tickers = $argv;
array_shift($tickers);
$stats = [];
foreach ($tickers as $ticker) {
  $url = 'http://www.google.com/finance?&q=' . $ticker;
  $results = curl($url);    
  $scrape1 = scrape_between($results, 'price-panel', '</div>');
  $scrape2 = scrape_between($scrape1, 'class="pr">', 'span>');
  $stats[] = scrape_between($scrape2, '">', '</');
}

// Save to file
$date =  date("Y-m-d");
$now = date("Y-m-d H:i:s");
$file = fopen('results/' . $date . '.csv', 'a');
for ($i = 0; $i < count($stats); $i++) {
  fwrite($file, $now . ',' . $tickers[$i] . ',' . $stats[$i] . "\n");
}
fclose($file);

// Write a last run log file with today's date
$logFile = fopen('last_run.txt', 'w');
fwrite($logFile, $now);
fclose($logFile);
