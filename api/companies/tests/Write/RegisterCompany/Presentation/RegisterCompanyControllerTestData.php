<?php

declare(strict_types=1);

namespace App\Tests\Write\RegisterCompany\Presentation;

use App\Shared\Domain\ValueObject\CompanyId;
use App\Shared\Domain\ValueObject\CompanyName;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\FirstName;
use App\Shared\Domain\ValueObject\LastName;

final class RegisterCompanyControllerTestData
{
    private const URL = '/api/companies';

    public function getUrl(): string
    {
        return self::URL;
    }

    /**
     * @return array<string, string>
     */
    public function getBody(): array
    {
        return [
            'id' => $this->getCompanyId()->uuid,
            'companyName' => $this->getCompanyName()->companyName,
            'userFirstName' => $this->getUserFirstName()->firstName,
            'userLastName' => $this->getUserLastName()->lastName,
            'userEmail' => $this->getUserEmail()->email,
        ];
    }

    private function getCompanyId(): CompanyId
    {
        return new CompanyId('8EFF399A-E7C2-4D81-B4B2-3ECDAA28B849');
    }

    private function getCompanyName(): CompanyName
    {
        return new CompanyName('Test company');
    }

    private function getUserFirstName(): FirstName
    {
        return new FirstName('User');
    }

    private function getUserLastName(): LastName
    {
        return new LastName('User');
    }

    private function getUserEmail(): Email
    {
        return new Email('user@email.com');
    }
}
