<?php

namespace Classes;

class Scraper 
{
    protected $ticker;
    protected $page;    
    protected $curlResource;
    protected $baseUrl = 'http://www.google.com/finance?&q=';
    protected $returnTransfer = true;
    protected $followLocation = true;
    protected $autoReferer = true;
    protected $connectionTimeout = 120;
    protected $timeout = 120;
    protected $maxRedirs = 10;
    protected $userAgents = [
        'Mozilla/4.0 (compatible; MSIE 7.0; AOL 9.7; AOLBuild 4343.19; Windows NT 5.1; Trident/4.0; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; .NET CLR 3.0.04506.648; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET4.0C; .NET4.0E)',
        'Mozilla/5.0 (Windows; U; MSIE 9.0; WIndows NT 9.0; en-US)',
        'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1a2pre) Gecko/2008073000 Shredder/3.0a2pre ThunderBrowse/3.2.1.8',
        'Mozilla/5.0 Slackware/13.37 (X11; U; Linux x86_64; en-US) AppleWebKit/534.16 (KHTML, like Gecko) Chrome/12.0.742.91'
    ];

    public function __construct($ticker) 
    {
        $this->ticker = $ticker;
        $this->curlResource = curl_init();
    }

    public function __destruct()
    {
        curl_close($this->curlResource);
    }

    public function getPage() 
    {
        curl_setopt_array($this->curlResource, $this->buildOptions());
        $this->page = curl_exec($this->curlResource);
    }

    public function scrapePrice() 
    {
        $scrape1 = $this->scrapeBetween($this->page, 'price-panel', '</div>');
        $scrape2 = $this->scrapeBetween($scrape1, 'class="pr">', 'span>');
        $price = $this->scrapeBetween($scrape2, '">', '</');
        return $price;
    }

    protected function scrapeBetween($data, $start, $end) 
    {
        $data = stristr($data, $start);
        $data = substr($data, strlen($start));
        $stop = stripos($data, $end);
        $data = substr($data, 0, $stop);
        return $data;
    }

    protected function buildOptions() 
    {
        return [
            CURLOPT_RETURNTRANSFER => $this->returnTransfer,
            CURLOPT_FOLLOWLOCATION => $this->followLocation,
            CURLOPT_AUTOREFERER => $this->autoReferer,
            CURLOPT_CONNECTTIMEOUT => $this->connectionTimeout, 
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_MAXREDIRS => $this->maxRedirs,
            CURLOPT_USERAGENT => $this->userAgents[array_rand($this->userAgents)],         
            CURLOPT_URL => $this->baseUrl . $this->ticker,         
        ];
    }
}
