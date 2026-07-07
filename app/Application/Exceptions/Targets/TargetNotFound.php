<?php

namespace App\Application\Exceptions;

use RuntimeException;

final class TargetNotFound extends RuntimeException
{
    public static function forUser(): self
    {
        return new self('Target not found for this user.');
    }
}
