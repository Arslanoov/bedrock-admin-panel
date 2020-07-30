<?php

declare(strict_types=1);

namespace App\Console\Commands\Cycle;

use Cycle\Migrations\GenerateMigrations;
use Spiral\Database\DatabaseManager;
use Spiral\Tokenizer\ClassLocator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Spiral\Migrations;
use Cycle\Schema;
use Cycle\Annotated;
use Symfony\Component\Finder\Finder;

final class CreateMigrationCommand extends Command
{
    private Migrations\Migrator $migrator;
    private DatabaseManager $dbal;

    /**
     * CreateMigrationCommand constructor.
     * @param Migrations\Migrator $migrator
     * @param DatabaseManager $dbal
     */
    public function __construct(Migrations\Migrator $migrator, DatabaseManager $dbal)
    {
        parent::__construct();
        $this->migrator = $migrator;
        $this->dbal = $dbal;
    }

    protected function configure(): void
    {
        $this
            ->setName('cycle:diff')
            ->setDescription('Automatically create migration')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $finder = (new Finder())->files()->in([__DIR__ . '/../../../../Domain']);
        $classLoader = new ClassLocator($finder);

        $migrator = $this->migrator;
        $dbal = $this->dbal;

        $schema = (new Schema\Compiler())->compile(new Schema\Registry($dbal), [
            new Schema\Generator\ResetTables(),
            new Annotated\Embeddings($classLoader),
            new Annotated\Entities($classLoader),
            new Annotated\MergeColumns(),
            new Schema\Generator\GenerateRelations(),
            new Schema\Generator\ValidateEntities(),
            new Schema\Generator\RenderTables(),
            new Schema\Generator\RenderRelations(),
            new Annotated\MergeIndexes(),
            new GenerateMigrations($migrator->getRepository(), $migrator->getConfig()),
            new Schema\Generator\GenerateTypecast()
        ]);

        $output->writeln('<info>Done!</info>');

        return 0;
    }
}