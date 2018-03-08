<?php

namespace App\Helpers;


class DumpFileHandler
{
    protected $config;
    protected $file;

    public function __construct($config)
    {
        $this->config = $config;
        $this->file = __DIR__ . '/../' . $this->config['file_name'];
    }

    public function isFileExist()
    {
        return file_exists($this->file);
    }

    public function getIpList()
    {
        if ($this->isFileExist($this->file)) {
            return file($this->file, FILE_IGNORE_NEW_LINES);
        } else {
            return [];
        }
    }

    public function putDumpToTheFile(array $dump)
    {
        file_put_contents($this->file, implode(PHP_EOL, $dump));
    }
}
