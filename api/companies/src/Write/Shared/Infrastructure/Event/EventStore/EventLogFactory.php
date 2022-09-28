<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Event\EventStore;

use App\Write\Shared\Application\Event\EventIdFactoryInterface;
use App\Write\Shared\Domain\Event\EventInterface;
use App\Write\Shared\Infrastructure\Entity\EventLog;

final class EventLogFactory
{
    public function __construct(
        private readonly EventIdFactoryInterface $eventIdFactory,
        private readonly EventClockInterface $eventClock
    ) {
    }

    public function create(EventInterface $event, EventData $eventData): EventLog
    {
        return new EventLog(
            $this->eventIdFactory->newEventId(),
            $event,
            $eventData,
            $this->eventClock->getDispatchDateTime()
        );
    }
}
