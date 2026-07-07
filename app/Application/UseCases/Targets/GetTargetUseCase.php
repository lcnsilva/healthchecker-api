<?php

namespace App\Application\UseCases\Targets;

use App\Application\Contracts\Targets\TargetRepository;
use App\Application\DTO\Targets\TargetData;
use App\Application\Exceptions\TargetNotFound;
use App\Application\Queries\Targets\GetTargetQuery;
use App\Domain\Shared\UserId;
use App\Domain\Target\ValueObjects\TargetId;

final readonly class GetTargetUseCase
{
    public function __construct(
        private TargetRepository $targets
    ){}

    public function execute(GetTargetQuery $query): TargetData
    {
        $target = $this->targets->getDataByUser(
            targetId: new TargetId($query->targetId),
            userId: new UserId($query->userId)
        );

        if($target === null) {
            throw TargetNotFound::forUser();
        }

        return $target;
    }
}