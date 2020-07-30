<?php

use Domain\User\Entity\User;
use Cycle\ORM;

return [
    'schemas' => [
        User::class => [
            ORM\Schema::ENTITY      => User::class,
            ORM\Schema::DATABASE    => 'default',
            ORM\Schema::TABLE       => 'user_users',
            ORM\Schema::PRIMARY_KEY => 'id',
            ORM\Schema::COLUMNS     => [
                'id'   => 'id',
                'login' => 'login',
                'status' => 'status'
            ],
            ORM\Schema::TYPECAST    => [
                'id' => 'int'
            ],
            ORM\Schema::RELATIONS   => []
        ]
    ]
];