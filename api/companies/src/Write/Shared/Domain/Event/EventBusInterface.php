<?php

declare(strict_types=1);

namespace App\Write\Shared\Domain\Event;

interface EventBusInterface extends EventQueueInterface
{
    public function dispatch(): void;
}
