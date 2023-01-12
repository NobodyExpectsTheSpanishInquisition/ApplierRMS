<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Queue;

final class RabbitMqConfiguration
{
    public const EXCHANGE = 'COMPANIES_EXCHANGE';
    public const EXCHANGE_TYPE = 'direct';
}
