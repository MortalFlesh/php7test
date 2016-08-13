<?php
declare(strict_types = 1);

namespace MF\PHP7Test\Command;

use MF\PHP7Test\Service\{
    Calculator, Mapper, Parser, SorterInterface
};
use Symfony\Component\Console\{
    Command\Command, Input\InputArgument, Input\InputInterface, Output\OutputInterface, Style\SymfonyStyle
};

class SortStrictCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('sort-strict')
            ->setDescription('Sorts values in strict mode')
            ->addArgument('values', InputArgument::OPTIONAL, 'Values to be sorted');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $style = new SymfonyStyle($input, $output);
        $style->title('Sort command in strict mode');

        $values = $input->getArgument('values');

        $sorterReverse = new class implements SorterInterface
        {
            /**
             * @param int []
             * @return int[]
             */
            public function sortInts(int ...$ints) : array
            {
                uasort($ints, function (int $a, int $b) : int {
                    return $b <=> $a;
                });

                return $ints;
            }
        };

        if (empty($values)) {
            $style->writeln('Will RSORT([3, 2, 1, 4])');
            $style->success($sorterReverse->sortInts(...[3, 2, 1, 4]));

            $style->writeln('Will RSORT(3, 2, 1, 4)');
            $style->success($sorterReverse->sortInts(3, 2, 1, 4));

            $style->writeln('Will RSORT(3, "2", 1.0, 4)');
            $style->success($sorterReverse->sortInts(3, "2", 1.0, 4));
        } else {
            $parser = new Parser();
            $mapper = new Mapper();

            $style->writeln(sprintf('Will sort values RSORT(%s)', $values));
            $numbers = $parser->parseStringsFromStringInput($values);
            $intNumbers = $mapper->mapStringsToInts(...$numbers);

            $style->success($sorterReverse->sortInts(...$intNumbers));
        }
    }

}
