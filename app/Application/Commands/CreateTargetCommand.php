<?php

namespace App\Application\Commands;

final readonly class CreateTargetCommand
{
    public function __construct(
        public int $userId,
        public string $name,
        public string $url
    ) {}
}
