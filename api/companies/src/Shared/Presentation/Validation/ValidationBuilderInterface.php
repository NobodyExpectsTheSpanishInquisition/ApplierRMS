<?php

declare(strict_types=1);

namespace App\Shared\Presentation\Validation;

interface ValidationBuilderInterface
{
    public function addValidationRule(ValidationRule $rule): self;

    public function validate(): void;
}
