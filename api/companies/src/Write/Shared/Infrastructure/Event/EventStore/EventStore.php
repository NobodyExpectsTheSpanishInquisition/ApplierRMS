<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Event\EventStore;

use App\Write\Shared\Domain\Event\EventInterface;

final class EventStore
{
    public function __construct(
        private readonly EventSerializerInterface $encoder,
        private readonly EventLogFactory $eventLogFactory,
        private readonly EventLogRepositoryInterface $eventLogRepository,
    ) {
    }

    public function store(EventInterface $event): void
    {
        $serializedEventData = $this->encoder->serialize($event);
        $eventLog = $this->eventLogFactory->create($event, $serializedEventData);

        $this->eventLogRepository->wrapInTransaction(
            function () use ($eventLog): void {
                $this->eventLogRepository->save($eventLog);
            }
        );
    }
}
