<?php

declare(strict_types=1);

namespace App\Write\Shared\Domain\Event;

use App\Write\Shared\Domain\Model\Company;

final class CompanyRegistered implements EventInterface
{
    public function __construct(private readonly Company $company)
    {
    }
}
