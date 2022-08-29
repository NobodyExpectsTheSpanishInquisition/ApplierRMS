<?php

declare(strict_types=1);

namespace App\Shared\Presentation\Validation;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class InvalidRequestException extends BadRequestHttpException
{
    private const MESSAGE_TEMPLATE = '%d. %s \\n';

    /**
     * @param array<int, string> $violationMessages
     */
    public static function becauseRulesAreViolated(array $violationMessages): self
    {
        $message = '';

        foreach ($violationMessages as $key => $violationMessage) {
            $message .= sprintf(self::MESSAGE_TEMPLATE, $key, $violationMessage);
        }

        return new self($message);
    }
}
