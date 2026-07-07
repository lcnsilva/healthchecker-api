<?php

namespace App\Application\Queries\Targets;

final readonly class ListTargetsQuery
{
    public function __construct(public int $userId) {}
}
