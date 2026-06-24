<?php

namespace App\Domain\Target\ValueObjects;

use InvalidArgumentException;

final readonly class TargetName {

    public string $value;

    public function __construct(string $value)
    {
        $name = trim($value);

        if($name === ''){
            throw new InvalidArgumentException('Target name is required');
        }

        if(mb_strlen($name) > 120) {
            throw new InvalidArgumentException('Target name cannot be longer than 120 characters.');
        }

        $this->value = $name;
    }
}
