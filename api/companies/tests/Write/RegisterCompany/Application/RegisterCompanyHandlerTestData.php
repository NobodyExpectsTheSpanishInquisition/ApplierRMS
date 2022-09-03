<?php

declare(strict_types=1);

namespace App\Tests\Write\RegisterCompany\Application;

use App\Shared\Domain\ValueObject\CompanyId;
use App\Shared\Domain\ValueObject\CompanyName;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\FirstName;
use App\Shared\Domain\ValueObject\LastName;
use App\Write\RegisterCompany\Application\RegisterCompanyCommand;

final class RegisterCompanyHandlerTestData
{
    public function getCommand(): RegisterCompanyCommand
    {
        return new RegisterCompanyCommand(
            $this->getCompanyId(),
            new CompanyName('test company'),
            new FirstName('user'),
            new LastName('user'),
            new Email('user@email.com')
        );
    }

    private function getCompanyId(): CompanyId
    {
        return new CompanyId('96AE120A-A3C0-409C-B904-314DAF374F5B');
    }
}
