# Google Finance Ticker Scraper
A small tool to be used at command line to scrape ticker prices from Google Finance. It is by no means exhaustive and was wrote in a short amount of time to serve the needs of one of my projects.

## Usage
Call cli.php from the command line with the list of tickers to scrape as arguments. Tickers should be in the form *exchange:ticker*. For example to scrape IBM you would use *NYSE:IBM* and to scrape Alphabet you would use *NASDAQ:GOOGL*. Search for a company on the [Google Finance](https://www.google.co.uk/finance) website if you don't know its ticker or the exchange it is listed on.
``` bash
# using the php cli interface in quiet mode
# use full path to cli.php if the project is not working directory
php -q cli.php NYSE:IBM NASDAQ:GOOGL
```
Results are appended to a daily CSV in the results directory. You are free to set the frequency at which results are appended to this csv by changing the frequency at which you call cli.php.
