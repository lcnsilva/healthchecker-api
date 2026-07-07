<?php

namespace App\Providers;

use App\Application\Contracts\Shared\TransactionManager;
use App\Application\Contracts\Targets\TargetRepository;
use Illuminate\Support\ServiceProvider;
use Override;

class ArchitetureServiceProvider extends ServiceProvider
{
    // #[Override]
    public function register(): void
    {
        $this->app->bind(TargetRepository::class);
        $this->app->bind(TransactionManager::class);
        // return parent::register();
    }
}