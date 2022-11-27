<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Queue;

use PhpAmqpLib\Connection\AMQPStreamConnection;

final class RabbitMqQueueClient implements QueueClientInterface
{
    public function __construct(
        private readonly AMQPStreamConnection $connection,
        private readonly AmqpMessageFactory $amqpMessageFactory
    ) {
    }

    /**
     * @inheritDoc
     */
    public function dispatchEvents(array $events): void
    {
        $channel = $this->connection->channel();

        foreach ($events as $event) {
            $message = $this->amqpMessageFactory->fromEvent($event);
            $channel->basic_publish($message);
        }

        $channel->close();
        $this->connection->close();
    }
}
