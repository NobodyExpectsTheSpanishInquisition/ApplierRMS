<?php

declare(strict_types=1);

namespace App\Write\Shared\Application\Transaction;

use Closure;

interface TransactionalRepositoryInterface
{
    public function wrapInTransaction(Closure $closure): void;
}
