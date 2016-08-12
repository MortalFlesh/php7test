<?php

namespace MF\PHP7Test\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Process;

class ConsoleCommand extends Command
{
    /** @var SymfonyStyle */
    private $style;

    protected function configure()
    {
        $this
            ->setName('console')
            ->setDescription('Runs console for PHP');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->style = new SymfonyStyle($input, $output);
        $this->style->title("\u{1F418} PHP7 Test - Console");

        $this->style->note($this->runProcess('php -v'));
        $this->style->writeln($this->runCommand('list'));

        $answer = $this->style->ask('What command you want to run?', 'exit');

        while ($this->isValidAnswer($answer)) {
            $this->style->section(sprintf('Run command %s', $answer));
            $this->style->writeln($this->runCommand($answer));

            $answer = $this->style->ask('What command you want to run?', 'exit');
        }

        $this->style->success("Have a nice day \u{1F600}");
    }

    private function runProcess(string $commandLine) : string
    {
        $process = new Process($commandLine);
        $process->run();

        return $process->getOutput();
    }

    private function runCommand(string $command) : string
    {
        return $this->runProcess(sprintf('php app.php %s', $command));
    }

    private function isValidAnswer(string $answer) : bool
    {
        return !empty($answer) && !in_array($answer, ['exit', 'quit', 'console'], true);
    }
}
