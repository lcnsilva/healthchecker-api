<?php 

namespace App\Infrastructure\Persistence\Eloquent;

use App\Application\Contracts\Targets\TargetRepository;
use App\Application\DTO\Targets\TargetData;
use App\Domain\Shared\UserId;
use App\Domain\Target\Entities\Target;
use App\Domain\Target\ValueObjects\TargetId;
use App\Domain\Target\ValueObjects\TargetName;
use App\Domain\Target\ValueObjects\TargetUrl;
use App\Models\TargetModel;
use Override;

final class EloquentTargetRepository implements TargetRepository
{
    private function toData(TargetModel $model): TargetData
    {
        return new TargetData(
            id: (int) $model->id,
            userId: (int) $model->user_id,
            name: (string) $model->name,
            url: (string) $model->url,
            isPaused: (bool) $model->is_paused,
            createdAt: $model->created_at?->toISOString() ?? '',
            updatedAt: $model->updated_at?->toISOString() ?? '',
        );
    }

    private function toDomain(TargetModel $model): Target
    {
        return new Target(
            id: new TargetId((int) $model->id),
            userId: new UserId((int) $model->user_id),
            name: new TargetName((string) $model->name),
            url: new TargetUrl((string) $model->url),
            isPaused: (bool) $model->is_paused,
        );
    }
    
    public function save(Target $target): TargetData
    {
        $model = $target->id === null ? new TargetModel : TargetModel::query()->findOrFail($target->id->value);

        $model->fill([
            'user_id' => $target->userId->value,
            'name' => $target->name->value,
            'url' => $target->url->value,
            'is_paused' => $target->isPaused
        ]);

        $model->save();
        return $this->toData($model);
    }

    public function findByUser(TargetId $targetId, UserId $userId): ?Target
    {
        $model = TargetModel::query()
            ->whereKey($targetId->value)
            ->where('user_id', $userId->value)
            ->first();
        return $model === null ? null : $this->toDomain($model);
    }

    public function getDataByUser(TargetId $targetId, UserId $userId): ?TargetData
    {
        $model = TargetModel::query()
            ->whereKey($targetId->value)
            ->where('user_id', $userId->value)
            ->first();
        
        return $model === null ? null : $this->toData($model);
    }

    public function listByUser(UserId $userId): array
    {
        return TargetModel::query()
            ->where('user_id', $userId->value)
            ->latest('id')
            ->get()
            ->map(fn (TargetModel $target): TargetData => $this->toData($target))
            ->all();
    }

    public function deleteByUser(TargetId $targetId, UserId $userId): bool
    {
        return TargetModel::query()
            ->whereKey($targetId->value)
            ->where('user_id', $userId->value)
            ->delete() > 0;
    }

}