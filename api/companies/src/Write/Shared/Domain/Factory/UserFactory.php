<?php

declare(strict_types=1);

namespace App\Write\Shared\Domain\Factory;

use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\FirstName;
use App\Shared\Domain\ValueObject\LastName;
use App\Shared\Domain\ValueObject\UserId;
use App\Write\Shared\Domain\Model\User;

final class UserFactory
{
    public function create(
        UserId $userId,
        FirstName $lastName,
        LastName $firstName,
        Email $email
    ): User {
        return new User($userId, $lastName, $firstName, $email);
    }
}
