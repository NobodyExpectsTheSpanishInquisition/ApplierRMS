<?php

declare(strict_types=1);

namespace App\Write\Shared\Domain\Event;

interface EventQueueInterface
{
    public function push(EventInterface $event): void;
}
