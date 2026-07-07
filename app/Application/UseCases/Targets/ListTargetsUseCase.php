<?php
namespace App\Application\UseCases\Targets;

use App\Application\Contracts\Targets\TargetRepository;
use App\Application\Queries\Targets\ListTargetsQuery;
use App\Domain\Shared\UserId;

final readonly class ListTargetsUseCase
{
    public function __construct(
        private TargetRepository $targets
    ){}
    
    public function execute(ListTargetsQuery $query): array
    {
        return $this->targets->listByUser(new UserId($query->userId));
    }
}