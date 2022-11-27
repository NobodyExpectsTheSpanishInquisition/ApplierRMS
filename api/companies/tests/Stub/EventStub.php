<?php

declare(strict_types=1);

namespace App\Tests\Stub;

use App\Shared\Domain\Event\EventInterface;

final class EventStub implements EventInterface
{
    public function __construct(public readonly string $property)
    {
    }
}
