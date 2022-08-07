<?php

declare(strict_types=1);

namespace App\Write\RegisterCompany\Application;

use App\Shared\Domain\FirstName;
use App\Shared\Domain\ValueObject\CompanyId;
use App\Shared\Domain\ValueObject\CompanyName;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\LastName;
use App\Write\Shared\Application\Cqrs\CommandInterface;

final class RegisterCompanyCommand implements CommandInterface
{
    public function __construct(
        public readonly CompanyId $id,
        public readonly CompanyName $companyName,
        public readonly FirstName $firstName,
        public readonly LastName $lastName,
        public readonly Email $email)
    {
    }
}
