<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Queue;

use App\Shared\Domain\Event\EventInterface;

interface QueueClientInterface
{
    /**
     * @param array<EventInterface> $events
     */
    public function dispatchEvents(array $events): void;
}
