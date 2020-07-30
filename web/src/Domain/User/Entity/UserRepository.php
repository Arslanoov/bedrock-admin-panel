<?php

declare(strict_types=1);

namespace Domain\User\Entity;

use Cycle\ORM\ORMInterface;
use Cycle\ORM\RepositoryInterface;

final class UserRepository
{
    private ORMInterface $orm;
    private RepositoryInterface $users;

    /**
     * UserRepository constructor.
     * @param ORMInterface $orm
     */
    public function __construct(ORMInterface $orm)
    {
        $this->orm = $orm;
        $this->users = $orm->getRepository(User::class);
    }

    public function findAll(): array
    {
        $users = (array) $this->users->findAll();
        return array_map(function (User $user) {
            return [
                'id' => $user->getId(),
                'login' => $user->getLogin(),
                'status' => $user->getStatus()
            ];
        }, $users);
    }
}