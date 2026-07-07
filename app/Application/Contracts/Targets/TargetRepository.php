<?php

namespace App\Application\Contracts\Targets;

use App\Application\DTO\Targets\TargetData;
use App\Domain\Shared\UserId;
use App\Domain\Target\Entities\Target;
use App\Domain\Target\ValueObjects\TargetId;

interface TargetRepository
{
    public function save(Target $target): TargetData;
    public function findByUser(TargetId $targetId, UserId $userId): ?Target;
    public function getDataByUser(TargetId $targetId, UserId $userId): ?TargetData;
    public function listByUser(UserId $userId): array;
    public function deleteByUser(TargetId $targetId, UserId $userId): bool;
}