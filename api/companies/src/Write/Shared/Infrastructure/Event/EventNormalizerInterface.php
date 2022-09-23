<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Event;

use App\Write\Shared\Domain\Event\EventInterface;

interface EventNormalizerInterface
{
    public function normalize(EventInterface $event): string;
}
