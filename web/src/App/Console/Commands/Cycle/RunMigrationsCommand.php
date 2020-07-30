<?php

declare(strict_types=1);

namespace App\Console\Commands\Cycle;

use Spiral\Migrations\Migrator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class RunMigrationsCommand extends Command
{
    private Migrator $migrator;

    /**
     * RunMigrationsCommand constructor.
     * @param Migrator $migrator
     */
    public function __construct(Migrator $migrator)
    {
        parent::__construct();
        $this->migrator = $migrator;
    }

    protected function configure(): void
    {
        $this
            ->setName('cycle:run')
            ->setDescription('Run migrations')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->migrator->configure();

        while ($this->migrator->run() !== null) { }

        $output->writeln('<info>Done!</info>');

        return 0;
    }
}