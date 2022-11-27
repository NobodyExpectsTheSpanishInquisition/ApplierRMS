<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Event;

use App\Shared\Domain\Event\EventInterface;
use App\Shared\Infrastructure\Queue\QueueClientInterface;
use App\Write\Shared\Domain\Event\EventBusInterface;
use App\Write\Shared\Infrastructure\Event\EventStore\EventStore;

final class MessengerEventBus implements EventBusInterface
{
    /**
     * @var array<int, EventInterface> $events
     */
    private array $events = [];

    public function __construct(private readonly EventStore $eventStore, private readonly QueueClientInterface $queue)
    {
    }

    public function dispatch(): void
    {
        foreach ($this->events as $event) {
            $this->eventStore->store($event);
        }

        $this->queue->dispatchEvents($this->events);
    }

    public function push(EventInterface $event): void
    {
        $this->events[] = $event;
    }
}
