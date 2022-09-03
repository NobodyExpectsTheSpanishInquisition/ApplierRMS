<?php

declare(strict_types=1);

namespace App\Shared\Presentation\Validation;

use Symfony\Component\Validator\Constraint;

final class ValidationRule
{
    /**
     * @param array<int, Constraint>
     */
    public function __construct(private readonly mixed $value, private readonly array $constraints)
    {
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function getConstraints(): array
    {
        return $this->constraints;
    }
}
