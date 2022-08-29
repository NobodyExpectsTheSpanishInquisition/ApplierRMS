<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Cqrs;

use App\Write\Shared\Application\Cqrs\CommandBusInterface;
use App\Write\Shared\Application\Cqrs\CommandInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerCommandBus implements CommandBusInterface
{
    public function __construct(private readonly MessageBusInterface $messageBus)
    {
    }

    public function dispatch(CommandInterface $command): void
    {
        $this->messageBus->dispatch($command);
    }
}
