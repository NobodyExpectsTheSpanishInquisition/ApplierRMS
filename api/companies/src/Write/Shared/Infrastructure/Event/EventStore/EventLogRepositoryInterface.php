<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Event\EventStore;

use App\Write\Shared\Infrastructure\Entity\EventLog;

interface EventLogRepositoryInterface
{
    public function save(EventLog $eventLog): void;
}
