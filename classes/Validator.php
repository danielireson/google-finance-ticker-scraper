<?php 

namespace Classes;

class Validator 
{
    protected static $minTickerLength = 1;
    protected static $maxTickerLength = 5;
    protected static $validExchanges = [
        'BCBA',
        'BMV',
        'BVMF',
        'CNSX',
        'CVE',
        'NASDAQ',
        'NYSE',
        'NYSEARCA',
        'NYSEMKT',
        'OPRA',
        'OTCBB',
        'OTCMKTS',
        'TSE',
        'AMS',
        'BIT',
        'BME',
        'CPH',
        'EBR',
        'ELI',
        'EPA',
        'ETR',
        'FRA',
        'HEL',
        'ICE',
        'IST',
        'LON',
        'MCX',
        'RSE',
        'STO',
        'SWX',
        'VTX',
        'TAL',
        'VIE',
        'VSE',
        'WSE',
        'JSE',
        'TADAWUL',
        'TLV',
        'BKK',
        'BOM',
        'KLSE',
        'HKG',
        'IDX',
        'KOSDAQ',
        'KRX',
        'NSE',
        'SGX',
        'SHA',
        'SHA',
        'SHE',
        'TPE',
        'TYO',
        'ASX',
        'NZE',
    ];

    public static function isValidTicker($ticker) 
    {
        $tickerArray = explode(':', $ticker);
        
        // Has picked up both a company ticker and market symbol
        if (count($tickerArray) !== 2) {
            return false;
        }

        // Valid market symbol
        if (!in_array(strtoupper($tickerArray[0]), self::$validExchanges)) {
            return false;
        }

        // Basic length validation on company ticker
        if (strlen($tickerArray[1]) < self::$minTickerLength || strlen($tickerArray[1]) > self::$maxTickerLength) {
            return false;
        }

        return true;
    }

    public static function checkTickerArguments(array $tickers)
    {
        foreach ($tickers as $ticker) {  
            if (!self::isValidTicker($ticker)) {
                echo "You passed an invalid ticker ($ticker). \n";
                die();
            }
        }

        return true;
    }
}
