<?php

namespace App\Application\DTO\Targets;

final readonly class TargetData
{
    public function __construct(
        public int $id,
        public int $userId,
        public string $name,
        public string $url,
        public bool $isPaused,
        public string $createdAt,
        public string $updatedAt,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->userId,
            'name' => $this->name,
            'url' => $this->url,
            'is_paused' => $this->isPaused,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }
}
