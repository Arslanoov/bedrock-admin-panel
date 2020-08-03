<?php

declare(strict_types=1);

namespace Framework\Http\Exception;

use Exception;
use Throwable;

final class AccessDeniedException extends Exception
{
    public function __construct($message = "Access denied.", $code = 403, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}