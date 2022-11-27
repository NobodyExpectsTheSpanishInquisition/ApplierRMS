<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Queue;

use PhpAmqpLib\Connection\AMQPStreamConnection;

final class RabbitMqQueueClientFactory
{
    public function create(int $port, string $host, string $user, string $password): RabbitMqQueueClient
    {
        AMQPStreamConnection::create_connection([['host' => $host, 'port' => $port, 'user' => $user, 'password' => $password]]);
        $connection = new AMQPStreamConnection($host, $port, $user, $password);
        $channel = $connection->channel();

        $channel->queue_declare();

        return new RabbitMqQueueClient($connection, new AmqpMessageFactory());
    }
}
