<?php

declare(strict_types=1);

namespace App\Write\RegisterCompany\Presentation;

use App\Shared\Domain\FirstName;
use App\Shared\Domain\ValueObject\CompanyId;
use App\Shared\Domain\ValueObject\CompanyName;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\LastName;

final class RegisterCompanyRequest
{
    public function __construct(
        private readonly string $id,
        private readonly string $companyName,
        private readonly string $userFirstName,
        private readonly string $userLastName,
        private readonly string $userEmail
    ) {
    }

    public function getId(): CompanyId
    {
        return new CompanyId($this->id);
    }

    public function getCompanyName(): CompanyName
    {
        return new CompanyName($this->companyName);
    }

    public function getUserFirstName(): FirstName
    {
        return new FirstName($this->userFirstName);
    }

    public function getUserLastName(): LastName
    {
        return new LastName($this->userLastName);
    }

    public function getUserEmail(): Email
    {
        return new Email($this->userEmail);
    }
}
