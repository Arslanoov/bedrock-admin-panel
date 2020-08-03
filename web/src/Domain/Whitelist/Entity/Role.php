<?php

declare(strict_types=1);

namespace Domain\Whitelist\Entity;

use Webmozart\Assert\Assert;

final class Role
{
    private const ROLES = [
        'visitor', 'member', 'operator', 'default'
    ];

    private string $value;

    /**
     * Role constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $value = strtolower($value);
        Assert::notEmpty($value);
        Assert::string($value);
        Assert::oneOf($value, self::ROLES);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    public function isDefault(): bool
    {
        return $this->value === 'default';
    }

    public static function default(): self
    {
        return new self('default');
    }

    public function __toString()
    {
        return ucfirst($this->value);
    }
}