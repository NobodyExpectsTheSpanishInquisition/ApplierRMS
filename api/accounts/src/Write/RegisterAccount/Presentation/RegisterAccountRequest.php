<?php

declare(strict_types=1);

namespace App\Write\RegisterAccount\Presentation;

use App\Shared\Domain\UserFirstName;
use App\Shared\Domain\ValueObject\AccountId;
use App\Shared\Domain\ValueObject\CompanyName;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\UserLastName;

final class RegisterAccountRequest
{
    public function __construct(
        private readonly string $id,
        private readonly string $companyName,
        private readonly string $userFirstName,
        private readonly string $userLastName,
        private readonly string $userEmail
    ) {
    }

    public function getId(): AccountId
    {
        return new AccountId($this->id);
    }

    public function getCompanyName(): CompanyName
    {
        return new CompanyName($this->companyName);
    }

    public function getUserFirstName(): UserFirstName
    {
        return new UserFirstName($this->userFirstName);
    }

    public function getUserLastName(): UserLastName
    {
        return new UserLastName($this->userLastName);
    }

    public function getUserEmail(): Email
    {
        return new Email($this->userEmail);
    }
}
