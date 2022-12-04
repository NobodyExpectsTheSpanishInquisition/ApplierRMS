<?php

declare(strict_types=1);

namespace App\Tests\Utils;

use App\Write\Shared\Domain\Event\EventBusInterface;
use App\Shared\Domain\Event\EventInterface;

final class EventBusSpy implements EventBusInterface
{
    /**
     * @var array<int, EventInterface> $events
     */
    private array $events = [];

    public function dispatch(): void
    {
        // Empty implementation
    }

    public function push(EventInterface $event): void
    {
        $this->events[] = $event;
    }

    /**
     * @return array<int, EventInterface>
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    public function getFirstEvent(): EventInterface
    {
        return $this->events[0];
    }
}
