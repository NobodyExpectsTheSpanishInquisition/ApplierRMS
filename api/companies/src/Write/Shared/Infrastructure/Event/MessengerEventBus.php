<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Event;

use App\Write\Shared\Domain\Event\EventBusInterface;
use App\Write\Shared\Domain\Event\EventInterface;

final class MessengerEventBus implements EventBusInterface
{
    /**
     * @var array<int, \App\Write\Shared\Domain\Event\EventInterface> $events
     */
    private array $events = [];

    public function dispatch(): void
    {
    }

    public function push(EventInterface $event): void
    {
        $this->events[] = $event;
    }
}
