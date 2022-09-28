<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Event\EventStore;

use App\Write\Shared\Domain\Event\EventInterface;

interface EventEncoderInterface
{
    public function encode(EventInterface $event): string;
}
