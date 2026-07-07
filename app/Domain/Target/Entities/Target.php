<?php

namespace App\Domain\Target\Entities;

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

    public static function create(UserId $userId, TargetName $name, TargetUrl $url): self
    {
        return new self(
            id: null,
            userId: $userId,
            name: $name,
            url: $url,
            isPaused: false
        );
    }

    public function rename(TargetName $name): void {
        $this->name = $name;
    }

    public function changeUrl(TargetUrl $url): void {
        $this->url = $url;
    }

    public function pause(): void {
        $this->isPaused = true;
    }

    public function resume(): void {
        $this->isPaused = false;
    }
}
