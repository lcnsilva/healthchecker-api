<?php

namespace App\Application\Queries\Targets;

final readonly class GetTargetQuery
{
    public function __construct(
        public int $targetId,
        public int $userId,
    ) {}
}
