<?php

namespace App\Application\Contracts\Shared;

interface TransactionManager
{
    public function run(callable $callback): mixed;
}
