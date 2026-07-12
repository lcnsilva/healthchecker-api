<?php

namespace App\Application\UseCases\Targets;

use App\Application\Contracts\Targets\TargetRepository;
use App\Application\Exceptions\Targets\TargetNotFound;
use App\Application\Queries\Targets\GetTargetQuery;
use App\Domain\Shared\UserId;
use App\Domain\Target\ValueObjects\TargetId;

final readonly class DeleteTargetUseCase
{
    public function __construct(
        private TargetRepository $targets
    ){}

    public function execute(GetTargetQuery $query): void
    {
        $deleted = $this->targets->deleteByUser(
            targetId: new TargetId($query->targetId),
            userId: new UserId($query->userId)
        );

        if(!$deleted) {
            throw TargetNotFound::forUser();
        }
    }
}
