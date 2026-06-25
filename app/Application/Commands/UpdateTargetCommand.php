<?php

namespace App\Application\Commands;

final readonly class UpdateTargetCommand
{
    public function __construct(
        public int $targetId,
        public int $userId,
        public string $name,
        public string $url,
        public bool $isPaused,
    ) {}
}