<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Queue;

use PhpAmqpLib\Connection\AMQPStreamConnection;

final class RabbitMqQueueClientFactory
{
    public function create(int $port, string $host, string $user, string $password): RabbitMqQueueClient
    {
        $connection = new AMQPStreamConnection($host, $port, $user, $password);
        $channel = $connection->channel();

        $channel->exchange_declare(RabbitMqConfiguration::EXCHANGE, RabbitMqConfiguration::EXCHANGE_TYPE);

        return new RabbitMqQueueClient($connection, new AmqpMessageFactory());
    }
}
