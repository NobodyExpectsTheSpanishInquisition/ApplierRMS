<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

final class LastName
{
    public function __construct(public readonly string $userLastName)
    {
    }
}
