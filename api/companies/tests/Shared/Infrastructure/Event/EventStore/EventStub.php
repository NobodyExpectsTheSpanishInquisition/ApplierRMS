<?php

declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Event\EventStore;

use App\Write\Shared\Domain\Event\EventInterface;

final class EventStub implements EventInterface
{
    public function __construct(public readonly string $property)
    {
    }
}
