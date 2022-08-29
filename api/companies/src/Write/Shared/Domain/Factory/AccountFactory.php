<?php

declare(strict_types=1);

namespace App\Write\Shared\Domain\Factory;

use App\Shared\Domain\ValueObject\AccountId;
use App\Shared\Domain\ValueObject\FirstName;
use App\Shared\Domain\ValueObject\LastName;
use App\Shared\Domain\ValueObject\UserId;
use App\Write\Shared\Domain\Model\Account;

final class AccountFactory
{
    public function create(
        AccountId $accountId,
        UserId $mainUserId,
        FirstName $userFirstName,
        LastName $lastName
    ): Account {
        return new Account($accountId, $mainUserId, $userFirstName, $lastName);
    }
}
