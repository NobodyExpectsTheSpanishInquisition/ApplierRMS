<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Transaction;

use App\Write\Shared\Application\Transaction\TransactionalRepositoryInterface;
use Closure;
use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractTransactionalRepository implements TransactionalRepositoryInterface
{
    public function __construct(protected EntityManagerInterface $entityManager)
    {
    }

    public function wrapInTransaction(Closure $closure): void
    {
        $this->entityManager->wrapInTransaction($closure);
    }
}
