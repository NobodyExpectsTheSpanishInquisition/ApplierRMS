<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Event\EventStore;

use App\Write\Shared\Application\Transaction\TransactionalRepositoryInterface;
use App\Write\Shared\Infrastructure\Entity\EventLog;

interface EventLogRepositoryInterface extends TransactionalRepositoryInterface
{
    public function save(EventLog $eventLog): void;
}
