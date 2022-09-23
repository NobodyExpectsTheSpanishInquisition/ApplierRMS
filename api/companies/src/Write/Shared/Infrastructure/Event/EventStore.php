<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Event;

use App\Write\Shared\Domain\Event\EventInterface;

final class EventStore
{
    public function __construct(
        private readonly EventNormalizerInterface $eventNormalizer,
        private readonly EventLogRepositoryInterface $eventLogRepository,
        private readonly EventLogFactory $eventLogFactory
    ) {
    }

    public function store(EventInterface $event): void
    {
        $normalizedEventData = $this->eventNormalizer->normalize($event);
        $eventLog = $this->eventLogFactory->create($event, $normalizedEventData);

        $this->eventLogRepository->save($eventLog);
    }
}
