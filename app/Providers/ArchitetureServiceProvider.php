<?php

namespace App\Providers;

use App\Application\Contracts\Shared\TransactionManager;
use App\Application\Contracts\Targets\TargetRepository;
use App\Infrastructure\Persistence\Eloquent\EloquentTargetRepository;
use App\Infrastructure\Support\LaravelTransactionManager;
use Illuminate\Support\ServiceProvider;

class ArchitetureServiceProvider extends ServiceProvider
{
    // #[Override]
    public function register(): void
    {
        $this->app->bind(TargetRepository::class, EloquentTargetRepository::class);
        $this->app->bind(TransactionManager::class, LaravelTransactionManager::class);
        // return parent::register();
    }
}
