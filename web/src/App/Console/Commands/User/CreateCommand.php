<?php

declare(strict_types=1);

namespace App\Console\Commands\User;

use Cycle\ORM\Transaction;
use Domain\User\Entity\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Throwable;

final class CreateCommand extends Command
{
    private Transaction $transaction;

    /**
     * CreateCommand constructor.
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        parent::__construct();
        $this->transaction = $transaction;
    }

    protected function configure(): void
    {
        $this
            ->setName('user:create')
            ->setDescription('Create User')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws Throwable
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $question = new Question('Login: ');
        $login = $this->getHelper('question')->ask($input, $output, $question);

        $user = new User($login);
        $this->transaction->persist($user);
        $this->transaction->run();

        $output->writeln('<info>Done!</info>');

        return 0;
    }
}