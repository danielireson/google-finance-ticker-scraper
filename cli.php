<?php

require "vendor/autoload.php";

use Classes\Log;
use Classes\Result;
use Classes\Scraper;
use Classes\Validator;

$tickers = $argv;
array_shift($tickers);
Validator::checkTickerArguments($tickers);

$results = new Result;
foreach ($tickers as $ticker) {
    $scraper = new Scraper($ticker);
    $scraper->getPage();
    $price = $scraper->scrapePrice();
    $results->save($ticker, $price);
    unset($scraper);
}
echo "Successfully scraped tickers. \n";
unset($results);

Log::lastRun();
