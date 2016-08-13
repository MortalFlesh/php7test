<?php
declare(strict_types = 1);

namespace MF\PHP7Test\Command;

use Symfony\Component\Console\{
    Command\Command, Input\InputInterface, Output\OutputInterface, Style\SymfonyStyle
};

class RegexCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('regex')
            ->setDescription('Regex command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $style = new SymfonyStyle($input, $output);
        $style->title('Regex command to replace by preg_replace_callback_array()');

        $style->writeln('Patterns /(PHP7)/ and /(!){3}/ for "Hello world from PHP7 test app!!!"');
        $replaced = preg_replace_callback_array(
            [
                '/(PHP7)/' => function (array $matches) {
                    return "\u{1F418} PHP7";
                },
                '/(!){3}/' => function (array $matches) {
                    return " \u{1F604}";
                },
            ],
            'Hello world from PHP7 test app!!!'
        );
        $style->success($replaced);
    }

}
