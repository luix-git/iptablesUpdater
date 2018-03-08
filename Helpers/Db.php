<?php

namespace App\Helpers;


class Db
{
    protected $dbh;
    protected $DbConfig;

    public function __construct($DbConfig)
    {
        $this->DbConfig = $DbConfig;
        $this->connect();
    }

    public function getIpList()
    {
        $query = $this->dbh->prepare('SELECT * FROM ' . $this->DbConfig['table']);

        $query->execute();

        return array_map(
            function ($ipInArray) {
                return $ipInArray['trusted_ip'];
            },
            $query->fetchAll()
        );
    }

    protected function connect()
    {
        $this->dbh = new \PDO(
            'mysql:host=' . $this->DbConfig['host'] . ';port=' . $this->DbConfig['port'] . ';dbname=' . $this->DbConfig['name'],
            $this->DbConfig['user'],
            $this->DbConfig['password']
        );
    }
}