<?php

use MF\PHP7Test\Command\{
    ConsoleCommand, SumCommand, SumStrictCommand
};

require __DIR__ . '/vendor/autoload.php';

$application = new \Symfony\Component\Console\Application('PHP7Test', '1.0.0');
$application->add(new ConsoleCommand());
$application->add(new SumCommand());
$application->add(new SumStrictCommand());

$application->run();
