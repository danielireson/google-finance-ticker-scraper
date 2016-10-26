# Google Finance Ticker Scraper
A small tool to scrape ticker prices from Google Finance. It is by no means exhaustive and was wrote in a short amount of time to serve the needs of one of my projects.
## Usage
Call scrape.php from the command line with the list of tickers to scrape as arguments. Tickers should be in the form *index:ticker*. For example to scrape IBM you would use *NYSE:IBM* and to scrape SAS you would use *NYSE:SAS*.
``` bash
# using the php cli interface in quiet mode
# use full path to scrape.php if not in the working directory
php -q scrape.php NYSE:IBM NYSE:SAS
```
