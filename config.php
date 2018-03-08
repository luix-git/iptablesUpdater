<?php

return [
    'db' => [
        'host'     => '127.0.0.1',
        'port'     => 30033,
        'name'     => 'mysql',
        'user'     => 'root',
        'password' => 'mysql',
        'table'    => 'ip',
        'column'   => 'trusted_ip'
    ],
    'dump_file' => [
        'file_name' => 'dump_ip'
    ]
];