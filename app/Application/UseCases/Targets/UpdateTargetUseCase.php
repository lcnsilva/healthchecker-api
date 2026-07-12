<?php

namespace App\Application\UseCases\Targets;

use App\Application\Commands\UpdateTargetCommand;
use App\Application\Contracts\Shared\TransactionManager;
use App\Application\Contracts\Targets\TargetRepository;
use App\Application\DTO\Targets\TargetData;
use App\Application\Exceptions\Targets\TargetNotFound;
use App\Domain\Shared\UserId;
use App\Domain\Target\ValueObjects\TargetId;
use App\Domain\Target\ValueObjects\TargetName;
use App\Domain\Target\ValueObjects\TargetUrl;

final readonly class UpdateTargetUseCase
{
    public function __construct(
        private TargetRepository $targets,
        private TransactionManager $transactions,
    ){}

    public function execute(UpdateTargetCommand $command): TargetData
    {
        return $this->transactions->run( function() use ($command): TargetData {
            $target = $this->targets->findByUser(
                targetId: new TargetId($command->targetId),
                userId: new UserId($command->userId),
            );

            if ($target === null) {
                throw TargetNotFound::forUser();
            }

            $target->rename(new TargetName($command->name));
            $target->changeUrl(new TargetUrl($command->url));
            $command->isPaused ? $target->pause() : $target->resume();

            return $this->targets->save($target);
        });
    }
}
