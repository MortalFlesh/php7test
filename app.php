<?php

error_reporting(E_ALL);

use MF\PHP7Test\Command\{
    ConsoleCommand, RegexCommand, SortCommand, SortStrictCommand, SumCommand, SumStrictCommand
};

require __DIR__ . '/vendor/autoload.php';

$application = new \Symfony\Component\Console\Application('PHP7Test', '1.0.0');
$application->add(new ConsoleCommand());
$application->add(new SumCommand());
$application->add(new SumStrictCommand());
$application->add(new SortCommand());
$application->add(new SortStrictCommand());
$application->add(new RegexCommand());

$application->run();
