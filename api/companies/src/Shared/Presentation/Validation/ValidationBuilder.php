<?php

declare(strict_types=1);

namespace App\Shared\Presentation\Validation;

use Exception;
use RuntimeException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class ValidationBuilder implements ValidationBuilderInterface
{
    /**
     * @var array<int, ValidationRule>
     */
    private array $rules;

    public function __construct(private readonly ValidatorInterface $validator)
    {
    }

    public function addValidationRule(ValidationRule $rule): self
    {
        $this->rules[] = $rule;

        return $this;
    }

    public function validate(): void
    {
        $violations = new ConstraintViolationList();
        foreach ($this->rules as $rule) {
            $violations->addAll($this->validator->validate($rule->getValue(), $rule->getConstraints()));
        }

        if (false === $this->wereFoundViolations($violations)) {
            return;
        }

        $this->handleViolations($violations);
    }

    private function wereFoundViolations(ConstraintViolationList $violations): bool
    {
        return 0 !== $violations->count();
    }

    private function handleViolations(ConstraintViolationList $violations): void
    {
        try {
            $messages = array_map(
                static fn(ConstraintViolationInterface $violation): string => sprintf(
                    '%s Value: %s',
                    $violation->getMessage(),
                    $violation->getInvalidValue()
                ),
                $violations->getIterator()->getArrayCopy()
            );
        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }

        throw InvalidRequestException::becauseRulesAreViolated($messages);
    }
}
