<?php

namespace MF\PHP7Test\Command;

use MF\PHP7Test\Service\{
    Calculator, Mapper, Parser
};
use Symfony\Component\Console\{
    Command\Command, Input\InputArgument, Input\InputInterface, Output\OutputInterface, Style\SymfonyStyle
};

class SumCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('sum')
            ->setDescription('Calculates sum in coercive mode [default in PHP7]')
            ->addArgument('values', InputArgument::OPTIONAL, 'Values to be calculated by SUM()');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $style = new SymfonyStyle($input, $output);
        $style->title('Sum command in coercive mode [default]');

        $calculator = new Calculator();

        $values = $input->getArgument('values');

        if (empty($values)) {
            $style->writeln('Will calculate SUM([1, 2, 3, 4])');
            $style->success($calculator->sumInts(...[1, 2, 3, 4]));

            $style->writeln('Will calculate SUM(1, 2, 3, 4)');
            $style->success($calculator->sumInts(1, 2, 3, 4));

            $style->writeln('Will calculate SUM(1.0, "2", 3, 4)');
            $style->success($calculator->sumInts(1.0, '2', 3, 4));
        } else {
            $parser = new Parser();
            $mapper = new Mapper();

            $style->writeln(sprintf('Will calculate SUM(%s)', $values));
            $numbers = $parser->parseStringsFromStringInput($values);
            $intNumbers = $mapper->mapStringsToInts(...$numbers);

            $style->success($calculator->sumInts(...$intNumbers));
        }
    }

}
