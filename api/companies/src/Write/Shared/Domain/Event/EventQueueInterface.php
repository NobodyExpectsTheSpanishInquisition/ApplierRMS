<?php

declare(strict_types=1);

namespace App\Write\Shared\Domain\Event;

use App\Shared\Domain\Event\EventInterface;

interface EventQueueInterface
{
    public function push(EventInterface $event): void;
}
