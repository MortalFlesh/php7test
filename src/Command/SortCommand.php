<?php

namespace MF\PHP7Test\Command;

use MF\PHP7Test\Service\{
    Mapper, Parser, SorterInterface
};
use Symfony\Component\Console\{
    Command\Command, Input\InputArgument, Input\InputInterface, Output\OutputInterface, Style\SymfonyStyle
};

class SortCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('sort')
            ->setDescription('Sorts values in coercive mode [default in PHP7]')
            ->addArgument('values', InputArgument::OPTIONAL, 'Values to be sorted');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $style = new SymfonyStyle($input, $output);
        $style->title('Sort command in coercive mode [default]');

        $values = $input->getArgument('values');

        /** @var SorterInterface $sorter */
        $sorter = new class implements SorterInterface
        {
            private $sortType = 'SORT-ASC';

            /** @var SymfonyStyle */
            private $style;

            /**
             * @param SymfonyStyle $style
             */
            public function setStyle(SymfonyStyle $style)
            {
                $this->style = $style;
            }

            /**
             * @param int []
             * @return int[]
             */
            public function sortInts(int ...$ints) : array
            {
                uasort($ints, function (int $a, int $b) : int {
                    $comp = $a <=> $b;

                    if (isset($this->style)) {
                        $this->style->writeln(var_export([
                            'int' => is_int($comp),
                            'bool' => is_bool($comp),
                        ], true));
                    }

                    return $comp;
                });

                return $ints;
            }
        };

        // Style for dumping type of <=> result (uncomment next line if needed)
        //$sorter->setStyle($style);

        $this->noteSortType($style, $sorter);

        if (empty($values)) {
            $style->writeln('Will SORT([3, 2, 1, 4])');
            $style->success($sorter->sortInts(...[3, 2, 1, 4]));

            $style->writeln('Will SORT(3, 2, 1, 4)');
            $style->success($sorter->sortInts(3, 2, 1, 4));

            $style->writeln('Will SORT(3, "2", 1.0, 4)');
            $style->success($sorter->sortInts(3, "2", 1.0, 4));
        } else {
            $parser = new Parser();
            $mapper = new Mapper();

            $style->writeln(sprintf('Will sort values SORT(%s)', $values));
            $numbers = $parser->parseStringsFromStringInput($values);
            $intNumbers = $mapper->mapStringsToInts(...$numbers);

            $style->success($sorter->sortInts(...$intNumbers));
        }
    }

    private function noteSortType(SymfonyStyle $style, SorterInterface $sorter)
    {
        $getSortType = function () {
            return $this->sortType;
        };

        $sortType = $getSortType->call($sorter);

        $style->note(sprintf('SORT method is %s', $sortType));
    }

}
