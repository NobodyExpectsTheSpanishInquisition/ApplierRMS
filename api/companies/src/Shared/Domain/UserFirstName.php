<?php

declare(strict_types=1);

namespace App\Shared\Domain;

final class UserFirstName
{
    public function __construct(public readonly string $userFirstName)
    {
    }
}
