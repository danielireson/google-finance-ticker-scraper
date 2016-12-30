<?php

namespace Classes;

class Result
{
    protected $file;

    public function __construct()
    {
        $this->file = fopen('results/' . date("Y-m-d") . '.csv', 'a');
    }

    public function __destruct()
    {
        fclose($this->file);
    }

    public function save($ticker, $price) 
    {
        $row = [
            date('Y-m-d H:i:s'),
            $ticker,
            $price,
        ];
        fwrite($this->file, implode(',', $row) . "\n");
    }
}
