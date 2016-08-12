<?php

namespace MF\PHP7Test\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SumCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('sum')
            ->setDescription('Calculates sum');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $style = new SymfonyStyle($input, $output);
        $style->title('Sum command');

        $style->success('Done');
    }

}
