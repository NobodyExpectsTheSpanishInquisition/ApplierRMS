<?php

declare(strict_types=1);

namespace App\Write\Shared\Domain\Model;

use App\Shared\Domain\ValueObject\CompanyId;
use App\Shared\Domain\ValueObject\CompanyName;

final class Company
{
    /**
     * @var array<int, Account> $accounts
     */
    private array $accounts = [];

    public function __construct(
        private readonly CompanyId $companyId,
        private CompanyName $companyName,
        Account $mainAccount
    ) {
        $this->accounts[] = $mainAccount;
    }
}
