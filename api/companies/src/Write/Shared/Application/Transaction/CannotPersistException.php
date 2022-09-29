<?php

declare(strict_types=1);

namespace App\Write\Shared\Application\Transaction;

use LogicException;

final class CannotPersistException extends LogicException
{
    /**
     * @param class-string $entityClassname
     */
    public static function becauseTransactionIsNotActive(string $entityClassname): self
    {
        return new self(
            sprintf(
                'Cannot persist entity: %s. Transaction is required. Open transaction and try again.',
                $entityClassname
            )
        );
    }
}
