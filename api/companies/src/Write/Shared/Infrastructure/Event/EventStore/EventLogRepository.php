<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Event\EventStore;

use App\Write\Shared\Application\Transaction\CannotPersistException;
use App\Write\Shared\Infrastructure\Entity\EventLog;
use Doctrine\ORM\EntityManagerInterface;

final class EventLogRepository implements EventLogRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(EventLog $eventLog): void
    {
        if (false === $this->entityManager->getConnection()->isTransactionActive()) {
            throw CannotPersistException::becauseTransactionIsNotActive($eventLog::class);
        }

        $this->entityManager->persist($eventLog);
    }
}
