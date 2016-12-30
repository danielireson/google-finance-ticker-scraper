<?php

namespace Classes;

class Log 
{
    public static function lastRun() 
    {
        $file = fopen('results/last_run.txt', 'w');
        fwrite($file, date('Y-m-d H:i:s'));
        fclose($file);
    }
}
