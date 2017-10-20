<?php
function server_log($event, $data)
{
    $date    = date("Y-m-d");
    $logname = "logs/" . $date . ".log";
    $ip      = $_SERVER['REMOTE_ADDR'];
    $time    = date("H:i:s");

    $log = $ip . " | " . $time . " | " . $event . " | " . $data . PHP_EOL;

    file_put_contents($logname, $log, FILE_APPEND);
}