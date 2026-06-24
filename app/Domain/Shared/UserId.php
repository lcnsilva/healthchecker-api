<?php

namespace App\Domain\Shared;

use InvalidArgumentException;

final readonly class UserId {
    public function __construct(public int $value)
    {
        if($this->value <= 0) {
            throw new InvalidArgumentException('User ID must be a positive integer.');
        }
    }
}
