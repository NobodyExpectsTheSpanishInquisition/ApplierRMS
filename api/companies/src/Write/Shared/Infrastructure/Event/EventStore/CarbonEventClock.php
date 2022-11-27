<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Event\EventStore;

use Carbon\Carbon;
use DateTimeImmutable;

final class CarbonEventClock implements EventClockInterface
{
    private const UTC_TIMEZONE = 'UTC';

    public function getDispatchDateTime(): DateTimeImmutable
    {
        return Carbon::now(self::UTC_TIMEZONE)->toDateTimeImmutable();
    }
}
