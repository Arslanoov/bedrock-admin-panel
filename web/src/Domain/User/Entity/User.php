<?php

declare(strict_types=1);

namespace Domain\User\Entity;

use Cycle\Annotated\Annotation as Cycle;

final class User
{
    private const STATUS_DRAFT = 'Draft';

    /**
     * @Cycle\Column(type="primary")
     */
    private ?int $id = null;
    /**
     * @Cycle\Column(type="string(32)")
     */
    private string $login;
    /**
     * @Cycle\Column(type="string(16)")
     */
    private string $status;

    public function __construct(string $login)
    {
        $this->login = $login;
        $this->status = self::STATUS_DRAFT;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}