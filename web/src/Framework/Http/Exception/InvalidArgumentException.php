<?php

declare(strict_types=1);

namespace Framework\Http\Exception;

use InvalidArgumentException as BaseInvalidArgumentException;
use Throwable;

final class InvalidArgumentException extends BaseInvalidArgumentException
{
    public function __construct($message = "", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}