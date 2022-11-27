<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Event\EventStore;

use DateTimeImmutable;

interface EventClockInterface
{
    public function getDispatchDateTime(): DateTimeImmutable;
}
