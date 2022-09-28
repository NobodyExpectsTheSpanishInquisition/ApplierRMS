<?php

declare(strict_types=1);

namespace App\Write\Shared\Application\Event;

interface EventIdFactoryInterface
{
    public function newEventId(): EventId;
}
