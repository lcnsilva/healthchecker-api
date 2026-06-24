<?php

namespace App\Domain\Target\ValueObjects;

use InvalidArgumentException;

final readonly class TargetId {
    public function __construct(public int $value)
    {
        if($this->value <= 0) {
            throw new InvalidArgumentException('Target id must be a positive integer');
        }
    }
}
