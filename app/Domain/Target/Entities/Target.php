<?php

use App\Domain\Shared\UserId;
use App\Domain\Target\ValueObjects\TargetId;
use App\Domain\Target\ValueObjects\TargetName;
use App\Domain\Target\ValueObjects\TargetUrl;

final class Target {

    public function __construct(
        public readonly ?TargetID $id,
        public readonly UserId $userId,
        public TargetName $name,
        public TargetUrl $url,
        public bool $isPaused = false
    ){}

    public static function create(UserId $userId, TargetName $targetName, TargetUrl $targetUrl): self
    {
        return new self(
            id: null,
            userId: $userId,
            name: $targetName,
            url: $targetUrl,
            isPaused: false
        );
    }

    public function rename(TargetName $targetName): void {
        $this->name = $targetName;
    }

    public function changeUrl(TargetUrl $targetUrl): void {
        $this->url = $targetUrl;
    }

    public function pause(): void {
        $this->isPaused = true;
    }

    public function resume(): void {
        $this->isPaused = false;
    }
}
