<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TargetModel extends Model
{
    protected function casts(): array
    {
        return [
            'is_paused' => 'boolean'
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}