<?php

declare(strict_types=1);

namespace App\Write\Shared\Application\Cqrs;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}
