<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Queue;

use App\Shared\Application\Exception\ApplicationException;
use Exception;
use PhpAmqpLib\Connection\AMQPStreamConnection;

final class RabbitMqQueueClient implements QueueClientInterface
{
    public function __construct(
        private readonly AMQPStreamConnection $connection,
        private readonly AmqpMessageFactory   $amqpMessageFactory
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function dispatchEvents(array $events): void
    {
        $channel = $this->connection->channel();

        foreach ($events as $event) {
            $message = $this->amqpMessageFactory->fromEvent($event);
            $channel->basic_publish($message,'test');
        }

        $channel->close();
        try {
            $this->connection->close();
        } catch (Exception $e) {
            throw new ApplicationException($e->getMessage());
        }
    }
}
