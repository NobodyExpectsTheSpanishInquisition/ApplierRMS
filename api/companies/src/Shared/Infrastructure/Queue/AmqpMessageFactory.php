<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Queue;

use App\Shared\Domain\Event\EventInterface;
use PhpAmqpLib\Message\AMQPMessage;

final class AmqpMessageFactory
{
    public function fromEvent(EventInterface $event): AMQPMessage
    {
        return new AMQPMessage(json_encode($event));
    }
}
