<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class HelloCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setName('say:hello')
            ->setDescription('Say hello')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<comment>Saying hello...</comment>');
        $output->writeln('Hello!');
        $output->writeln('<info>Done!</info>');

        return 0;
    }
}