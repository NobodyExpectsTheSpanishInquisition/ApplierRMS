<?php

declare(strict_types=1);

namespace App\Write\RegisterAccount\Application;

use App\Shared\Domain\UserFirstName;
use App\Shared\Domain\ValueObject\AccountId;
use App\Shared\Domain\ValueObject\CompanyName;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\UserLastName;
use App\Write\Shared\Application\Cqrs\CommandInterface;

final class RegisterAccountCommand implements CommandInterface
{
    public function __construct(
        public readonly AccountId $id,
        public readonly CompanyName $companyName,
        public readonly UserFirstName $userFirstName,
        public readonly UserLastName $userLastName,
        public readonly Email $userEmail)
    {
    }
}
