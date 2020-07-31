<?php

declare(strict_types=1);

namespace App\Console\Commands\Server;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class HelloCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setName('server:docker:hello')
            ->setDescription('Say docker hello command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $content = shell_exec('RET=`docker run hello-world`;echo $RET');

        $output->writeln($content);

        return 0;
    }
}