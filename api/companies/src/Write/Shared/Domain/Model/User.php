<?php

declare(strict_types=1);

namespace App\Write\Shared\Domain\Model;

use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\FirstName;
use App\Shared\Domain\ValueObject\LastName;
use App\Shared\Domain\ValueObject\UserId;

final class User
{
    public function __construct(
        private readonly UserId $userId,
        private readonly FirstName $firstName,
        private readonly LastName $lastName,
        private readonly Email $email
    ) {
    }
}
