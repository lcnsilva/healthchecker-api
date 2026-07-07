<?php

namespace App\Application\UseCases\Targets;

use App\Application\Commands\CreateTargetCommand;
use App\Application\Contracts\Shared\TransactionManager;
use App\Application\Contracts\Targets\TargetRepository;
use App\Application\DTO\Targets\TargetData;
use App\Domain\Shared\UserId;
use App\Domain\Target\Entities\Target;
use App\Domain\Target\ValueObjects\TargetName;
use App\Domain\Target\ValueObjects\TargetUrl;

final readonly class CreateTargetUseCase
{
    public function __construct(
        private TargetRepository $targets,
        private TransactionManager $transactions
    )
    {}

    public function execute(CreateTargetCommand $command): TargetData
    {
        return $this->transactions->run(function () use ($command): TargetData {
            $target = Target::create(
                userId: new UserId($command->userId),
                name: new TargetName($command->name),
                url: new TargetUrl($command->url),
            );

            return $this->targets->save($target);
        });
    }
}