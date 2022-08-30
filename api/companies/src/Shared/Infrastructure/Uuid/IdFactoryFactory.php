<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Uuid;

use Ramsey\Uuid\Uuid;

final class IdFactoryFactory
{
    public static function create(): IdFactory
    {
        return new IdFactory(Uuid::getFactory());
    }
}
