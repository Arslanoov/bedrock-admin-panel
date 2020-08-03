<?php

declare(strict_types=1);

namespace Framework\Http\Exception;

use Exception;
use Throwable;

final class NotFoundException extends Exception
{
    public function __construct($message = "Not found.", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}