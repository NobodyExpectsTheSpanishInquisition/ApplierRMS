<?php

declare(strict_types=1);

namespace App\Write\RegisterCompany\Application;

use App\Write\Shared\Application\Cqrs\CommandHandlerInterface;

final class RegisterCompanyHandler implements CommandHandlerInterface
{
    public function __invoke(RegisterCompanyCommand $command): void
    {

    }
}
