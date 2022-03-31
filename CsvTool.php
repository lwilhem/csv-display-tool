#!/usr/bin/env php
<?php
require_once __DIR__.'/vendor/autoload.php';

use CsvDisplayTool\Command\DisplayCsvCommand;
use Symfony\Component\Console\Application;


$application = new Application();
$application->add(new DisplayCsvCommand());
try {
    $application->run();
} catch (Exception $e) {
}