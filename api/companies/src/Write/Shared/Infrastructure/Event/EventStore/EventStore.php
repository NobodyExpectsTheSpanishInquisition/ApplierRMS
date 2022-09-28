<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Event\EventStore;

use App\Write\Shared\Domain\Event\EventInterface;

final class EventStore
{
    public function __construct(
        private readonly EventEncoderInterface $encoder,
        private readonly EventLogRepositoryInterface $eventLogRepository,
        private readonly EventLogFactory $eventLogFactory
    ) {
    }

    public function store(EventInterface $event): void
    {
        $normalizedEventData = $this->encoder->encode($event);
        $eventLog = $this->eventLogFactory->create($event, $normalizedEventData);

        $this->eventLogRepository->save($eventLog);
    }
}
