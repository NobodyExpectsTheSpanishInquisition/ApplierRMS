<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

class Uuid
{
    public function __construct(public readonly string $uuid)
    {
    }
}
