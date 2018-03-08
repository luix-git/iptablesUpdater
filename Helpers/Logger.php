<?php

namespace App\Helpers;


class Logger
{
    protected $logfile;

    public function __construct()
    {
        if(!is_dir(__DIR__ . '/../logs')) {
            mkdir(__DIR__ . '/../logs');
        }

        $this->logfile = __DIR__ . '/../logs/' . date('d.m.Y') . '_iptables_updater.log';
    }

    public function info($text)
    {
        $this->writeLog('INFO', $text);
    }

    public function warning($text)
    {
        $this->writeLog('WARNING', $text);
    }

    public function error($text)
    {
        $this->writeLog('ERROR', $text);
    }

    protected function writeLog($logType, $text)
    {
        $string = '[' . $logType . '] ' . date('d.m.Y H:i:s ') . $text;
        file_put_contents($this->logfile, $string . PHP_EOL, FILE_APPEND);
    }
}
