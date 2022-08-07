<?php

declare(strict_types=1);

namespace App\Write\RegisterAccount\Application;

use App\Write\Shared\Application\Cqrs\CommandHandlerInterface;

final class RegisterAccountHandler implements CommandHandlerInterface
{
    public function __invoke(RegisterAccountCommand $command): void
    {

    }
}
