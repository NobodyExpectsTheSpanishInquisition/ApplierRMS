<?php

declare(strict_types=1);

namespace App\Write\Shared\Domain\Factory;

use App\Shared\Domain\ValueObject\AccountId;
use App\Shared\Domain\ValueObject\CompanyId;
use App\Shared\Domain\ValueObject\CompanyName;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\FirstName;
use App\Shared\Domain\ValueObject\LastName;
use App\Shared\Domain\ValueObject\UserId;
use App\Write\Shared\Domain\Model\Company;

final class CompanyFactory
{
    public function __construct(private readonly AccountFactory $accountFactory)
    {
    }

    public function create(
        CompanyId $companyId,
        CompanyName $companyName,
        AccountId $mainAccountId,
        UserId $mainUserId,
        FirstName $firstName,
        LastName $lastName,
        Email $email
    ): Company {
        return new Company(
            $companyId,
            $companyName,
            $this->accountFactory->create($mainAccountId, $mainUserId, $firstName, $lastName, $email)
        );
    }
}
