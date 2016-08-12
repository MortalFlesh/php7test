<?php
declare(strict_types = 1);

use MF\PHP7Test\Command\{
    ConsoleCommand, SumCommand
};

require __DIR__ . '/vendor/autoload.php';

$application = new \Symfony\Component\Console\Application('PHP7Test', '1.0.0');
$application->add(new ConsoleCommand());
$application->add(new SumCommand());

$application->run();
