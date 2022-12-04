<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Event\EventStore;

use JsonException;
use LogicException;

final class EventData
{
    public function __construct(public readonly string $eventData)
    {
        $this->assert($this->eventData);
    }

    private function assert(string $eventData): void
    {
        try {
            json_decode($eventData, false, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new LogicException($e->getMessage());
        }
    }
}
