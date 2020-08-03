<?php

declare(strict_types=1);

namespace Framework\Http\Pipeline;

use Framework\Http\Exception\InvalidArgumentException;

final class UnknownMiddlewareTypeException extends Framework\Http\Exception\InvalidArgumentException
{

}