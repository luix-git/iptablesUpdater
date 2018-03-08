<?php

namespace App;

use App\Helpers\Db;
use App\Helpers\DumpFileHandler;
use App\Helpers\Informer;
use App\Helpers\Logger;
use App\Helpers\Validator;

include __DIR__ . '/Helpers/autoload.php';

$informer = new Informer();
$logger = new Logger;

if (in_array('--fromFile', $argv)) {
    $source = 'file';
} else {
    $source = 'db';
}

$config = array_slice(include (__DIR__ . '/config.php'), 0);

$informer->common('Starting script...');
$logger->info('Starting script...');
$informer->common('Source: "' . $source . '".');
$logger->info('Source: "' . $source . '".');
$informer->common('Getting IP adresses...');

if ($source == 'db') {
    //Get IP addresses from the database
    try {
        $Db = new Db($config['db']);
    } catch (\Throwable $exception) {
        $informer->error('DataBase connection error');
        $logger->error('DataBase connection error.');
        die();
    }
    $ipAdresses = $Db->getIpList();
} else {
    //Get IP addresses from the file
    $dumpFile = new DumpFileHandler($config['dump_file']);
    if (!$dumpFile->isFileExist()) {
        $informer->error('Dump file does not exist');
        $logger->error('Dump file does not exist.');
        die();
    } else {
        $ipAdresses = $dumpFile->getIpList();
    }
}

$informer->common('Founded: ' . count($ipAdresses));
$logger->info('IP\'s Founded: ' . count($ipAdresses));

//Validate IP addresses
foreach ($ipAdresses as $key => $ip) {
    if (!Validator::ip($ip)) {
        $informer->warning('Incorrect IP: ' . $ip);
        unset($ipAdresses[$key]);
    }
}

$informer->common('Validated: ' . count($ipAdresses));
$logger->info('IP\'s Validated: ' . count($ipAdresses));

$informer->success(json_encode(array_values($ipAdresses)));