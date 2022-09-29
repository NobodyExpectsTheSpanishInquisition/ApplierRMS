<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Event\EventStore;

use App\Write\Shared\Application\Transaction\CannotPersistException;
use App\Write\Shared\Infrastructure\Entity\EventLog;
use App\Write\Shared\Infrastructure\Transaction\AbstractTransactionalRepository;

final class EventLogRepository extends AbstractTransactionalRepository implements EventLogRepositoryInterface
{
    public function save(EventLog $eventLog): void
    {
        if (false === $this->entityManager->getConnection()->isTransactionActive()) {
            throw CannotPersistException::becauseTransactionIsNotActive($eventLog::class);
        }

        $this->entityManager->persist($eventLog);
    }
}
